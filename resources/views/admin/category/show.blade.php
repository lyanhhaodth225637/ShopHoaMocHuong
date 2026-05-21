@extends('layouts.admin.app')

@section('admin-content')
    @php
        $sectionLabels = [
            'kieu_dang' => 'Kiểu dáng',
            'loai_hoa' => 'Loại hoa',
            'theo_dip' => 'Theo dịp',
            'theo_mau' => 'Theo màu sắc',
            'dac_biet' => 'Đặc biệt',

            'hoa_co_dau' => 'Cô dâu & chú rể',
            'phu_kien_cuoi' => 'Phụ kiện cưới',
            'trang_tri_cuoi' => 'Trang trí cưới',
            'dich_vu_cuoi' => 'Dịch vụ cưới',

            'lan' => 'Lan hồ điệp',
            'cay_xanh' => 'Cây xanh',
            'qua_tang_cay' => 'Quà tặng cây',

            'combo_hoa' => 'Combo hoa + quà',
            'gio_qua' => 'Giỏ & hộp quà',
            'hop_qua' => 'Hộp quà',
            'phu_kien' => 'Phụ kiện',

            'banh' => 'Bánh kem',
            'combo' => 'Combo đặc biệt',
            'do_uong' => 'Đồ uống',

            'khac' => 'Khác',
        ];
    @endphp

    <div class="container mt-4">
        <h1 class="mb-4">
            Chi tiết danh mục - {{ $category->name }}
        </h1>

        {{-- Alert --}}
        <div>
            @include('admin.partials.alert')
        </div>

        {{-- Page Header --}}
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">

                        @if ($category->description)
                            <div class="text-muted mt-2">
                                {{ $category->description }}
                            </div>
                        @endif
                    </div>

                    {{-- Page title actions --}}
                    <div class="col-12 col-md-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <a href="{{ route('admin.category.index') }}" class="btn btn-white">
                                Quay lại
                            </a>

                           

                            <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                                data-bs-target="#modal-create-category" aria-label="Thêm danh mục con">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <line x1="12" y1="5" x2="12" y2="19" />
                                    <line x1="5" y1="12" x2="19" y2="12" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Page Body --}}
        <div class="page-body">
            <div class="container-xl">

                {{-- Card thông tin danh mục cha --}}
                <div class="row row-cards mb-3">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="subheader">Tên danh mục</div>
                                <div class="h3 m-0">{{ $category->name }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="subheader">Slug</div>
                                <div class="h3 m-0 text-truncate">{{ $category->slug }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="subheader">Số danh mục con</div>
                                <div class="h3 m-0">{{ $category->children->count() }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="subheader">Trạng thái</div>

                                @if ($category->is_active)
                                    <span class="badge bg-success-lt">Đang hiển thị</span>
                                @else
                                    <span class="badge bg-secondary-lt">Đang ẩn</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Bảng danh mục con --}}
                <div class="row row-deck row-cards">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Danh mục con của "{{ $category->name }}"
                                </h3>
                            </div>

                            <div class="card-body border-bottom py-3">
                                <div class="d-flex">
                                    <div class="text-muted">
                                        Tổng:
                                        <strong>{{ $category->children->count() }}</strong>
                                        danh mục con
                                    </div>

                                    <div class="ms-auto text-muted">
                                        Search:
                                        <div class="ms-2 d-inline-block">
                                            <input type="text" class="form-control form-control-sm"
                                                id="search-child-category"
                                                aria-label="Search category">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table card-table table-vcenter text-nowrap datatable">
                                    <thead>
                                        <tr>
                                            <th class="w-1">
                                                <input class="form-check-input m-0 align-middle" type="checkbox"
                                                    aria-label="Select all categories">
                                            </th>

                                            <th>Tên</th>
                                            <th>Slug</th>
                                            <th>Nhóm</th>
                                            <th>Icon</th>
                                            <th>Thứ tự</th>
                                            <th>Trạng thái</th>
                                            <th>Ngày tạo</th>
                                            <th class="text-end">Thao tác</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($category->children as $item)
                                            @php
                                                $sectionKey = $item->mega_section ?: 'khac';
                                            @endphp

                                            <tr>
                                                <td>
                                                    <input class="form-check-input m-0 align-middle" type="checkbox"
                                                        aria-label="Select category">
                                                </td>

                                                <td>
                                                    <a href="{{ route('admin.category.show', ['id' => $item->id, 'slug' => $item->slug]) }}"
                                                        class="text-reset fw-semibold">
                                                        {{ $item->name }}
                                                    </a>

                                                    @if ($item->description)
                                                        <div class="text-muted small text-truncate" style="max-width: 260px;">
                                                            {{ $item->description }}
                                                        </div>
                                                    @endif
                                                </td>

                                                <td>
                                                    <span class="text-muted">
                                                        {{ $item->slug }}
                                                    </span>
                                                </td>

                                                <td>
                                                    @if ($item->mega_section)
                                                        <span class="badge bg-purple-lt">
                                                            {{ $sectionLabels[$sectionKey] ?? $sectionKey }}
                                                        </span>
                                                    @else
                                                        <span class="text-muted">—</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    @if ($item->icon)
                                                        <i class="{{ $item->icon }}"></i>
                                                        <span class="text-muted ms-1">{{ $item->icon }}</span>
                                                    @else
                                                        <span class="text-muted">—</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    {{ $item->sort_order }}
                                                </td>

                                                <td>
                                                    <label class="form-check form-switch form-check-inline">
                                                        <input class="form-check-input cursor-pointer" type="checkbox"
                                                            onchange="toggleActive(this, {{ $item->id }})"
                                                            {{ $item->is_active ? 'checked' : '' }}>
                                                    </label>
                                                </td>

                                                <td>
                                                    {{ $item->created_at?->format('d/m/Y') }}
                                                </td>

                                                <td class="text-end">
                                                    <div class="dropdown">
                                                        <button class="btn dropdown-toggle align-text-top"
                                                            data-bs-toggle="dropdown">
                                                            Thao tác
                                                        </button>

                                                        <div class="dropdown-menu dropdown-menu-end">

                                                            <a class="dropdown-item"
                                                                href="#"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modal-edit-category-{{ $item->id }}">
                                                                Cập nhật
                                                            </a>

                                                            <form action="{{ route('admin.category.destroy', ['id'=>$item->id]) }}" method="POST"
                                                                onsubmit="return confirm('Bạn có chắc muốn xóa danh mục này?')">
                                                                @csrf
                                                                @method('DELETE')

                                                                <button type="submit" class="dropdown-item text-danger">
                                                                    Xóa
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center text-muted py-4">
                                                    Danh mục này chưa có danh mục con.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="card-footer d-flex align-items-center">
                                <a href="{{ route('admin.category.index') }}" class="btn btn-white">
                                    Quay lại danh sách
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @foreach ($category->children as $item)
            @include('admin.category.edit', [
                'category' => $item,
                'parentCategories' => $parentCategories,
            ])
    @endforeach

@endsection

@section('js')
    <script>
        const searchInput = document.getElementById('search-child-category');

        if (searchInput) {
            searchInput.addEventListener('input', function () {
                const keyword = this.value.toLowerCase();

                document.querySelectorAll('.datatable tbody tr').forEach(row => {
                    row.style.display = row.textContent.toLowerCase().includes(keyword) ? '' : 'none';
                });
            });
        }
    </script>
@endsection
