<!DOCTYPE html>
<html>
<head>
    <title>{{ config('app.name') }}</title>
</head>
<body>

    <div>
        <img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo" style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; max-width: 100%; border: none; height: 75px; max-height: 75px; width: 75px;">
    </div>
    <p>{!! $content['body'] !!}</p>

    <p>Thanks,<br>{{ config('app.name') }}</p>
</body>
</html>

