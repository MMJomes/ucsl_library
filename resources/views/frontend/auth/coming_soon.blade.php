<!DOCTYPE html>
<html>
<style>
    body,
    html {
        height: 100%;
        margin: 0;
    }

    .bgimg {
        min-height: 100vh;
        background-color: Red;
        background: url({{ asset('assets/images/CU_Loikaw.jpg') }});
        no-repeat center center;
        background-size: cover;
    }

    .topleft {
        position: absolute;
        top: 0;
        left: 16px;
    }

    .bottomleft {
        position: absolute;
        bottom: 0;
        left: 16px;
    }

    .middle {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
    }

    hr {
        margin: auto;
        width: 40%;
    }
</style>

<body>

    <div class="bgimg">
        <div class="topleft">
            <img src="{{ url('assets/images/logo.png')}} " id="user-photo"
            class="rounded-circle user-photo media-object" alt="User" width="140px">
        </div>
        <div class="middle" style="color: red">
            <h1 class="text-white" style="color: white" style="font-size:1in !important;">This Site Is Under Construction!</h1>
            <hr>
        </div>
        <div class="bottomleft" style="color: white">
            <p>For More Detail Contact Admin</p>
            <p>Email :<span style="color: lightseagreen">library@ucsloikaw.edu.mm</span></p>
        </div>
    </div>

</body>

</html>
