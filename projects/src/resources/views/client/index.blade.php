<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stil Deposu</title>
    <link rel="stylesheet" href="/assets/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/client/style.css">
    <script src="https://kit.fontawesome.com/8f624e6537.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/png" sizes="32x32" href="/images/logo.png">
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
        }

        .footer {
            background: #fefeff;
            height: 170px;
            border-top: 1px solid #eeefee;
        }
    </style>
</head>

<body>
    @include('client.layout.navbar')
    @include('client.layout.main')
    @include('client.layout.footer')

    <script src="/assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
