<div class="modal modal-blur fade" id="modal-edit-post" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <form id="editPostForm" method="POST" enctype="multipart/form-data" class="modal-content">
            @csrf
            @method('PUT')

            <div class="modal-header">
                <h5 class="modal-title">Cap nhat bai viet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Chu de</label>
                            <select id="edit_post_category_id" name="post_category_id" class="form-select">
                                <option value="">Chon chu de</option>
                                @foreach ($postCategories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Tieu de</label>
                            <input type="text" id="edit_post_title" name="title" class="form-control">
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label class="form-label">Loai bai viet</label>
                            <select id="edit_post_type" name="type" class="form-select">
                                <option value="news">Tin tuc</option>
                                <option value="tip">Meo</option>
                                <option value="guide">Huong dan</option>
                                <option value="event">Su kien</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label class="form-label">Trang thai</label>
                            <select id="edit_post_status" name="status" class="form-select">
                                <option value="draft">Ban nhap</option>
                                <option value="published">Da dang</option>
                                <option value="hidden">An</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label class="form-label">Ngay dang</label>
                            <input type="datetime-local" id="edit_post_published_at" name="published_at" class="form-control">
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label class="form-label">Video URL</label>
                            <input type="url" id="edit_post_video_url" name="video_url" class="form-control">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Thumbnail moi</label>
                            <input type="file" id="edit_post_thumbnail" name="thumbnail" accept="image/*" class="form-control">
                            <div id="edit-post-thumbnail-current" class="mt-2"></div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Them anh phu moi</label>
                            <input type="file" id="edit_post_images" name="images[]" accept="image/*" multiple class="form-control">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Tom tat</label>
                            <textarea id="edit_post_excerpt" name="excerpt" rows="3" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Noi dung</label>
                            <textarea id="edit_post_content" name="content" rows="6" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Meta title</label>
                            <input type="text" id="edit_post_meta_title" name="meta_title" class="form-control">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Meta description</label>
                            <textarea id="edit_post_meta_description" name="meta_description" rows="3" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label">Anh hien co</label>
                            <div id="edit-post-gallery-current" class="row g-2"></div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <label class="form-check form-switch">
                            <input type="hidden" name="is_active" value="0">
                            <input id="edit_post_is_active" class="form-check-input" type="checkbox" name="is_active" value="1">
                            <span class="form-check-label">Hien thi</span>
                        </label>
                    </div>

                    <div class="col-lg-3">
                        <label class="form-check form-switch">
                            <input type="hidden" name="is_featured" value="0">
                            <input id="edit_post_is_featured" class="form-check-input" type="checkbox" name="is_featured" value="1">
                            <span class="form-check-label">Noi bat</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">Huy</button>
                <button type="submit" class="btn btn-primary ms-auto">Luu thay doi</button>
            </div>
        </form>
    </div>
</div>
