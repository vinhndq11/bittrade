@php($lang = isset($lang) ? "_{$lang}" : '')
<div class="form-group">
    {{ Form()::label("{$name}{$lang}", $label ?? trans("setting.$name", [], $lang)) }}
    <div class="input-group">
        {{ Form()::text("{$name}{$lang}", setting("{$name}{$lang}"), ['class' => 'form-control', 'id'=>"{$name}{$lang}"] ) }}
        <span class="input-group-btn">
            <button class="btn btn-primary btn-browser" type="button"><span class="glyphicon glyphicon-book" aria-hidden="true"></span></button>
        </span>
    </div>
</div>
