@extends("layouts.app")

@section("content")
    <form method="post" action="/url" enctype="multipart/form-data">
        <h2 class="text-center"><strong>{{ env('APP_NAME') }}</strong></h2>
        @if (isset($errors))
            <p class="alert alert-danger">
                {!! $errors !!}
            </p>
        @endif
        <div class="form-group"><input class="form-control" type="url" id="textUrl" name="url" placeholder="Podcast Feed-URL" required=""><small class="form-text text-muted">Trage hier die URL zu dem XML Feed deines zu filternden Podcasts ein. Wenn du diese nicht kennst, kannst du sie auf <a href="https://www.listennotes.com/">listennotes.com</a> herausfinden.</small></div>
        <div
            class="form-group">
            <div class="form-row" style="margin: 0;">
                <div class="col">
                    <div class="form-check"><input class="form-check-input" type="radio" id="radio-whitelist" name="type" value="whitelist" checked=""><label class="form-check-label" for="radio-whitelist">Whitelist</label></div>
                </div>
                <div class="col">
                    <div class="form-check"><input class="form-check-input" type="radio" id="radio-blacklist" name="type" value="blacklist"><label class="form-check-label" for="radio-blacklist">Blacklist</label></div>
                </div>
            </div><small class="form-text text-muted" id="hint-whitelist">Erlaubt nur Episoden, die eins der unten angegebenen Wörter im Titel beinhaltet.</small><small class="form-text text-muted d-none" id="hint-blacklist">Erlaubt nur Episoden, die die unten angegebenen Wörter <strong>NICHT</strong> im Titel beinhalten.</small></div>
        <div class="form-group">
            <textarea name="filter" class="form-control" id="textFilter" placeholder="Filter (einen pro Zeile)" style="height: 200px;" required></textarea>
        </div>
        <div class="form-group">
            <button class="btn btn-primary btn-block" type="submit">URL erzeugen</button></div><div class="collapse-line-element">
            <div class="collapse-line-container">
                <div class="collapse-line">
                    <a class="" data-toggle="collapse" href="#collapse-advanced" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <i class="collapse-icon-left fas fa-caret-down"></i> Erweiterte Einstellungen <i class="collapse-icon-right fas fa-caret-down"></i>
                    </a>
                </div>
            </div>
            <div class="collapse hide" id="collapse-advanced">

                <p class="text-justify alert alert-info">
                    <i class="fas fa-info-circle fa-2x float-left mr-2 my-2"></i>
                    Wenn du möchtest, kannst du hier noch den Titel und die Podcast Grafik verändern.<br>
                    Das kann besonders dann praktisch sein, wenn du die selbe Quelle mehrfach verwendest und z. B. zwei verschiedene Formate im selben Podcast abonnieren möchtest.
                </p>

                <div class="form-group">
                    <input type="text" name="custom_title" id="custom-title" class="form-control" placeholder="Benutzerdefinierter Titel">
                    <small class="form-text text-muted">Mit dieser Einstellung kannst du den Podcasttitel verändern.</small>
                </div>

                <div class="custom-file">
                    <input type="file" name="custom_artwork" id="file-thumbnail" class="custom-file-input">
                    <label for="file-thumbnail" class="custom-file-label text-muted" data-browse="Durchsuchen">Benutzerdefinierte Grafik</label>
                    <small class="form-text text-muted">
                        Verändere die Grafik des Podcasts, damit du ihn leicht in der Liste deiner abonnierten Podcasts wiederfindest. Es wird eine quadratische Grafik mit min. 1400x1400px und max. 3000x3000px erwartet.
                    </small>
                </div>

            </div>
        </div>
    </form>
@endsection
