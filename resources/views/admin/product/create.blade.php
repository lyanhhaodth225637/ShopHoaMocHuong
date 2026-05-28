<div class="modal modal-blur fade" id="modal-create-product" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data" class="modal-content">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title">Thêm sản phẩm mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" placeholder="Ví dụ: Bó hoa hồng đỏ 99 bông">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Danh mục sản phẩm</label>
                            <div class="category-checkbox-list @error('category_ids') is-invalid @enderror @error('category_ids.*') is-invalid @enderror">
                                @foreach ($categories as $category)
                                    <label class="category-checkbox-item">
                                        <input type="checkbox" name="category_ids[]" value="{{ $category->id }}"
                                            {{ in_array($category->id, old('category_ids', [])) ? 'checked' : '' }}
                                            onchange="updateCategoryTags()">
                                        <span>{{ $category->parent ? $category->parent->name . ' / ' : '' }}{{ $category->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                            @error('category_ids')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            @error('category_ids.*')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <div id="category-tags" class="category-tags mt-2"></div>
                            <small class="form-hint">Chọn một hoặc nhiều danh mục.</small>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Mã SKU <span class="text-danger">*</span></label>
                            <select id="create_sku_id" class="form-select @error('sku_id') is-invalid @enderror"
                                name="sku_id" onchange="syncCreateSkuInfo()">
                                <option value="">-- Chọn SKU --</option>
                                @foreach ($availableSkus as $sku)
                                    <option value="{{ $sku->id }}"
                                        data-price="{{ $sku->default_sale_price }}"
                                        data-stock="{{ $sku->inventory?->quantity ?? 0 }}"
                                        @selected(old('sku_id') == $sku->id)>
                                        {{ $sku->sku }} - {{ $sku->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('sku_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-hint">SKU đã chọn cho sản phẩm khác sẽ không xuất hiện.</small>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Giá bán</label>
                            <input type="number" id="create_price"
                                class="form-control @error('price') is-invalid @enderror"
                                name="price" value="{{ old('price', 0) }}" min="0" step="1000" readonly>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Số lượng tồn</label>
                            <input type="number" id="create_stock_quantity"
                                class="form-control @error('stock_quantity') is-invalid @enderror"
                                name="stock_quantity" value="{{ old('stock_quantity', 0) }}" min="0" readonly>
                            @error('stock_quantity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Thứ tự sắp xếp</label>
                            <input type="number" class="form-control @error('sort_order') is-invalid @enderror"
                                name="sort_order" value="{{ old('sort_order', 0) }}" min="0">
                            @error('sort_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label">Link video sản phẩm</label>
                            <input type="url" class="form-control @error('video_url') is-invalid @enderror"
                                name="video_url" value="{{ old('video_url') }}"
                                placeholder="https://www.youtube.com/watch?v=...">
                            @error('video_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Ảnh chính</label>
                            <div class="image-upload-zone" id="main-image-zone"
                                onclick="document.getElementById('main_image_input').click()"
                                ondragover="handleDragOver(event)"
                                ondragleave="handleDragLeave(event)"
                                ondrop="handleDrop(event, 'main_image_input', 'main-image-preview', 'main-image-placeholder')">
                                <div id="main-image-preview" class="image-preview" style="display:none;">
                                    <img id="main-image-preview-img" src="" alt="Preview ảnh chính">
                                    <button type="button" class="image-preview-remove"
                                        onclick="event.stopPropagation(); clearImage('main_image_input', 'main-image-preview', 'main-image-placeholder')">&times;</button>
                                </div>
                                <div id="main-image-placeholder" class="image-placeholder">
                                    <span>Nhấn hoặc kéo ảnh vào đây</span>
                                </div>
                                <input type="file" id="main_image_input" name="main_image" accept="image/*"
                                    style="display:none;"
                                    onchange="previewImage(this, 'main-image-preview', 'main-image-preview-img', 'main-image-placeholder')">
                            </div>
                            @error('main_image')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Ảnh chia sẻ SEO</label>
                            <div class="image-upload-zone" id="og-image-zone"
                                onclick="document.getElementById('og_image_input').click()"
                                ondragover="handleDragOver(event)"
                                ondragleave="handleDragLeave(event)"
                                ondrop="handleDrop(event, 'og_image_input', 'og-image-preview', 'og-image-placeholder')">
                                <div id="og-image-preview" class="image-preview" style="display:none;">
                                    <img id="og-image-preview-img" src="" alt="Preview ảnh SEO">
                                    <button type="button" class="image-preview-remove"
                                        onclick="event.stopPropagation(); clearImage('og_image_input', 'og-image-preview', 'og-image-placeholder')">&times;</button>
                                </div>
                                <div id="og-image-placeholder" class="image-placeholder">
                                    <span>Nhấn hoặc kéo ảnh vào đây</span>
                                </div>
                                <input type="file" id="og_image_input" name="og_image" accept="image/*"
                                    style="display:none;"
                                    onchange="previewImage(this, 'og-image-preview', 'og-image-preview-img', 'og-image-placeholder')">
                            </div>
                            @error('og_image')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label">Ảnh phụ sản phẩm</label>
                            <div class="image-upload-zone gallery-upload-zone" id="gallery-image-zone"
                                onclick="document.getElementById('gallery_images_input').click()"
                                ondragover="handleDragOver(event)"
                                ondragleave="handleDragLeave(event)"
                                ondrop="handleGalleryDrop(event)">
                                <div id="gallery-image-placeholder" class="image-placeholder">
                                    <span>Nhấn hoặc kéo nhiều ảnh phụ vào đây</span>
                                </div>
                                <input type="file" id="gallery_images_input" name="images[]" accept="image/*"
                                    multiple style="display:none;" onchange="previewGalleryImages(this)">
                            </div>
                            <div id="gallery-images-preview" class="gallery-images-preview mt-2"></div>
                            @error('images')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                            @error('images.*')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Trạng thái</label>
                            <label class="form-check form-switch">
                                <input type="hidden" name="is_active" value="0">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1"
                                    @checked(old('is_active', true))>
                                <span class="form-check-label">Hiển thị sản phẩm</span>
                            </label>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Sản phẩm nổi bật</label>
                            <label class="form-check form-switch">
                                <input type="hidden" name="is_featured" value="0">
                                <input class="form-check-input" type="checkbox" name="is_featured" value="1"
                                    @checked(old('is_featured', false))>
                                <span class="form-check-label">Đánh dấu nổi bật</span>
                            </label>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label">Mô tả ngắn</label>
                            <textarea name="short_description"
                                class="form-control @error('short_description') is-invalid @enderror"
                                rows="2">{{ old('short_description') }}</textarea>
                            @error('short_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label">Mô tả chi tiết</label>
                            <textarea name="description"
                                class="form-control @error('description') is-invalid @enderror"
                                rows="5">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <hr class="my-2">
                        <h4 class="mb-3">Thông tin SEO</h4>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Meta title</label>
                            <input type="text" class="form-control @error('meta_title') is-invalid @enderror"
                                name="meta_title" value="{{ old('meta_title') }}">
                            @error('meta_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Meta keywords</label>
                            <input type="text" class="form-control @error('meta_keywords') is-invalid @enderror"
                                name="meta_keywords" value="{{ old('meta_keywords') }}">
                            @error('meta_keywords')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label">Meta description</label>
                            <textarea name="meta_description"
                                class="form-control @error('meta_description') is-invalid @enderror"
                                rows="2">{{ old('meta_description') }}</textarea>
                            @error('meta_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label">Canonical URL</label>
                            <input type="text" class="form-control @error('canonical_url') is-invalid @enderror"
                                name="canonical_url" value="{{ old('canonical_url') }}">
                            @error('canonical_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <hr class="my-2">
                        <h4 class="mb-3">Open Graph</h4>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">OG title</label>
                            <input type="text" class="form-control @error('og_title') is-invalid @enderror"
                                name="og_title" value="{{ old('og_title') }}">
                            @error('og_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">OG description</label>
                            <textarea name="og_description"
                                class="form-control @error('og_description') is-invalid @enderror"
                                rows="2">{{ old('og_description') }}</textarea>
                            @error('og_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">Hủy</a>
                <button type="submit" class="btn btn-primary ms-auto">Thêm sản phẩm</button>
            </div>
        </form>
    </div>
</div>

<style>
.category-checkbox-list { border: 1px solid #dee2e6; border-radius: 6px; padding: 8px 12px; max-height: 150px; overflow-y: auto; background: #fff; }
.category-checkbox-list.is-invalid { border-color: #dc3545; }
.category-checkbox-item { display: flex; align-items: center; gap: 8px; padding: 5px 0; cursor: pointer; font-size: 14px; color: #333; margin: 0; }
.category-checkbox-item input[type="checkbox"] { width: 16px; height: 16px; cursor: pointer; flex-shrink: 0; }
.category-tags { display: flex; flex-wrap: wrap; gap: 6px; }
.category-tag { display: inline-flex; align-items: center; gap: 4px; background: #d1e7dd; color: #0a5c36; font-size: 12px; padding: 3px 10px; border-radius: 99px; line-height: 1.4; }
.category-tag-remove { background: none; border: none; padding: 0; cursor: pointer; color: #0a5c36; font-size: 16px; line-height: 1; display: flex; align-items: center; }
.image-upload-zone { border: 2px dashed #dee2e6; border-radius: 8px; padding: 16px; text-align: center; cursor: pointer; background: #f8f9fa; transition: border-color .2s, background .2s; min-height: 120px; display: flex; align-items: center; justify-content: center; }
.image-upload-zone:hover, .image-upload-zone.dragover { border-color: #0d6efd; background: #e8f0fe; }
.image-placeholder { display: flex; flex-direction: column; align-items: center; gap: 8px; color: #9ca3af; font-size: 13px; pointer-events: none; }
.image-preview { position: relative; display: inline-block; max-width: 100%; }
.image-preview img { max-height: 140px; max-width: 100%; border-radius: 6px; object-fit: cover; display: block; }
.image-preview-remove { position: absolute; top: 4px; right: 4px; background: rgba(0,0,0,.55); border: none; border-radius: 50%; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 18px; line-height: 1; cursor: pointer; padding: 0; }
.gallery-upload-zone { min-height: 100px; }
.gallery-images-preview { display: flex; flex-wrap: wrap; gap: 10px; }
.gallery-preview-item { position: relative; width: 90px; height: 90px; border: 1px solid #dee2e6; border-radius: 6px; overflow: hidden; background: #f8f9fa; }
.gallery-preview-item img { width: 100%; height: 100%; object-fit: cover; display: block; }
.gallery-preview-count { font-size: 13px; color: #6c757d; }
</style>

<script>
function updateCategoryTags() {
    const checkboxes = document.querySelectorAll('#modal-create-product input[name="category_ids[]"]');
    const container = document.getElementById('category-tags');
    container.innerHTML = '';
    checkboxes.forEach(function (cb) {
        if (!cb.checked) return;
        const label = cb.closest('label').querySelector('span').textContent.trim();
        const val = cb.value;
        const tag = document.createElement('span');
        tag.className = 'category-tag';
        const txt = document.createElement('span');
        txt.textContent = label;
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'category-tag-remove';
        btn.innerHTML = '&times;';
        btn.addEventListener('click', function () {
            const cbx = document.querySelector('#modal-create-product input[name="category_ids[]"][value="' + val + '"]');
            if (cbx) cbx.checked = false;
            updateCategoryTags();
        });
        tag.appendChild(txt);
        tag.appendChild(btn);
        container.appendChild(tag);
    });
}

function syncCreateSkuInfo() {
    const select = document.getElementById('create_sku_id');
    const option = select?.options[select.selectedIndex];
    document.getElementById('create_price').value = option?.dataset.price || 0;
    document.getElementById('create_stock_quantity').value = option?.dataset.stock || 0;
}

document.addEventListener('DOMContentLoaded', function () {
    updateCategoryTags();
    syncCreateSkuInfo();
});

function previewImage(input, previewId, previewImgId, placeholderId) {
    const file = input.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function (e) {
        document.getElementById(previewImgId).src = e.target.result;
        document.getElementById(previewId).style.display = 'block';
        document.getElementById(placeholderId).style.display = 'none';
    };
    reader.readAsDataURL(file);
}

function clearImage(inputId, previewId, placeholderId) {
    document.getElementById(inputId).value = '';
    document.getElementById(previewId).style.display = 'none';
    document.getElementById(placeholderId).style.display = 'flex';
}

function previewGalleryImages(input) {
    const previewContainer = document.getElementById('gallery-images-preview');
    const placeholder = document.getElementById('gallery-image-placeholder');
    previewContainer.innerHTML = '';
    const files = Array.from(input.files || []);
    if (!files.length) {
        placeholder.style.display = 'flex';
        return;
    }
    placeholder.style.display = 'none';
    const count = document.createElement('div');
    count.className = 'gallery-preview-count w-100';
    count.textContent = 'Đã chọn ' + files.length + ' ảnh phụ';
    previewContainer.appendChild(count);
    files.forEach(function (file) {
        if (!file.type.startsWith('image/')) return;
        const item = document.createElement('div');
        item.className = 'gallery-preview-item';
        const img = document.createElement('img');
        const reader = new FileReader();
        reader.onload = function (e) { img.src = e.target.result; };
        reader.readAsDataURL(file);
        item.appendChild(img);
        previewContainer.appendChild(item);
    });
}

function handleGalleryDrop(event) {
    event.preventDefault();
    event.currentTarget.classList.remove('dragover');
    const files = Array.from(event.dataTransfer.files || []).filter(file => file.type.startsWith('image/'));
    if (!files.length) return;
    const input = document.getElementById('gallery_images_input');
    const dt = new DataTransfer();
    files.forEach(file => dt.items.add(file));
    input.files = dt.files;
    previewGalleryImages(input);
}

function handleDragOver(event) { event.preventDefault(); event.currentTarget.classList.add('dragover'); }
function handleDragLeave(event) { event.currentTarget.classList.remove('dragover'); }
function handleDrop(event, inputId, previewId, placeholderId) {
    event.preventDefault();
    event.currentTarget.classList.remove('dragover');
    const file = event.dataTransfer.files[0];
    if (!file || !file.type.startsWith('image/')) return;
    const input = document.getElementById(inputId);
    const dt = new DataTransfer();
    dt.items.add(file);
    input.files = dt.files;
    previewImage(input, previewId, document.querySelector('#' + previewId + ' img').id, placeholderId);
}
</script>
