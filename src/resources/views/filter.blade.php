@extends("layouts.app")

@section("content")
    <form method="post" action="/url" enctype="multipart/form-data">
        <h2 class="text-center"><strong>{{ env('APP_NAME') }}</strong></h2>
        @if (isset($errors))
            <p class="alert alert-danger">
                {!! $errors !!}
            </p>
        @endif
        <div class="form-group">
            <input class="form-control" type="url" id="textUrl" name="url" placeholder="{{ __('filter.placeholder_url') }}" required="">
            <small class="form-text text-muted">@lang("filter.hint_url")</small>
        </div>
        <div class="form-group">
            <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
                <label class="btn btn-primary active">
                    <input type="radio" id="radio-whitelist" name="type" value="whitelist" checked>
                    @lang('filter.label_whitelist')
                </label>
                <label class="btn btn-primary">
                    <input type="radio" id="radio-blacklist" name="type" value="blacklist">
                    @lang('filter.label_blacklist')
                </label>
            </div>
            <small class="form-text text-muted" id="hint-whitelist">@lang('filter.hint_whitelist')</small>
            <small class="form-text text-muted d-none" id="hint-blacklist">@lang('filter.hint_blacklist')</small>
        </div>
        <div class="form-group">
            <textarea name="filter" class="form-control" id="textFilter" placeholder="{{ __('filter.placeholder_filter') }}" style="height: 200px;" required></textarea>
        </div>
        <div class="form-group">
            <button class="btn btn-primary btn-block" type="submit">{{ __('filter.button_generate_url') }}</button>
        </div>
        <div class="collapse-line-element">
            <div class="collapse-line-container">
                <div class="collapse-line">
                    <a class="" data-toggle="collapse" href="#collapse-advanced" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <i class="collapse-icon-left fas fa-caret-down"></i> {{ __('filter.collapse_advanced_settings') }} <i class="collapse-icon-right fas fa-caret-down"></i>
                    </a>
                </div>
            </div>
            <div class="collapse hide" id="collapse-advanced">

                <p class="text-justify alert alert-info">
                    <i class="fas fa-info-circle fa-2x float-left mr-2 my-2"></i>
                    @lang('filter.intro_advanced_settings')
                </p>

                <div class="form-group">
                    <input type="text" name="custom_title" id="custom-title" class="form-control" placeholder="{{ __('filter.placeholder_custom_title') }}">
                    <small class="form-text text-muted">{{ __('filter.hint_custom_title') }}</small>
                </div>

                <div class="custom-file">
                    <input type="file" name="custom_artwork" id="file-thumbnail" class="custom-file-input">
                    <label for="file-thumbnail" class="custom-file-label text-muted" data-browse="{{ __('filter.file_browse') }}">{{ __('filter.placeholder_custom_artwork') }}</label>
                    <small class="form-text text-muted">
                        @lang('filter.hint_custom_artwork')
                    </small>
                </div>

            </div>
        </div>
    </form>
@endsection
