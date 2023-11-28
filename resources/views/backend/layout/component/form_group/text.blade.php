@php($lang = isset($lang) ? "_{$lang}" : '')
<div class="form-group">
    {{ Form()::label("{$name}{$lang}", $label ?? trans("setting.$name", [], $lang)) }}
    {{ Form()::text("{$name}{$lang}", setting("{$name}{$lang}",  $default_value ?? ''), ['class' => 'form-control', 'id'=>"{$name}{$lang}"]) }}
</div>
