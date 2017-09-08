<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#52768e">
    <title>@yield('title') Backend {{ $site_title or '' }}</title>
    <link href="//cdn.bootcss.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
    @if(isset($site_css) && $site_css)
        <link href="{{ $site_css }}" rel="stylesheet">
    @else
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @endif
    @yield('css')
    <script>
        window.XblogConfig = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            'github_username' => isset($github_username) ? $github_username : '',
        ]);?>
    </script>
</head>
<body>
<div id="app">
    @include('backend.layouts.header')
    <div id="content-wrap">
        <div class="container">
            @include('backend.partials.errors')
            @include('backend.partials.success')
            @yield('content')
        </div>
    </div>
    @include('backend.layouts.footer')
</div>

    <script src="{{ mix('js/app.js') }}"></script>
@yield('script')
</body>
</html>
