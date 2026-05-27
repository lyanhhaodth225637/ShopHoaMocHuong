<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Category::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $categories = [

            // ═══════════════════════════════════════
            // 1. HOA TƯƠI — core của shop
            // ═══════════════════════════════════════
            [
                'name' => 'Hoa tươi',
                'slug' => 'hoa-tuoi',
                'icon' => 'fa-solid fa-seedling',
                'sort_order' => 1,
                'description' => 'Bó hoa, hộp hoa, giỏ hoa và hoa theo dịp.',
                'children' => [
                    ['name' => 'Bó hoa', 'slug' => 'bo-hoa', 'icon' => 'fa-solid fa-hand-holding-heart', 'section' => 'kieu_dang', 'sort' => 1],
                    ['name' => 'Hộp hoa', 'slug' => 'hop-hoa', 'icon' => 'fa-solid fa-box-open', 'section' => 'kieu_dang', 'sort' => 2],
                    ['name' => 'Giỏ hoa', 'slug' => 'gio-hoa', 'icon' => 'fa-solid fa-basket-shopping', 'section' => 'kieu_dang', 'sort' => 3],
                    ['name' => 'Hoa để bàn', 'slug' => 'hoa-de-ban', 'icon' => 'fa-solid fa-table', 'section' => 'kieu_dang', 'sort' => 4],
                    ['name' => 'Hoa kệ đứng', 'slug' => 'hoa-ke-dung', 'icon' => 'fa-solid fa-trophy', 'section' => 'kieu_dang', 'sort' => 5],

                    ['name' => 'Sinh nhật', 'slug' => 'sinh-nhat', 'icon' => 'fa-solid fa-cake-candles', 'section' => 'theo_dip', 'sort' => 1],
                    ['name' => 'Tình yêu / Valentine', 'slug' => 'tinh-yeu-valentine', 'icon' => 'fa-solid fa-heart', 'section' => 'theo_dip', 'sort' => 2],
                    ['name' => 'Khai trương', 'slug' => 'khai-truong', 'icon' => 'fa-solid fa-store', 'section' => 'theo_dip', 'sort' => 3],
                    ['name' => 'Tốt nghiệp', 'slug' => 'tot-nghiep', 'icon' => 'fa-solid fa-graduation-cap', 'section' => 'theo_dip', 'sort' => 4],
                    ['name' => '8/3 · 20/10', 'slug' => '83-2010', 'icon' => 'fa-solid fa-venus', 'section' => 'theo_dip', 'sort' => 5],
                    ['name' => 'Chia buồn', 'slug' => 'chia-buon-tang-le', 'icon' => 'fa-solid fa-dove', 'section' => 'theo_dip', 'sort' => 6],
                ],
            ],

            // ═══════════════════════════════════════
            // 2. HOA CƯỚI
            // ═══════════════════════════════════════
            [
                'name' => 'Hoa cưới',
                'slug' => 'hoa-cuoi',
                'icon' => 'fa-solid fa-rings-wedding',
                'sort_order' => 2,
                'description' => 'Hoa cầm tay, trang trí tiệc cưới và dịch vụ trọn gói.',
                'children' => [
                    ['name' => 'Hoa cầm tay cô dâu', 'slug' => 'hoa-cam-tay-co-dau', 'icon' => 'fa-solid fa-hand-holding-heart', 'section' => 'hoa_co_dau', 'sort' => 1],
                    ['name' => 'Hoa cài áo chú rể', 'slug' => 'hoa-cai-ao-chu-re', 'icon' => 'fa-solid fa-shirt', 'section' => 'hoa_co_dau', 'sort' => 2],
                    ['name' => 'Vòng hoa đội đầu', 'slug' => 'vong-hoa-doi-dau', 'icon' => 'fa-solid fa-circle-dot', 'section' => 'hoa_co_dau', 'sort' => 3],

                    ['name' => 'Cổng hoa cưới', 'slug' => 'cong-hoa-cuoi', 'icon' => 'fa-solid fa-archway', 'section' => 'trang_tri', 'sort' => 1],
                    ['name' => 'Hoa bàn tiệc', 'slug' => 'hoa-ban-tiec', 'icon' => 'fa-solid fa-utensils', 'section' => 'trang_tri', 'sort' => 2],
                    ['name' => 'Trang trí phòng cưới', 'slug' => 'trang-tri-phong-cuoi', 'icon' => 'fa-solid fa-house-heart', 'section' => 'trang_tri', 'sort' => 3],
                    ['name' => 'Trang trí xe hoa', 'slug' => 'trang-tri-xe-hoa', 'icon' => 'fa-solid fa-car', 'section' => 'trang_tri', 'sort' => 4],

                    ['name' => 'Gói cưới cơ bản', 'slug' => 'goi-cuoi-co-ban', 'icon' => 'fa-solid fa-box', 'section' => 'dich_vu', 'sort' => 1],
                    ['name' => 'Gói cưới sang trọng', 'slug' => 'goi-cuoi-sang-trong', 'icon' => 'fa-solid fa-gem', 'section' => 'dich_vu', 'sort' => 2],
                    ['name' => 'Tư vấn miễn phí', 'slug' => 'tu-van-cuoi-mien-phi', 'icon' => 'fa-solid fa-comments', 'section' => 'dich_vu', 'sort' => 3],
                ],
            ],

            // ═══════════════════════════════════════
            // 3. CÂY & LAN
            // ═══════════════════════════════════════
            [
                'name' => 'Cây & Lan',
                'slug' => 'cay-lan',
                'icon' => 'fa-solid fa-leaf',
                'sort_order' => 3,
                'description' => 'Lan hồ điệp, cây xanh văn phòng và chậu cây quà tặng.',
                'children' => [
                    ['name' => 'Lan đơn cành', 'slug' => 'lan-don-canh', 'icon' => 'fa-solid fa-spa', 'section' => 'lan', 'sort' => 1],
                    ['name' => 'Lan chậu 2–3 cành', 'slug' => 'lan-chau-2-3-canh', 'icon' => 'fa-solid fa-spa', 'section' => 'lan', 'sort' => 2],
                    ['name' => 'Lan hộp quà', 'slug' => 'lan-hop-qua-cao-cap', 'icon' => 'fa-solid fa-gem', 'section' => 'lan', 'sort' => 3],

                    ['name' => 'Cây để bàn văn phòng', 'slug' => 'cay-de-ban-van-phong', 'icon' => 'fa-solid fa-briefcase', 'section' => 'cay_xanh', 'sort' => 1],
                    ['name' => 'Cây phong thủy', 'slug' => 'cay-phong-thuy', 'icon' => 'fa-solid fa-yin-yang', 'section' => 'cay_xanh', 'sort' => 2],
                    ['name' => 'Cây treo – cây leo', 'slug' => 'cay-treo-cay-leo', 'icon' => 'fa-solid fa-arrow-up-from-ground-water', 'section' => 'cay_xanh', 'sort' => 3],
                    ['name' => 'Chậu cây quà tặng', 'slug' => 'chau-cay-qua-tang', 'icon' => 'fa-solid fa-gift', 'section' => 'cay_xanh', 'sort' => 4],
                ],
            ],

            // ═══════════════════════════════════════
            // 4. QUÀ TẶNG
            // ═══════════════════════════════════════
            [
                'name' => 'Quà tặng',
                'slug' => 'qua-tang',
                'icon' => 'fa-solid fa-gift',
                'sort_order' => 4,
                'description' => 'Combo hoa kèm quà, giỏ quà và hộp quà cao cấp.',
                'children' => [
                    ['name' => 'Hoa + Gấu bông', 'slug' => 'gau-bong-hoa', 'icon' => 'fa-solid fa-teddy-bear', 'section' => 'combo', 'sort' => 1],
                    ['name' => 'Hoa + Chocolate', 'slug' => 'chocolate-hoa', 'icon' => 'fa-solid fa-cookie-bite', 'section' => 'combo', 'sort' => 2],
                    ['name' => 'Hoa + Rượu vang', 'slug' => 'ruou-vang-hoa', 'icon' => 'fa-solid fa-wine-bottle', 'section' => 'combo', 'sort' => 3],
                    ['name' => 'Hoa + Bánh kem', 'slug' => 'combo-hoa-banh', 'icon' => 'fa-solid fa-cake-candles', 'section' => 'combo', 'sort' => 4],

                    ['name' => 'Giỏ quà tết', 'slug' => 'gio-qua-tet', 'icon' => 'fa-solid fa-basket-shopping', 'section' => 'gio_hop', 'sort' => 1],
                    ['name' => 'Giỏ trái cây', 'slug' => 'gio-trai-cay-tuoi', 'icon' => 'fa-solid fa-apple-whole', 'section' => 'gio_hop', 'sort' => 2],
                    ['name' => 'Hộp quà cao cấp', 'slug' => 'hop-qua-cao-cap', 'icon' => 'fa-solid fa-box-open', 'section' => 'gio_hop', 'sort' => 3],

                    ['name' => 'Set nến thơm', 'slug' => 'set-nen-thom', 'icon' => 'fa-solid fa-fire', 'section' => 'phu_kien', 'sort' => 1],
                    ['name' => 'Set trà – cà phê', 'slug' => 'set-tra-ca-phe', 'icon' => 'fa-solid fa-mug-hot', 'section' => 'phu_kien', 'sort' => 2],
                    ['name' => 'Thiệp & phong bì', 'slug' => 'thiep-phong-bi', 'icon' => 'fa-solid fa-envelope-open-text', 'section' => 'phu_kien', 'sort' => 3],
                ],
            ],

            // ═══════════════════════════════════════
            // 5. SỰ KIỆN
            // ═══════════════════════════════════════
            [
                'name' => 'Sự kiện',
                'slug' => 'su-kien',
                'icon' => 'fa-solid fa-calendar-star',
                'sort_order' => 5,
                'description' => 'Trang trí hoa cho khai trương, hội nghị, tiệc công ty và sự kiện lớn.',
                'children' => [
                    ['name' => 'Khai trương – khánh thành', 'slug' => 'khai-truong-khanh-thanh', 'icon' => 'fa-solid fa-store', 'section' => 'su_kien', 'sort' => 1],
                    ['name' => 'Hội nghị – hội thảo', 'slug' => 'hoi-nghi-hoi-thao', 'icon' => 'fa-solid fa-people-group', 'section' => 'su_kien', 'sort' => 2],
                    ['name' => 'Lễ tốt nghiệp', 'slug' => 'le-tot-nghiep', 'icon' => 'fa-solid fa-graduation-cap', 'section' => 'su_kien', 'sort' => 3],
                    ['name' => 'Tiệc sinh nhật trọn gói', 'slug' => 'tiec-sinh-nhat-tron-goi', 'icon' => 'fa-solid fa-champagne-glasses', 'section' => 'su_kien', 'sort' => 4],
                    ['name' => 'Trao giải – vinh danh', 'slug' => 'trao-giai-vinh-danh', 'icon' => 'fa-solid fa-trophy', 'section' => 'su_kien', 'sort' => 5],
                    ['name' => 'Nhận báo giá', 'slug' => 'nhan-bao-gia', 'icon' => 'fa-solid fa-file-invoice', 'section' => 'su_kien', 'sort' => 6],
                ],
            ],


            // ═══════════════════════════════════════
            // 6. PHỤ KIỆN
            // ═══════════════════════════════════════
            [
                'name' => 'Phụ kiện',
                'slug' => 'phu-kien',
                'icon' => 'fa-solid fa-screwdriver-wrench',
                'sort_order' => 6,
                'description' => 'Phụ kiện gói hoa, chăm hoa, trang trí và dụng cụ cắm hoa.',
                'children' => [
                    ['name' => 'Nước dưỡng hoa', 'slug' => 'nuoc-duong-hoa', 'icon' => 'fa-solid fa-droplet', 'section' => 'cham_hoa', 'sort' => 1],
                    ['name' => 'Dưỡng lá', 'slug' => 'duong-la', 'icon' => 'fa-solid fa-leaf', 'section' => 'cham_hoa', 'sort' => 2],
                    ['name' => 'Bình xịt chăm hoa', 'slug' => 'binh-xit-cham-hoa', 'icon' => 'fa-solid fa-spray-can', 'section' => 'cham_hoa', 'sort' => 3],

                    ['name' => 'Ruy băng', 'slug' => 'ruy-bang', 'icon' => 'fa-solid fa-ribbon', 'section' => 'goi_trang_tri', 'sort' => 1],
                    ['name' => 'Giấy gói hoa', 'slug' => 'giay-goi-hoa', 'icon' => 'fa-solid fa-scroll', 'section' => 'goi_trang_tri', 'sort' => 2],
                    ['name' => 'Lưới gói hoa', 'slug' => 'luoi-goi-hoa', 'icon' => 'fa-solid fa-border-all', 'section' => 'goi_trang_tri', 'sort' => 3],
                    ['name' => 'Thiệp chúc mừng', 'slug' => 'thiep-chuc-mung', 'icon' => 'fa-solid fa-envelope-open-text', 'section' => 'goi_trang_tri', 'sort' => 4],

                    ['name' => 'Mút cắm hoa', 'slug' => 'mut-cam-hoa', 'icon' => 'fa-solid fa-cube', 'section' => 'dung_cu', 'sort' => 1],
                    ['name' => 'Kéo cắt cành', 'slug' => 'keo-cat-canh', 'icon' => 'fa-solid fa-scissors', 'section' => 'dung_cu', 'sort' => 2],
                    ['name' => 'Súng bắn keo', 'slug' => 'sung-ban-keo', 'icon' => 'fa-solid fa-gun', 'section' => 'dung_cu', 'sort' => 3],
                ],
            ],

            // ═══════════════════════════════════════
            // 7. ĐỒ GỖ
            // ═══════════════════════════════════════
            [
                'name' => 'Đồ gỗ',
                'slug' => 'do-go',
                'icon' => 'fa-solid fa-tree',
                'sort_order' => 7,
                'description' => 'Tượng gỗ, kệ gỗ, đế gỗ và phụ kiện decor bằng gỗ.',
                'children' => [
                    ['name' => 'Tượng gỗ', 'slug' => 'tuong-go', 'icon' => 'fa-solid fa-chess-rook', 'section' => 'tuong_go', 'sort' => 1],
                    ['name' => 'Tượng Phật gỗ', 'slug' => 'tuong-phat-go', 'icon' => 'fa-solid fa-hands-praying', 'section' => 'tuong_go', 'sort' => 2],
                    ['name' => 'Tượng linh vật gỗ', 'slug' => 'tuong-linh-vat-go', 'icon' => 'fa-solid fa-dragon', 'section' => 'tuong_go', 'sort' => 3],
                    ['name' => 'Tượng phong thủy', 'slug' => 'tuong-phong-thuy', 'icon' => 'fa-solid fa-yin-yang', 'section' => 'tuong_go', 'sort' => 4],

                    ['name' => 'Kệ gỗ decor', 'slug' => 'ke-go-decor', 'icon' => 'fa-solid fa-table-cells-large', 'section' => 'decor_go', 'sort' => 1],
                    ['name' => 'Đế gỗ trưng bày', 'slug' => 'de-go-trung-bay', 'icon' => 'fa-solid fa-layer-group', 'section' => 'decor_go', 'sort' => 2],
                    ['name' => 'Hộp gỗ quà tặng', 'slug' => 'hop-go-qua-tang', 'icon' => 'fa-solid fa-box-open', 'section' => 'decor_go', 'sort' => 3],
                    ['name' => 'Khay gỗ', 'slug' => 'khay-go', 'icon' => 'fa-solid fa-inbox', 'section' => 'decor_go', 'sort' => 4],
                ],
            ],

            // ═══════════════════════════════════════
            // 8. CHẬU
            // ═══════════════════════════════════════
            [
                'name' => 'Chậu',
                'slug' => 'chau',
                'icon' => 'fa-solid fa-bucket',
                'sort_order' => 8,
                'description' => 'Chậu trồng cây, chậu decor và chậu quà tặng.',
                'children' => [
                    ['name' => 'Chậu đất nung', 'slug' => 'chau-dat-nung', 'icon' => 'fa-solid fa-fire-flame-simple', 'section' => 'chat_lieu_chau', 'sort' => 1],
                    ['name' => 'Chậu sứ', 'slug' => 'chau-su', 'icon' => 'fa-solid fa-circle', 'section' => 'chat_lieu_chau', 'sort' => 2],
                    ['name' => 'Chậu xi măng', 'slug' => 'chau-xi-mang', 'icon' => 'fa-solid fa-cubes', 'section' => 'chat_lieu_chau', 'sort' => 3],
                    ['name' => 'Chậu nhựa', 'slug' => 'chau-nhua', 'icon' => 'fa-solid fa-recycle', 'section' => 'chat_lieu_chau', 'sort' => 4],
                    ['name' => 'Chậu gỗ', 'slug' => 'chau-go', 'icon' => 'fa-solid fa-tree', 'section' => 'chat_lieu_chau', 'sort' => 5],

                    ['name' => 'Chậu mini để bàn', 'slug' => 'chau-mini-de-ban', 'icon' => 'fa-solid fa-mug-saucer', 'section' => 'kieu_chau', 'sort' => 1],
                    ['name' => 'Chậu treo', 'slug' => 'chau-treo', 'icon' => 'fa-solid fa-arrow-up-from-ground-water', 'section' => 'kieu_chau', 'sort' => 2],
                    ['name' => 'Chậu bonsai', 'slug' => 'chau-bonsai', 'icon' => 'fa-solid fa-spa', 'section' => 'kieu_chau', 'sort' => 3],
                    ['name' => 'Chậu lan', 'slug' => 'chau-lan', 'icon' => 'fa-solid fa-seedling', 'section' => 'kieu_chau', 'sort' => 4],
                    ['name' => 'Chậu cây quà tặng', 'slug' => 'chau-cay-qua-tang-phu-kien', 'icon' => 'fa-solid fa-gift', 'section' => 'kieu_chau', 'sort' => 5],
                ],
            ],
           

        ];

        foreach ($categories as $catData) {
            $parent = Category::create([
                'name' => $catData['name'],
                'slug' => $catData['slug'],
                'icon' => $catData['icon'],
                'parent_id' => null,
                'sort_order' => $catData['sort_order'],
                'description' => $catData['description'] ?? null,
                'meta_title' => $catData['name'] . ' – Mộc Hương Flower Shop',
                'meta_description' => $catData['description'] ?? null,
                'is_active' => true,
            ]);

            foreach ($catData['children'] ?? [] as $child) {
                Category::create([
                    'name' => $child['name'],
                    'slug' => $child['slug'],
                    'icon' => $child['icon'],
                    'parent_id' => $parent->id,
                    'mega_section_key' => $child['section'] ?? null,
                    'mega_section_label' => $this->sectionLabel($child['section'] ?? null),
                    'sort_order' => $child['sort'] ?? 0,
                    'meta_title' => $child['name'] . ' – Mộc Hương Flower Shop',
                    'meta_description' => 'Khám phá ' . $child['name'] . ' tại Mộc Hương Flower Shop.',
                    'is_active' => true,
                ]);
            }
        }

        $this->command->info('✅ CategorySeeder chạy thành công!');
    }

    private function sectionLabel(?string $key): ?string
    {
        return match ($key) {
            'kieu_dang' => 'Kiểu dáng',
            'theo_dip' => 'Theo dịp',
            'hoa_co_dau' => 'Cô dâu & chú rể',
            'trang_tri' => 'Trang trí',
            'dich_vu' => 'Dịch vụ',
            'lan' => 'Lan hồ điệp',
            'cay_xanh' => 'Cây xanh',
            'combo' => 'Combo hoa + quà',
            'gio_hop' => 'Giỏ & hộp quà',
            'phu_kien' => 'Phụ kiện',
            'cham_hoa' => 'Chăm hoa',
            'goi_trang_tri' => 'Gói & trang trí',
            'dung_cu' => 'Dụng cụ',
            'tuong_go' => 'Tượng gỗ',
            'decor_go' => 'Decor gỗ',
            'chat_lieu_chau' => 'Chất liệu chậu',
            'kieu_chau' => 'Kiểu chậu',
            'su_kien' => 'Loại sự kiện',
            default => null,
        };
    }
}