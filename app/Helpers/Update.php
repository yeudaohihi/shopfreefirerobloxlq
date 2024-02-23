<?php
/**
 * @author baodev@cmsnt.co
 *
 * @version 1.0.1
 */

namespace App\Helpers;

use Error;
use Helper;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;

class Update
{
  private static $api_url;
  private static $hash_key;
  private static $base_path;
  private static $client_key;

  public function __construct()
  {
    self::$api_url    = 'https://updates.baocms.net/shopnickv3/index.php';
    self::$hash_key   = 'e01cc7e1e3957ff1cec61d5de0b8c964';
    self::$base_path  = base_path('devonly');
    self::$client_key = env('CLIENT_SECRET_KEY', 'e01cc7e1e3957ff1cec61d5de0b8c964');
  }

  public static function enableUpdate()
  {
    return env('SERVER_ALLOW_UPDATE', false);
  }

  public static function currentVersion()
  {
    $version = Helper::getConfig('version_code', 1000);

    return $version;
  }

  public static function latestVersion()
  {
    try {
      $response = Http::get(self::$api_url, ['route' => 'check-update', 'hash' => self::$hash_key, 'secret' => self::$client_key]);

      if ($response->successful()) {
        $data = $response->json();

        return $data['data']['version_code'];
      }

      return self::currentVersion();
    } catch (\Throwable $th) {
      return self::currentVersion();
    }
  }

  public static function checkUpdate()
  {
    $latestVersion = self::latestVersion();

    if ($latestVersion > self::currentVersion()) {
      return $latestVersion;
    }

    return 0;
  }

  public static function downloadUpdate()
  {
    if (!self::enableUpdate()) {
      return false;
    }

    if (self::checkUpdate() === null) {
      return false;
    }

    if (!is_dir(self::$base_path)) {
      mkdir(self::$base_path);
    }

    $filename = md5(time() . rand(0, 9999)) . '.zip';

    $response = Http::get(self::$api_url, [
      'hash'   => self::$hash_key,
      'route'  => 'download-update',
      'secret' => self::$client_key,
    ]);

    if ($response->successful()) {

      $data = $response->json();

      if (isset($data['status']) && $data['status'] === 403) {
        return false;
      }

      $file = self::$base_path . '/' . $filename;

      file_put_contents($file, $response->body());

      return $file;
    }

    return false;
  }

  public static function extractUpdate($file)
  {
    if (!self::enableUpdate()) {
      return false;
    }

    if (!is_file($file)) {
      return false;
    }

    $zip = new \ZipArchive();

    if ($zip->open($file) === true) {
      $zip->extractTo(base_path());
      $zip->close();

      return true;
    }

    return false;
  }

  public static function cleanUpdate()
  {
    if (!self::enableUpdate()) {
      return false;
    }

    if (!is_dir(self::$base_path)) {
      return false;
    }

    $files = glob(self::$base_path . '/*');

    foreach ($files as $file) {
      if (is_file($file)) {
        unlink($file);
      }
    }

    return true;
  }

  public static function runUpdate()
  {
    try {
      // command for update
      $config = \App\Models\Config::where(['name' => 'version_code'])->firstOrNew(['name' => 'version_code']);

      $config->value = self::latestVersion();

      // clear cache
      Artisan::call('cache:clear');
      // clear config
      Artisan::call('config:clear');
      // clear view
      Artisan::call('view:clear');
      // clear route
      Artisan::call('route:clear');
      // clear optimize
      Artisan::call('optimize:clear');
      // regenrate app key
      Artisan::call('key:generate');
      // databases migrate
      Artisan::call('migrate', [
        '--force' => true,
      ]);


      //alter table | add columns
      if (!Schema::hasColumn('groups', 'descr_seo')) {
        Schema::table('groups', function (Blueprint $table) {
          $table->longText('descr_seo')->nullable()->after('descr');
        });
      }

      if (!Schema::hasColumn('groups', 'meta_seo')) {
        Schema::table('groups', function (Blueprint $table) {
          $table->json('meta_seo')->nullable()->after('descr');
        });
      }

      /*
      $table->json('list_skin')->nullable();
      $table->text('raw_skins')->nullable();
      $table->json('list_champ')->nullable();
      $table->text('raw_champions')->nullable();
      */
      if (!Schema::hasColumn('list_items', 'list_skin')) {
        Schema::table('list_items', function (Blueprint $table) {
          $table->json('list_skin')->nullable()->after('priority');
        });
      }

      if (!Schema::hasColumn('list_items', 'raw_skins')) {
        Schema::table('list_items', function (Blueprint $table) {
          $table->text('raw_skins')->nullable()->after('list_skin');
        });
      }

      if (!Schema::hasColumn('list_items', 'list_champ')) {
        Schema::table('list_items', function (Blueprint $table) {
          $table->json('list_champ')->nullable()->after('raw_skins');
        });
      }

      if (!Schema::hasColumn('list_items', 'raw_champions')) {
        Schema::table('list_items', function (Blueprint $table) {
          $table->text('raw_champions')->nullable()->after('list_champ');
        });
      }

      if (!Schema::hasColumn('list_items', 'cf_the_loai')) {
        Schema::table('list_items', function (Blueprint $table) {
          $table->integer('cf_the_loai')->nullable()->after('raw_champions');
        });
      }

      if (!Schema::hasColumn('list_items', 'cf_vip_ingame')) {
        Schema::table('list_items', function (Blueprint $table) {
          $table->integer('cf_vip_ingame')->nullable()->default(0)->after('cf_the_loai');
        });
      }

      if (!Schema::hasColumn('list_items', 'cf_vip_ingame')) {
        Schema::table('list_items', function (Blueprint $table) {
          $table->integer('cf_vip_amount')->nullable()->default(0)->after('cf_vip_ingame');
        });
      }

      // alter table list_items add cost double default 0 not null after image;
      if (!Schema::hasColumn('list_items', 'cost')) {
        Schema::table('list_items', function (Blueprint $table) {
          $table->double('cost')->default(0)->after('image');
        });
      }

      // alter table transactions add cost_amount int default 0 not null after amount;
      if (!Schema::hasColumn('transactions', 'cost_amount')) {
        Schema::table('transactions', function (Blueprint $table) {
          $table->integer('cost_amount')->default(0)->after('amount');
        });
      }

      // alter table list_items modify highlights json null;
      if (Schema::hasColumn('list_items', 'highlights')) {
        Schema::table('list_items', function (Blueprint $table) {
          $table->json('highlights')->nullable()->change();
        });
      }

      // alter table `groups` modify descr longtext null;
      if (Schema::hasColumn('groups', 'descr')) {
        Schema::table('groups', function (Blueprint $table) {
          $table->longText('descr')->nullable()->change();
        });
      }

      // alter table users add balance_2 int default 0 not null after balance_1;
      if (!Schema::hasColumn('users', 'balance_2')) {
        Schema::table('users', function (Blueprint $table) {
          $table->integer('balance_2')->default(0)->after('balance_1');
        });
      }

      /*
      alter table transactions
    modify amount bigint not null;

    alter table transactions
        modify cost_amount bigint default 0 not null;

    alter table transactions
        modify balance_after bigint not null;

    alter table transactions
        modify balance_before bigint not null;
        */

      if (Schema::hasColumn('transactions', 'amount')) {
        Schema::table('transactions', function (Blueprint $table) {
          $table->bigInteger('amount')->change();
        });
      }

      if (Schema::hasColumn('transactions', 'cost_amount')) {
        Schema::table('transactions', function (Blueprint $table) {
          $table->bigInteger('cost_amount')->default(0)->change();
        });
      }

      if (Schema::hasColumn('transactions', 'balance_after')) {
        Schema::table('transactions', function (Blueprint $table) {
          $table->bigInteger('balance_after')->change();
        });
      }

      if (Schema::hasColumn('transactions', 'balance_before')) {
        Schema::table('transactions', function (Blueprint $table) {
          $table->bigInteger('balance_before')->change();
        });
      }

      // alter table invoices modify amount bigint not null;
      if (Schema::hasColumn('invoices', 'amount')) {
        Schema::table('invoices', function (Blueprint $table) {
          $table->bigInteger('amount')->change();
        });
      }

      // invoices
      if (!Schema::hasColumn('invoices', 'trans_id')) {
        Schema::table('invoices', function (Blueprint $table) {
          $table->string('trans_id')->nullable()->after('username');
        });
      }

      // alter table posts add priority int default 0 not null after type;
      if (!Schema::hasColumn('posts', 'priority')) {
        Schema::table('posts', function (Blueprint $table) {
          $table->integer('priority')->default(0)->after('type');
        });
      }

      // alter table invoices add request_id int default 0 not null after currency;
      if (!Schema::hasColumn('invoices', 'request_id')) {
        Schema::table('invoices', function (Blueprint $table) {
          $table->string('request_id')->nullable()->after('currency');
        });
      }

      // alter table users add register_ip varchar(128) null after register_by;
      if (!Schema::hasColumn('users', 'register_ip')) {
        Schema::table('users', function (Blueprint $table) {
          $table->string('register_ip')->nullable()->after('register_by');
        });
      }

      // alter table users add last_action timestamp default current_timestamp() not null after register_ip;
      if (!Schema::hasColumn('users', 'last_action')) {
        Schema::table('users', function (Blueprint $table) {
          $table->timestamp('last_action')->nullable()->after('register_ip');
        });
      }

      // alter table transactions add domain varchar(255) null after username;
      if (!Schema::hasColumn('transactions', 'domain')) {
        Schema::table('transactions', function (Blueprint $table) {
          $table->string('domain')->nullable()->after('username');
        });
      }

      // alter table configs add domain varchar(255) null after value;
      if (!Schema::hasColumn('configs', 'domain')) {
        Schema::table('configs', function (Blueprint $table) {
          $table->string('domain')->nullable()->after('value');
        });
      }

      // remove unique key `name` of configs table
      if (Schema::hasColumn('configs', 'name')) {
        Schema::table('configs', function (Blueprint $table) {
          // check if unique key exists
          $indexExists = collect(DB::select("SHOW INDEXES FROM configs WHERE Key_name = 'configs_name_unique'"))->count();
          if ($indexExists) {
            $table->dropUnique('configs_name_unique');
          }

        });
      }

      // alter table list_items add domain varchar(255) null after price;
      if (!Schema::hasColumn('list_items', 'domain')) {
        Schema::table('list_items', function (Blueprint $table) {
          $table->string('domain')->nullable()->after('price');
        });
      }

      // alter table resource_v2_s add domain varchar(255) null after type;
      if (!Schema::hasColumn('resource_v2_s', 'domain')) {
        Schema::table('resource_v2_s', function (Blueprint $table) {
          $table->string('domain')->nullable()->after('type');
        });
      }

      // alter table notifications add domain varchar(255) null after value;
      if (!Schema::hasColumn('notifications', 'domain')) {
        Schema::table('notifications', function (Blueprint $table) {
          $table->string('domain')->nullable()->after('value');
        });
      }

      // query remove all rows domain=Helper::getDomain()
      // DB::table('configs')->where('domain', Helper::getDomain())->delete();
      // DB::table('noticiations')->where('domain', Helper::getDomain())->delete();

      return $config->save();
    } catch (\Exception $th) {
      throw new Error($th->getMessage());
    } finally {
      self::cleanUpdate();
    }
  }
}
