@section('content')
    <div class="box box-{{$viewFolder}}">
        {{ Form()::open(['url' => isset($mainData) ? route("admin.$viewFolder.show", $mainData->id) : route("admin.$viewFolder.store"), 'method' => isset($mainData) ? 'PUT' : 'POST', 'enctype'=>'multipart/form-data', 'spellcheck'=>'false', 'is_edit' => isset($mainData) ? 1 : 0, 'class' => 'form-main']) }}
        <div class="box-header with-border">
            <div class="row">
                <div class="col-md-12">
                    @if(view()->exists("backend.{$viewFolder}.partial.button"))
                        @include("backend.{$viewFolder}.partial.button")
                    @else
                        @if(!isset($mainData))
                            <button class="btn btn-primary" name="save" value="{{route("admin.$viewFolder.create")}}" type="submit"><i class="fa fa-plus"></i> Lưu </button>
                        @else
                            <button class="btn btn-primary" name="save" value="{{route("admin.$viewFolder.index")}}" type="submit"><i class="fa fa-check"></i> Lưu </button>
                        @endif
                        <a class="btn btn-danger" href="{{route("admin.$viewFolder.index")}}"><i class="fa fa-close"></i> Trở về danh sách</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="box-body">
            {{ $slot }}
        </div>
        {{ Form()::close() }}
    </div>
@endsection


