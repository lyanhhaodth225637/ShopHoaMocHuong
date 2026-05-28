<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label required">Tên khách hàng</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $customer->name ?? '') }}" required>
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Số điện thoại</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', $customer->phone ?? '') }}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $customer->email ?? '') }}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Địa chỉ</label>
            <input type="text" name="address" class="form-control" value="{{ old('address', $customer->address ?? '') }}">
        </div>
    </div>

    <div class="col-12">
        <div class="mb-3">
            <label class="form-label">Ghi chú</label>
            <textarea name="note" class="form-control" rows="4">{{ old('note', $customer->note ?? '') }}</textarea>
        </div>
    </div>

    <div class="col-12">
        <label class="form-check">
            <input type="hidden" name="is_active" value="0">
            <input class="form-check-input" type="checkbox" name="is_active" value="1"
                   @checked(old('is_active', $customer->is_active ?? true))>
            <span class="form-check-label">Hoạt động</span>
        </label>
    </div>
</div>
