<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/all-assets/common/logo/cpb/icon/favicon-32x32.png') }}">
        <title>Pet Care</title>
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="{{ mix('css/website/app.css') }}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600;700&display=swap" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <index-component authuser="{{ Auth::user() }}" certificate="{{ $certificate }} "></index-component>
        </div>
        <script src="{{ mix('js/website/app.js') }}"></script>
        <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    </body>
</html>
