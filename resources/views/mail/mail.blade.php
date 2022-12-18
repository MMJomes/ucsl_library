<!DOCTYPE html>
<html lang="en">

<head>
    <title>UCSL DIGITAL LIBRARY MANAGENMENT SYSTEM FOR (UCSL)</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<style>
    table {
        border: 1px solid #ccc;
        border-collapse: collapse;
        margin: 0;
        padding: 0;
        width: 100%;
        table-layout: fixed;
    }

    table caption {
        font-size: 1.5em;
        margin: .5em 0 .75em;
    }

    table tr {
        background-color: #f8f8f8;
        border: 1px solid #ddd;
        padding: .35em;
    }

    table th,
    table td {
        padding: .625em;
        text-align: center;
    }

    table th {
        font-size: .85em;
        letter-spacing: .1em;
        text-transform: uppercase;
    }

    @media screen and (max-width: 600px) {
        table {
            border: 0;
        }

        table caption {
            font-size: 1.3em;
        }

        table thead {
            border: none;
            clip: rect(0 0 0 0);
            height: 1px;
            margin: -1px;
            overflow: hidden;
            padding: 0;
            position: absolute;
            width: 1px;
        }

        table tr {
            border-bottom: 3px solid #ddd;
            display: block;
            margin-bottom: .625em;
        }

        table td {
            border-bottom: 1px solid #ddd;
            display: block;
            font-size: .8em;
            text-align: right;
        }

        table td::before {

            content: attr(data-label);
            float: left;
            font-weight: bold;
            text-transform: uppercase;
        }

        table td:last-child {
            border-bottom: 0;
        }
    }

    body {
        font-family: "Open Sans", sans-serif;
        line-height: 1.25;
    }

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
    <div style="justify-content: center">
        <div class="card"><br><br>
            <div class="card-header" style="font-weight: bold;">
                <center>
                    <img src="{{ url('cu.jpg') }}" alt="" width="90%" style="height:auto;display:block;" />
                </center>

            </div>
            <div class="card-body">
                <table role="presentation"
                    style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
                    <caption style="font-size: 16px">DIGITAL LIBRARY MANAGENMENT SYSTEM FOR (UCSL) </caption>
                    <tbody>
                        <tr>
                            <td colspan="4">
                                <br>
                                <center>{{ $about }}:</center>
                                <br/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" style="float:inline-start;">
                                <br>
                                <center>Date: <span>{{ $date }} : {{ $time }}</span></center>
                                <br/>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p class="card-text"
                    style="text-decoration: underline;font-family: 'Times New Roman', Times, serif;font-size: larger;">
                    About:</p>
                <p class="card-text" style="text-align: left;margin-left: 8px;font-size: 12px;">
                    Dear:<span>{{ $username }}</span></p>
                <p class="card-text">{{ $mymessage }}</p>
            </div>
            <div class="card-footer">
                <h6 class="card-title mb-4">Powered By <span><a target="_blank"
                            href="https://www.linkedin.com/in/maungmyint/" blank> Maung Myint</a></span></h6><br>

            </div>
        </div>

    </div>
</body>

</html>
