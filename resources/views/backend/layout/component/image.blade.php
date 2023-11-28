<div class="image-component {{ isset($src) && $src ? 'has-image' : '' }}" style="min-height: {{$height ?? 200}}px">
    <img src="{{ $src ?? '' }}" alt="Image">
    <div class="ratio">
        {{ trans('backend.ratio') }}: <span class="aspect">NaN</span>
    </div>
    <button type="button" class="btn btn-sm btn-remove-image">
        <i class="fa fa-times-circle"></i>
    </button>
    <span class="glyphicon glyphicon-plus-sign icon-plus"></span>
    <input type="hidden" name="{{ $name }}" value="{{ $src ?? '' }}" class="{{ $class ?? '' }}" >
</div>
