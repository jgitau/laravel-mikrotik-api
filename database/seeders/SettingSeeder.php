<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            [
                'id' => 1,
                'module_id' => 3,
                'setting' => 'clients_vouchers_printer',
                'value' => 'double_column_voucher_printer',
                'flag_module' => "clients",
            ],
        ];

        foreach ($settings as $setting) {
            Setting::insert($setting);
        }
    }
}





