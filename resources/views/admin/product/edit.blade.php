<div class="modal modal-blur fade" id="modal-edit-product" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <form method="POST" enctype="multipart/form-data" class="modal-content" id="editProductForm">
            @csrf
            @method('PUT')

            <div class="modal-header">
                <h5 class="modal-title">Cập nhật sản phẩm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                            <input type="text" id="edit_name" class="form-control @error('name') is-invalid @enderror" name="name">
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
                                        <input type="checkbox" class="edit-category-checkbox" name="category_ids[]" value="{{ $category->id }}" onchange="updateEditCategoryTags()">
                                        <span>{{ $category->parent ? $category->parent->name . ' / ' : '' }}{{ $category->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                            <div id="edit-category-tags" class="category-tags mt-2"></div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Mã SKU <span class="text-danger">*</span></label>
                            <select id="edit_sku_id" class="form-select @error('sku_id') is-invalid @enderror" name="sku_id" onchange="syncEditSkuInfo()">
                            </select>
                            @error('sku_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-hint">Giữ SKU hiện tại hoặc chọn SKU chưa gán cho sản phẩm khác.</small>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Giá bán</label>
                            <input type="number" id="edit_price" class="form-control @error('price') is-invalid @enderror" name="price" min="0" step="1000" readonly>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Số lượng tồn</label>
                            <input type="number" id="edit_stock_quantity" class="form-control @error('stock_quantity') is-invalid @enderror" name="stock_quantity" min="0" readonly>
                            @error('stock_quantity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Thứ tự sắp xếp</label>
                            <input type="number" id="edit_sort_order" class="form-control @error('sort_order') is-invalid @enderror" name="sort_order" min="0">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label">Link video sản phẩm</label>
                            <input type="url" id="edit_video_url" class="form-control @error('video_url') is-invalid @enderror" name="video_url">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Ảnh chính</label>
                            <div class="image-upload-zone" id="edit-main-image-zone"
                                onclick="document.getElementById('edit_main_image_input').click()"
                                ondragover="handleEditDragOver(event)" ondragleave="handleEditDragLeave(event)"
                                ondrop="handleEditDrop(event, 'edit_main_image_input', 'edit-main-image-preview', 'edit-main-image-placeholder')">
                                <div id="edit-main-image-preview" class="image-preview" style="display:none;">
                                    <img id="edit-main-image-preview-img" src="" alt="Preview ảnh chính">
                                    <button type="button" class="image-preview-remove"
                                        onclick="event.stopPropagation(); clearEditImage('edit_main_image_input', 'edit-main-image-preview', 'edit-main-image-placeholder')">&times;</button>
                                </div>
                                <div id="edit-main-image-placeholder" class="image-placeholder"><span>Nhấn hoặc kéo ảnh mới vào đây</span></div>
                                <input type="file" id="edit_main_image_input" name="main_image" accept="image/*" style="display:none;"
                                    onchange="previewEditImage(this, 'edit-main-image-preview', 'edit-main-image-preview-img', 'edit-main-image-placeholder')">
                            </div>
                            <div id="edit-main-image-current" class="mt-2"></div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Ảnh SEO</label>
                            <div class="image-upload-zone" id="edit-og-image-zone"
                                onclick="document.getElementById('edit_og_image_input').click()"
                                ondragover="handleEditDragOver(event)" ondragleave="handleEditDragLeave(event)"
                                ondrop="handleEditDrop(event, 'edit_og_image_input', 'edit-og-image-preview', 'edit-og-image-placeholder')">
                                <div id="edit-og-image-preview" class="image-preview" style="display:none;">
                                    <img id="edit-og-image-preview-img" src="" alt="Preview ảnh SEO">
                                    <button type="button" class="image-preview-remove"
                                        onclick="event.stopPropagation(); clearEditImage('edit_og_image_input', 'edit-og-image-preview', 'edit-og-image-placeholder')">&times;</button>
                                </div>
                                <div id="edit-og-image-placeholder" class="image-placeholder"><span>Nhấn hoặc kéo ảnh mới vào đây</span></div>
                                <input type="file" id="edit_og_image_input" name="og_image" accept="image/*" style="display:none;"
                                    onchange="previewEditImage(this, 'edit-og-image-preview', 'edit-og-image-preview-img', 'edit-og-image-placeholder')">
                            </div>
                            <div id="edit-og-image-current" class="mt-2"></div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label">Thêm ảnh phụ sản phẩm</label>
                            <div class="image-upload-zone gallery-upload-zone" id="edit-gallery-image-zone"
                                onclick="document.getElementById('edit_gallery_images_input').click()"
                                ondragover="handleEditDragOver(event)" ondragleave="handleEditDragLeave(event)"
                                ondrop="handleEditGalleryDrop(event)">
                                <div id="edit-gallery-image-placeholder" class="image-placeholder"><span>Nhấn hoặc kéo nhiều ảnh phụ mới vào đây</span></div>
                                <input type="file" id="edit_gallery_images_input" name="images[]" accept="image/*" multiple style="display:none;" onchange="previewEditGalleryImages(this)">
                            </div>
                            <div id="edit-gallery-images-current" class="gallery-images-preview mt-2"></div>
                            <div id="edit-gallery-images-preview" class="gallery-images-preview mt-2"></div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Trạng thái</label>
                            <label class="form-check form-switch">
                                <input type="hidden" name="is_active" value="0">
                                <input class="form-check-input" id="edit_is_active" type="checkbox" name="is_active" value="1">
                                <span class="form-check-label">Hiển thị sản phẩm</span>
                            </label>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Sản phẩm nổi bật</label>
                            <label class="form-check form-switch">
                                <input type="hidden" name="is_featured" value="0">
                                <input class="form-check-input" id="edit_is_featured" type="checkbox" name="is_featured" value="1">
                                <span class="form-check-label">Đánh dấu nổi bật</span>
                            </label>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label">Mô tả ngắn</label>
                            <textarea name="short_description" id="edit_short_description" class="form-control @error('short_description') is-invalid @enderror" rows="2"></textarea>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label">Mô tả chi tiết</label>
                            <textarea name="description" id="edit_description" class="form-control @error('description') is-invalid @enderror" rows="5"></textarea>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <hr class="my-2">
                        <h4 class="mb-3">Thông tin SEO</h4>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Meta title</label>
                            <input type="text" id="edit_meta_title" class="form-control @error('meta_title') is-invalid @enderror" name="meta_title">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Meta keywords</label>
                            <input type="text" id="edit_meta_keywords" class="form-control @error('meta_keywords') is-invalid @enderror" name="meta_keywords">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label">Meta description</label>
                            <textarea name="meta_description" id="edit_meta_description" class="form-control @error('meta_description') is-invalid @enderror" rows="2"></textarea>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label">Canonical URL</label>
                            <input type="text" id="edit_canonical_url" class="form-control @error('canonical_url') is-invalid @enderror" name="canonical_url">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <hr class="my-2">
                        <h4 class="mb-3">Open Graph</h4>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">OG title</label>
                            <input type="text" id="edit_og_title" class="form-control @error('og_title') is-invalid @enderror" name="og_title">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">OG description</label>
                            <textarea name="og_description" id="edit_og_description" class="form-control @error('og_description') is-invalid @enderror" rows="2"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">Hủy</a>
                <button type="submit" class="btn btn-primary ms-auto">Cập nhật sản phẩm</button>
            </div>
        </form>
    </div>
</div>

<script>
function buildEditSkuOptions(currentProductId, currentSkuId) {
    const select = document.getElementById('edit_sku_id');
    if (!select || !Array.isArray(window.productSkuOptions)) return;
    select.innerHTML = '<option value="">-- Chọn SKU --</option>';
    window.productSkuOptions.forEach(function (sku) {
        const assignedProductId = sku.assigned_product_id;
        if (assignedProductId && Number(assignedProductId) !== Number(currentProductId)) {
            return;
        }
        const option = document.createElement('option');
        option.value = sku.id;
        option.textContent = sku.code + ' - ' + sku.name;
        option.dataset.price = sku.price;
        option.dataset.stock = sku.stock_quantity;
        if (Number(sku.id) === Number(currentSkuId)) {
            option.selected = true;
        }
        select.appendChild(option);
    });
}

function syncEditSkuInfo() {
    const select = document.getElementById('edit_sku_id');
    const option = select?.options[select.selectedIndex];
    document.getElementById('edit_price').value = option?.dataset.price || 0;
    document.getElementById('edit_stock_quantity').value = option?.dataset.stock || 0;
}

function updateEditCategoryTags() {
    const checkboxes = document.querySelectorAll('#modal-edit-product input[name="category_ids[]"]');
    const container = document.getElementById('edit-category-tags');
    if (!container) return;
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
            const cbx = document.querySelector('#modal-edit-product input[name="category_ids[]"][value="' + val + '"]');
            if (cbx) cbx.checked = false;
            updateEditCategoryTags();
        });
        tag.appendChild(txt);
        tag.appendChild(btn);
        container.appendChild(tag);
    });
}

function previewEditImage(input, previewId, previewImgId, placeholderId) {
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

function clearEditImage(inputId, previewId, placeholderId) {
    document.getElementById(inputId).value = '';
    document.getElementById(previewId).style.display = 'none';
    document.getElementById(placeholderId).style.display = 'flex';
}

function previewEditGalleryImages(input) {
    const previewContainer = document.getElementById('edit-gallery-images-preview');
    const placeholder = document.getElementById('edit-gallery-image-placeholder');
    previewContainer.innerHTML = '';
    const files = Array.from(input.files || []);
    if (!files.length) {
        placeholder.style.display = 'flex';
        return;
    }
    placeholder.style.display = 'none';
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

function renderExistingEditImage(containerId, imageUrl, label) {
    const container = document.getElementById(containerId);
    if (!container) return;
    if (!imageUrl) {
        container.innerHTML = '';
        return;
    }
    container.innerHTML = '<div class="text-secondary small mb-1">' + label + '</div><div class="image-preview" style="display:block;"><img src="' + imageUrl + '" alt="' + label + '"></div>';
}

function renderExistingEditGalleryImages(imageUrls) {
    const container = document.getElementById('edit-gallery-images-current');
    if (!container) return;
    if (!Array.isArray(imageUrls) || !imageUrls.length) {
        container.innerHTML = '';
        return;
    }
    container.innerHTML = '<div class="gallery-preview-count w-100">Ảnh phụ hiện tại</div>' + imageUrls.map(url => '<div class="gallery-preview-item"><img src="' + url + '" alt="Ảnh phụ hiện tại"></div>').join('');
}

function handleEditGalleryDrop(event) {
    event.preventDefault();
    event.currentTarget.classList.remove('dragover');
    const files = Array.from(event.dataTransfer.files || []).filter(file => file.type.startsWith('image/'));
    if (!files.length) return;
    const input = document.getElementById('edit_gallery_images_input');
    const dt = new DataTransfer();
    files.forEach(file => dt.items.add(file));
    input.files = dt.files;
    previewEditGalleryImages(input);
}

function handleEditDragOver(event) { event.preventDefault(); event.currentTarget.classList.add('dragover'); }
function handleEditDragLeave(event) { event.currentTarget.classList.remove('dragover'); }
function handleEditDrop(event, inputId, previewId, placeholderId) {
    event.preventDefault();
    event.currentTarget.classList.remove('dragover');
    const file = event.dataTransfer.files[0];
    if (!file || !file.type.startsWith('image/')) return;
    const input = document.getElementById(inputId);
    const dt = new DataTransfer();
    dt.items.add(file);
    input.files = dt.files;
    previewEditImage(input, previewId, document.querySelector('#' + previewId + ' img').id, placeholderId);
}

document.addEventListener('DOMContentLoaded', function () {
    const editForm = document.getElementById('editProductForm');
    document.querySelectorAll('.btn-edit-product').forEach(button => {
        button.addEventListener('click', function () {
            if (!editForm) return;
            editForm.action = this.dataset.updateUrl;
            document.getElementById('edit_name').value = this.dataset.name || '';
            document.getElementById('edit_sort_order').value = this.dataset.sortOrder || 0;
            document.getElementById('edit_video_url').value = this.dataset.videoUrl || '';
            document.getElementById('edit_short_description').value = this.dataset.shortDescription || '';
            document.getElementById('edit_description').value = this.dataset.description || '';
            document.getElementById('edit_meta_title').value = this.dataset.metaTitle || '';
            document.getElementById('edit_meta_keywords').value = this.dataset.metaKeywords || '';
            document.getElementById('edit_meta_description').value = this.dataset.metaDescription || '';
            document.getElementById('edit_canonical_url').value = this.dataset.canonicalUrl || '';
            document.getElementById('edit_og_title').value = this.dataset.ogTitle || '';
            document.getElementById('edit_og_description').value = this.dataset.ogDescription || '';
            document.getElementById('edit_is_active').checked = this.dataset.isActive == 1;
            document.getElementById('edit_is_featured').checked = this.dataset.isFeatured == 1;

            buildEditSkuOptions(this.dataset.productId, this.dataset.skuId);
            syncEditSkuInfo();

            document.querySelectorAll('#modal-edit-product input[name="category_ids[]"]').forEach(checkbox => {
                checkbox.checked = false;
            });
            const categoryIds = JSON.parse(this.dataset.categoryIds || '[]');
            categoryIds.forEach(id => {
                const checkbox = document.querySelector('#modal-edit-product input[name="category_ids[]"][value="' + id + '"]');
                if (checkbox) checkbox.checked = true;
            });
            updateEditCategoryTags();
            renderExistingEditImage('edit-main-image-current', this.dataset.mainImageUrl, 'Ảnh chính hiện tại');
            renderExistingEditImage('edit-og-image-current', this.dataset.ogImageUrl, 'Ảnh SEO hiện tại');
            renderExistingEditGalleryImages(JSON.parse(this.dataset.galleryImageUrls || '[]'));
        });
    });
});
</script>
