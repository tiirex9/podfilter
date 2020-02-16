<!DOCTYPE html>
<html style="height: 100%;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Podfilter</title>
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="/assets/css/styles.min.css">
</head>

<body style="height: 100%;">
    <div class="contact-clean" style="height: 100%;">
        <form method="post">
            <h2 class="text-center"><strong>Podfilter</strong></h2>
            <p>Die folgende URL wurde für dich generiert.<br>Füge sie in deiner liebsten Podcast-App ein.</p>
            <div class="input-group"><input class="form-control" type="text" id="textUrl" value="{{ $url }}" readonly="">
                <div class="input-group-append"><button class="btn btn-primary" id="btnCopy" type="button" data-clipboard-target="#textUrl"><i class="far fa-copy"></i></button></div>
            </div>
        </form>
    </div>
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="/assets/js/script.min.js"></script>
</body>

</html>
