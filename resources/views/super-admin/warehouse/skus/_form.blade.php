<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label required">Đơn vị tính</label>
            <select name="unit_id" class="form-select" required>
                <option value="">-- Chọn đơn vị --</option>
                @foreach ($units as $unit)
                    <option value="{{ $unit->id }}" @selected(old('unit_id', $sku->unit_id ?? '') == $unit->id)>
                        {{ $unit->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label required">Mã SKU</label>
            <input type="text" name="sku" class="form-control" value="{{ old('sku', $sku->sku ?? '') }}" required>
        </div>
    </div>

    <div class="col-md-12">
        <div class="mb-3">
            <label class="form-label required">Tên hàng</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $sku->name ?? '') }}" required>
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Giá vốn mặc định</label>
            <input type="number" name="default_cost_price" class="form-control" min="0" step="1000"
                   value="{{ old('default_cost_price', $sku->default_cost_price ?? 0) }}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Giá bán mặc định</label>
            <input type="number" name="default_sale_price" class="form-control" min="0" step="1000"
                   value="{{ old('default_sale_price', $sku->default_sale_price ?? 0) }}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Tồn tối thiểu</label>
            <input type="number" name="min_quantity" class="form-control" min="0"
                   value="{{ old('min_quantity', $sku->min_quantity ?? 0) }}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Tồn tối đa</label>
            <input type="number" name="max_quantity" class="form-control" min="0"
                   value="{{ old('max_quantity', $sku->max_quantity ?? '') }}">
        </div>
    </div>

    <div class="col-12">
        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description', $sku->description ?? '') }}</textarea>
        </div>
    </div>

    <div class="col-12">
        <label class="form-check">
            <input type="hidden" name="track_inventory" value="0">
            <input class="form-check-input" type="checkbox" name="track_inventory" value="1"
                   @checked(old('track_inventory', $sku->track_inventory ?? true))>
            <span class="form-check-label">Có quản lý tồn kho</span>
        </label>

        <label class="form-check mt-2">
            <input type="hidden" name="is_active" value="0">
            <input class="form-check-input" type="checkbox" name="is_active" value="1"
                   @checked(old('is_active', $sku->is_active ?? true))>
            <span class="form-check-label">Hoạt động</span>
        </label>
    </div>
</div>
