# BIS Forms API

An API to insert Gravity Forms into another Business Information System (BIS).

Once the lead is inserted into the remote system, a local database field in the WordPress gravity form is populated with the new lead id.

## Installation

Upload the BIS Forms Plugin and activate it.

### Testing

At the end of your child theme's functions.php file, add these lines:

```php
$bis_environment = "testing";
$bis_debug = true;
include_once(ABSPATH . "wp-content/plugins/gravity-forms-push-api/main.php");
```

If you don't have a functions.php file, then create one.

### Going Live

At the end of your child theme's functions.php file, add these lines:

```php
$bis_environment = "production";
$bis_debug = false;
include_once(ABSPATH . "wp-content/plugins/gravity-forms-push-api/main.php");
```

If you don't have a functions.php file, then create one.

## Production versus Testing versus Localhost

The `BIS_MODE` constant determines if the system's environment should be in production or testing mode.
A third mode, automatically detected, is when REMOTE_ADDR is 127.0.0.1 which facilitates local testing.

### Log file creation

Log files will be created when debugging is true. These start with `log_DDMMYYYY` and they are in the plugin directory.
It may add up after a while, so be sure to delete them.

In production mode, no log files will be created.

# Support

Contact Eugene on +27823096710 or email hello@eugenefvdm.com

