<?php
/**
 * @author baodev@cmsnt.co
 *
 * @version 1.0.1
 */

use App\Models\History;
use HTMLPurifier as HTMLPurifier;
use HTMLPurifier_Config as HTMLPurifier_Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class Helper
{
  // function for laravel models
  public static function getConfig($name, $default = null, $type = 'config')
  {
    switch ($type) {
      case 'config':

        $config = \App\Models\Config::where('name', $name)->first();

        if ($config) {
          return $config->value;
        } else {
          \App\Models\Config::create(['name' => $name, 'value' => $default]);
        }

        return $default;
      case 'api':
        $config = \App\Models\ApiConfig::where('name', $name)->first();
        if ($config) {
          return $config->value;
        } else {
          \App\Models\ApiConfig::create(['name' => $name, 'value' => $default]);
        }

        return $default;
      default:
        return $default;
    }
  }

  public static function getNotice($name, $default = '')
  {
    $notice = \App\Models\Notification::where('name', $name)->first();

    if ($notice) {
      return $notice->value;
    } else {
      \App\Models\Notification::create(['name' => $name, 'value' => $default]);
    }

    return $default;
  }

  public static function getApiConfig($name, $default = '')
  {
    $config = \App\Models\ApiConfig::where('name', $name)->first();
    if ($config) {
      return $config->value;
    } else {
      \App\Models\ApiConfig::create(['name' => $name, 'value' => $default]);
    }

    return $default;
  }

  public static function addHistory($content, $data = [])
  {
    return History::create([
      'role'       => auth()->user()->role,
      'data'       => $data,
      'content'    => $content,
      'user_id'    => auth()->id(),
      'username'   => auth()->user()->username,
      'ip_address' => request()->ip(),
    ]);
  }

  // function for string

  public static function formatStatus($status, $type = 'html')
  {
    switch (strtolower($status)) {
      case 'paid':
        return $type == 'html' ? '<span class="fw-bold" style="color: #3D30A2">Đã thanh toán</span>' : 'Đã thanh toán';
      case 'unpaid':
        return $type == 'html' ? '<span class="fw-bold" style="color: #2B2A4C">Chưa thanh toán</span>' : 'Chưa thanh toán';
      case 'pending':
        return $type == 'html' ? '<span class="fw-bold" style="color: #FF9130">Chờ xử lý</span>' : 'Chờ xử lý';
      case 'processing':
        return $type == 'html' ? '<span class="fw-bold" style="color: #FF5B22">Đang xử lý</span>' : 'Đang xử lý';
      case 'completed':
        return $type == 'html' ? '<span class="fw-bold" style="color: #3D30A2">Hoàn thành</span>' : 'Hoàn thành';
      case 'cancelled':
        return $type == 'html' ? '<span class="fw-bold" style="color: #000000">Đã bị hủy</span>' : 'Đã bị hủy';
      case 'active':
        return $type == 'html' ? '<span class="fw-bold" style="color: #2D9596">Đang hoạt động</span>' : 'Đang hoạt động';
      case 'inactive':
        return $type == 'html' ? '<span class="fw-bold" style="color: #B31312">Đã khóa</span>' : 'Đã khóa';
      case 'expired':
        return $type == 'html' ? '<span class="fw-bold" style="color: #B31312">Đã hết hạn</span>' : 'Đã hết hạn';
      case 'error':
        return $type == 'html' ? '<span class="fw-bold" style="color: #B31312">Không hợp lệ</span>' : 'Không hợp lệ';
      default:
        return $type == 'html' ? '<span class="fw-bold" style="color: #AF2655">Không xác định</span>' : 'Không xác định';
    }
  }

  public static function formatPrice($price, $currency = '$')
  {
    return number_format($price, 0, ',', '.') . ' ' . $currency;
  }

  public static function formatNumber($number)
  {
    return number_format($number, 0, ',', '.');
  }

  public static function formatTime($time, $format = 'd/m/Y H:i:s')
  {
    return date($format, strtotime($time));
  }

  public static function formatDate($time, $format = 'd/m/Y')
  {
    return date($format, strtotime($time));
  }

  public static function formatTimeAgo($time)
  {
    $time = strtotime($time);
    $diff = time() - $time;

    if ($diff < 60) {
      // if zero
      if ($diff < 0) {
        return 'vừa xong';
      } else {
        return $diff . ' giây trước';
      }
    }
    $diff = round($diff / 60);
    if ($diff < 60) {
      return $diff . ' phút trước';
    }
    $diff = round($diff / 60);
    if ($diff < 24) {
      return $diff . ' giờ trước';
    }
    $diff = round($diff / 24);
    if ($diff < 7) {
      return $diff . ' ngày trước';
    }
    $diff = round($diff / 7);
    if ($diff < 4) {
      return $diff . ' tuần trước';
    }

    return date('d/m/Y H:i:s', $time);
  }

  public static function formatTransType($type)
  {
    switch (strtolower($type)) {
      case 'deposit':
        return 'Nạp tiền';
      default:
        return strtoupper($type);
    }
  }

  public static function randomString($length = 10, $uppercase = false)
  {
    $characters       = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString     = '';
    for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    return $uppercase ? strtoupper($randomString) : $randomString;
  }

  public static function randomNumber($length = 10)
  {
    $characters       = '0123456789';
    $charactersLength = strlen($characters);
    $randomString     = '';
    for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    return $randomString;
  }

  public static function parseOrderId($string, $prefix)
  {
    $re = '/' . $prefix . '\w+/im';
    preg_match_all($re, $string, $matches, PREG_SET_ORDER, 0);
    if (count($matches) == 0) {
      return null;
    }

    // Print the entire match result
    $orderCode    = $matches[0][0];
    $prefixLength = strlen($prefix);
    $orderId      = intval(substr($orderCode, $prefixLength));

    return $orderId;
  }

  public static function parseOrderName($string, $prefix)
  {
    $re = '/' . $prefix . '\w+/im';
    preg_match_all($re, $string, $matches, PREG_SET_ORDER, 0);
    if (count($matches) == 0) {
      return null;
    }

    // Print the entire match result
    $orderCode    = $matches[0][0];
    $prefixLength = strlen($prefix);
    $orderId      = substr($orderCode, $prefixLength);

    return $orderId;
  }

  public static function hideUsername($string, $length = 3)
  {
    if (strlen($string) <= $length) {
      return $string;
    }

    $string = substr($string, 0, $length) . str_repeat('*', strlen($string) - $length);

    return $string;
  }

  public static function hideEmail($string, $length = 3)
  {
    $email = explode('@', $string);
    $email = substr($email[0], 0, $length) . str_repeat('*', strlen($email[0]) - $length) . '@' . $email[1];

    return $email;
  }

  public static function htmlPurifier($dirty_html)
  {
    $config   = HTMLPurifier_Config::createDefault();
    $purifier = new HTMLPurifier($config);
    // Cho phép sử dụng các đường dẫn ảnh dạng data URI (base64)
    $config->set('URI.AllowedSchemes', ['data' => true, 'http' => true, 'https' => true]);

    // Khởi tạo đối tượng HTMLPurifier với cấu hình đã tạo
    $purifier = new HTMLPurifier($config);

    // Sử dụng HTMLPurifier để làm sạch mã HTML
    $clean_html = $purifier->purify($dirty_html);

    return $clean_html;
  }

  // function for datetime
  public static function getRemainingHours($end, $format = '%hh %m %s')
  {
    $end = !strtotime($end) ? date('Y-m-d H:i:s', $end) : $end;

    $startDate = new \DateTime();
    $endDate   = new DateTime($end);

    if ($startDate > $endDate) {
      return sprintf($format, 0, 0, 0);
    }

    $diff    = $endDate->diff($startDate);
    $days    = $diff->days;
    $hours   = $diff->h;
    $minutes = $diff->i;
    $seconds = $diff->s;

    $totalSeconds = $days * 86400 + $hours * 3600 + $minutes * 60 + $seconds;
    $diffDays     = floor($totalSeconds / 86400);
    $diffHours    = floor(($totalSeconds - $diffDays * 86400) / 3600);
    $diffMinutes  = floor(($totalSeconds - $diffDays * 86400 - $diffHours * 3600) / 60);

    return str_replace(['%d', '%h', '%m', '%s'], [$diffDays, $diffHours, $diffMinutes, $seconds], $format);
  }

  public static function getRemainingDays($end, $format = '%dd %hh')
  {
    $end = !strtotime($end) ? date('Y-m-d H:i:s', $end) : $end;

    $startDate = new \DateTime();
    $endDate   = new DateTime($end);

    if ($startDate > $endDate) {
      return sprintf($format, 0, 0, 0);
    }

    $diff    = $endDate->diff($startDate);
    $days    = $diff->days;
    $hours   = $diff->h;
    $minutes = $diff->i;
    $seconds = $diff->s;

    $totalSeconds = $days * 86400 + $hours * 3600 + $minutes * 60 + $seconds;
    $diffDays     = floor($totalSeconds / 86400);
    $diffHours    = floor(($totalSeconds - $diffDays * 86400) / 3600);
    $diffMinutes  = floor(($totalSeconds - $diffDays * 86400 - $diffHours * 3600) / 60);

    return sprintf($format, $diffDays, $diffHours, $diffMinutes);
  }

  public static function getTimeAgo($timestamp)
  {
    $lang = currentLang();

    $time = strtotime($timestamp) ? strtotime($timestamp) : $timestamp;
    // $time  = time() - $time_ago;

    $time_difference = time() - $time;

    if ($time_difference < 1) {
      return $lang === 'vn' ? 'vừa xong' : 'just now';
    }
    $condition = [
      12 * 30 * 24 * 60 * 60 => ($lang === 'vn' ? 'năm' : 'year'),
      30 * 24 * 60 * 60 => ($lang === 'vn' ? 'tháng' : 'month'),
      24 * 60 * 60 => ($lang === 'vn' ? 'ngày' : 'day'),
      60 * 60 => ($lang === 'vn' ? 'giờ' : 'hour'),
      60                     => ($lang === 'vn' ? 'phút' : 'minute'),
      1                      => ($lang === 'vn' ? 'giây' : 'second'),
    ];

    foreach ($condition as $secs => $str) {
      $d = $time_difference / $secs;

      if ($d >= 1) {
        $t = round($d);

        return $t . ' ' . $str . ' ' . ($lang === 'vn' ? 'trước' : 'ago');
      }
    }
  }

  // function convert timezone to new timezone
  public static function convertTimezone($time, $from = 'UTC', $timezone = 'Asia/Ho_Chi_Minh')
  {
    $date = new DateTime($time, new DateTimeZone($from));
    $date->setTimezone(new DateTimeZone($timezone));

    return $date->format('Y-m-d H:i:s');
  }

  // function convert number to currency
  public static function formatCurrency($number, $currency = 'VND')
  {
    $currency = strtoupper($currency);
    switch ($currency) {
      case 'VND':
        return number_format($number, 0, ',', '.') . ' ₫';
      case 'USD':
        return '$' . number_format($number, 2, '.', ',');
      default:
        return number_format($number, 0, ',', '.') . ' ₫';
    }
  }

  // function for server
  public static function getDomain()
  {
    return $_SERVER['HTTP_HOST'] ?? '';
  }

  public static function getHostname()
  {
    return $_SERVER['HTTP_HOST'] ?? '';
  }

  public static function getIp()
  {
    $ip = request()->ip();

    if (request()->header('CF-Connecting-IP')) {
      $ip = request()->header('CF-Connecting-IP');
    }

    return $ip;
  }

  public static function getBrowser()
  {
    return request()->header('User-Agent');
  }

  // function for http request
  public static function curlGet($url)
  {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $output = curl_exec($ch);
    curl_close($ch);

    return $output;
  }

  public static function curlPost($url, $data = [])
  {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec($ch);
    curl_close($ch);

    return $server_output;
  }

  public static function sendMessageTelegram($message, $chat_id, $token)
  {
    $url     = 'https://api.telegram.org/bot' . $token . '/sendMessage';
    $data    = [
      'chat_id' => $chat_id,
      'text'    => $message,
    ];
    $options = [
      'http' => [
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        'method'  => 'POST',
        'content' => http_build_query($data),
      ],
    ];
    $context = stream_context_create($options);
    $result  = file_get_contents($url, false, $context);
    if ($result === false) {
      return false;
    } else {
      $json = json_decode($result);
      if ($json->ok) {
        return true;
      } else {
        return false;
      }
    }
  }

  // function for upload
  public static function uploadFile($file, $provider = 'public', $path = null)
  {
    switch ($provider) {
      case 'imgur':
        return self::uploadImgur($file->getContent());
      case 'public':
        return self::uploadPublic($file, $path);
      default:
        return null;
    }
  }

  public static function deleteFile($path)
  {
    try {
      $location = public_path($path);

      if (file_exists($location)) {
        unlink($location);
      }

      return true;
    } catch (\Throwable $th) {
      //throw $th;
      return false;
    }
  }

  public static function uploadPublic($file, $path = null)
  {
    if ($file->isValid()) {
      // Store the image
      $fileExt  = $file->extension();
      $filePath = 'uploads/' . date('d-m-Y');
      $fileName = str()->uuid() . '.' . $fileExt;

      if ($path) {
        $filePath = $filePath . '/' . $path;
      }

      $file->move($filePath, $fileName);

      return '/' . ($filePath . '/' . $fileName);
    }

    return null;
  }

  public static function uploadImgur($file)
  {
    $client_id     = '86e171e4f20f914';
    $client_secret = 'cd9540ff7140fe4210350816a44db7b4ab95fd95';

    $result = Http::withHeaders([
      'Authorization' => 'Client-ID ' . $client_id,
    ])
      ->post('https://api.imgur.com/3/image', ['image' => base64_encode($file)])
      ->json();

    if ($result['success'] === true) {

      return $result['data']['link'];
    }

    return null;
  }

  // function send mail
  public static function sendMail($data)
  {
    $to          = $data['to'] ?? '';
    $subject     = $data['subject'] ?? '';
    $body        = $data['body'] ?? $data['content'] ?? '';
    $from        = $data['from'] ?? '';
    $fromName    = $data['fromName'] ?? '';
    $cc          = $data['cc'] ?? null;
    $bcc         = $data['bcc'] ?? '';
    $replyTo     = $data['replyTo'] ?? '';
    $replyToName = $data['replyToName'] ?? '';
    $attachments = $data['attachments'] ?? [];
    $headers     = $data['headers'] ?? [];

    try {
      self::sendMailNow($to, $subject, $body, $from, $fromName, $cc, $bcc, $replyTo, $replyToName, $attachments, $headers);

      return true;
    } catch (\Throwable $th) {
      // throw $th;
      return false;
    }
  }

  private static function sendMailNow($to, $subject, $body, $from = null, $fromName = null, $cc = null, $bcc = null, $replyTo = null, $replyToName = null, $attachments = null, $headers = null)
  {
    $smtp = self::getApiConfig('smtp_detail');

    if ($smtp) {
      config([
        'mail.mailers.smtp.host'       => $smtp['host'],
        'mail.mailers.smtp.port'       => $smtp['port'],
        'mail.mailers.smtp.encryption' => 'tls',
        'mail.mailers.smtp.username'   => $smtp['user'],
        'mail.mailers.smtp.password'   => $smtp['pass'],
        'mail.from.address'            => $smtp['user'],
        'mail.from.name'               => strtoupper(self::getDomain()),
      ]);
    }

    return Mail::send([], [], function ($message) use ($to, $subject, $body, $from, $fromName, $cc, $bcc, $replyTo, $replyToName, $attachments, $headers) {
      $message->to($to);
      $message->subject($subject);
      $message->html($body);
      // $message->setContent($body);
      // $message->text(strip_tags($body));

      if ($from) {
        $message->from($from, $fromName);
      }
      if ($cc) {
        $message->cc($cc);
      }
      if ($bcc) {
        $message->bcc($bcc);
      }
      if ($replyTo) {
        $message->replyTo($replyTo, $replyToName);
      }
      if ($attachments) {
        foreach ($attachments as $attachment) {
          $message->attach($attachment);
        }
      }
      if ($headers) {
        foreach ($headers as $key => $value) {
          $message->getHeaders()->addTextHeader($key, $value);
        }
      }
    });
  }

  public static function checkLicense()
  {
    $license = env('CLIENT_SECRET_KEY', null);

    if (!$license) {
      die('Vui lòng cấu hình CLIENT_SECRET_KEY trong file .env');
    }

    if (strlen($license) < 26) {
      die('CLIENT_SECRET_KEY không hợp lệ');
    }

    //
  }
}
