@php
    $oldItems = old('items');
    if (! $oldItems && isset($inputSlip)) {
        $oldItems = $inputSlip->items->map(fn ($item) => [
            'sku_id' => $item->sku_id,
            'quantity' => $item->quantity,
            'cost_price' => $item->cost_price,
            'note' => $item->note,
        ])->toArray();
    }
    $oldItems = $oldItems ?: [['sku_id' => '', 'quantity' => 1, 'cost_price' => 0, 'note' => '']];
@endphp

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Nhà cung cấp</label>
            <select name="supplier_id" class="form-select">
                <option value="">-- Không chọn --</option>
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" @selected(old('supplier_id', $inputSlip->supplier_id ?? '') == $supplier->id)>
                        {{ $supplier->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label required">Ngày nhập</label>
            <input type="date" name="input_date" class="form-control"
                   value="{{ old('input_date', isset($inputSlip) ? optional($inputSlip->input_date)->format('Y-m-d') : now()->format('Y-m-d')) }}"
                   required>
        </div>
    </div>

    <div class="col-12">
        <div class="mb-3">
            <label class="form-label">Ghi chú</label>
            <textarea name="note" class="form-control" rows="3">{{ old('note', $inputSlip->note ?? '') }}</textarea>
        </div>
    </div>
</div>

<hr>

<h3 class="card-title mb-3">Danh sách hàng nhập</h3>

<div class="table-responsive">
    <table class="table table-bordered" id="items-table">
        <thead>
            <tr>
                <th style="min-width: 280px">SKU</th>
                <th style="width: 140px">Số lượng</th>
                <th style="width: 180px">Giá nhập</th>
                <th>Ghi chú</th>
                <th style="width: 80px"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($oldItems as $index => $item)
                <tr>
                    <td>
                        <select name="items[{{ $index }}][sku_id]" class="form-select tom-select" required>
                            <option value="">-- Chọn SKU --</option>
                            @foreach ($skus as $sku)
                                <option value="{{ $sku->id }}" @selected(($item['sku_id'] ?? '') == $sku->id)>
                                    {{ $sku->sku }} - {{ $sku->name }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="number" name="items[{{ $index }}][quantity]" class="form-control" min="1"
                               value="{{ $item['quantity'] ?? 1 }}" required>
                    </td>
                    <td>
                        <input type="number" name="items[{{ $index }}][cost_price]" class="form-control" min="0" step="1000"
                               value="{{ $item['cost_price'] ?? 0 }}" required>
                    </td>
                    <td>
                        <input type="text" name="items[{{ $index }}][note]" class="form-control" value="{{ $item['note'] ?? '' }}">
                    </td>
                    <td>
                        <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeRow(this)">Xóa</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<button type="button" class="btn btn-outline-primary" onclick="addInputRow()">
    <i class="ti ti-plus"></i> Thêm dòng
</button>

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.bootstrap5.min.css" rel="stylesheet">
<style>
    .ts-control { min-height: 38px; border-radius: 4px; }
    .ts-dropdown { z-index: 9999 !important; }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
<script>
    let inputIndex = {{ count($oldItems) }};

    function initTomSelect(element) {
        if (!element.tomselect) {
            new TomSelect(element, {
                create: false,
                dropdownParent: 'body',
                sortField: { field: "text", direction: "asc" }
            });
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.tom-select').forEach(el => initTomSelect(el));
    });

    function skuOptions(selected = '') {
        return `
            <option value="">-- Chọn SKU --</option>
            @foreach ($skus as $sku)
                <option value="{{ $sku->id }}">{{ $sku->sku }} - {{ $sku->name }}</option>
            @endforeach
        `;
    }

    function addInputRow() {
        const tbody = document.querySelector('#items-table tbody');

        const row = document.createElement('tr');
        row.innerHTML = `
            <td>
                <select name="items[${inputIndex}][sku_id]" class="form-select tom-select" required>
                    ${skuOptions()}
                </select>
            </td>
            <td>
                <input type="number" name="items[${inputIndex}][quantity]" class="form-control" min="1" value="1" required>
            </td>
            <td>
                <input type="number" name="items[${inputIndex}][cost_price]" class="form-control" min="0" step="1000" value="0" required>
            </td>
            <td>
                <input type="text" name="items[${inputIndex}][note]" class="form-control">
            </td>
            <td>
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeRow(this)">Xóa</button>
            </td>
        `;

        tbody.appendChild(row);
        
        const newSelect = tbody.lastElementChild.querySelector('.tom-select');
        if (newSelect) initTomSelect(newSelect);

        inputIndex++;
    }

    function removeRow(button) {
        const tbody = document.querySelector('#items-table tbody');
        if (tbody.querySelectorAll('tr').length <= 1) {
            alert('Phiếu phải có ít nhất 1 dòng.');
            return;
        }
        button.closest('tr').remove();
    }
</script>
@endpush
