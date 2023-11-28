@php($lang = isset($lang) ? "_{$lang}" : '')
<div class="form-group">
    {{ Form()::label("{$name}{$lang}", $label ?? trans("setting.$name", [], $lang)) }}
    {{ Form()::number("{$name}{$lang}", setting("{$name}{$lang}",  $default_value ?? ''), ['class' => 'form-control currency', 'id'=>"{$name}{$lang}"]) }}
</div>
