{{-- <!DOCTYPE html>
<html>
<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
    }

    form {
        border: 3px solid #f1f1f1;
        font-family: Arial;
    }

    .button {
        background-color: #00CCFF;
        padding: 8px 16px;
        display: inline-block;
        text-decoration: none;
        color: #FFFFFF border-radius: 3px;
        width: 100%;
        padding: 1px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    .button:hover {
        background-color: #0066FF;
    }

    .container {
        padding: 20px;
        background-color: #f1f1f1;
    }

</style>

<body>
    <form auction="#" method="POST">
        <div class="container">
            <h3>User Name: {{ $username }}</h3>
            <h3>User Password:  {{ $userpassword }}</h3>
            <h4>Date : {{ $date }} / Time: {{ $time }}<h4>
        </div>
{{--
        <div class="container" style="background-color:white;text-aligin:center">
            <center>
                <a href="https://mti.com.mm">
                    <img src="{{ $message->embed($image) }}" style="width: 40%" alt="Image">
                </a>

                <p>{!! $footer !!}</p>
            </center>
        </div>
        @if ($type != 'voter_announce')
        <div class="container">
            <a href="{{ $link }}" class="button btn btn-primary">
                <center><p style="font-weight:bold";>VOTE</p></center>
            </a>
        </div>
        @endif
    </form>

</body>

</html> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Mail</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
    .card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        max-width: 80%;
        text-align: center;
        margin: auto;
        margin-top: 20px;
        margin-bottom: 20px;
        font-family: arial;
    }

    body {
        font-family: Arial, Helvetica, sans-serif;
    }
</style>

<body>

    <div class="container justify-content-center" style="justify-content: center">
        <div class="card"><br><br>
            <div class="card-header" style="font-weight: bold;">
                Member Register Mail Notification
            </div>
            <div class="card-body">
                <p class="card-text">User Name: {{ $username }}</p>
                <p class="card-text">User Password: {{ $userpassword }}</p>
                <p class="card-text">Date : {{ $date }} / Time: {{ $time }}</p>
            </div>
            <div class="card-footer">
                <h6 class="card-title mb-4">Powered By MTI</h6><br>

            </div>
        </div>

    </div>
</body>

</html>
