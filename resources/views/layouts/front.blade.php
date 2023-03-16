<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.partials.back-head')

</head>
<body>
        @yield('content')
    {{-- @include('layouts.frontend_partials.frontend_script') --}}
    @include('layouts.partials.back-script')
</body>

</html>
