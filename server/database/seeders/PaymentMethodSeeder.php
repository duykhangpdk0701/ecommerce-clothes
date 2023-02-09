<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'type' => NULL,
                'name' => ['vi' => 'Thanh toán khi nhận hàng', 'en' => 'Payment on delivery'],
                'key' => 'CashOnDelivery',
                'fee' => 0.0000,
                'fee_type' => 1,
                'status' => 0
            ],
            [
                'id' => 2,
                'type' => NULL,
                'name' => ['vi' => 'Thẻ ATM nội địa', 'en' => 'Domestic ATM card'],
                'key' => 'ATM_ONLINE',
                'fee' => 0.0000,
                'fee_type' => 1,
                'status' => 0
            ],
            [
                'id' => 3,
                'type' => NULL,
                'name' => ['vi' => 'INTERNET BANKING', 'en' => 'INTERNET BANKING'],
                'key' => 'IB_ONLINE',
                'fee' => 0.0000,
                'fee_type' => 1,
                'status' => 0
            ],
            [
                'id' => 4,
                'type' => NULL,
                'name' => ['vi' => 'Thẻ ATM OFFLINE', 'en' => 'ATM card OFFLINE'],
                'key' => 'ATM_OFFLINE',
                'fee' => 0.0000,
                'fee_type' => 1,
                'status' => 0
            ],
            [
                'id' => 5,
                'type' => NULL,
                'name' => ['vi' => 'VISA/ MASTERCARD', 'en' => 'VISA/ MASTERCARD'],
                'key' => 'VISA',
                'fee' => 0.0000,
                'fee_type' => 1,
                'status' => 0
            ],
            [
                'id' => 6,
                'type' => NULL,
                'name' => ['vi' => 'Tiền mặt', 'en' => 'Cash'],
                'key' => 'PayAtStoreCash',
                'fee' => 0.0000,
                'fee_type' => 1,
                'status' => 1
            ],
            [
                'id' => 7,
                'type' => NULL,
                'name' => ['vi' => 'Chuyển khoản', 'en' => 'Transfer'],
                'key' => 'PayAtStoreTransfer',
                'fee' => 0.0000,
                'fee_type' => 1,
                'status' => 1
            ],
            [
                'id' => 8,
                'type' => NULL,
                'name' => ['vi' => 'Đặt hàng trực tuyến', 'en' => 'Order Online'],
                'key' => 'OrderOnline',
                'fee' => 0.0000,
                'fee_type' => 1,
                'status' => 1
            ],
            [
                'id' => 9,
                'type' => NULL,
                'name' => ['vi' => 'Tín dụng', 'en' => 'Credit'],
                'key' => 'PayAtStoreCredit',
                'fee' => 3.0000,
                'fee_type' => 1,
                'status' => 1
            ],
            [
                'id' => 10,
                'type' => NULL,
                'name' => ['vi' => 'Thanh toán khi nhận hàng', 'en' => 'Cash On Delivery (COD)'],
                'key' => 'COD',
                'fee' => 0.0000,
                'fee_type' => 1,
                'status' => 1
            ],
            [
                'id' => 11,
                'type' => NULL,
                'name' => ['vi' => 'Thanh toán qua MOMO', 'en' => 'Pay At Store MOMO'],
                'key' => 'PayAtStoreMoMo',
                'fee' => 0.0000,
                'fee_type' => 1,
                'status' => 0
            ],
        ];

        foreach ($data as $item) {
            PaymentMethod::updateOrCreate(
                [
                    'id' => $item['id']
                ],
                [
                    'type' => $item['type'],
                    'name' => $item['name'],
                    'key' => $item['key'],
                    'fee' => $item['fee'],
                    'fee_type' => $item['fee_type'],
                    'status' => $item['status']
                ]
            );
        }
    }
}
