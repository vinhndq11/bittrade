@php($lang = isset($lang) ? "_{$lang}" : '')
@php($class = 'form-control ' . (isset($class) ? $class : ''))
<div class="form-group">
    {{ Form()::label("{$name}{$lang}", $label ?? trans("setting.$name", [], $lang)) }}
    {{ Form()::textarea("{$name}{$lang}", setting("{$name}{$lang}"), ['class' => $class, 'id'=>"{$name}{$lang}", 'rows' => $rows ?? 3] ) }}
</div>
