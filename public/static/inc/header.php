<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=$title;?></title>
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

    <script src="/static/js/Utils.js"></script>
    <script src="/static/js/Controller/Main.js"></script>
    <script src="/static/js/Controller/List.js"></script>
    <script src="/static/js/Controller/Session.js"></script>
    <script src="/static/js/Init.js"></script>
    <script src="/static/js/main.js"></script>

</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top navbar-blue">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Link Shortener</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="/">Home</a></li>
                    <li><a href="/links">Saved Links</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="logout">Log Out</li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
