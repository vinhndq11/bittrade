@extends('backend.layout.master')

@section('title', 'Lịch sử giao dịch')

@section('css')
@endsection

@section('js')
    <script>
		const columns = [
			{ data: 'DT_RowIndex', title: '#', orderable: false, searchable: false },
			{ data: 'code', name: 'code', title: 'Mã giao dịch'},
			{ data: 'point_type_label', name: 'point_type', title: 'Loại tài khoản'},
			{ data: 'transaction_type_label', name: 'transaction_type', title: 'Loại g.dịch'},
			{ data: 'transaction_status_label', name: 'transaction_status', title: 'Trạng thái g.dịch'},
			{ data: 'value', name: 'value', title: 'Giá trị', className: 'text-right', render: (data) => '$' + window.Helper.formatNumber(data)},
			{ data: 'created_at', name: 'created_at', title: 'Ngày tạo'},
			{ data: 'updated_at', name: 'updated_at', title: 'Cập nhật lần cuối'},
			{ data: 'member.first_name', name: 'member_id', title: 'Thành viên', render: (data, type, row) => data ? data : `#${row.member.username}`},
			{ data: 'note', name: 'note', title: 'Ghi chú' },
			{ data: 'action', name: 'action', title: '...' }
		];
		window.filter_function = function () {
			let point_type = $('#point_type').val();
			let transaction_type = $('#transaction_type').val();
			let transaction_status = $('#transaction_status').val();
			let member_id = $('#member_id').val();
			return { point_type, transaction_type, transaction_status, member_id };
		}
		$('table')
            .on('click', 'button.btn-confirm', function (){
			let confirmLink = $(this).data('link');
			$.confirm({
				title: 'Bạn muốn làm gì với giao dịch này?',
                content: '',
				type: 'red',
				typeAnimated: true,
				buttons: {
					accept: {
						text: 'Duyệt xong',
						btnClass: 'btn-green',
						action: function(){
							$.post(confirmLink, { action: 'accept' } ).then(({ data, message, success }) => {
								$.alert(message);
								success && window.tableMain.draw();
                            });
						}
					},
					cancel: {
						text: 'Hủy bỏ',
						btnClass: 'btn-red',
						action: function(){
							$.post(confirmLink, { action: 'cancel' } ).then(({ data, message, success }) => {
								$.alert(message);
								success && window.tableMain.draw();
							});
						}
					},
					close: {
						text: 'Đóng lại',
					},
				}
			});
        })
            .on('click', '.btn-detail', function (){
                let link = $(this).data('link');
                $.get(link).then(({data: { view }}) => {
					$('#modal-info .modal-body').html(view);
					$('#modal-info').modal('show');
                });
            });
    </script>
    <div class="modal fade" id="modal-info">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Chi tiết giao dịch</h4>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div
@endsection

@component('backend.layout.component.list', ['addNew' => false])
@endcomponent
