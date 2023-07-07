<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ config('app.name') }} | Print Preview</title>
    <style>
        @page { margin: 0px; }
        body { margin: 0px; }

        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            text-align: center;
        }

        .report-header{
            text-align: center;
        }

        table{
            width: 100%;
        }

        .print-content{
            padding: 15px;
        }

        .under-lined{
            border-bottom: 1px solid #000;
        }

        .text-left{
            text-align: left;
        }

        .text-right{
            text-align: right!;
        }

        .text-center{
            text-align: center;
        }

        .text-underline{
            text-decoration: underline;
        }

        #tableTop{
            width: 100%;
            border: 1px solid black;
            border-collapse: collapse;
            font-size: 12px;
        }

        #tableTop td{
            border: 1px solid #000;
        }

        #ulist{
            list-style-type: none;
            margin: 0;
            display: inline-block;
        }

        #ulist li{
            padding: 5px;
        }


        .center {
            line-height: 50px;
            height: 50px;
        }

        .center span {
            line-height: 1.5;
            display: inline-block;
            vertical-align: middle;
        }

        .page_break{
            page-break-after: always;
            page-break-inside: avoid;
        }

        .page_break:last-child{
            page-break-after: avoid;
        }
    </style>
</head>
<body>

    @yield('content')

</body>
</html>
