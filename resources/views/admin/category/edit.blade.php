<div class="modal modal-blur fade" id="modal-edit-category-{{ $category->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('admin.category.update', ['id'=>$category->id, 'slug'=>$category->slug]) }}" method="POST" class="modal-content">
            @csrf
            @method('PUT')

            <div class="modal-header">
                <h5 class="modal-title">Cập nhật danh mục</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="row">
                    {{-- Tên danh mục --}}
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">
                                Tên danh mục <span class="text-danger">*</span>
                            </label>

                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ old('name', $category->name) }}" placeholder="Ví dụ: Hoa sinh nhật">

                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Danh mục cha --}}
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Danh mục cha</label>

                            <select name="parent_id" class="form-select @error('parent_id') is-invalid @enderror">
                                <option value="">Không có - là danh mục cha</option>

                                @foreach ($parentCategories as $parent)
                                    @if ($parent->id !== $category->id)
                                        <option value="{{ $parent->id }}"
                                            @selected(old('parent_id', $category->parent_id) == $parent->id)>
                                            {{ $parent->name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>

                            @error('parent_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Mega section --}}
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Mega section</label>

                            <select name="mega_section" class="form-select @error('mega_section') is-invalid @enderror">
                                <option value="">Không thuộc mega section</option>

                                <option value="kieu_dang" @selected(old('mega_section', $category->mega_section) == 'kieu_dang')>
                                    Kiểu dáng
                                </option>

                                <option value="loai_hoa" @selected(old('mega_section', $category->mega_section) == 'loai_hoa')>
                                    Loại hoa
                                </option>

                                <option value="theo_dip" @selected(old('mega_section', $category->mega_section) == 'theo_dip')>
                                    Theo dịp
                                </option>

                                <option value="theo_mau" @selected(old('mega_section', $category->mega_section) == 'theo_mau')>
                                    Theo màu
                                </option>

                                <option value="dac_biet" @selected(old('mega_section', $category->mega_section) == 'dac_biet')>
                                    Đặc biệt
                                </option>

                                <option value="hoa_co_dau" @selected(old('mega_section', $category->mega_section) == 'hoa_co_dau')>
                                    Hoa cô dâu
                                </option>

                                <option value="trang_tri_cuoi" @selected(old('mega_section', $category->mega_section) == 'trang_tri_cuoi')>
                                    Trang trí cưới
                                </option>

                                <option value="lan" @selected(old('mega_section', $category->mega_section) == 'lan')>
                                    Lan
                                </option>

                                <option value="cay_xanh" @selected(old('mega_section', $category->mega_section) == 'cay_xanh')>
                                    Cây xanh
                                </option>

                                <option value="combo_hoa" @selected(old('mega_section', $category->mega_section) == 'combo_hoa')>
                                    Combo hoa
                                </option>
                            </select>

                            @error('mega_section')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <small class="form-hint">
                                Chỉ chọn khi danh mục này là danh mục con trong mega menu.
                            </small>
                        </div>
                    </div>

                    {{-- Icon --}}
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Icon</label>

                            <input type="text" class="form-control @error('icon') is-invalid @enderror" name="icon"
                                value="{{ old('icon', $category->icon) }}"
                                placeholder="Ví dụ: ti ti-flower hoặc fa-solid fa-gift">

                            @error('icon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <small class="form-hint">
                                Lưu class icon, không lưu ảnh.
                            </small>
                        </div>
                    </div>

                    {{-- Sort order --}}
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Thứ tự sắp xếp</label>

                            <input type="number" class="form-control @error('sort_order') is-invalid @enderror"
                                name="sort_order" value="{{ old('sort_order', $category->sort_order) }}" min="0">

                            @error('sort_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Trạng thái --}}
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Trạng thái</label>

                            <label class="form-check form-switch">
                                <input type="hidden" name="is_active" value="0">

                                <input class="form-check-input" type="checkbox" name="is_active" value="1"
                                    @checked(old('is_active', $category->is_active))>

                                <span class="form-check-label">Hiển thị danh mục</span>
                            </label>

                            @error('is_active')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Mô tả --}}
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label">Mô tả</label>

                            <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                rows="3" placeholder="Nhập mô tả ngắn cho danh mục">{{ old('description', $category->description) }}</textarea>

                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Meta title --}}
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label">Meta title</label>

                            <input type="text" class="form-control @error('meta_title') is-invalid @enderror"
                                name="meta_title" value="{{ old('meta_title', $category->meta_title) }}"
                                placeholder="Tiêu đề SEO">

                            @error('meta_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Meta description --}}
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label">Meta description</label>

                            <textarea name="meta_description"
                                class="form-control @error('meta_description') is-invalid @enderror" rows="3"
                                placeholder="Mô tả SEO">{{ old('meta_description', $category->meta_description) }}</textarea>

                            @error('meta_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                    Hủy
                </button>

                <button type="submit" class="btn btn-primary ms-auto">
                    Cập nhật danh mục
                </button>
            </div>
        </form>
    </div>
</div>