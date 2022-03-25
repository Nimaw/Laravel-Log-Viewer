# Laravel log viewer

You can view your logs easly with beautiful panel.
You can search, view, filter logs and switch log files.

# Installation

```
composer require nimaw/logviewer
```

# Seting up laravel logviewer

Run:

To publish logviewer dashboard assets.

```
php artisan vendor:publish --tag=logviewer-assets
```

Now you can easly access to dashboard with `/logs` address.

# Configuration

You can also publish configuration to customize things like logs path, logs extentions, route, middlewares to include, pagination count.

```
php artisan vendor:publish --tag=logviewer-config
```

# Note

By default laravel log viewer need to authenticate to access to dashboard, If you do not need this future you can easily remove "auth" middleware on config file.
