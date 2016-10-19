<!DOCTYPE html>
<html class="bg-black">
<head>
    <meta charset="UTF-8">
    <title>Log In</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link type="text/css" rel="stylesheet" href="/static/vendor/bootstrap/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="/static/vendor/bootstrap/css/bootstrap-theme.min.css">
    <link type="text/css" rel="stylesheet" href="/static/css/main.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <script type="text/javascript" src="/static/vendor/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="/static/vendor/bootstrap/js/bootstrap.min.js"></script>

    <script src="/static/js/Controller/Session.js"></script>
    <script src="/static/js/Utils.js"></script>
    <script src="/static/js/Init.js"></script>
    <script src="/static/js/main.js"></script>

</head>
<body class="login-body">
    <div class="login">
        <h3 class="text-center"><strong>Log In form</strong></h3>
        <div class="container">
            <div class="col-xs-12">
            <p class="text-danger error-message"></p>
                <form id="login" action="" method="post">
                    <div>
                        <p class="text-danger error-message"></p>
                        <div class="form-group">
                            <input type="email" name="Email" class="form-control" placeholder="E-mail" required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="Password" class="form-control" placeholder="Password" required>
                        </div>
                        <input type="hidden" name="csrf_token">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-block">Log In</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
