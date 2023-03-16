<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style type="text/css">
        .orderId {
            color: #000;
            font-size: 16px;
            font-weight: bold;
            color: gray;
            margin: 0;
            margin-bottom: 5px;
            padding-bottom: 15px;
            font-size: 14px;
            text-align: left;
        }

        .event {
            color: #000;
            font-weight: bold;
            color: gray;
            margin: 0;
            text-align: left;
            margin-bottom: 5px;
            padding-bottom: 5px;
            font-size: 14px;
        }
    </style>
</head>

<body style="margin-top:20px;">
    <div bgcolor="#f6f6f6" style="color: #333; height: 100%; width: 100%;" height="100%" width="100%">
        <table bgcolor="#f6f6f6" cellspacing="0"
            style="border-collapse: collapse;overflow-x:auto; padding: 40px; width: 100%;" width="100%">
            <tbody>
                <tr>
                    <td width="5px" style="padding: 0;"></td>
                    <td style="clear: both; display: block; margin: 0 auto; max-width: 600px; padding: 10px 0;">
                        <table width="100%" cellspacing="0" style="border-collapse: collapse; overflow-x:auto;">
                        </table>
                    </td>
                    <td width="5px" style="padding: 0;"></td>
                </tr>

                <tr>
                    <td width="5px" style="padding: 0;"></td>

                    <td
                        style="border: 1px solid #000; border-top: 1; clear: both; display: block; margin: 0 auto; max-width: 600px; padding: 0;">
                        <table cellspacing="0"
                            style="overflow-x:auto; border-collapse: collapse; margin: 0 auto; max-width: 600px;">
                            <tbody>
                                <tr>

                                    <td rowspan="7" valign="top"
                                        style="padding: 20px;margin-top: 120px; border-right: 1px dotted #000;">
                                        <img src="{{ url($registration->qrs['0']->image_url) }}" alt="image"
                                            width="120" height="120">
                                        {{--
                                            <img src="{{ $message->embed(auth()->user()->image) }}" width="120" height="120"/> --}}

                                        {{-- <img src="{{ $message->embed(public_path() .'/' . '/assets/frontend/images/qr.jpg') }}"
                                            alt="image" width="120" height="120"> --}}

                                        <img src="{{ $message->embed(public_path() . auth()->user()->image) }}"
                                            alt="image" width="120" height="120">

                                        <h3>
                                            {{ $registration->reg_no }}
                                        </h3>
                                        <h5 style="font-wegiht:bold">
                                            မြန်မာ့အီးဗီအသွင်ကူးပြောင်းရေးနှင့် ရွှေရောင်မြန်မာအနာဂါတ်
                                        </h5>
                                        <p
                                            style="border-bottom: 2px #000 ; border-top: 2px dotted gray; font-weight: bold; padding: 5px 0;">
                                        </p>
                                        <span>Register</span>
                                        <p>{{ $registration->name }}</p>
                                    </td>

                                    <th colspan="2" valign="top" style="padding: 20px;">
                                        <p class="orderId">
                                            Registration Number : <span
                                                style="font-weight: bold;color:#000;">{{ $registration->reg_no }}</span>
                                        </p>
                                        <h5 class="orderId">
                                            Event : <span style="font-weight: bold;color:#000 ;font-size:12px">Myanmar
                                                EV Adoption & The Future of Golden Myanmar</span>
                                        </h5>
                                        <table cellspacing="0" style="overflow-x:auto; border-collapse: collapse;">
                                            <tr>
                                                <th class="event" colspan="3" style="padding: 5px 0;">
                                                    <h5>
                                                        Ticket Owner : <p
                                                            style="font-weight: bold;color:#000 ;font-size:11px">
                                                            {{ $registration->name }}</p>
                                                    </h5>
                                                </th>
                                                <th style="padding:10px "></th>
                                                <th class="event" style="padding: 5px 0;left:20px">
                                                    <h5>
                                                        Email : <p style="font-weight: bold;color:#000 ;font-size:11px">
                                                            {{ $registration->email }}</p>
                                                    </h5>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th style="padding: 1px 0;">
                                                    <h5 class="event">
                                                        Ticket Type : <span
                                                            style="font-weight: bold;color:#000 ;font-size:11px">
                                                            Register </span>
                                                    </h5>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th class="event" colspan="3" style="padding: 5px 0;">
                                                    <h5>
                                                        Payment : <p
                                                            style="font-weight: bold;color:#000 ;font-size:12px">
                                                            Free (FREE Ticket)</p>
                                                    </h5>
                                                </th>
                                                <th style="padding:10px "></th>
                                                <th class="event" style="padding: 5px 0;left:20px">
                                                    <h5>
                                                        Member ID : <p
                                                            style="font-weight: bold;color:#000 ;font-size:11px">
                                                            {{ $registration->member_id ?? '-' }}</p>
                                                    </h5>
                                                </th>
                                            </tr>
                                            <tr style="border-bottom: 1px gray ; width:100%; border-top: 1px solid gray; font-weight: bold;"
                                                width=100%>
                                                </p>

                                            <tr>
                                                <th class="event" colspan="3" style="padding: 5px 0;">
                                                    <h5>
                                                        Date : <p style="font-weight: bold;color:#000 ;font-size:11px">
                                                            04-12-2022</p>
                                                    </h5>
                                                </th>
                                                <th style="padding:10px "></th>
                                                <th class="event" style="padding: 5px 0;left:20px">
                                                    <h5>
                                                        Time : <p style="font-weight: bold;color:#000 ;font-size:11px">
                                                            02:00 PM ~ 05:00 PM</p>
                                                    </h5>
                                                </th>
                                            </tr>
                                            <tr>
                                                <td style="padding: 5px 0;">
                                                    <h5 class="event">
                                                        Location : <span
                                                            style="font-weight: bold;color:#000 ;font-size:12px">
                                                            Pathein Ballroom, Novotel Yangon Max Hotel.
                                                        </span>
                                                    </h5>
                                                </td>
                                            </tr>
                                        </table>

                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td width="5px" style="padding: 0;"></td>
                </tr>

                <tr style="color: #666; font-size: 12px;">
                    <td width="5px" style="padding: 10px 0;"></td>
                    <td style="clear: both; display: block; margin: 0 auto; max-width: 600px; padding: 10px 0;">
                        <table width="100%" cellspacing="0" style="border-collapse: collapse;">
                            <tbody>
                                <tr>
                                    <td width="100%" valign="top" style="padding: 10px 0;">
                                        <h4 style="margin: 0;">Message from organizer</h4>
                                        <p
                                            style="color: #666; font-size: 12px; font-weight: normal; margin-bottom: 10px;">
                                            For more assistance, please contact us at Tel: +662-833-5370 or
                                            <a href="mailto" style="color: #666;" target="_blank">
                                                <span style="color: rgb(218, 147, 14)">nfo@digitechasean.com</span>
                                            </a>
                                        </p>
                                        <p
                                            style="color: #666; font-size: 12px; font-weight: normal; margin-bottom: 10px;">
                                            สอบถามข้อมูลเพิRมเติมเกีRยวกับการจัดงานกรุณาติดต่อ 02-833-5370 หรืออีเมล
                                            <a href="mailto" style="color: #666;" target="_blank">
                                                <span style="color: rgb(218, 147, 14)">info@digitechasean.com</span>
                                            </a>
                                        </p>
                                        <p
                                            style="color: #666; font-size: 12px; font-weight: normal; margin-bottom: 10px;">
                                            หรือแอดไลน์ @digitech.(
                                            <a href="href" style="color: #666;" target="_blank">
                                                <span style="color: rgb(218, 147, 14)">https://lin.ee/KuJ2gpn</span> )
                                            </a>
                                        </p>
                                        <br>
                                        <p
                                            style="color: #666; font-size: 12px; font-weight: normal; margin-bottom: 10px;">
                                            Check out! Our 2022 exhibitors
                                            <a href="href" style="color: #666;" target="_blank">
                                                <span style="color: rgb(218, 147, 14)">https://bit.ly/3ecAHuc</span>
                                            </a>
                                        </p>
                                        <p
                                            style="color: #666; font-size: 12px; font-weight: normal; margin-bottom: 10px;">
                                            ดูรายละเอียดผู้ร่วมแสดงสินค้าปn 2022
                                            <a href="href" style="color: #666;" target="_blank">
                                                <span style="color: rgb(218, 147, 14)">https://bit.ly/3ecAHuc</span>
                                            </a>
                                        </p>
                                    </td>
                                    <td width="10%" style="padding: 10px 0;">&nbsp;</td>

                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td width="5px" style="padding: 10px 0;"></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
