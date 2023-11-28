$(function (){
	let socket = io(window.SOCKET_PATH);
	$('input[name="choose-result"]').on('ifChecked', function (){
		$.put(window.OVERRIDE_RESULT_PATH, { override_result: $(this).val() });
	})
	socket.on('WE_PRICE', ({ second, is_bet }) => {
		$('.second').text(second);
		$('.is_bet_label').text(is_bet ? 'Đang chờ đặt lệnh' : 'Đang chờ kết quả');
		if(is_bet){
			$('.btn-second').removeAttr('disabled');
			$('.label-result').find('input, button').removeAttr('disabled');
		} else {
			$('.btn-second').attr('disabled', 'disabled');
			if (second < 10) {
				$('.label-result').find('input, button').attr('disabled', 'disabled');
			}
		}

		$.get(window.DATA_PATH).then(({ data, message, success }) => {
			if(success){
				Object.keys(data).forEach(key => $(`.${key}`).text(data[key]));
				let { member_transactions, override_result } = data;
				let trs = member_transactions.map(item => {
					return `<tr>
						<td>${item.username}</td>
						<td>${item.email}</td>
						<td>${item.bet_condition === 'up' ? 'Tăng' : 'Giảm'}</td>
						<td>${item.count}</td>
						<td>${item.sum}</td>
					</tr>`
				}).join('');
				if(!override_result){
					$('input').iCheck('uncheck');
				} else {
					$(`input[value="${override_result}"]`).attr('checked', 'checked');
					$('input').iCheck('update');
				}
				$('#member_transactions>tbody').html(trs);
			}
		});
	})
});
