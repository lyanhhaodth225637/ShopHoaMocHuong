<div class="modal modal-blur fade" id="modal-edit-post-category" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form id="editPostCategoryForm" method="POST" class="modal-content">
            @csrf
            @method('PUT')
            <input type="hidden" id="edit_post_category_id" name="post_category_id" value="{{ old('post_category_id') }}">

            <div class="modal-header">
                <h5 class="modal-title">Cập nhật chủ đề bài viết</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">
                                Tên chủ đề <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                id="edit_post_category_name"
                                class="form-control @error('name') is-invalid @enderror"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Ví dụ: Mẹo chăm sóc hoa"
                            >

                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Thứ tự sắp xếp</label>

                            <input
                                type="number"
                                id="edit_post_category_sort_order"
                                class="form-control @error('sort_order') is-invalid @enderror"
                                name="sort_order"
                                min="0"
                                value="{{ old('sort_order', 0) }}"
                            >

                            @error('sort_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Trạng thái</label>

                            <label class="form-check form-switch">
                                <input type="hidden" name="is_active" value="0">

                                <input
                                    id="edit_post_category_is_active"
                                    class="form-check-input"
                                    type="checkbox"
                                    name="is_active"
                                    value="1"
                                    @checked(old('is_active'))
                                >

                                <span class="form-check-label">Hiển thị danh mục</span>
                            </label>

                            @error('is_active')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label">Mô tả</label>

                            <textarea
                                id="edit_post_category_description"
                                name="description"
                                class="form-control @error('description') is-invalid @enderror"
                                rows="3"
                                placeholder="Nhập mô tả ngắn cho danh mục"
                            >{{ old('description') }}</textarea>

                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label">Meta title</label>

                            <input
                                type="text"
                                id="edit_post_category_meta_title"
                                class="form-control @error('meta_title') is-invalid @enderror"
                                name="meta_title"
                                value="{{ old('meta_title') }}"
                                placeholder="Tiêu đề SEO"
                            >

                            @error('meta_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label">Meta description</label>

                            <textarea
                                id="edit_post_category_meta_description"
                                name="meta_description"
                                class="form-control @error('meta_description') is-invalid @enderror"
                                rows="3"
                                placeholder="Mô tả SEO"
                            >{{ old('meta_description') }}</textarea>

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
                    Lưu thay đổi
                </button>
            </div>
        </form>
    </div>
</div>
