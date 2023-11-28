<div class="nav-tabs-custom">
    <ul class="nav nav-tabs" role="tablist">
        @foreach($composerLocales as $lang)
            <li class="{{$lang==$composerLocale ? 'active' : ''}}">
                <a href="#lang-{{$lang}}" data-toggle="tab">
                    <img alt="{{$lang}}" src="img/flag_{{$lang}}.jpg" class="img-responsive img-flag">
                    {{ trans("backend.lang", [], $lang) }}
                </a>
            </li>
        @endforeach
    </ul>
    <div class="tab-content">
        @foreach($composerLocales as $lang)
            <div class="tab-pane fade {{$lang==$composerLocale ? 'active in' : ''}}" id="lang-{{$lang}}">
                @foreach($form_fields as $field)
                    @if(empty($field['block']))
                    <div class="form-group">
                        {{ Form()::label("trans_{$field['name']}_{$lang}", trans("{$viewFolder}.{$field['name']}", [], $lang)) }}
                        @switch($field['type'])
                            @case(FORM_TYPE_SLUG)
                            {{ Form()::text("{$lang}[{$field['name']}]", $mainData->{"{$field['name']}:{$lang}"} ?? old("{$lang}.{$field['name']}"), ['class' => 'form-control', 'id'=>"trans_{$field['name']}_{$lang}", 'required' => $field['required'] ?? false, 'ref' => $field['ref'] ?? '' ] ) }}
                            @break

                            @case(FORM_TYPE_TEXTAREA)
                            {{ Form()::textarea("{$lang}[{$field['name']}]", $mainData->{"{$field['name']}:{$lang}"} ?? old("{$lang}.{$field['name']}"), ['class' => 'form-control', 'id'=>"trans_{$field['name']}_{$lang}" , 'rows'=> $field['rows'] ?? 4, 'required' => $field['required'] ?? false, 'ref' => $field['ref'] ?? ''] ) }}
                            @break

                            @case(FORM_TYPE_EDITOR)
                            {{ Form()::textarea("{$lang}[{$field['name']}]", $mainData->{"{$field['name']}:{$lang}"} ?? old("{$lang}.{$field['name']}"), ['class' => 'form-control editor', 'id'=>"trans_{$field['name']}_{$lang}", 'rows'=> $field['rows'] ?? 4, 'required' => $field['required'] ?? false] ) }}
                            @break

                            @default
                                {{ Form()::text("{$lang}[{$field['name']}]", $mainData->{"{$field['name']}:{$lang}"} ?? old("{$lang}.{$field['name']}"), ['class' => 'form-control', 'id'=>"trans_{$field['name']}_{$lang}", 'required' => $field['required'] ?? false] ) }}
                        @endswitch
                    </div>
                    @endif
                @endforeach
            </div>
        @endforeach
    </div>
</div>
