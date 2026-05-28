<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label required">Tên nhà cung cấp</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $supplier->name ?? '') }}" required>
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Số điện thoại</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', $supplier->phone ?? '') }}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $supplier->email ?? '') }}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Mã số thuế</label>
            <input type="text" name="tax_code" class="form-control" value="{{ old('tax_code', $supplier->tax_code ?? '') }}">
        </div>
    </div>

    <div class="col-12">
        <div class="mb-3">
            <label class="form-label">Địa chỉ</label>
            <input type="text" name="address" class="form-control" value="{{ old('address', $supplier->address ?? '') }}">
        </div>
    </div>

    <div class="col-12">
        <div class="mb-3">
            <label class="form-label">Ghi chú</label>
            <textarea name="note" class="form-control" rows="4">{{ old('note', $supplier->note ?? '') }}</textarea>
        </div>
    </div>

    <div class="col-12">
        <label class="form-check">
            <input type="hidden" name="is_active" value="0">
            <input class="form-check-input" type="checkbox" name="is_active" value="1"
                   @checked(old('is_active', $supplier->is_active ?? true))>
            <span class="form-check-label">Hoạt động</span>
        </label>
    </div>
</div>
