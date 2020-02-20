@extends("layouts.app")

@section("content")
    <form method="post">
        <h2 class="text-center"><strong>{{ env('APP_NAME') }}</strong></h2>
        <p class="text-center">Die folgende URL wurde für dich generiert.<br>Füge sie in deiner liebsten Podcast-App
            ein.</p>
        <div class="input-group"><input class="form-control" type="text" id="textUrl" value="{{ $url }}" readonly>
            <div class="input-group-append">
                <button class="btn btn-primary clipboard-copy" type="button" data-clipboard-target="#textUrl"><i
                        class="far fa-copy"></i></button>
            </div>
        </div>
        <a class="d-block btn btn-outline-primary mt-5" href="/"><i class="fas fa-chevron-left"></i>&nbsp;Zurück</a>
    </form>
@endsection
