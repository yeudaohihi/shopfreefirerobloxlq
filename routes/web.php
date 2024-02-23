<?php

use App\Helpers\Update;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Auth::routes();

Route::get('/login/{provider}', [App\Http\Controllers\Auth\SocialController::class, 'redirectToProvider'])->name('auth.social');
Route::get('/login/{provider}/callback', [App\Http\Controllers\Auth\SocialController::class, 'handleProviderCallback'])->name('auth.social.callback');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/set-locale/{locale}', App\Http\Controllers\SetLocaleController::class)->name('set-locale');

// Store Routes -> Accounts
Route::prefix('/tai-khoan')->group(function () {
  Route::get('/{slug}', [App\Http\Controllers\Store\AccountController::class, 'index'])->name('store.account');
  Route::get('/thong-tin/{code}', [App\Http\Controllers\Store\AccountController::class, 'show'])->name('store.account.show');
});

// Store Routes -> AccountsV2
Route::prefix('/tai-khoan-v2')->group(function () {
  Route::get('/{slug}', [App\Http\Controllers\Store\AccountV2Controller::class, 'index'])->name('store.accountv2');
  Route::get('/thong-tin/{code}', [App\Http\Controllers\Store\AccountV2Controller::class, 'show'])->name('store.accountv2.show');
});

// Store Routes -> Items
Route::prefix('/vat-pham')->group(function () {
  Route::get('/{slug}', [App\Http\Controllers\Store\ItemController::class, 'index'])->name('store.item');
  Route::get('/thong-tin/{code}', [App\Http\Controllers\Store\ItemController::class, 'show'])->name('store.item.show');
});

// Store Routes -> Boosting Game
Route::prefix('/cay-thue')->group(function () {
  Route::get('/{slug}', [App\Http\Controllers\Store\BoostingController::class, 'index'])->name('store.boosting');
  Route::get('/thong-tin/{code}', [App\Http\Controllers\Store\BoostingController::class, 'show'])->name('store.boosting.show');
});

// Games Routes -> Spin Quest
Route::prefix('/games')->group(function () {
  // Spin Quest
  Route::get('/spin-quest/{id?}', [App\Http\Controllers\Game\SpinQuestController::class, 'index'])->name('games.spin-quest');
});

// Accounts Routes
Route::middleware('auth')->prefix('/account')->group(function () {
  // Profile Routes
  Route::prefix('/profile')->group(function () {
    Route::get('/', [App\Http\Controllers\Account\ProfileController::class, 'index'])->name('account.profile.index');
    Route::get('/transactions', [App\Http\Controllers\Account\ProfileController::class, 'transactions'])->name('account.profile.transactions');
    Route::post('/update', [App\Http\Controllers\Account\ProfileController::class, 'update'])->name('account.profile.update');
    Route::post('/update-password', [App\Http\Controllers\Account\ProfileController::class, 'updatePassword'])->name('accounts.profile.update-password');
  });
  // Deposit Routes
  Route::prefix('/deposits')->group(function () {
    Route::get('/', [App\Http\Controllers\Account\DepositController::class, 'index'])->name('account.deposits.index');
    Route::get('/card', [App\Http\Controllers\Account\DepositController::class, 'card'])->name('account.deposits.card');
    Route::get('/crypto', [App\Http\Controllers\Account\DepositController::class, 'crypto'])->name('account.deposits.crypto');
    Route::get('/paypal', [App\Http\Controllers\Account\DepositController::class, 'paypal'])->name('account.deposits.paypal');
    Route::get('/perfect-money', [App\Http\Controllers\Account\DepositController::class, 'perfectMoney'])->name('account.deposits.perfect-money');
  });
  // Orders Routes
  Route::prefix('/orders')->group(function () {
    Route::get('/items/{code?}', [App\Http\Controllers\Account\OrderController::class, 'items'])->name('account.orders.items');
    Route::get('/accounts/{code?}', [App\Http\Controllers\Account\OrderController::class, 'accounts'])->name('account.orders.accounts');
    Route::get('/accounts-v2/{code?}', [App\Http\Controllers\Account\OrderController::class, 'accountsV2'])->name('account.orders.accounts-v2');
    Route::get('/boosting-game/{code?}', [App\Http\Controllers\Account\OrderController::class, 'boosting'])->name('account.orders.boosting');
  });
  // Withdraw Routes
  Route::prefix('/withdraws')->group(function () {
    Route::get('/', [App\Http\Controllers\Account\WithdrawController::class, 'index'])->name('account.withdraws.index');
    Route::post('/store', [App\Http\Controllers\Account\WithdrawController::class, 'store'])->name('account.withdraws.store');
  });
});

// Articles Routes
Route::prefix('/news')->group(function () {
  Route::get('/', [App\Http\Controllers\ArticleController::class, 'index'])->name('articles.index');
  Route::get('/{slug}', [App\Http\Controllers\ArticleController::class, 'show'])->name('articles.show');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('/admin')->group(function () {
  // Dashboard
  Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
  Route::get('/update', [App\Http\Controllers\Admin\UpdateController::class, 'index'])->name('admin.update');
  // Settings
  Route::prefix('/settings')->group(function () {
    // GeneralController
    Route::prefix('/general')->group(function () {
      Route::get('/', [App\Http\Controllers\Admin\Settings\GeneralController::class, 'index'])->name('admin.settings.general');
      Route::post('/', [App\Http\Controllers\Admin\Settings\GeneralController::class, 'update'])->name('admin.settings.general.update');
    });
    // ApiController
    Route::prefix('/apis')->group(function () {
      Route::get('/', [App\Http\Controllers\Admin\Settings\ApiController::class, 'index'])->name('admin.settings.apis');
      Route::post('/', [App\Http\Controllers\Admin\Settings\ApiController::class, 'update'])->name('admin.settings.apis.update');
    });
    // NoticeController
    Route::prefix('/notices')->group(function () {
      Route::get('/', [App\Http\Controllers\Admin\Settings\NoticeController::class, 'index'])->name('admin.settings.notices');
      Route::post('/', [App\Http\Controllers\Admin\Settings\NoticeController::class, 'update'])->name('admin.settings.notices.update');
    });
  });
  // Users
  Route::prefix('/users')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users');
    Route::get('/edit/{id}', [App\Http\Controllers\Admin\UserController::class, 'show'])->name('admin.users.show');
    Route::post('/update/{id}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('admin.users.update');
  });
  // Banks
  Route::prefix('/banks/accounts')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\BankController::class, 'index'])->name('admin.banks');
    Route::post('/store', [App\Http\Controllers\Admin\BankController::class, 'store'])->name('admin.banks.store');
    Route::post('/update', [App\Http\Controllers\Admin\BankController::class, 'update'])->name('admin.banks.update');
    Route::post('/delete', [App\Http\Controllers\Admin\BankController::class, 'delete'])->name('admin.banks.delete');
  });
  // Invoices
  Route::prefix('/invoices')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\InvoiceController::class, 'index'])->name('admin.invoices');
    Route::post('/update', [App\Http\Controllers\Admin\InvoiceController::class, 'update'])->name('admin.invoices.update');
    Route::post('/delete', [App\Http\Controllers\Admin\InvoiceController::class, 'delete'])->name('admin.invoices.delete');
  });
  // Cards
  Route::prefix('/cards')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\CardController::class, 'index'])->name('admin.cards');
  });
  // Posts
  Route::prefix('/posts')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\PostController::class, 'index'])->name('admin.posts');
    Route::get('/create', [App\Http\Controllers\Admin\PostController::class, 'create'])->name('admin.posts.create');
    Route::post('/store', [App\Http\Controllers\Admin\PostController::class, 'store'])->name('admin.posts.store');
    Route::get('/edit/{id}', [App\Http\Controllers\Admin\PostController::class, 'show'])->name('admin.posts.show');
    Route::post('/update/{id}', [App\Http\Controllers\Admin\PostController::class, 'update'])->name('admin.posts.update');
    Route::post('/delete', [App\Http\Controllers\Admin\PostController::class, 'delete'])->name('admin.posts.delete');
  });
  // Transactions
  Route::prefix('/transactions')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\TransactionController::class, 'index'])->name('admin.transactions');
  });
  // Histories
  Route::prefix('/histories')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\HistoryController::class, 'index'])->name('admin.histories');
  });

  Route::prefix('/accounts')->group(function () {
    // Accounts/Categories
    Route::prefix('/categories')->group(function () {
      Route::get('/', [App\Http\Controllers\Admin\Account\CategoryController::class, 'index'])->name('admin.accounts.categories');
      Route::post('/store', [App\Http\Controllers\Admin\Account\CategoryController::class, 'store'])->name('admin.accounts.categories.store');
      Route::post('/update', [App\Http\Controllers\Admin\Account\CategoryController::class, 'update'])->name('admin.accounts.categories.update');
      Route::post('/delete', [App\Http\Controllers\Admin\Account\CategoryController::class, 'delete'])->name('admin.accounts.categories.delete');
    });
    // Accounts/Groups -> Categories
    Route::prefix('/groups')->group(function () {
      Route::get('/{id}', [App\Http\Controllers\Admin\Account\GroupController::class, 'index'])->name('admin.accounts.groups');
      Route::get('/{id}/create', [App\Http\Controllers\Admin\Account\GroupController::class, 'create'])->name('admin.accounts.groups.create');
      Route::post('/store', [App\Http\Controllers\Admin\Account\GroupController::class, 'store'])->name('admin.accounts.groups.store');
      Route::get('/{id}/edit/{gid}', [App\Http\Controllers\Admin\Account\GroupController::class, 'edit'])->name('admin.accounts.groups.edit');
      Route::post('/update', [App\Http\Controllers\Admin\Account\GroupController::class, 'update'])->name('admin.accounts.groups.update');
      Route::post('/delete', [App\Http\Controllers\Admin\Account\GroupController::class, 'delete'])->name('admin.accounts.groups.delete');
    });
    // Accounts/Items -> Groups
    Route::prefix('/items')->group(function () {
      Route::get('/{id?}', [App\Http\Controllers\Admin\Account\ItemController::class, 'index'])->name('admin.accounts.items');
      Route::post('/store', [App\Http\Controllers\Admin\Account\ItemController::class, 'store'])->name('admin.accounts.items.store');
      Route::get('/edit/{id}', [App\Http\Controllers\Admin\Account\ItemController::class, 'show'])->name('admin.accounts.items.show');
      Route::post('/update', [App\Http\Controllers\Admin\Account\ItemController::class, 'update'])->name('admin.accounts.items.update');
      Route::post('/delete', [App\Http\Controllers\Admin\Account\ItemController::class, 'delete'])->name('admin.accounts.items.delete');
      Route::post('/delete-list', [App\Http\Controllers\Admin\Account\ItemController::class, 'deleteList'])->name('admin.accounts.items.delete-list');
    });
  });

  // Games
  Route::prefix('/games')->group(function () {
    Route::prefix('/spin-quest')->group(function () {
      Route::get('/', [App\Http\Controllers\Admin\Game\SpinQuestController::class, 'index'])->name('admin.games.spin-quest');
      Route::post('/store', [App\Http\Controllers\Admin\Game\SpinQuestController::class, 'store'])->name('admin.games.spin-quest.store');
      Route::get('/edit/{id}', [App\Http\Controllers\Admin\Game\SpinQuestController::class, 'show'])->name('admin.games.spin-quest.show');
      Route::post('/update', [App\Http\Controllers\Admin\Game\SpinQuestController::class, 'update'])->name('admin.games.spin-quest.update');
      Route::post('/update-prize', [App\Http\Controllers\Admin\Game\SpinQuestController::class, 'updatePrize'])->name('admin.games.spin-quest.update-prize');
      Route::post('/delete', [App\Http\Controllers\Admin\Game\SpinQuestController::class, 'delete'])->name('admin.games.spin-quest.delete');
    });
    // withdraws
    Route::prefix('/withdraws')->group(function () {
      Route::get('/', [App\Http\Controllers\Admin\Game\WithdrawController::class, 'index'])->name('admin.games.withdraws');
      Route::post('/update', [App\Http\Controllers\Admin\Game\WithdrawController::class, 'update'])->name('admin.games.withdraws.update');
      Route::post('/delete', [App\Http\Controllers\Admin\Game\WithdrawController::class, 'delete'])->name('admin.games.withdraws.delete');
    });
  });

  Route::prefix('/accountsv2')->group(function () {
    // Accounts/Categories
    Route::prefix('/categories')->group(function () {
      Route::get('/', [App\Http\Controllers\Admin\AccountV2\CategoryController::class, 'index'])->name('admin.accountsv2.categories');
      Route::post('/store', [App\Http\Controllers\Admin\AccountV2\CategoryController::class, 'store'])->name('admin.accountsv2.categories.store');
      Route::post('/update', [App\Http\Controllers\Admin\AccountV2\CategoryController::class, 'update'])->name('admin.accountsv2.categories.update');
      Route::post('/delete', [App\Http\Controllers\Admin\AccountV2\CategoryController::class, 'delete'])->name('admin.accountsv2.categories.delete');
    });
    // Accounts/Groups -> Categories
    Route::prefix('/groups')->group(function () {
      Route::get('/{id}', [App\Http\Controllers\Admin\AccountV2\GroupController::class, 'index'])->name('admin.accountsv2.groups');
      Route::get('/{id}/create', [App\Http\Controllers\Admin\AccountV2\GroupController::class, 'create'])->name('admin.accountsv2.groups.create');
      Route::post('/store', [App\Http\Controllers\Admin\AccountV2\GroupController::class, 'store'])->name('admin.accountsv2.groups.store');
      Route::get('/{id}/edit/{gid}', [App\Http\Controllers\Admin\AccountV2\GroupController::class, 'edit'])->name('admin.accountsv2.groups.edit');
      Route::post('/update', [App\Http\Controllers\Admin\AccountV2\GroupController::class, 'update'])->name('admin.accountsv2.groups.update');
      Route::post('/delete', [App\Http\Controllers\Admin\AccountV2\GroupController::class, 'delete'])->name('admin.accountsv2.groups.delete');
    });
    // Accounts/Items -> Groups
    Route::prefix('/items')->group(function () {
      Route::get('/{id?}', [App\Http\Controllers\Admin\AccountV2\ItemController::class, 'index'])->name('admin.accountsv2.items');
      Route::post('/store', [App\Http\Controllers\Admin\AccountV2\ItemController::class, 'store'])->name('admin.accountsv2.items.store');
      Route::get('/edit/{id}', [App\Http\Controllers\Admin\AccountV2\ItemController::class, 'show'])->name('admin.accountsv2.items.show');
      Route::post('/update', [App\Http\Controllers\Admin\AccountV2\ItemController::class, 'update'])->name('admin.accountsv2.items.update');
      Route::post('/delete', [App\Http\Controllers\Admin\AccountV2\ItemController::class, 'delete'])->name('admin.accountsv2.items.delete');
    });
    // Accounts/Resources
    Route::prefix('/resources')->group(function () {
      Route::get('/{id?}', [App\Http\Controllers\Admin\AccountV2\ResourceController::class, 'index'])->name('admin.accountsv2.resources');
      Route::post('/store', [App\Http\Controllers\Admin\AccountV2\ResourceController::class, 'store'])->name('admin.accountsv2.resources.store');
      Route::get('/edit/{id}', [App\Http\Controllers\Admin\AccountV2\ResourceController::class, 'show'])->name('admin.accountsv2.resources.show');
      Route::post('/update', [App\Http\Controllers\Admin\AccountV2\ResourceController::class, 'update'])->name('admin.accountsv2.resources.update');
      Route::post('/export', [App\Http\Controllers\Admin\AccountV2\ResourceController::class, 'export'])->name('admin.accountsv2.resources.export');
      Route::post('/delete', [App\Http\Controllers\Admin\AccountV2\ResourceController::class, 'delete'])->name('admin.accountsv2.resources.delete');
    });
  });
  // Items/Categories
  Route::prefix('/items/cateogires')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\Item\CategoryController::class, 'index'])->name('admin.items.categories');
    Route::post('/store', [App\Http\Controllers\Admin\Item\CategoryController::class, 'store'])->name('admin.items.categories.store');
    Route::post('/update', [App\Http\Controllers\Admin\Item\CategoryController::class, 'update'])->name('admin.items.categories.update');
    Route::post('/delete', [App\Http\Controllers\Admin\Item\CategoryController::class, 'delete'])->name('admin.items.categories.delete');
  });
  // Items/Groups -> Categories
  Route::prefix('/items/groups')->group(function () {
    Route::get('/{id}', [App\Http\Controllers\Admin\Item\GroupController::class, 'index'])->name('admin.items.groups');
    Route::post('/store', [App\Http\Controllers\Admin\Item\GroupController::class, 'store'])->name('admin.items.groups.store');
    Route::post('/update', [App\Http\Controllers\Admin\Item\GroupController::class, 'update'])->name('admin.items.groups.update');
    Route::post('/delete', [App\Http\Controllers\Admin\Item\GroupController::class, 'delete'])->name('admin.items.groups.delete');
  });
  // Items/Data -> Groups
  Route::prefix('/items/data')->group(function () {
    Route::get('/{id?}', [App\Http\Controllers\Admin\Item\DataController::class, 'index'])->name('admin.items.data');
    Route::post('/store', [App\Http\Controllers\Admin\Item\DataController::class, 'store'])->name('admin.items.data.store');
    Route::get('/edit/{id}', [App\Http\Controllers\Admin\Item\DataController::class, 'show'])->name('admin.items.data.show');
    Route::post('/update', [App\Http\Controllers\Admin\Item\DataController::class, 'update'])->name('admin.items.data.update');
    Route::post('/delete', [App\Http\Controllers\Admin\Item\DataController::class, 'delete'])->name('admin.items.data.delete');
  });
  // Items/Orders -> Data
  Route::prefix('/items/orders')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\Item\OrderController::class, 'index'])->name('admin.items.orders');
    Route::post('/update', [App\Http\Controllers\Admin\Item\OrderController::class, 'update'])->name('admin.items.orders.update');
    Route::post('/refund', [App\Http\Controllers\Admin\Item\OrderController::class, 'refund'])->name('admin.items.orders.refund');
    Route::post('/delete', [App\Http\Controllers\Admin\Item\OrderController::class, 'delete'])->name('admin.items.orders.delete');
  });
  // Boosting/Categories
  Route::prefix('/boosting/categories')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\Boosting\CategoryController::class, 'index'])->name('admin.boosting.categories');
    Route::post('/store', [App\Http\Controllers\Admin\Boosting\CategoryController::class, 'store'])->name('admin.boosting.categories.store');
    Route::post('/update', [App\Http\Controllers\Admin\Boosting\CategoryController::class, 'update'])->name('admin.boosting.categories.update');
    Route::post('/delete', [App\Http\Controllers\Admin\Boosting\CategoryController::class, 'delete'])->name('admin.boosting.categories.delete');
  });
  // Boosting/Groups -> Categories
  Route::prefix('/boosting/groups')->group(function () {
    Route::get('/{id}', [App\Http\Controllers\Admin\Boosting\GroupController::class, 'index'])->name('admin.boosting.groups');
    Route::post('/store', [App\Http\Controllers\Admin\Boosting\GroupController::class, 'store'])->name('admin.boosting.groups.store');
    Route::post('/update', [App\Http\Controllers\Admin\Boosting\GroupController::class, 'update'])->name('admin.boosting.groups.update');
    Route::post('/delete', [App\Http\Controllers\Admin\Boosting\GroupController::class, 'delete'])->name('admin.boosting.groups.delete');
  });
  // Boosting/Packages -> Groups
  Route::prefix('/boosting/packages')->group(function () {
    Route::get('/{id?}', [App\Http\Controllers\Admin\Boosting\PackageController::class, 'index'])->name('admin.boosting.packages');
    Route::post('/store', [App\Http\Controllers\Admin\Boosting\PackageController::class, 'store'])->name('admin.boosting.packages.store');
    Route::get('/edit/{id}', [App\Http\Controllers\Admin\Boosting\PackageController::class, 'show'])->name('admin.boosting.packages.show');
    Route::post('/update', [App\Http\Controllers\Admin\Boosting\PackageController::class, 'update'])->name('admin.boosting.packages.update');
    Route::post('/delete', [App\Http\Controllers\Admin\Boosting\PackageController::class, 'delete'])->name('admin.boosting.packages.delete');
  });
  // Boosting/Orders -> Packages
  Route::prefix('/boosting/orders')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\Boosting\OrderController::class, 'index'])->name('admin.boosting.orders');
    Route::post('/update', [App\Http\Controllers\Admin\Boosting\OrderController::class, 'update'])->name('admin.boosting.orders.update');
    Route::post('/refund', [App\Http\Controllers\Admin\Boosting\OrderController::class, 'refund'])->name('admin.boosting.orders.refund');
  });
});

// Staff Routes
Route::middleware(['auth', 'collaborator'])->prefix('/staff')->group(function () {
  Route::get('/dashboard', [App\Http\Controllers\Staff\DashboardController::class, 'index'])->name('staff.dashboard');
});

// Cron Routes
Route::prefix('/cron')->group(function () {
  Route::get('/deposit/check', [App\Http\Controllers\Cron\DepositController::class, 'check'])->name('cron.deposit.check');
  Route::match(['post', 'get'], '/deposit/card-callback', [App\Http\Controllers\Cron\DepositController::class, 'cardCallback'])->name('cron.deposit.card-callback');
  Route::get('/run-backup', [App\Http\Controllers\Cron\BackupController::class, 'run'])->name('cron.run-backup');
  Route::get('/deposit/fpayment-callback', [App\Http\Controllers\Cron\DepositController::class, 'fpaymentCallback'])->name('cron.deposit.fpayment-callback');
  Route::get('/deposit/pm-callback', [App\Http\Controllers\Cron\DepositController::class, 'pmCallback'])->name('cron.deposit.pm-callback');

  // artisan
  Route::get('/artisan/init-setup', function () {
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

    return Artisan::output();
  });

  // artisan
  Route::get('/artisan/fix-update', function () {
    $update = Update::runUpdate();

    if ($update) {
      return 'Update thành công';
    }

    return 'Update thất bại';
  });
});
