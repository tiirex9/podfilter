<!DOCTYPE html>
<html style="height: 100%;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>{{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="/assets/css/styles.min.css">
</head>

<body style="height: 100%;">
<div class="contact-clean" style="height: 100%;">
    <form method="post" action="/url">
        <h2 class="text-center"><strong>{{ env('APP_NAME') }}</strong></h2>
        <div class="form-group">
            <input class="form-control" type="url" id="textUrl" name="url"
                   placeholder="Podcast RSS-Feed URL" required="">
            <small class="form-text text-muted">
                Trage hier die URL zu dem RSS Feed deines zu filternden Podcasts ein. Wenn du diese nicht kennst, kannst
                du
                sie auf <a href="https://www.listennotes.com/" target="_blank">listennotes.com</a> herausfinden.
            </small>
        </div>
        <div
            class="form-group">
            <div class="form-row" style="margin: 0;">
                <div class="col">
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="checkWhitelist" name="type" value="whitelist"
                               onclick="changeType(this);" checked/>
                        <label class="form-check-label" for="checkWhitelist">Whitelist</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="checkBlacklist" name="type" value="blacklist"
                               onclick="changeType(this);"/>
                        <label class="form-check-label" for="checkBlacklist">Blacklist</label>
                    </div>
                </div>
            </div>
            <small class="form-text text-muted" id="hintWhitelist">
                Erlaubt nur Folgen, die eins der unten angegebenen Wörter im Folgentitel beinhaltet.
            </small>
            <small class="form-text text-muted" id="hintBlacklist">
                Erlaubt nur Folgen, die die unten angegebenen Wörter <strong>NICHT</strong> im Folgentitel beinhalten.
            </small>
        </div>
        <div
            class="form-group"><textarea class="form-control" id="textFilter" name="filter"
                                         placeholder="Filter (einen pro Zeile)" style="height: 200px;"
                                         required=""></textarea></div>
        <div class="form-group">
            <button class="btn btn-primary btn-block" type="submit">URL erzeugen</button>
        </div>
    </form>
</div>
<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/bootstrap/js/bootstrap.min.js"></script>
<script src="/assets/js/script.min.js"></script>
</body>

</html>
