<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // ==================== TẠO 4 TÀI KHOẢN TEST ====================

        // 1. Super Admin (quyền cao nhất)
        $superAdmin = User::create([
            'name' => 'Super Administrator',
            'email' => 'lyanhhaodth225637@gmail.com',
            'password' => Hash::make('12345678'),   // mật khẩu: 123456
        ]);
        $superAdmin->assignRole('super-admin');

        // 2. Admin
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
        $admin->assignRole('admin');

        // 3. Staff (Nhân viên)
        $staff = User::create([
            'name' => 'Nhân viên Sales',
            'email' => 'staff@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
        $staff->assignRole('staff');

        // 4. Customer (Khách hàng)
        $customer = User::create([
            'name' => 'Khách hàng Test',
            'email' => 'customer@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
        $customer->assignRole('customer');

        $this->command->info('✅ Đã tạo 4 tài khoản thành công!');
        $this->command->info('   Email: lyanhhaodth225637@gmail.com     | Mật khẩu: 12345678');
        $this->command->info('   Email: admin@gmail.com          | Mật khẩu: 12345678');
        $this->command->info('   Email: staff@gmail.com          | Mật khẩu: 12345678');
        $this->command->info('   Email: customer@gmail.com       | Mật khẩu: 12345678');
    }
}