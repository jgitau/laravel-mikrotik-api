<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = [
            [
                'username' => 'root',
                'password' => 'radvar#123',
                'fullname' => 'Varnion Root',
                'email' => 'root@megalos.com',
                'group_id' => 1,
                'status' => 1
            ],
            [
                'username' => 'admin',
                'password' => 'admin',
                'fullname' => 'Megalos Admin',
                'email' => 'admin@megalos.com',
                'group_id' => 1,
                'status' => 1
            ]
        ];

        foreach ($admins as $adminData) {
            $admin = new Admin();
            $hashedPassword = Hash::make($adminData['password']);

            $admin->admin_uid = (string) str()->uuid();
            $admin->group_id = $adminData['group_id'];
            $admin->username = $adminData['username'];
            $admin->password = $hashedPassword;
            $admin->fullname = $adminData['fullname'];
            $admin->email = $adminData['email'];
            $admin->status = $adminData['status'];

            $admin->save();
        }
    }
}
