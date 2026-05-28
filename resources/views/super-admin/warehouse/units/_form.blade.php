<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            <label class="form-label required">Tên đơn vị</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $unit->name ?? '') }}" required>
        </div>
    </div>

    <div class="col-12">
        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description', $unit->description ?? '') }}</textarea>
        </div>
    </div>

    <div class="col-12">
        <label class="form-check">
            <input type="hidden" name="is_active" value="0">
            <input class="form-check-input" type="checkbox" name="is_active" value="1"
                   @checked(old('is_active', $unit->is_active ?? true))>
            <span class="form-check-label">Hoạt động</span>
        </label>
    </div>
</div>
