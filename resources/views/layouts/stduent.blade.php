@inject('request', 'Illuminate\Http\Request')
<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.partials.back-head')
    <title>DIGITAL LIBRARY MANAGENMENT SYSTEM</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1">
    <link href="{{ asset('assets/dist/user/user.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/dist/user/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/dist/user/jquery.dataTables.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/dist/user/jquery-1.9.1.js') }}"></script>
    <script src="{{ asset('assets/dist/user/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/dist/user/jquery.dataTables.min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: "Lato", sans-serif
        }
        .mySlides {
            display: none
        }
    </style>
</head>
<body>
    @include('frontend.user.navbar')
    <div id="navDemo" class="w3-bar-block w3-black w3-hide w3-hide-large w3-hide-medium w3-top"
        style="margin-top:46px">
        <a href="{{route('users.rents')}}" class="w3-bar-item w3-button w3-padding-large">RENTED BOOKS</a>
        <a href="{{route('users.prerequest')}}" class="w3-bar-item w3-button w3-padding-large" onclick="myFunction()">PREQUEST BOOKS</a>
        <a href="{{route('member.profile')}}" class="w3-bar-item w3-button w3-padding-large" onclick="myFunction()">PROFILE</a>
    </div>
    <div class="w3-content" style="max-width:2000px;margin-top:46px">

        @yield('content')
    </div>


    <!-- Footer -->
    @include('frontend.user.footer')

    <script>
        // Automatic Slideshow - change image every 4 seconds
        var myIndex = 0;
        carousel();

        function carousel() {
            var i;
            var x = document.getElementsByClassName("mySlides");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            myIndex++;
            if (myIndex > x.length) {
                myIndex = 1
            }
            x[myIndex - 1].style.display = "block";
            setTimeout(carousel, 4000);
        }

        // Used to toggle the menu on small screens when clicking on the menu button
        function myFunction() {
            var x = document.getElementById("navDemo");
            if (x.className.indexOf("w3-show") == -1) {
                x.className += " w3-show";
            } else {
                x.className = x.className.replace(" w3-show", "");
            }
        }

        // When the user clicks anywhere outside of the modal, close it
        var modal = document.getElementById('ticketModal');
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

</body>

</html>
