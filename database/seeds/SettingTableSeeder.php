<?php

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Setting::exists() && $this->command->confirm('Do you want to truncate Setting table???', false)) {
            Setting::truncate();
        }
        $settings = [
            ['name' => 'App Name', 'key' => 'app_name', 'value' => 'WEFINEX', 'default_value' => 'WEFINEX', 'description' => 'Tên ứng dụng', 'color' => 'blue', 'editable' => 1],
            ['name' => 'Profit percent', 'key' => 'profit_percent', 'value' => '95', 'default_value' => '95', 'description' => 'Phần trăm lợi nhuận khách nhận được khi cược thắng (%)', 'color' => 'blue', 'editable' => 1],
            ['name' => 'Demo default balance', 'key' => 'demo_default_balance', 'value' => '500000', 'default_value' => '500000', 'description' => 'Số tiền mặc định của tài khoản demo', 'color' => 'blue', 'editable' => 1],
            ['name' => 'Contact phone', 'key' => 'contact_phone', 'value' => '', 'default_value' => '', 'description' => 'Số điện thoại liên hệ', 'color' => 'black', 'editable' => 1],
            ['name' => 'Contact email', 'key' => 'contact_email', 'value' => '', 'default_value' => '', 'description' => 'Email liên hệ', 'color' => 'black', 'editable' => 1],
            ['name' => 'Seo title', 'key' => 'seo_title', 'value' => '', 'default_value' => '', 'description' => 'Seo title', 'color' => 'green', 'editable' => 1],
            ['name' => 'Seo description', 'key' => 'seo_description', 'value' => '...', 'default_value' => '...', 'description' => 'Seo description', 'color' => 'green', 'editable' => 1],
            ['name' => 'Seo keywords', 'key' => 'seo_keywords', 'value' => '...', 'default_value' => '...', 'description' => 'Seo keywords', 'color' => 'green', 'editable' => 1],
            ['name' => 'Ngân hàng', 'key' => 'bank_name', 'value' => '...', 'default_value' => '...', 'description' => 'Tên ngân hàng nhận chuyển khoản', 'color' => 'red', 'editable' => 1],
            ['name' => 'Số tài khoản', 'key' => 'bank_number', 'value' => '...', 'default_value' => '...', 'description' => 'Số tài khoản', 'color' => 'red', 'editable' => 1],
            ['name' => 'Chủ tài khoản', 'key' => 'bank_account', 'value' => '...', 'default_value' => '...', 'description' => 'Chủ tài khoản', 'color' => 'red', 'editable' => 1],
            ['name' => 'Chi nhánh', 'key' => 'bank_branch', 'value' => '...', 'default_value' => '...', 'description' => 'Chi nhánh', 'color' => 'red', 'editable' => 1],
        ];
        foreach ($settings as $item) {
            if(!Setting::query()->where('key', $item['key'])->exists()){
                Setting::create($item);
            }
        }
    }
}
