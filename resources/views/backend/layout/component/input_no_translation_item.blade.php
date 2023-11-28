@php
    $class = 'form-control ' . ($field['class'] ?? '');
    $class = $class . (isset($field['required']) && $field['required'] ? ' required' : '');
@endphp
@if(empty($field['block']))
    @if($field['type'] == FORM_TYPE_HIDDEN)
        {{ Form()::hidden($field['name'], $mainData->{$field['name']} ?? old($field['name'], $field['default_value'] ?? null), ['class' => $class, 'id'=>$field['name']] ) }}
    @else
        <div class="form-group">
            <label for="{{ $field['name'] }}"><i class='fa fa-times-circle-o fa-spin'></i> {{ trans("{$viewFolder}.{$field['name']}") }} <span class="color-red text-bold">{{ !empty($field['required']) ? '*' : '' }}</span></label>
            @switch($field['type'])
                @case(FORM_TYPE_TEXTAREA)
                {{ Form()::textarea($field['name'], $mainData->{$field['name']} ?? old($field['name'], $field['default_value'] ?? null), ['class' => $class, 'id'=>$field['name'], 'rows'=> $field['row_line'] ?? 4, 'disabled' => $field['disabled'] ?? false] ) }}
                @break

                @case(FORM_TYPE_NUMBER)
                {{ Form()::number($field['name'], $mainData->{$field['name']} ?? old($field['name'], $field['default_value'] ?? null) , ['class' => $class,'id'=>$field['name'], 'min'=> $field['min'] ?? null, 'max' => $field['max'] ?? null, 'disabled' => $field['disabled'] ?? false] ) }}
                @break

                @case(FORM_TYPE_CURRENCY)
                {{ Form()::number($field['name'], $mainData->{$field['name']} ?? old($field['name'], $field['default_value'] ?? null) , ['class' => "$class currency",'id'=>$field['name'], 'min'=> $field['min'] ?? null, 'max' => $field['max'] ?? null, 'disabled' => $field['disabled'] ?? false] ) }}
                @break

                @case(FORM_TYPE_EDITOR)
                {{ Form()::textarea($field['name'], $mainData->{$field['name']} ?? old($field['name'], $field['default_value'] ?? null), ['class' => "$class editor", 'id'=>$field['name'], 'disabled' => $field['disabled'] ?? false] ) }}
                @break

                @case(FORM_TYPE_SELECT)
                {{ Form()::select($field['name'], $field['list'], $mainData->{$field['name']} ?? old($field['name'], $field['default_value'] ?? null) , ['id'=>$field['name'], 'class' => "$class select2", 'disabled' => $field['disabled'] ?? false] ) }}
                @break

                @case(FORM_TYPE_SELECT_LEVEL)
                <select aria-label="" id="{{ $field['name'] }}" {{ ($field['disabled'] ?? false) ? 'disabled' : '' }} class="{{ $class }} select2" name="{{ $field['name'] }}">
                    @foreach($field['list'] as $item)
                        <option value="{{ $item->id }}" {{ ($mainData->{$field['name']} ?? old($field['name'], $field['default_value'] ?? null)) == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                        @foreach($item->children as $child)
                            <option value="{{ $child->id }}" {{ ($mainData->{$field['name']} ?? old($field['name'], $field['default_value'] ?? null)) == $child->id ? 'selected' : '' }}>--- {{ $child->name }}</option>
                        @endforeach
                    @endforeach
                </select>
                @break

                @case(FORM_TYPE_SELECT_LEVEL_MULTI)
                <select multiple="multiple" aria-label="" class="{{ $class }} select2" name="{{ $field['name'] }}[]" id="{{ $field['name'] }}">
                    @foreach($field['list'] as $item)
                        <option value="{{$item->id}}" {{ isset($mainData) && in_array($item->id, $mainData->{$field['name']}->pluck('id')->toArray()) ? 'selected="selected"' : '' }}>{{ $item->name }}</option>
                        @foreach($item->children as $child)
                            <option value="{{$child->id}}" {{ isset($mainData) && in_array($child->id, $mainData->{$field['name']}->pluck('id')->toArray()) ? 'selected="selected"' : '' }}>--- {{ $child->name }}</option>
                        @endforeach
                    @endforeach
                </select>
                @break

                @case(FORM_TYPE_SELECT_MULTI)
                <select multiple="multiple" aria-label="" class="{{ $class }} select2" name="{{ $field['name'] }}[]" id="{{ $field['name'] }}">
                    @foreach($field['list'] as $id => $text)
                        <option value="{{$id}}" {{ isset($mainData) && in_array($id, is_null($mainData->{$field['name']}) ? [] : (is_array($mainData->{$field['name']}) ? $mainData->{$field['name']} : $mainData->{$field['name']}->pluck('id')->toArray())) ? 'selected="selected"' : '' }}>{{ $text }}</option>
                    @endforeach
                </select>
                @break

                @case(FORM_TYPE_IMAGE)
                @include('backend.layout.component.image', [ 'src' => $mainData->{$field['name']} ?? old($field['name'], $field['default_value'] ?? null), 'name'=>$field['name'], 'height' => $field['height'] ?? 200, 'class' => $class ])
                @break

                @case(FORM_TYPE_URL)
                    <div class="input-group">
                        <input aria-label="" type="text" class="form-control url {{ $class }}" {{ ($field['disabled'] ?? false) ? 'disabled' : '' }} name="{{ $field['name'] }}" value="{{ $mainData->{$field['name']} ?? old($field['name'], $field['default_value'] ?? null) }}">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-warning btn-flat btn-browse">{{ trans('backend.browse') }}</button>
                        </div>
                    </div>
                @break

                @case(FORM_TYPE_IMAGE_MULTI)
                @include('backend.layout.component.image_multi', [ 'list' => $mainData->{$field['name']} ?? [], 'name'=>$field['name'] ])
                @break

                @case(FORM_TYPE_PASSWORD)
                @include('backend.layout.component.password')
                @break

                @case(FORM_TYPE_TIME)
                {{ Form()::text($field['name'], $mainData->{$field['name']} ?? old($field['name'], $field['default_value'] ?? null) , ['id'=>$field['name'], 'class' => "$class timepicker", 'data-format' => $field['data-format'] ?? 'HH:mm', 'disabled' => $field['disabled'] ?? false] ) }}
                @break

                @case(FORM_TYPE_DATE)
                {{ Form()::text($field['name'], isset($mainData) ? Date2String($mainData->{$field['name']}, $field['format'] ?? BIRTHDAY_FORMAT_DATE) : old($field['name'], $field['default_value'] ?? null) , ['id'=>$field['name'], 'class' => "$class format-date", 'data-format' => $field['format'] ?? PICKER_FORMAT_DATE, 'disabled' => $field['disabled'] ?? false] ) }}
                @break

                @case(FORM_TYPE_DATETIME)
                {{ Form()::text($field['name'], isset($mainData) ? Date2String($mainData->{$field['name']}, $field['format'] ?? MYSQL_FORMAT_DATE) : old($field['name'], $field['default_value'] ?? null) , ['id'=>$field['name'], 'class' => "$class format-date-time", 'data-format' => $field['format'] ?? PICKER_FORMAT_DATETIME, 'disabled' => $field['disabled'] ?? false] ) }}
                @break

                @case(FORM_TYPE_EMAIL)
                {{ Form()::email($field['name'], $mainData->{$field['name']} ?? old($field['name'], $field['default_value'] ?? null), ['class' => $class, 'id'=>$field['name'], 'disabled' => $field['disabled'] ?? false] ) }}
                @break

                @case(FORM_TYPE_MAP)
                    <div id="{{ $field['name'] }}" data-lat="{{ $field['lat'] }}" data-lng="{{ $field['lng'] }}" class="gmaps-body"></div>
                    <input type="hidden" name="{{ $field['lat'] }}" value="{{ $mainData->{$field['lat']} ?? old($field['lat']) }}">
                    <input type="hidden" name="{{ $field['lng'] }}" value="{{ $mainData->{$field['lng']} ?? old($field['lng']) }}">
                @break

                @case(FORM_TYPE_COLOR)
                <div class="input-group {{ $field['name'] }} color-picker">
                    {{ Form()::text($field['name'], $mainData->{$field['name']} ?? old($field['name'], $field['default_value'] ?? null), ['class' => $class, 'id'=>$field['name'], 'disabled' => $field['disabled'] ?? false] ) }}
                    <div class="input-group-addon">
                        <i style="background-color: {{old($field['name'], $field['default_value'] ?? null)}};"></i>
                    </div>
                </div>
                @break

                @case(FORM_TYPE_FILE)
                <div class="input-group">
                      <span class="input-group-btn">
                        <span class="btn btn-default btn-file">
                          Browse...
                            {{ Form()::file($field['name'], ['class' => $class, 'id'=>$field['name'], 'disabled' => $field['disabled'] ?? false, 'accept' => $field['accept'] ?? false] ) }}
                        </span>
                      </span>
                    <input readonly="readonly" placeholder="" disabled data-filename aria-label="" class="form-control" type="text">
                </div>
                @break

                @default
                {{ Form()::text($field['name'], $mainData->{$field['name']} ?? old($field['name'], $field['default_value'] ?? null), ['class' => $class, 'id'=>$field['name'], 'disabled' => $field['disabled'] ?? false, 'readonly' => $field['readonly'] ?? false, 'maxlength' => $field['maxlength'] ?? ''] ) }}
            @endswitch
            <span class="color-red error-message"></span>
        </div>
    @endif
@endif
