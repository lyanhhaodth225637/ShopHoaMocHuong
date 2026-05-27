@extends('layouts.admin.app')

@section('admin-content')
    <div class="container mt-4">
        <h1 class="mb-4">Danh Mục - Mộc Hương Flower Shop</h1>
        <!-- alert -->
        <div>
             @include('admin.partials.alert')
        </div>   
        {{-- Page Header --}}
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                       
                        <h2 class="page-title">
                            Danh Mục
                        </h2>
                    </div>
                    {{-- Page title actions --}}
                    <div class="col-12 col-md-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <span class="d-none d-sm-inline">
                                <a href="#" class="btn btn-white">
                                    New view
                                </a>
                            </span>
                            <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                                data-bs-target="#modal-create-category">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <line x1="12" y1="5" x2="12" y2="19" />
                                    <line x1="5" y1="12" x2="19" y2="12" />
                                </svg>
                                Thêm danh mục mới
                            </a>
                            <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                                data-bs-target="#modal-report" aria-label="Create new report">
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
                <div class="row row-deck row-cards">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Invoices</h3>
                            </div>
                            <div class="card-body border-bottom py-3">
                                <div class="d-flex">
                                    <div class="text-muted">
                                        Show
                                        <div class="mx-2 d-inline-block">
                                            <input type="text" class="form-control form-control-sm" value="8" size="3"
                                                aria-label="Invoices count">
                                        </div>
                                        entries
                                    </div>
                                    <div class="ms-auto text-muted">
                                        Search:
                                        <div class="ms-2 d-inline-block">
                                            <input type="text" class="form-control form-control-sm"
                                                aria-label="Search invoice">
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
                                            <th>Danh mục cha</th>
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
                                                <tr>
                                                    <td>
                                                        <input class="form-check-input m-0 align-middle" type="checkbox"
                                                            aria-label="Select category">
                                                    </td>

                                                    <td>
                                                        <a href="#" class="text-reset fw-semibold">
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
                                                        @if ($item->parent)
                                                            <span class="badge bg-blue-lt">
                                                                {{ $item->parent->name }}
                                                            </span>
                                                        @else
                                                            <span class="badge bg-green-lt">
                                                                Danh mục cha
                                                            </span>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        @if ($item->mega_section_key || $item->mega_section_label)
                                                            <span class="badge bg-purple-lt">
                                                                {{ $item->mega_section_resolved_label }}
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
                                                                    href="{{ route('admin.category.show', ['id' => $item->id, 'slug' => $item->slug]) }}">
                                                                    Xem
                                                                </a>

                                                                <a class="dropdown-item btn-edit-category"
                                                                    href="#"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#modal-edit-category"
                                                                    data-update-url="{{ route('admin.category.update', ['id' => $item->id, 'slug' => $item->slug]) }}"
                                                                    data-parent-id="{{ $item->parent_id }}"
                                                                    data-name="{{ e($item->name) }}"
                                                                    data-mega-section-key="{{ e($item->mega_section_key) }}"
                                                                    data-mega-section-label="{{ e($item->mega_section_label) }}"
                                                                    data-icon="{{ e($item->icon) }}"
                                                                    data-description="{{ e($item->description) }}"
                                                                    data-meta-title="{{ e($item->meta_title) }}"
                                                                    data-meta-description="{{ e($item->meta_description) }}"
                                                                    data-sort-order="{{ $item->sort_order }}"
                                                                    data-is-active="{{ $item->is_active ? 1 : 0 }}">
                                                                    Cập nhật
                                                                </a>

                                                                <form action="{{ route('admin.category.destroy', ['id'=>$item->id]) }}"
                                                                    method="POST"
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
                                                    <td colspan="10" class="text-center text-muted py-4">
                                                        Chưa có danh mục nào.
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                        
                                </table>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <datalist id="mega-section-label-suggestions">
        @foreach ($megaSectionSuggestions as $megaSectionSuggestion)
            <option value="{{ $megaSectionSuggestion->mega_section_label ?: $megaSectionSuggestion->mega_section_key }}"></option>
        @endforeach
    </datalist>
    <datalist id="mega-section-key-suggestions">
        @foreach ($megaSectionSuggestions as $megaSectionSuggestion)
            <option value="{{ $megaSectionSuggestion->mega_section_key }}"></option>
        @endforeach
    </datalist>
    @include('admin.category.create')

    @include('admin.category.edit', [
        'parentCategories' => $parentCategories,
    ])
@endsection

{{-- ==================== JAVASCRIPT ==================== --}}
{{-- ==================== JAVASCRIPT ==================== --}}
@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tables = document.querySelectorAll('.datatable');

            tables.forEach(function (table) {
                if (typeof Tabler !== 'undefined' && typeof Tabler.Table !== 'undefined') {
                    new Tabler.Table(table);
                }
            });

            const searchInput = document.getElementById('search-child-category');

            if (searchInput) {
                searchInput.addEventListener('input', function () {
                    const keyword = this.value.toLowerCase();

                    document.querySelectorAll('.datatable tbody tr').forEach(function (row) {
                        row.style.display = row.textContent.toLowerCase().includes(keyword) ? '' : 'none';
                    });
                });
            }

            const editForm = document.getElementById('editCategoryForm');

            document.querySelectorAll('.btn-edit-category').forEach(function (button) {
                button.addEventListener('click', function () {
                    if (!editForm) {
                        return;
                    }

                    editForm.action = this.dataset.updateUrl || this.dataset.action || '';

                    setValue('edit_parent_id', this.dataset.parentId || '');
                    setValue('edit_name', this.dataset.name || '');
                    setValue('edit_mega_section_label', this.dataset.megaSectionLabel || '');
                    setValue('edit_mega_section_key', this.dataset.megaSectionKey || '');
                    setValue('edit_icon', this.dataset.icon || '');
                    setValue('edit_description', this.dataset.description || '');
                    setValue('edit_meta_title', this.dataset.metaTitle || '');
                    setValue('edit_meta_description', this.dataset.metaDescription || '');
                    setValue('edit_sort_order', this.dataset.sortOrder || 0);

                    const activeInput = document.getElementById('edit_is_active');

                    if (activeInput) {
                        activeInput.checked = String(this.dataset.isActive) === '1';
                    }
                });
            });

            const editMegaSectionLabel = document.getElementById('edit_mega_section_label');
            const editMegaSectionKey = document.getElementById('edit_mega_section_key');

            if (editMegaSectionLabel && editMegaSectionKey) {
                editMegaSectionLabel.addEventListener('input', function () {
                    if (editMegaSectionKey.value.trim() !== '') {
                        return;
                    }

                    editMegaSectionKey.value = makeSectionKey(this.value);
                });
            }

            function setValue(id, value) {
                const element = document.getElementById(id);

                if (element) {
                    element.value = value ?? '';
                }
            }

            function makeSectionKey(value) {
                return String(value || '')
                    .toLowerCase()
                    .normalize('NFD')
                    .replace(/[\u0300-\u036f]/g, '')
                    .replace(/đ/g, 'd')
                    .replace(/Đ/g, 'd')
                    .replace(/[^a-z0-9]+/g, '_')
                    .replace(/^_+|_+$/g, '');
            }
        });
    </script>
@endsection