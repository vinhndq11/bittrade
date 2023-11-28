@foreach($form_fields as $key => $field)
    @if($key === 'row')
        <div class="row">
            @foreach($field as $fi)
                <div class="col-xs-{{ $fi['col'] ??  12 / count($field['rows']) }}">
                    @include('backend.layout.component.input_no_translation_item', ['field' => $fi])
                </div>
            @endforeach
        </div>
    @elseif(!empty($field['rows']))
        <div class="row">
            @foreach($field['rows'] as $fi)
                <div class="col-xs-{{ $fi['col'] ?? 12 / count($field['rows']) }}">
                    @include('backend.layout.component.input_no_translation_item', ['field' => $fi])
                </div>
            @endforeach
        </div>
    @else
        @include('backend.layout.component.input_no_translation_item')
    @endif
@endforeach
