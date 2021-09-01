<?php return array (
  'app' => 
  array (
    'name' => 'Laravel',
    'env' => 'local',
    'debug' => true,
    'url' => 'http://localhost/cutz',
    'asset_url' => NULL,
    'timezone' => 'Africa/Cairo',
    'locale' => 'en',
    'fallback_locale' => 'ar',
    'faker_locale' => 'en_US',
    'key' => 'base64:wYoNpZWVThuBpARhq9Lkh0UwBUrtH6biH3ukkOGmXps=',
    'cipher' => 'AES-256-CBC',
    'providers' => 
    array (
      0 => 'Illuminate\\Auth\\AuthServiceProvider',
      1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2 => 'Illuminate\\Bus\\BusServiceProvider',
      3 => 'Illuminate\\Cache\\CacheServiceProvider',
      4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5 => 'Illuminate\\Cookie\\CookieServiceProvider',
      6 => 'Illuminate\\Database\\DatabaseServiceProvider',
      7 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      8 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      9 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      10 => 'Illuminate\\Hashing\\HashServiceProvider',
      11 => 'Illuminate\\Mail\\MailServiceProvider',
      12 => 'Illuminate\\Notifications\\NotificationServiceProvider',
      13 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      14 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      15 => 'Illuminate\\Queue\\QueueServiceProvider',
      16 => 'Illuminate\\Redis\\RedisServiceProvider',
      17 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      18 => 'Illuminate\\Session\\SessionServiceProvider',
      19 => 'Illuminate\\Translation\\TranslationServiceProvider',
      20 => 'Illuminate\\Validation\\ValidationServiceProvider',
      21 => 'Illuminate\\View\\ViewServiceProvider',
      22 => 'Victorybiz\\GeoIPLocation\\GeoIPLocationServiceProvider',
      23 => 'Maatwebsite\\Excel\\ExcelServiceProvider',
      24 => 'App\\Providers\\AppServiceProvider',
      25 => 'App\\Providers\\AuthServiceProvider',
      26 => 'App\\Providers\\BroadcastServiceProvider',
      27 => 'App\\Providers\\EventServiceProvider',
      28 => 'App\\Providers\\RouteServiceProvider',
      29 => 'Barryvdh\\DomPDF\\ServiceProvider',
      30 => 'Laravel\\Passport\\PassportServiceProvider',
      31 => 'UxWeb\\SweetAlert\\SweetAlertServiceProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Broadcast' => 'Illuminate\\Support\\Facades\\Broadcast',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Config' => 'Illuminate\\Support\\Facades\\Config',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Redis' => 'Illuminate\\Support\\Facades\\Redis',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
      'Excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
      'GeoIPLocation' => 'Victorybiz\\GeoIPLocation\\Facades\\GeoIPLocationFacade',
      'PDF' => 'Barryvdh\\DomPDF\\Facade',
      'Alert' => 'UxWeb\\SweetAlert\\SweetAlert',
    ),
  ),
  'auth' => 
  array (
    'defaults' => 
    array (
      'guard' => 'web',
      'passwords' => 'users',
    ),
    'guards' => 
    array (
      'web' => 
      array (
        'driver' => 'session',
        'provider' => 'users',
      ),
      'customer' => 
      array (
        'driver' => 'session',
        'provider' => 'customers',
      ),
      'vendor' => 
      array (
        'driver' => 'session',
        'provider' => 'vendors',
      ),
      'api' => 
      array (
        'driver' => 'token',
        'provider' => 'users',
      ),
      'customer-api' => 
      array (
        'driver' => 'passport',
        'provider' => 'customers',
        'hash' => false,
      ),
    ),
    'providers' => 
    array (
      'users' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\User',
      ),
      'customers' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\Customer',
      ),
      'vendors' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\Vendor',
      ),
    ),
    'passwords' => 
    array (
      'users' => 
      array (
        'provider' => 'users',
        'table' => 'password_resets',
        'expire' => 60,
      ),
      'customers' => 
      array (
        'provider' => 'customers',
        'table' => 'password_resets',
        'expire' => 60,
      ),
    ),
  ),
  'broadcasting' => 
  array (
    'default' => 'pusher',
    'connections' => 
    array (
      'pusher' => 
      array (
        'driver' => 'pusher',
        'key' => 'f9cf2eb9e16b16abaf33',
        'secret' => '4f805240aaf3c8724dd1',
        'app_id' => '1102672',
        'options' => 
        array (
          'encrypted' => true,
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
      'log' => 
      array (
        'driver' => 'log',
      ),
      'null' => 
      array (
        'driver' => 'null',
      ),
    ),
  ),
  'cache' => 
  array (
    'default' => 'file',
    'stores' => 
    array (
      'apc' => 
      array (
        'driver' => 'apc',
      ),
      'array' => 
      array (
        'driver' => 'array',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'cache',
        'connection' => NULL,
      ),
      'file' => 
      array (
        'driver' => 'file',
        'path' => 'C:\\xampp71\\htdocs\\cutz\\storage\\framework/cache/data',
      ),
      'memcached' => 
      array (
        'driver' => 'memcached',
        'persistent_id' => NULL,
        'sasl' => 
        array (
          0 => NULL,
          1 => NULL,
        ),
        'options' => 
        array (
        ),
        'servers' => 
        array (
          0 => 
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'cache',
      ),
    ),
    'prefix' => 'laravel_cache',
  ),
  'database' => 
  array (
    'default' => 'mysql',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'driver' => 'sqlite',
        'database' => 'cutz',
        'prefix' => '',
        'foreign_key_constraints' => true,
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'cutz',
        'username' => 'root',
        'password' => '',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => true,
        'engine' => NULL,
      ),
      'pgsql' => 
      array (
        'driver' => 'pgsql',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'cutz',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
        'schema' => 'public',
        'sslmode' => 'prefer',
      ),
      'sqlsrv' => 
      array (
        'driver' => 'sqlsrv',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'cutz',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
      ),
    ),
    'migrations' => 'migrations',
    'redis' => 
    array (
      'client' => 'predis',
      'default' => 
      array (
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => 0,
      ),
      'cache' => 
      array (
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => 1,
      ),
    ),
  ),
  'debug-server' => 
  array (
    'host' => 'tcp://127.0.0.1:9912',
  ),
  'dompdf' => 
  array (
    'show_warnings' => false,
    'orientation' => 'portrait',
    'defines' => 
    array (
      'font_dir' => 'C:\\xampp71\\htdocs\\cutz\\storage\\fonts/',
      'font_cache' => 'C:\\xampp71\\htdocs\\cutz\\storage\\fonts/',
      'temp_dir' => 'C:\\Users\\umair\\AppData\\Local\\Temp',
      'chroot' => 'C:\\xampp71\\htdocs\\cutz',
      'enable_font_subsetting' => false,
      'pdf_backend' => 'CPDF',
      'default_media_type' => 'screen',
      'default_paper_size' => 'a4',
      'default_font' => 'serif',
      'dpi' => 96,
      'enable_php' => false,
      'enable_javascript' => true,
      'enable_remote' => true,
      'font_height_ratio' => 1.1,
      'enable_html5_parser' => false,
    ),
  ),
  'excel' => 
  array (
    'exports' => 
    array (
      'chunk_size' => 1000,
      'pre_calculate_formulas' => false,
      'csv' => 
      array (
        'delimiter' => ',',
        'enclosure' => '"',
        'line_ending' => '
',
        'use_bom' => false,
        'include_separator_line' => false,
        'excel_compatibility' => false,
      ),
    ),
    'imports' => 
    array (
      'read_only' => true,
      'heading_row' => 
      array (
        'formatter' => 'slug',
      ),
      'csv' => 
      array (
        'delimiter' => ',',
        'enclosure' => '"',
        'line_ending' => '
',
        'use_bom' => false,
        'include_separator_line' => false,
        'excel_compatibility' => false,
      ),
    ),
    'extension_detector' => 
    array (
      'xlsx' => 'Xlsx',
      'xlsm' => 'Xlsx',
      'xltx' => 'Xlsx',
      'xltm' => 'Xlsx',
      'xls' => 'Xls',
      'xlt' => 'Xls',
      'ods' => 'Ods',
      'ots' => 'Ods',
      'slk' => 'Slk',
      'xml' => 'Xml',
      'gnumeric' => 'Gnumeric',
      'htm' => 'Html',
      'html' => 'Html',
      'csv' => 'Csv',
      'tsv' => 'Csv',
      'pdf' => 'Dompdf',
    ),
    'value_binder' => 
    array (
      'default' => 'Maatwebsite\\Excel\\DefaultValueBinder',
    ),
    'transactions' => 
    array (
      'handler' => 'db',
    ),
    'temporary_files' => 
    array (
      'local_path' => 'C:\\Users\\umair\\AppData\\Local\\Temp',
      'remote_disk' => NULL,
    ),
  ),
  'filesystems' => 
  array (
    'default' => 'local',
    'cloud' => 's3',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => 'C:\\xampp71\\htdocs\\cutz\\storage\\app',
      ),
      'public' => 
      array (
        'driver' => 'local',
        'root' => 'C:\\xampp71\\htdocs\\cutz\\storage\\app/public',
        'url' => 'http://localhost/cutz/storage',
        'visibility' => 'public',
      ),
      'public_uploads' => 
      array (
        'driver' => 'local',
        'root' => 'C:\\xampp71\\htdocs\\cutz\\public\\uploads',
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => NULL,
        'secret' => NULL,
        'region' => NULL,
        'bucket' => NULL,
        'url' => NULL,
      ),
    ),
  ),
  'hashing' => 
  array (
    'driver' => 'bcrypt',
    'bcrypt' => 
    array (
      'rounds' => 10,
    ),
    'argon' => 
    array (
      'memory' => 1024,
      'threads' => 2,
      'time' => 2,
    ),
  ),
  'image' => 
  array (
    'driver' => 'gd',
  ),
  'laratrust' => 
  array (
    'use_morph_map' => false,
    'use_cache' => true,
    'use_teams' => false,
    'teams_strict_check' => false,
    'user_models' => 
    array (
      'users' => 'App\\User',
    ),
    'models' => 
    array (
      'role' => 'App\\Role',
      'permission' => 'App\\Permission',
      'team' => 'App\\Team',
    ),
    'tables' => 
    array (
      'roles' => 'roles',
      'permissions' => 'permissions',
      'teams' => 'teams',
      'role_user' => 'role_user',
      'permission_user' => 'permission_user',
      'permission_role' => 'permission_role',
    ),
    'foreign_keys' => 
    array (
      'user' => 'user_id',
      'role' => 'role_id',
      'permission' => 'permission_id',
      'team' => 'team_id',
    ),
    'middleware' => 
    array (
      'register' => true,
      'handling' => 'redirect',
      'params' => '403',
    ),
    'magic_can_method_case' => 'kebab_case',
  ),
  'laratrust_seeder' => 
  array (
    'role_structure' => 
    array (
      'super_admin' => 
      array (
        'countries' => 'c,r,u,d',
        'cities' => 'c,r,u,d',
        'states' => 'c,r,u,d',
        'provenances' => 'c,r,u,d',
        'weights' => 'c,r,u,d',
        'productWeights' => 'c,r,u,d',
        'sections' => 'c,r,u,d',
        'subCategories' => 'c,r,u,d',
        'instructions' => 'c,r,u,d',
        'galleries' => 'c,r,u,d',
        'rates' => 'c,r,u,d',
        'wishlists' => 'c,r,u,d',
        'carts' => 'c,r,u,d',
        'orders' => 'c,r,u,d',
        'invoices' => 'c,r,u,d',
        'additions' => 'c,r,u,d',
        'addresses' => 'c,r,u,d',
        'pieces' => 'c,r,u,d',
        'notifications' => 'c,r,u,d',
        'ads' => 'c,r,u,d',
        'collections' => 'c,r,u,d',
        'customers' => 'c,r,u,d',
        'quotes' => 'c,r,u,d',
        'tickets' => 'c,r,u,d',
        'subscribe' => 'c,r,u,d',
        'pages' => 'c,r,u,d',
        'promocodes' => 'c,r,u,d',
        'brands' => 'c,r,u,d',
        'packages' => 'c,r,u,d',
        'services' => 'c,r,u,d',
        'plans' => 'c,r,u,d',
        'parteners' => 'c,r,u,d',
        'tags' => 'c,r,u,d',
        'testimonails' => 'c,r,u,d',
        'blogs' => 'c,r,u,d',
        'abouts' => 'c,r,u,d',
        'inbox' => 'c,r,u,d',
        'socail' => 'c,r,u,d',
        'sliders' => 'c,r,u,d',
        'categories' => 'c,r,u,d',
        'products' => 'c,r,u,d',
        'clients' => 'c,r,u,d',
        'options' => 'c,r,u,d',
        'settings' => 'c,r,u,d',
        'users' => 'c,r,u,d',
        'roles' => 'c,r,u,d',
      ),
      'admin' => 
      array (
      ),
    ),
    'permissions_map' => 
    array (
      'c' => 'create',
      'r' => 'read',
      'u' => 'update',
      'd' => 'delete',
    ),
  ),
  'laravellocalization' => 
  array (
    'supportedLocales' => 
    array (
      'en' => 
      array (
        'name' => 'English',
        'script' => 'Latn',
        'native' => 'English',
        'regional' => 'en_GB',
      ),
      'ar' => 
      array (
        'name' => 'Arabic',
        'script' => 'Arab',
        'native' => 'العربية',
        'regional' => 'ar_AE',
      ),
    ),
    'useAcceptLanguageHeader' => false,
    'hideDefaultLocaleInURL' => false,
    'localesOrder' => 
    array (
    ),
    'localesMapping' => 
    array (
    ),
    'utf8suffix' => '.UTF-8',
    'urlsIgnored' => 
    array (
      0 => '/skipped',
    ),
  ),
  'logging' => 
  array (
    'default' => 'stack',
    'channels' => 
    array (
      'stack' => 
      array (
        'driver' => 'stack',
        'channels' => 
        array (
          0 => 'daily',
        ),
      ),
      'single' => 
      array (
        'driver' => 'single',
        'path' => 'C:\\xampp71\\htdocs\\cutz\\storage\\logs/laravel.log',
        'level' => 'debug',
      ),
      'daily' => 
      array (
        'driver' => 'daily',
        'path' => 'C:\\xampp71\\htdocs\\cutz\\storage\\logs/laravel.log',
        'level' => 'debug',
        'days' => 14,
      ),
      'slack' => 
      array (
        'driver' => 'slack',
        'url' => NULL,
        'username' => 'Laravel Log',
        'emoji' => ':boom:',
        'level' => 'critical',
      ),
      'papertrail' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\SyslogUdpHandler',
        'handler_with' => 
        array (
          'host' => NULL,
          'port' => NULL,
        ),
      ),
      'stderr' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\StreamHandler',
        'formatter' => NULL,
        'with' => 
        array (
          'stream' => 'php://stderr',
        ),
      ),
      'syslog' => 
      array (
        'driver' => 'syslog',
        'level' => 'debug',
      ),
      'errorlog' => 
      array (
        'driver' => 'errorlog',
        'level' => 'debug',
      ),
    ),
  ),
  'mail' => 
  array (
    'driver' => 'smtp',
    'host' => 'mail.cutz.com.eg',
    'port' => '587',
    'from' => 
    array (
      'address' => 'cutzmail@cutz.com.eg',
      'name' => 'cutzOrders',
    ),
    'encryption' => NULL,
    'username' => 'cutzmail@cutz.com.eg',
    'password' => 'LceEK1$TX{f2',
    'sendmail' => '/usr/sbin/sendmail -bs',
    'markdown' => 
    array (
      'theme' => 'default',
      'paths' => 
      array (
        0 => 'C:\\xampp71\\htdocs\\cutz\\resources\\views/vendor/mail',
      ),
    ),
    'log_channel' => NULL,
  ),
  'passport' => 
  array (
    'private_key' => NULL,
    'public_key' => NULL,
  ),
  'queue' => 
  array (
    'default' => 'sync',
    'connections' => 
    array (
      'sync' => 
      array (
        'driver' => 'sync',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'jobs',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'beanstalkd' => 
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'sqs' => 
      array (
        'driver' => 'sqs',
        'key' => 'your-public-key',
        'secret' => 'your-secret-key',
        'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
        'queue' => 'your-queue-name',
        'region' => 'us-east-1',
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => NULL,
      ),
    ),
    'failed' => 
    array (
      'database' => 'mysql',
      'table' => 'failed_jobs',
    ),
  ),
  'services' => 
  array (
    'mailgun' => 
    array (
      'domain' => NULL,
      'secret' => NULL,
      'endpoint' => 'api.mailgun.net',
    ),
    'ses' => 
    array (
      'key' => NULL,
      'secret' => NULL,
      'region' => 'us-east-1',
    ),
    'sparkpost' => 
    array (
      'secret' => NULL,
    ),
    'stripe' => 
    array (
      'model' => 'App\\User',
      'key' => NULL,
      'secret' => NULL,
      'webhook' => 
      array (
        'secret' => NULL,
        'tolerance' => 300,
      ),
    ),
    'facebook' => 
    array (
      'client_id' => '1322853481426411',
      'client_secret' => 'ceb36abc8f5b14507dbc785a75246140',
      'redirect' => 'https://cutz.com.eg/customer/callback/facebook',
    ),
    'google' => 
    array (
      'client_id' => '164854096620-fd7hethinpip19e3b62t6nve2qatrpsc.apps.googleusercontent.com',
      'client_secret' => 'yoJezup3a0G2krhtYil-4aFg',
      'redirect' => 'https://cutz.com.eg/customer/callback/google',
    ),
    'recaptcha' => 
    array (
      'key' => '6LeqzR0cAAAAABd4s4oMxUiIFqLZh7mz0y0xIuJZ',
      'secret' => '6LeqzR0cAAAAANjFqKQJYgV0mRbbmPrJTk4b-BH7',
    ),
  ),
  'session' => 
  array (
    'driver' => 'file',
    'lifetime' => '120',
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => 'C:\\xampp71\\htdocs\\cutz\\storage\\framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'store' => NULL,
    'lottery' => 
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'laravel_session',
    'path' => '/',
    'domain' => NULL,
    'secure' => false,
    'http_only' => true,
    'same_site' => NULL,
  ),
  'sweet-alert' => 
  array (
    'autoclose' => 2500,
  ),
  'tinker' => 
  array (
    'commands' => 
    array (
    ),
    'dont_alias' => 
    array (
    ),
  ),
  'translatable' => 
  array (
    'locales' => 
    array (
      0 => 'ar',
      1 => 'en',
    ),
    'locale_separator' => '-',
    'locale' => NULL,
    'use_fallback' => false,
    'use_property_fallback' => true,
    'fallback_locale' => 'en',
    'translation_model_namespace' => NULL,
    'translation_suffix' => 'Translation',
    'locale_key' => 'locale',
    'to_array_always_loads_translations' => true,
  ),
  'trustedproxy' => 
  array (
    'proxies' => NULL,
    'headers' => 30,
  ),
  'view' => 
  array (
    'paths' => 
    array (
      0 => 'C:\\xampp71\\htdocs\\cutz\\resources\\views',
    ),
    'compiled' => 'C:\\xampp71\\htdocs\\cutz\\storage\\framework\\views',
  ),
);
