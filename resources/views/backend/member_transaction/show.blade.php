<table class="table table-bordered table-hover">
    <tr>
        <th>Mã giao dịch</th>
        <td>{{ $item->code }}</td>
        <td>{{ Date2String($item->created_at, HUMAN_FORMAT_DATE) }}</td>
    </tr>
    <tr>
        <th>Thành viên</th>
        <td>{{ optional($item->member)->full_name ?? optional($item->member)->username ?? 'UNKNOWN' }}</td>
        <td>{{ optional($item->member)->email ?? 'UNKNOWN' }}</td>
    </tr>
    <tr>
        <th>Loại tiền sử dụng</th>
        <td colspan="2">Tài khoản {{ $item->point_type_label }}</td>
    </tr>
    <tr>
        <th>Loại giao dịch</th>
        <td colspan="2">{{ $item->transaction_type_label }}</td>
    </tr>
    <tr>
        <th>Trạng thái giao dịch</th>
        <td colspan="2">{{ $item->transaction_status_label }}</td>
    </tr>
    <tr>
        <th>Giá trị giao dịch</th>
        <td colspan="2">${{ number_format($item->value) }}</td>
    </tr>
    <tr>
        <th>Ghi chú</th>
        <td colspan="2">{{ $item->note }}</td>
    </tr>
    @if($withdrawal = $item->withdrawal)
    <tr>
        <th>Cổng thanh toán</th>
        <td colspan="2" style="text-transform: uppercase">{{ $withdrawal->payment_type }}</td>
    </tr>
    <tr>
        <th>Ngân hàng</th>
        <td colspan="2">{{ $withdrawal->bank_name }}</td>
    </tr>
    <tr>
        <th>Số tài khoản nhận</th>
        <td colspan="2">{{ $withdrawal->bank_number }}</td>
    </tr>
    <tr>
        <th>Tên tài khoản</th>
        <td colspan="2">{{ $withdrawal->bank_account }}</td>
    </tr>
    @endif
</table>
