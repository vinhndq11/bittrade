<?php
return [
    'transaction_type' => [
        TRANSACTION_TYPE_WITHDRAWAL => 'Rút tiền',
        TRANSACTION_TYPE_RECHARGE => 'Nạp tiền',
        TRANSACTION_TYPE_BET => 'Đặt cược',
        TRANSACTION_TYPE_BUY_VIP => 'Mua VIP',
        TRANSACTION_TYPE_REF => 'Hoa hồng',
    ],
    'transaction_status' => [
        TRANSACTION_STATUS_FINISH => 'Hoàn thành',
        TRANSACTION_STATUS_PENDING => 'Đang chờ',
        TRANSACTION_STATUS_PROCESSING => 'Đang xử lý',
        TRANSACTION_STATUS_CANCEL => 'Đã hủy',
    ],
    'point_type' => [
        POINT_TYPE_DEMO => 'Demo',
        POINT_TYPE_REAL => 'Thực'
    ],
    'commission_type' => [
        COMMISSION_TYPE_TRADE => 'Giao dịch',
        COMMISSION_TYPE_VIP => 'VIP',
    ]
];
