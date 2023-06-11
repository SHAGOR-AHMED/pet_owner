<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('common.cpbd-icon')
    <title>Login</title>
    <!-- Custom Theme files -->
    <link rel="stylesheet" href="{{ asset('all-assets/common/login/css/style2.css') }}" type="text/css" media="all" />
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('css/admin/app.css') }}">
  </head>
  <body>
    <div id="app">
		  <login-component targeturl="{{ Session::get('target_url') }}"></login-component>
    </div>
    <script src="{{ mix('js/admin/app.js') }}"></script>
  </body>
</html>