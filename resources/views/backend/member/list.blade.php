@extends('backend.layout.master')

@section('title', 'Quản lý thành viên')

@section('css')
@endsection

@section('js')
    <script>
		const columns = [
			{ data: 'DT_RowIndex', title: '#', orderable: false, searchable: false },
			{ data: 'first_name', name: 'first_name', title: 'Tên/Username', orderable: false, render: (data, type, row) => data ? data : `#${row.username}` },
			{ data: 'username', name: 'username', visible: false },
			{ data: 'email', name: 'email', title: 'Email' },
			{ data: 'ref_username', name: 'ref_username', title: 'Người giới thiệu', render: (data, type, row) => data ? '#' + data : '' },
			{ data: 'user_mode_label', name: 'user_mode', title: 'Hạng thành viên' },
			{ data: 'created_at', name: 'created_at', title: 'Tạo lúc', className: 'text-center' },
			{ data: 'demo_balance', name: 'id', orderable: false, title: 'Tài khoản demo', className: 'text-right', render: (data, type, row) => `$${window.Helper.formatNumber(data)} <button class="btn btn-xs btn-primary plus-balance" data-type='demo' data-id="${row.id}" data-email="${row.email}" title="Nạp thêm"><i class="fa fa-plus-circle"></i></button>` },
			{ data: 'real_balance', name: 'id', orderable: false, title: 'Tài khoản thực', className: 'text-right', render: (data, type, row) => `$${window.Helper.formatNumber(data)} <button class="btn btn-xs btn-primary plus-balance" data-type='real' data-id="${row.id}" data-email="${row.email}" title="Nạp thêm"><i class="fa fa-plus-circle"></i></button>`  },
			{ data: 'active', name: 'is_active', title: 'Trạng thái', className: 'text-center' },
			{ data: 'action', name: 'action', title: '...' },
		];
    </script>
    <div class="modal fade" id="modal-recharge">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Nạp tiền cho tài khoản: <b class="account"></b></h4>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="form-group">
                            <label for="first_name">Số tiền cần nạp ($)</label>
                            <input type="hidden" name="balance_type">
                            <input type="hidden" name="recharge_id">
                            <input title="" class="form-control currency" value="{{ setting('minimum_deposit') }}" autocomplete="off" name="balance_amount" type="number">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary recharge-submit">Nạp ngay</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        const $modalRecharge = $('#modal-recharge');
        $('.recharge-submit').click(function (){
			let data_type = $('input[name="balance_type"]').val();
			let amount = $('input[name="balance_amount"]').val();
			let recharge_id = $('input[name="recharge_id"]').val();
			$.post('{{ route('admin.member.recharge.post', 'ID') }}'.replace('ID', recharge_id), {
				data_type,
				amount
			}).then(({ success, message }) => {
				$.alert(message)
				if(success){
					$modalRecharge.modal('hide');
					window.tableMain.draw();
                }
			});
        });
        $('#datatable').on('click', 'button.plus-balance', function (){
			$modalRecharge.find('.account').text($(this).data('email'));
			$modalRecharge.modal('show');
			$('input[name="balance_type"]').val($(this).data('type'));
			$('input[name="recharge_id"]').val($(this).data('id'));
        });
    </script>
@endsection

@component('backend.layout.component.list')
@endcomponent
