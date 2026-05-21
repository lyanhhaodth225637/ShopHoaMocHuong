<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // ==================== DANH SÁCH PERMISSIONS ====================
        $permissions = [
            'product.view',
            'product.create',
            'product.edit',
            'product.delete',
            'category.view',
            'category.create',
            'category.edit',
            'category.delete',
            'brand.view',
            'brand.create',
            'brand.edit',
            'brand.delete',
            'order.view',
            'order.edit',
            'order.delete',
            'customer.view',
            'customer.edit',
            'user.view',
            'user.create',
            'user.edit',
            'user.delete',
            'role.view',
            'role.create',
            'role.edit',
            'role.delete',
            'permission.view',
            'permission.assign',
        ];

        // Tạo permission (nếu chưa có thì tạo, có rồi thì bỏ qua)
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // ==================== TẠO / LẤY ROLES ====================
        $superAdmin = Role::firstOrCreate(['name' => 'super-admin']);
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $staff = Role::firstOrCreate(['name' => 'staff']);
        $customer = Role::firstOrCreate(['name' => 'customer']);

        // ==================== GÁN QUYỀN ====================
        // Super Admin: được tất cả quyền
        $superAdmin->syncPermissions(Permission::all());

        // Admin: được hầu hết quyền
        $admin->syncPermissions([
            'product.view',
            'product.create',
            'product.edit',
            'product.delete',
            'category.view',
            'category.create',
            'category.edit',
            'category.delete',
            'brand.view',
            'brand.create',
            'brand.edit',
            'brand.delete',
            'order.view',
            'order.edit',
            'order.delete',
            'customer.view',
            'customer.edit',
            'user.view',
            'user.edit',
        ]);

        // Staff: quyền hạn chế
        $staff->syncPermissions([
            'product.view',
            'product.edit',
            'category.view',
            'brand.view',
            'order.view',
            'order.edit',
            'customer.view',
        ]);

        $this->command->info('-> PermissionSeeder chạy thành công!');
        $this->command->info('   Đã tạo/cập nhật ' . count($permissions) . ' permissions.');
    }
}