<div class="modal modal-blur fade" id="modal-create-post-category" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('admin.post.store_category') }}" method="POST" class="modal-content">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title">Thêm chủ đề bài viết</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="row">
                    {{-- Tên danh mục --}}
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">
                                Tên chủ đề <span class="text-danger">*</span>
                            </label>

                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ old('name') }}" placeholder="Ví dụ: Mẹo chăm sóc hoa">

                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    {{-- Sort order --}}
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Thứ tự sắp xếp</label>

                            <input type="number" class="form-control @error('sort_order') is-invalid @enderror"
                                name="sort_order" value="{{ old('sort_order', 0) }}" min="0">

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
                                    @checked(old('is_active', true))>

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
                                rows="3" placeholder="Nhập mô tả ngắn cho danh mục">{{ old('description') }}</textarea>

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
                                name="meta_title" value="{{ old('meta_title') }}" placeholder="Tiêu đề SEO">

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
                                placeholder="Mô tả SEO">{{ old('meta_description') }}</textarea>

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
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>

                    Thêm danh mục
                </button>
            </div>
        </form>
    </div>
</div>