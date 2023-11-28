@section('content')
    <div class="box post-list">
        <div class="box-header">
            <div class="row">
                <div class="col-md-10 col-xs-12">
                    @if(view()->exists("backend.$viewFolder.partial.filter"))
                        @include("backend.$viewFolder.partial.filter")
                    @endif
                </div>
                <div class="col-md-2 col-xs-12">
                    @if(!isset($addNew) || $addNew)
                        <a href="{{route("admin.$viewFolder.create")}}" class="btn btn-success pull-right"><i class="fa fa-plus-circle"></i> Thêm mới</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table id="datatable" class="table table-bordered table-hover">
                    <thead>
                        {{ $slot }}
                    </thead>
                    <tfoot>
                        {{ $slot }}
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
