<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    public function run(): void
    {
        $units = [
            'Cái',
            'Cây',
            'Chậu',
            'Bó',
            'Cành',
            'Nhánh',
            'Bông',
            'Giỏ',
            'Lẵng',
            'Bình',
            'Hộp',
            'Set',
            'Combo',
            'Cặp',
            'Bộ',
            'Chiếc',
            'Túi',
            'Gói',
            'Bao',
            'Thùng',
            'Cuộn',
            'Mét',
            'Mét vuông',
            'Mét khối',
            'Kg',
            'Gram',
            'Lít',
            'ml',
            'Khay',
            'Vỉ',
            'Bịch',
            'Lon',
            'Chai',
            'Hũ',
            'Tấm',
            'Thanh',
            'Cọc',
            'Cuốn',
            'Xấp',
            'Bịch đất',
            'Bao đất',
            'Bao phân',
            'Viên',
            'Gốc',
            'Khóm',
            'Bụi',
            'Lô',
        ];

        foreach ($units as $unit) {
            DB::table('units')->updateOrInsert(
                ['name' => $unit],
                [
                    'description' => null,
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}