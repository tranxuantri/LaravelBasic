<html>
<head>
    <title>App Name - @yield('title', 'Toidicode.com')</title>
</head>
<body>
@section('sidebar')
    This is the master sidebar.
@show

<div class="container">
    @yield('content')
</div>

@stack('scripts')
</body>
</html>