@extends('layouts.admin.app')

@section('admin-content')
    <div class="container-fluid mt-4 px-4">
        <h1 class="mb-4">Tùy chỉnh giao diện</h1>

        @if (session('success') || session('message'))
            <div class="alert alert-success alert-dismissible">
                <div class="d-flex">
                    <i class="ti ti-circle-check icon alert-icon"></i>
                    <div>{{ session('success') ?? session('message') }}</div>
                </div>
                <a class="btn-close" data-bs-dismiss="alert"></a>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible">
                <div class="d-flex">
                    <i class="ti ti-alert-triangle icon alert-icon"></i>
                    <div>
                        <strong>Vui lòng kiểm tra lại dữ liệu.</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <a class="btn-close" data-bs-dismiss="alert"></a>
            </div>
        @endif

        <div class="row">

            {{-- Sidebar Tab --}}
            <div class="col-md-3 col-lg-2">
                <div class="card">
                    <div class="card-body p-2">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            @php
                                $tabs = [
                                    ['id' => 'tab-hero',                'icon' => 'ti-layout-navbar',    'label' => 'Hero trang chủ'],
                                    ['id' => 'tab-slides',              'icon' => 'ti-photo',            'label' => 'Slider ảnh nền'],
                                    ['id' => 'tab-stats',               'icon' => 'ti-chart-bar',        'label' => 'Thống kê Hero'],
                                    ['id' => 'tab-feature-boxes',       'icon' => 'ti-sparkles',         'label' => 'Feature Box'],
                                    ['id' => 'tab-occasion-categories', 'icon' => 'ti-category',         'label' => 'Danh mục theo dịp'],
                                    ['id' => 'tab-promo-banners',       'icon' => 'ti-discount-2',       'label' => 'Promo Banner'],
                                    ['id' => 'tab-theme',               'icon' => 'ti-palette',          'label' => 'Màu sắc & Theme'],
                                    ['id' => 'tab-layout',              'icon' => 'ti-layout',           'label' => 'Bố cục trang'],
                                    ['id' => 'tab-font',                'icon' => 'ti-typography',       'label' => 'Phông chữ'],
                                    ['id' => 'tab-logo',                'icon' => 'ti-brand-tabler',     'label' => 'Logo & Banner'],
                                    ['id' => 'tab-footer',              'icon' => 'ti-layout-bottombar', 'label' => 'Footer'],
                                    ['id' => 'tab-advanced',            'icon' => 'ti-settings',         'label' => 'Nâng cao'],
                                ];
                            @endphp

                            @foreach ($tabs as $i => $tab)
                                <button
                                    class="nav-link text-start mb-1 {{ $i === 0 ? 'active' : '' }}"
                                    id="{{ $tab['id'] }}-btn"
                                    data-bs-toggle="pill"
                                    data-bs-target="#{{ $tab['id'] }}"
                                    type="button"
                                    role="tab"
                                >
                                    <i class="ti {{ $tab['icon'] }} me-2"></i>{{ $tab['label'] }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- Nội dung tab --}}
            <div class="col-md-9 col-lg-10">
                <div class="tab-content" id="v-pills-tabContent">

                    {{-- ═══════════════════════════════════════
                         Tab: Hero trang chủ
                    ═══════════════════════════════════════ --}}
                    <div class="tab-pane fade show active" id="tab-hero" role="tabpanel">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Nội dung Hero trang chủ</h3>
                            </div>

                            <form action="{{ route('admin.home-hero.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row g-3">

                                        <div class="col-md-8">
                                            <label class="form-label">Badge</label>
                                            <input type="text" name="badge_text" class="form-control"
                                                value="{{ old('badge_text', $hero->badge_text ?? 'Shop hoa tươi uy tín') }}">
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Trạng thái</label>
                                            <label class="form-check form-switch mt-2">
                                                <input class="form-check-input" type="checkbox" name="is_active" value="1"
                                                    {{ old('is_active', $hero->is_active ?? true) ? 'checked' : '' }}>
                                                <span class="form-check-label">Hiển thị</span>
                                            </label>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Tiêu đề dòng 1</label>
                                            <input type="text" name="title_line_1" class="form-control"
                                                value="{{ old('title_line_1', $hero->title_line_1 ?? 'Gửi trọn') }}">
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Từ nhấn mạnh</label>
                                            <input type="text" name="title_highlight" class="form-control"
                                                value="{{ old('title_highlight', $hero->title_highlight ?? 'yêu thương') }}">
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Tiêu đề dòng 2</label>
                                            <input type="text" name="title_line_2" class="form-control"
                                                value="{{ old('title_line_2', $hero->title_line_2 ?? 'qua từng đóa hoa') }}">
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Mô tả</label>
                                            <textarea name="subtitle" rows="3" class="form-control">{{ old('subtitle', $hero->subtitle ?? 'Hoa tươi mỗi ngày – giao hàng nhanh trong 2 giờ – thiết kế theo yêu cầu. Hơn 500 mẫu hoa cho mọi dịp đặc biệt.') }}</textarea>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Nút chính – Nội dung</label>
                                            <input type="text" name="primary_button_text" class="form-control"
                                                value="{{ old('primary_button_text', $hero->primary_button_text ?? 'Đặt hoa ngay') }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Nút chính – Link</label>
                                            <input type="text" name="primary_button_link" class="form-control"
                                                value="{{ old('primary_button_link', $hero->primary_button_link ?? '/san-pham') }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Nút phụ – Nội dung</label>
                                            <input type="text" name="secondary_button_text" class="form-control"
                                                value="{{ old('secondary_button_text', $hero->secondary_button_text ?? 'Tư vấn miễn phí') }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Nút phụ – Link</label>
                                            <input type="text" name="secondary_button_link" class="form-control"
                                                value="{{ old('secondary_button_link', $hero->secondary_button_link ?? '#') }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Ảnh tròn bên phải</label>
                                            <input type="file" name="circle_image" class="form-control">
                                            @if (!empty($hero?->circle_image))
                                                <div class="mt-2">
                                                    <img src="{{ asset('storage/' . $hero->circle_image) }}"
                                                        class="rounded border"
                                                        style="width:120px;height:120px;object-fit:cover;">
                                                </div>
                                            @endif
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Gợi ý</label>
                                            <div class="text-secondary small mt-1">
                                                Dùng định dạng jpg, png hoặc webp. Kích thước nên vuông để hiển thị đẹp trong khung tròn.
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Badge nổi 1 – Tiêu đề</label>
                                            <input type="text" name="float_badge_1_title" class="form-control"
                                                value="{{ old('float_badge_1_title', $hero->float_badge_1_title ?? 'Hoa Cưới') }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Badge nổi 1 – Mô tả</label>
                                            <input type="text" name="float_badge_1_subtitle" class="form-control"
                                                value="{{ old('float_badge_1_subtitle', $hero->float_badge_1_subtitle ?? 'Hạnh phúc trăm năm') }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Badge nổi 2 – Tiêu đề</label>
                                            <input type="text" name="float_badge_2_title" class="form-control"
                                                value="{{ old('float_badge_2_title', $hero->float_badge_2_title ?? 'Lễ Tốt Nghiệp') }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Badge nổi 2 – Mô tả</label>
                                            <input type="text" name="float_badge_2_subtitle" class="form-control"
                                                value="{{ old('float_badge_2_subtitle', $hero->float_badge_2_subtitle ?? 'Lưu giữ khoảnh khắc') }}">
                                        </div>

                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <button class="btn btn-primary">
                                        <i class="ti ti-device-floppy me-1"></i> Lưu nội dung Hero
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- ═══════════════════════════════════════
                         Tab: Slider ảnh nền
                    ═══════════════════════════════════════ --}}
                    <div class="tab-pane fade" id="tab-slides" role="tabpanel">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Slider ảnh nền</h3>
                            </div>
                            <div class="card-body">

                                <form action="{{ route('admin.home-hero.slides.store') }}" method="POST"
                                    enctype="multipart/form-data" class="row g-3 mb-4">
                                    @csrf

                                    <div class="col-md-3">
                                        <label class="form-label">Ảnh nền <span class="text-danger">*</span></label>
                                        <input type="file" name="image" class="form-control" required>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Ảnh mobile</label>
                                        <input type="file" name="mobile_image" class="form-control">
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">Tiêu đề</label>
                                        <input type="text" name="title" class="form-control">
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">Alt ảnh</label>
                                        <input type="text" name="alt" class="form-control">
                                    </div>

                                    <div class="col-md-1">
                                        <label class="form-label">Thứ tự</label>
                                        <input type="number" name="sort_order" class="form-control" value="0">
                                    </div>

                                    <div class="col-md-1">
                                        <label class="form-label">Hiện</label>
                                        <label class="form-check form-switch mt-2">
                                            <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
                                        </label>
                                    </div>

                                    <div class="col-12 text-end">
                                        <button class="btn btn-primary">
                                            <i class="ti ti-plus me-1"></i> Thêm ảnh nền
                                        </button>
                                    </div>
                                </form>

                                <div class="table-responsive">
                                    <table class="table table-vcenter">
                                        <thead>
                                            <tr>
                                                <th>Ảnh</th>
                                                <th>Tiêu đề</th>
                                                <th>Mobile</th>
                                                <th>Alt</th>
                                                <th>Thứ tự</th>
                                                <th>Trạng thái</th>
                                                <th class="text-end">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($slides as $slide)
                                                <tr>
                                                    <td>
                                                        <img src="{{ asset('storage/' . $slide->image) }}"
                                                            class="rounded border"
                                                            style="width:120px;height:60px;object-fit:cover;">
                                                    </td>
                                                    <td>{{ $slide->title }}</td>
                                                    <td>
                                                        @if ($slide->mobile_image)
                                                            <img src="{{ asset('storage/' . $slide->mobile_image) }}"
                                                                class="rounded border"
                                                                style="width:60px;height:90px;object-fit:cover;">
                                                        @else
                                                            <span class="text-secondary small">Dùng ảnh desktop</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $slide->alt }}</td>
                                                    <td>{{ $slide->sort_order }}</td>
                                                    <td>
                                                        <span class="badge {{ $slide->is_active ? 'bg-success text-success-fg' : 'bg-secondary text-secondary-fg' }}">
                                                            {{ $slide->is_active ? 'Hiển thị' : 'Ẩn' }}
                                                        </span>
                                                    </td>
                                                    <td class="text-end">
                                                        <button type="button" class="btn btn-sm btn-outline-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editSlideModal{{ $slide->id }}">
                                                            <i class="ti ti-edit"></i> Sửa
                                                        </button>
                                                        <form action="{{ route('admin.home-hero.slides.destroy', $slide) }}"
                                                            method="POST" class="d-inline"
                                                            onsubmit="return confirm('Xóa ảnh nền này?')">
                                                            @csrf @method('DELETE')
                                                            <button class="btn btn-sm btn-outline-danger">
                                                                <i class="ti ti-trash"></i> Xóa
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center text-secondary">Chưa có ảnh nền.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ═══════════════════════════════════════
                         Tab: Thống kê Hero
                    ═══════════════════════════════════════ --}}
                    <div class="tab-pane fade" id="tab-stats" role="tabpanel">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Thống kê Hero</h3>
                            </div>
                            <div class="card-body">

                                <form action="{{ route('admin.home-hero.stats.store') }}" method="POST" class="row g-3 mb-4">
                                    @csrf

                                    <div class="col-md-4">
                                        <label class="form-label">Giá trị <span class="text-danger">*</span></label>
                                        <input type="text" name="value" class="form-control" placeholder="500+" required>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Nhãn <span class="text-danger">*</span></label>
                                        <input type="text" name="label" class="form-control" placeholder="Mẫu hoa" required>
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">Thứ tự</label>
                                        <input type="number" name="sort_order" class="form-control" value="0">
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">Hiện</label>
                                        <label class="form-check form-switch mt-2">
                                            <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
                                        </label>
                                    </div>

                                    <div class="col-12 text-end">
                                        <button class="btn btn-primary">
                                            <i class="ti ti-plus me-1"></i> Thêm thống kê
                                        </button>
                                    </div>
                                </form>

                                <div class="table-responsive">
                                    <table class="table table-vcenter">
                                        <thead>
                                            <tr>
                                                <th>Giá trị</th>
                                                <th>Nhãn</th>
                                                <th>Thứ tự</th>
                                                <th>Trạng thái</th>
                                                <th class="text-end">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($stats as $stat)
                                                <tr>
                                                    <td>{{ $stat->value }}</td>
                                                    <td>{{ $stat->label }}</td>
                                                    <td>{{ $stat->sort_order }}</td>
                                                    <td>
                                                        <span class="badge {{ $stat->is_active ? 'bg-success text-success-fg' : 'bg-secondary text-secondary-fg' }}">
                                                            {{ $stat->is_active ? 'Hiển thị' : 'Ẩn' }}
                                                        </span>
                                                    </td>
                                                    <td class="text-end">
                                                        <button type="button" class="btn btn-sm btn-outline-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editStatModal{{ $stat->id }}">
                                                            <i class="ti ti-edit"></i> Sửa
                                                        </button>
                                                        <form action="{{ route('admin.home-hero.stats.destroy', $stat) }}"
                                                            method="POST" class="d-inline"
                                                            onsubmit="return confirm('Xóa thống kê này?')">
                                                            @csrf @method('DELETE')
                                                            <button class="btn btn-sm btn-outline-danger">
                                                                <i class="ti ti-trash"></i> Xóa
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center text-secondary">Chưa có thống kê.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ═══════════════════════════════════════
                         Tab: Feature Box
                    ═══════════════════════════════════════ --}}
                    <div class="tab-pane fade" id="tab-feature-boxes" role="tabpanel">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Feature Box trang chủ</h3>
                            </div>
                            <div class="card-body">

                                <form action="{{ route('admin.home-feature-boxes.store') }}" method="POST" class="row g-3 mb-4">
                                    @csrf

                                    <div class="col-md-3">
                                        <label class="form-label">Tiêu đề <span class="text-danger">*</span></label>
                                        <input type="text" name="title" class="form-control"
                                            placeholder="Sản phẩm đa dạng" value="{{ old('title') }}" required>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Mô tả</label>
                                        <input type="text" name="description" class="form-control"
                                            placeholder="Hoa tươi, cây cảnh..." value="{{ old('description') }}">
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">Icon</label>
                                        <input type="text" name="icon" class="form-control"
                                            placeholder="fas fa-seedling" value="{{ old('icon') }}">
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">Link</label>
                                        <input type="text" name="link_url" class="form-control"
                                            placeholder="/san-pham" value="{{ old('link_url') }}">
                                    </div>

                                    <div class="col-md-1">
                                        <label class="form-label">Thứ tự</label>
                                        <input type="number" name="sort_order" class="form-control"
                                            value="{{ old('sort_order', 0) }}">
                                    </div>

                                    <div class="col-md-1">
                                        <label class="form-label">Hiện</label>
                                        <label class="form-check form-switch mt-2">
                                            <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-check mt-2">
                                            <input class="form-check-input" type="checkbox" name="is_external" value="1">
                                            <span class="form-check-label">Link ngoài, mở tab mới</span>
                                        </label>
                                    </div>

                                    <div class="col-12 text-end">
                                        <button class="btn btn-primary">
                                            <i class="ti ti-plus me-1"></i> Thêm Feature Box
                                        </button>
                                    </div>
                                </form>

                                <div class="table-responsive">
                                    <table class="table table-vcenter">
                                        <thead>
                                            <tr>
                                                <th>Icon</th>
                                                <th>Tiêu đề</th>
                                                <th>Mô tả</th>
                                                <th>Link</th>
                                                <th>Thứ tự</th>
                                                <th>Trạng thái</th>
                                                <th class="text-end">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($featureBoxes as $featureBox)
                                                <tr>
                                                    <td>
                                                        @if ($featureBox->icon)
                                                            <i class="{{ $featureBox->icon }} fs-2"></i>
                                                        @else
                                                            <span class="text-secondary">–</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $featureBox->title }}</td>
                                                    <td>{{ $featureBox->description }}</td>
                                                    <td>
                                                        @if ($featureBox->link_url)
                                                            <span class="text-secondary small">{{ $featureBox->link_url }}</span>
                                                            @if ($featureBox->is_external)
                                                                <span class="badge bg-blue-lt ms-1">Link ngoài</span>
                                                            @endif
                                                        @else
                                                            <span class="text-secondary">–</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $featureBox->sort_order }}</td>
                                                    <td>
                                                        <span class="badge {{ $featureBox->is_active ? 'bg-success text-success-fg' : 'bg-secondary text-secondary-fg' }}">
                                                            {{ $featureBox->is_active ? 'Hiển thị' : 'Ẩn' }}
                                                        </span>
                                                    </td>
                                                    <td class="text-end">
                                                        <button type="button" class="btn btn-sm btn-outline-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editFeatureBoxModal{{ $featureBox->id }}">
                                                            <i class="ti ti-edit"></i> Sửa
                                                        </button>
                                                        <form action="{{ route('admin.home-feature-boxes.destroy', $featureBox) }}"
                                                            method="POST" class="d-inline"
                                                            onsubmit="return confirm('Xóa Feature Box này?')">
                                                            @csrf @method('DELETE')
                                                            <button class="btn btn-sm btn-outline-danger">
                                                                <i class="ti ti-trash"></i> Xóa
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center text-secondary">Chưa có Feature Box.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ═══════════════════════════════════════
                         Tab: Danh mục theo dịp
                    ═══════════════════════════════════════ --}}
                    <div class="tab-pane fade" id="tab-occasion-categories" role="tabpanel">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Danh mục theo dịp</h3>
                            </div>
                            <div class="card-body">

                                <form action="{{ route('admin.home-occasion-categories.store') }}" method="POST" class="row g-3 mb-4">
                                    @csrf

                                    <div class="col-md-3">
                                        <label class="form-label">Tiêu đề <span class="text-danger">*</span></label>
                                        <input type="text" name="title" class="form-control"
                                            placeholder="Hoa cưới" value="{{ old('title') }}" required>
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">Icon / Emoji</label>
                                        <input type="text" name="icon" class="form-control"
                                            placeholder="💍 hoặc fas fa-ring" value="{{ old('icon') }}">
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Link</label>
                                        <input type="text" name="link_url" class="form-control"
                                            placeholder="/san-pham?category=hoa-cuoi" value="{{ old('link_url') }}">
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">Danh mục thật</label>
                                        <select name="category_id" class="form-select">
                                            <option value="">Không liên kết</option>
                                            @foreach ($categories ?? [] as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-1">
                                        <label class="form-label">Thứ tự</label>
                                        <input type="number" name="sort_order" class="form-control"
                                            value="{{ old('sort_order', 0) }}">
                                    </div>

                                    <div class="col-md-1">
                                        <label class="form-label">Hiện</label>
                                        <label class="form-check form-switch mt-2">
                                            <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
                                        </label>
                                    </div>

                                    <div class="col-12 text-end">
                                        <button class="btn btn-primary">
                                            <i class="ti ti-plus me-1"></i> Thêm danh mục theo dịp
                                        </button>
                                    </div>
                                </form>

                                <div class="table-responsive">
                                    <table class="table table-vcenter">
                                        <thead>
                                            <tr>
                                                <th>Icon</th>
                                                <th>Tiêu đề</th>
                                                <th>Link</th>
                                                <th>Danh mục liên kết</th>
                                                <th>Thứ tự</th>
                                                <th>Trạng thái</th>
                                                <th class="text-end">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($occasionCategories as $occasionCategory)
                                                <tr>
                                                    <td><span class="fs-2">{{ $occasionCategory->icon }}</span></td>
                                                    <td>{{ $occasionCategory->title }}</td>
                                                    <td>
                                                        <span class="text-secondary small">
                                                            {{ $occasionCategory->link_url ?? '–' }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $occasionCategory->category?->name ?? '–' }}</td>
                                                    <td>{{ $occasionCategory->sort_order }}</td>
                                                    <td>
                                                        <span class="badge {{ $occasionCategory->is_active ? 'bg-success text-success-fg' : 'bg-secondary text-secondary-fg' }}">
                                                            {{ $occasionCategory->is_active ? 'Hiển thị' : 'Ẩn' }}
                                                        </span>
                                                    </td>
                                                    <td class="text-end">
                                                        <button type="button" class="btn btn-sm btn-outline-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editOccasionCategoryModal{{ $occasionCategory->id }}">
                                                            <i class="ti ti-edit"></i> Sửa
                                                        </button>
                                                        <form action="{{ route('admin.home-occasion-categories.destroy', $occasionCategory) }}"
                                                            method="POST" class="d-inline"
                                                            onsubmit="return confirm('Xóa danh mục theo dịp này?')">
                                                            @csrf @method('DELETE')
                                                            <button class="btn btn-sm btn-outline-danger">
                                                                <i class="ti ti-trash"></i> Xóa
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center text-secondary">Chưa có danh mục theo dịp.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ═══════════════════════════════════════
                         Tab: Promo Banner
                    ═══════════════════════════════════════ --}}
                    <div class="tab-pane fade" id="tab-promo-banners" role="tabpanel">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Promo Banner trang chủ</h3>
                            </div>
                            <div class="card-body">

                                <form action="{{ route('admin.home-promo-banners.store') }}" method="POST"
                                    enctype="multipart/form-data" class="row g-3 mb-4">
                                    @csrf

                                    <div class="col-md-3">
                                        <label class="form-label">Tiêu đề <span class="text-danger">*</span></label>
                                        <input type="text" name="title" class="form-control"
                                            placeholder="Hoa cưới trọn gói" value="{{ old('title') }}" required>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Mô tả</label>
                                        <input type="text" name="description" class="form-control"
                                            placeholder="Dịch vụ trang trí đám cưới..." value="{{ old('description') }}">
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">Badge</label>
                                        <input type="text" name="badge_text" class="form-control"
                                            placeholder="Ưu đãi đặc biệt" value="{{ old('badge_text') }}">
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">Nhấn mạnh</label>
                                        <input type="text" name="highlight_text" class="form-control"
                                            placeholder="Giảm 25%" value="{{ old('highlight_text') }}">
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">Kích thước <span class="text-danger">*</span></label>
                                        <select name="size" class="form-select" required>
                                            <option value="big" {{ old('size') === 'big' ? 'selected' : '' }}>Lớn</option>
                                            <option value="small" {{ old('size', 'small') === 'small' ? 'selected' : '' }}>Nhỏ</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Chữ nút</label>
                                        <input type="text" name="button_text" class="form-control"
                                            placeholder="Đặt ngay →" value="{{ old('button_text') }}">
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Link nút</label>
                                        <input type="text" name="button_url" class="form-control"
                                            placeholder="/san-pham" value="{{ old('button_url') }}">
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">CSS class</label>
                                        <input type="text" name="css_class" class="form-control"
                                            placeholder="promo-banner-1" value="{{ old('css_class') }}">
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">Ảnh nền</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>

                                    <div class="col-md-1">
                                        <label class="form-label">Thứ tự</label>
                                        <input type="number" name="sort_order" class="form-control"
                                            value="{{ old('sort_order', 0) }}">
                                    </div>

                                    <div class="col-md-1">
                                        <label class="form-label">Hiện</label>
                                        <label class="form-check form-switch mt-2">
                                            <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
                                        </label>
                                    </div>

                                    <div class="col-12 text-end">
                                        <button class="btn btn-primary">
                                            <i class="ti ti-plus me-1"></i> Thêm Promo Banner
                                        </button>
                                    </div>
                                </form>

                                <div class="table-responsive">
                                    <table class="table table-vcenter">
                                        <thead>
                                            <tr>
                                                <th>Ảnh</th>
                                                <th>Tiêu đề</th>
                                                <th>Badge</th>
                                                <th>Nhấn mạnh</th>
                                                <th>Kích thước</th>
                                                <th>Thứ tự</th>
                                                <th>Trạng thái</th>
                                                <th class="text-end">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($promoBanners as $promoBanner)
                                                <tr>
                                                    <td>
                                                        @if ($promoBanner->image)
                                                            <img src="{{ asset('storage/' . $promoBanner->image) }}"
                                                                class="rounded border"
                                                                style="width:120px;height:60px;object-fit:cover;">
                                                        @else
                                                            <span class="text-secondary small">Không có ảnh</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div>{{ $promoBanner->title }}</div>
                                                        @if ($promoBanner->description)
                                                            <div class="text-secondary small">{{ $promoBanner->description }}</div>
                                                        @endif
                                                    </td>
                                                    <td>{{ $promoBanner->badge_text }}</td>
                                                    <td>{{ $promoBanner->highlight_text }}</td>
                                                    <td>
                                                        <span class="badge {{ $promoBanner->size === 'big' ? 'bg-primary text-primary-fg' : 'bg-info text-info-fg' }}">
                                                            {{ $promoBanner->size === 'big' ? 'Lớn' : 'Nhỏ' }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $promoBanner->sort_order }}</td>
                                                    <td>
                                                        <span class="badge {{ $promoBanner->is_active ? 'bg-success text-success-fg' : 'bg-secondary text-secondary-fg' }}">
                                                            {{ $promoBanner->is_active ? 'Hiển thị' : 'Ẩn' }}
                                                        </span>
                                                    </td>
                                                    <td class="text-end">
                                                        <button type="button" class="btn btn-sm btn-outline-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editPromoBannerModal{{ $promoBanner->id }}">
                                                            <i class="ti ti-edit"></i> Sửa
                                                        </button>
                                                        <form action="{{ route('admin.home-promo-banners.destroy', $promoBanner) }}"
                                                            method="POST" class="d-inline"
                                                            onsubmit="return confirm('Xóa Promo Banner này?')">
                                                            @csrf @method('DELETE')
                                                            <button class="btn btn-sm btn-outline-danger">
                                                                <i class="ti ti-trash"></i> Xóa
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8" class="text-center text-secondary">Chưa có Promo Banner.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ═══════════════════════════════════════
                         Các tab chưa phát triển
                    ═══════════════════════════════════════ --}}
                    @foreach ([
                        'tab-theme'   => ['label' => 'Màu sắc & Theme'],
                        'tab-layout'  => ['label' => 'Bố cục trang'],
                        'tab-font'    => ['label' => 'Phông chữ'],
                        'tab-logo'    => ['label' => 'Logo & Banner'],
                        'tab-footer'  => ['label' => 'Footer'],
                        'tab-advanced'=> ['label' => 'Cài đặt nâng cao'],
                    ] as $tabId => $tabMeta)
                        <div class="tab-pane fade" id="{{ $tabId }}" role="tabpanel">
                            <div class="card">
                                <div class="card-header"><strong>{{ $tabMeta['label'] }}</strong></div>
                                <div class="card-body">
                                    <div class="empty">
                                        <div class="empty-icon">
                                            <i class="ti ti-tools-kitchen-2 fs-1 text-secondary"></i>
                                        </div>
                                        <p class="empty-title">Chức năng đang phát triển</p>
                                        <p class="empty-subtitle text-secondary">Tính năng này sẽ sớm có mặt.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════
         Modals: Sửa Slide
    ═══════════════════════════════════════════════════════ --}}
    @foreach ($slides as $slide)
        <div class="modal modal-blur fade" id="editSlideModal{{ $slide->id }}" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <form action="{{ route('admin.home-hero.slides.update', $slide) }}" method="POST"
                    enctype="multipart/form-data" class="modal-content">
                    @csrf @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Sửa ảnh nền</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Ảnh hiện tại</label>
                                <div>
                                    <img src="{{ asset('storage/' . $slide->image) }}" class="rounded border"
                                        style="width:220px;height:110px;object-fit:cover;">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Ảnh mới</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Ảnh mobile hiện tại</label>
                                @if ($slide->mobile_image)
                                    <div>
                                        <img src="{{ asset('storage/' . $slide->mobile_image) }}" class="rounded border"
                                            style="width:120px;height:180px;object-fit:cover;">
                                    </div>
                                @else
                                    <div class="text-secondary small mt-2">Chưa có, đang dùng ảnh desktop.</div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Ảnh mobile mới</label>
                                <input type="file" name="mobile_image" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tiêu đề</label>
                                <input type="text" name="title" class="form-control" value="{{ $slide->title }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Alt ảnh</label>
                                <input type="text" name="alt" class="form-control" value="{{ $slide->alt }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Thứ tự</label>
                                <input type="number" name="sort_order" class="form-control" value="{{ $slide->sort_order }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Trạng thái</label>
                                <label class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" name="is_active" value="1"
                                        {{ $slide->is_active ? 'checked' : '' }}>
                                    <span class="form-check-label">Hiển thị</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">Đóng</button>
                        <button class="btn btn-primary">
                            <i class="ti ti-device-floppy me-1"></i> Cập nhật
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

    {{-- ═══════════════════════════════════════════════════════
         Modals: Sửa Thống kê
    ═══════════════════════════════════════════════════════ --}}
    @foreach ($stats as $stat)
        <div class="modal modal-blur fade" id="editStatModal{{ $stat->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <form action="{{ route('admin.home-hero.stats.update', $stat) }}" method="POST" class="modal-content">
                    @csrf @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Sửa thống kê</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Giá trị</label>
                                <input type="text" name="value" class="form-control" value="{{ $stat->value }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nhãn</label>
                                <input type="text" name="label" class="form-control" value="{{ $stat->label }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Thứ tự</label>
                                <input type="number" name="sort_order" class="form-control" value="{{ $stat->sort_order }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Trạng thái</label>
                                <label class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" name="is_active" value="1"
                                        {{ $stat->is_active ? 'checked' : '' }}>
                                    <span class="form-check-label">Hiển thị</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">Đóng</button>
                        <button class="btn btn-primary">
                            <i class="ti ti-device-floppy me-1"></i> Cập nhật
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

    {{-- ═══════════════════════════════════════════════════════
         Modals: Sửa Feature Box
    ═══════════════════════════════════════════════════════ --}}
    @foreach ($featureBoxes ?? [] as $featureBox)
        <div class="modal modal-blur fade" id="editFeatureBoxModal{{ $featureBox->id }}" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <form action="{{ route('admin.home-feature-boxes.update', $featureBox) }}" method="POST" class="modal-content">
                    @csrf @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Sửa Feature Box</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Tiêu đề</label>
                                <input type="text" name="title" class="form-control"
                                    value="{{ old('title', $featureBox->title) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Icon</label>
                                <input type="text" name="icon" class="form-control"
                                    value="{{ old('icon', $featureBox->icon) }}" placeholder="fas fa-seedling">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Mô tả</label>
                                <input type="text" name="description" class="form-control"
                                    value="{{ old('description', $featureBox->description) }}">
                            </div>
                            <div class="col-md-8">
                                <label class="form-label">Link</label>
                                <input type="text" name="link_url" class="form-control"
                                    value="{{ old('link_url', $featureBox->link_url) }}"
                                    placeholder="/san-pham hoặc https://zalo.me/...">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Thứ tự</label>
                                <input type="number" name="sort_order" class="form-control"
                                    value="{{ old('sort_order', $featureBox->sort_order) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" name="is_active" value="1"
                                        {{ old('is_active', $featureBox->is_active) ? 'checked' : '' }}>
                                    <span class="form-check-label">Hiển thị</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" name="is_external" value="1"
                                        {{ old('is_external', $featureBox->is_external) ? 'checked' : '' }}>
                                    <span class="form-check-label">Link ngoài, mở tab mới</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">Đóng</button>
                        <button class="btn btn-primary">
                            <i class="ti ti-device-floppy me-1"></i> Cập nhật
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

    {{-- ═══════════════════════════════════════════════════════
         Modals: Sửa Danh mục theo dịp
    ═══════════════════════════════════════════════════════ --}}
    @foreach ($occasionCategories ?? [] as $occasionCategory)
        <div class="modal modal-blur fade" id="editOccasionCategoryModal{{ $occasionCategory->id }}" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <form action="{{ route('admin.home-occasion-categories.update', $occasionCategory) }}" method="POST"
                    class="modal-content">
                    @csrf @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Sửa danh mục theo dịp</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Tiêu đề</label>
                                <input type="text" name="title" class="form-control"
                                    value="{{ old('title', $occasionCategory->title) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Icon / Emoji</label>
                                <input type="text" name="icon" class="form-control"
                                    value="{{ old('icon', $occasionCategory->icon) }}"
                                    placeholder="💍 hoặc fas fa-ring">
                            </div>
                            <div class="col-md-8">
                                <label class="form-label">Link</label>
                                <input type="text" name="link_url" class="form-control"
                                    value="{{ old('link_url', $occasionCategory->link_url) }}"
                                    placeholder="/san-pham?category=hoa-cuoi">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Thứ tự</label>
                                <input type="number" name="sort_order" class="form-control"
                                    value="{{ old('sort_order', $occasionCategory->sort_order) }}">
                            </div>
                            <div class="col-md-8">
                                <label class="form-label">Danh mục thật</label>
                                <select name="category_id" class="form-select">
                                    <option value="">Không liên kết</option>
                                    @foreach ($categories ?? [] as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id', $occasionCategory->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Trạng thái</label>
                                <label class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" name="is_active" value="1"
                                        {{ old('is_active', $occasionCategory->is_active) ? 'checked' : '' }}>
                                    <span class="form-check-label">Hiển thị</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">Đóng</button>
                        <button class="btn btn-primary">
                            <i class="ti ti-device-floppy me-1"></i> Cập nhật
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

    {{-- ═══════════════════════════════════════════════════════
         Modals: Sửa Promo Banner
    ═══════════════════════════════════════════════════════ --}}
    @foreach ($promoBanners ?? [] as $promoBanner)
        <div class="modal modal-blur fade" id="editPromoBannerModal{{ $promoBanner->id }}" tabindex="-1">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <form action="{{ route('admin.home-promo-banners.update', $promoBanner) }}" method="POST"
                    enctype="multipart/form-data" class="modal-content">
                    @csrf @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Sửa Promo Banner</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Tiêu đề</label>
                                <input type="text" name="title" class="form-control"
                                    value="{{ old('title', $promoBanner->title) }}" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Badge</label>
                                <input type="text" name="badge_text" class="form-control"
                                    value="{{ old('badge_text', $promoBanner->badge_text) }}"
                                    placeholder="Ưu đãi đặc biệt">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Nhấn mạnh</label>
                                <input type="text" name="highlight_text" class="form-control"
                                    value="{{ old('highlight_text', $promoBanner->highlight_text) }}"
                                    placeholder="Giảm 25%">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Mô tả</label>
                                <input type="text" name="description" class="form-control"
                                    value="{{ old('description', $promoBanner->description) }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Chữ nút</label>
                                <input type="text" name="button_text" class="form-control"
                                    value="{{ old('button_text', $promoBanner->button_text) }}"
                                    placeholder="Đặt ngay →">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Link nút</label>
                                <input type="text" name="button_url" class="form-control"
                                    value="{{ old('button_url', $promoBanner->button_url) }}"
                                    placeholder="/san-pham">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Kích thước</label>
                                <select name="size" class="form-select" required>
                                    <option value="big" {{ old('size', $promoBanner->size) === 'big' ? 'selected' : '' }}>Lớn</option>
                                    <option value="small" {{ old('size', $promoBanner->size) === 'small' ? 'selected' : '' }}>Nhỏ</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">CSS class</label>
                                <input type="text" name="css_class" class="form-control"
                                    value="{{ old('css_class', $promoBanner->css_class) }}"
                                    placeholder="promo-banner-1">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Thứ tự</label>
                                <input type="number" name="sort_order" class="form-control"
                                    value="{{ old('sort_order', $promoBanner->sort_order) }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Trạng thái</label>
                                <label class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" name="is_active" value="1"
                                        {{ old('is_active', $promoBanner->is_active) ? 'checked' : '' }}>
                                    <span class="form-check-label">Hiển thị</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Ảnh hiện tại</label>
                                @if ($promoBanner->image)
                                    <div>
                                        <img src="{{ asset('storage/' . $promoBanner->image) }}"
                                            class="rounded border"
                                            style="width:220px;height:110px;object-fit:cover;">
                                    </div>
                                @else
                                    <div class="text-secondary small">Chưa có ảnh nền.</div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Ảnh nền mới</label>
                                <input type="file" name="image" class="form-control">
                                <div class="form-hint">Bỏ trống nếu không muốn đổi ảnh.</div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">Đóng</button>
                        <button class="btn btn-primary">
                            <i class="ti ti-device-floppy me-1"></i> Cập nhật
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

    {{-- ═══════════════════════════════════════════════════════
         Script: giữ tab active sau khi submit / reload
    ═══════════════════════════════════════════════════════ --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const TAB_KEY = 'activeCustomizeTab';

            // 1. Đăng ký lưu tab khi user chuyển tab
            document.querySelectorAll('#v-pills-tab [data-bs-toggle="pill"]').forEach(function (btn) {
                btn.addEventListener('shown.bs.tab', function (e) {
                    sessionStorage.setItem(TAB_KEY, e.target.getAttribute('data-bs-target'));
                });
            });

            // 2. Restore tab đã lưu (dùng requestAnimationFrame để Bootstrap kịp init)
            const savedTarget = sessionStorage.getItem(TAB_KEY);
            if (!savedTarget) return;

            const tabBtn = document.querySelector('#v-pills-tab [data-bs-target="' + savedTarget + '"]');
            if (!tabBtn) return;

            requestAnimationFrame(function () {
                bootstrap.Tab.getOrCreateInstance(tabBtn).show();
            });
        });
    </script>
    <script>
document.addEventListener('DOMContentLoaded', function () {
    const TAB_KEY = 'activeCustomizeTab';

    // Lưu tab khi user chuyển
    document.querySelectorAll('#v-pills-tab [data-bs-toggle="pill"]').forEach(function (btn) {
        btn.addEventListener('shown.bs.tab', function (e) {
            sessionStorage.setItem(TAB_KEY, e.target.getAttribute('data-bs-target'));
        });
    });

    // Restore — dùng setTimeout đủ dài để Bootstrap init xong
    const savedTarget = sessionStorage.getItem(TAB_KEY);
    if (!savedTarget) return;

    const tabBtn = document.querySelector('#v-pills-tab [data-bs-target="' + savedTarget + '"]');
    if (!tabBtn) return;

    setTimeout(function () {
        bootstrap.Tab.getOrCreateInstance(tabBtn).show();
    }, 50);
});
</script>
<script>
    // Chạy sớm nhất có thể, trước khi Bootstrap init
    (function () {
        const saved = sessionStorage.getItem('activeCustomizeTab');
        if (!saved) return;

        // Xóa active/show khỏi tab mặc định trước khi Bootstrap render
        document.querySelectorAll('#v-pills-tab .nav-link, .tab-pane').forEach(function (el) {
            el.classList.remove('active', 'show');
        });

        const btn = document.querySelector('#v-pills-tab [data-bs-target="' + saved + '"]');
        const pane = document.querySelector(saved);
        if (btn) btn.classList.add('active');
        if (pane) pane.classList.add('show', 'active');
    })();
</script>
@endsection