@extends('backend.layout.master')

@section('title', 'Cập nhật mẫu email')

@section('css')
    <link rel="stylesheet" href="plugins/codemirror/lib/codemirror.css" />
@endsection

@section('js')
    <script src="plugins/codemirror/lib/codemirror.js"></script>
    <script src="plugins/codemirror/addon/selection/selection-pointer.js"></script>
    <script src="plugins/codemirror/mode/xml/xml.js"></script>
    <script src="plugins/codemirror/mode/javascript/javascript.js"></script>
    <script src="plugins/codemirror/mode/css/css.js"></script>
    <script src="plugins/codemirror/mode/vbscript/vbscript.js"></script>
    <script src="plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>
    <script>
        window.templates = JSON.parse('{!! json_encode($templates) !!}');
		Object.keys(window.templates).forEach(item => {
			CodeMirror.fromTextArea(document.getElementById(item), {
				mode: {
					name: "htmlmixed",
					scriptTypes: [
						{matches: /\/x-handlebars-template|\/x-mustache/i, mode: null},
						{ matches: /(text|application)\/(x-)?vb(a|script)/i, mode: "vbscript"}
                    ]
				},
				selectionPointer: true
			});
        });
    </script>
@endsection

@section('content')
    <div class="box">
        {{ Form()::open(['url' => route("admin.template.update"), 'method' => 'PUT', 'enctype'=>'multipart/form-data', 'spellcheck'=>'false', 'class' => 'form-main']) }}
        <div class="box-header with-border">
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-primary" name="save" value="{{route("admin.template.index")}}" type="submit"><i class="fa fa-check"></i> Lưu </button>
                    <a class="btn btn-warning pull-right" href="{{route("admin.template.index")}}"><i class="fa fa-close"></i> Hủy bỏ</a>
                </div>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                @foreach($templates as $filename => $title)
                <div class="col-xs-12 col-sm-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{$title}}</h3>
                        </div>
                        <div class="panel-body">
                            <textarea id="{{ $filename }}" name="mail[{{ $filename }}]">
                                {{ file_get_contents(resource_path("views/mail/{$filename}.blade.php")) }}
                            </textarea>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        {{ Form()::close() }}
    </div>
@endsection

