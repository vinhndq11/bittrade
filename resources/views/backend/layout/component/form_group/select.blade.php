@php($lang = isset($lang) ? "_{$lang}" : '')
<div class="form-group">
    {{ Form()::label("{$name}{$lang}", $label ?? trans("setting.$name", [], $lang)) }}
    {{ Form()::select("{$name}{$lang}", $list ?? [] , setting("{$name}{$lang}") , ['id'=>"{$name}{$lang}", 'class' => "form-control select2"] ) }}
</div>
