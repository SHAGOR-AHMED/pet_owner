<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CP Food | Reset Password</title>
    <!-- Custom Theme files -->
    <link href="{{ asset('login/css/style.css') }}" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('css/admin/app.css') }}">
  </head>
  <body>
    <div id="app">
		  <reset-password-component email="{{ $email }}"></reset-password-component>
    </div>
    <script src="{{ mix('js/admin/app.js') }}"></script>
  </body>
</html>