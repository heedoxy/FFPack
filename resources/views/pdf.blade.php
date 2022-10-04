@php
    $helper = new \App\Helpers\Helper();
    $counter = 1;
    $total = 0;
@endphp

    <!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>PDF</title>

    <style>

        @font-face {

            font-family: 'samim';
            src: url('/assets/fonts/farsi-fonts/Samim/Samim.eot'),
            url('/assets/fonts/farsi-fonts/Samim/Samim.woff'),
            url('/assets/fonts/farsi-fonts/Samim/Samim.woff2'),
            url('/assets/fonts/farsi-fonts/Samim/Samim.ttf');

        }

        body {
            direction: rtl;
            font-family: 'samim';
        }


        * {
            direction: rtl;
        }

        body {
            padding: 0 20px;
            width: 920px;
            margin: 0 auto;
        }

        p {
            font-size: 16px;
        }

        .main-title {
            text-align: center;
            margin-top: 20px;
        }

        .paragraph {
            text-align: right;
        }

        .img-container {
            text-align: center;
        }

        .img-container .image {
            width: 10px;
        }

        table, th, td {
            border: 1px solid;
        }

        table {
            border-collapse: collapse;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 15px
        }

        table th, td {
            padding: 25px
        }
    </style>


</head>

<body>

<div class="img-container">
    <img class="image" width="100px" src="{{public_path('../assets/image/logo.png')}}" alt="">
</div>

<h1 class="main-title">فست فوت پک</h1>

<h2 style="text-align: center">
    صورتحساب :
    {{ $factor->code }}
    #
</h2>

<ul style="line-height: 30px">
    <li>
        تاریخ :
        {{ (new \Hekmatinasser\Verta\Verta( $factor->created_at ))->format('j / n / Y') }}
    </li>
    <li>
        آقای / خانم :
        {{ $factor->name . " " . $factor->family }}
    </li>
</ul>

<div style="text-align: center">
    <table>
        <thead>
        <tr style="background-color: #b7b7b7">
            <th>#</th>
            <th>توضیحات</th>
            <th>مقدار</th>
            <th>واحد</th>
            <th>قیمت</th>
            <th>جمع</th>
        </tr>
        </thead>
        <tbody>
        @foreach($details as $detail)
            <tr>
                <td>{{ $counter++ }}</td>
                <td>{{ $detail->name }}</td>
                <td>{{ $detail->amount }}</td>
                <td>{{ $detail->utitle }}</td>
                <td>
                    {{ $helper->e2p(number_format($detail->price)) }}
                    تومان
                </td>
                <td>
                    @php($total += $detail->amount * $detail->price)
                    {{ $helper->e2p(number_format($detail->amount * $detail->price)) }}
                    تومان
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>
</div>

<h3 style="font-size: 15px; margin-right: 25px">
    جمع کل :
    {{ $helper->e2p(number_format($total)) }}
    تومان
</h3>

<div class="paragraph" style="color: gray; text-align: center">
    از اعتماد شما سپاس گذاریم .
</div>

</body>

</html>
