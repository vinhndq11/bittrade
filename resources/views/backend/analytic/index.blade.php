@extends('backend.layout.master')

@section('title', 'Phân tích cược TÀI KHOẢN THỰC')

@section('css')
@stop

@section('js')
    <script>
        window.DATA_PATH = '{{ route('admin.analytic.data') }}'
        window.SOCKET_PATH = '{{ setting('socket_link') }}';
        window.OVERRIDE_RESULT_PATH = '{{ route('admin.analytic.update_bet_result') }}';
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.0.1/socket.io.min.js"></script>
    <script src="js/analytic.js"></script>
    <script>
		jQuery('input').iCheck({
			checkboxClass: 'icheckbox_square-blue',
			radioClass: 'iradio_square-blue',
			increaseArea: '20%'
		});
    </script>
@stop

@section('content')
    <div class="row">
        <section class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Quyết định kết quả</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12 col-md-4">
                            <h1 style="margin-top: 0;">
                                <span class="label label-primary btn-result">
                                    <span>Dự đoán kết quả:</span> <span class="bet_guess" style="font-weight: bolder; text-transform: uppercase; color: yellow">...</span>
                                </span>
                            </h1>
                        </div>
                        <div class="col-xs-12 col-md-4 text-center">
                            <h1 style="margin-top: 0;">
                                <span class="label label-info btn-second">
                                    <span class="is_bet_label">Chờ kết quả</span>: <span class="second" style="font-weight: bolder; color: yellow; font-size: 25px">0</span>s
                                </span>
                            </h1>
                        </div>
                        <div class="col-xs-12 col-md-4 text-center">
                            <label class="label-result label-up">
                                <button type="button" style="background-color:#ffffff;" class="btn btn-default btn-lg">
                                    <input type="radio" name="choose-result" value="up"> <span class="label label-success">Quyết định tăng</span>
                                </button>
                            </label>
                            <label class="label-result label-down">
                                <button type="button" style="background-color:#ffffff;" class="btn btn-default btn-lg">
                                    <input type="radio" name="choose-result" value="down"> <span class="label label-danger">Quyết định giảm</span>
                                </button>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
