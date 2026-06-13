@php
    $oldItems = old('items');
    if (! $oldItems && isset($outputSlip)) {
        $oldItems = $outputSlip->items->map(fn ($item) => [
            'sku_id' => $item->sku_id,
            'quantity' => $item->quantity,
            'sale_price' => $item->sale_price,
            'note' => $item->note,
        ])->toArray();
    }
    $oldItems = $oldItems ?: [['sku_id' => '', 'quantity' => 1, 'sale_price' => 0, 'note' => '']];
@endphp

<div class="row">
    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label">Khách hàng</label>
            <select name="customer_id" class="form-select">
                <option value="">-- Không chọn --</option>
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}" @selected(old('customer_id', $outputSlip->customer_id ?? '') == $customer->id)>
                        {{ $customer->name }} {{ $customer->phone ? '- ' . $customer->phone : '' }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label required">Ngày xuất</label>
            <input type="date" name="output_date" class="form-control"
                   value="{{ old('output_date', isset($outputSlip) ? optional($outputSlip->output_date)->format('Y-m-d') : now()->format('Y-m-d')) }}"
                   required>
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label required">Loại xuất</label>
            @php($type = old('output_type', $outputSlip->output_type ?? 'sale'))
            <select name="output_type" class="form-select" required>
                <option value="sale" @selected($type === 'sale')>Bán hàng</option>
                <option value="internal_use" @selected($type === 'internal_use')>Dùng nội bộ</option>
                <option value="damage" @selected($type === 'damage')>Hư hỏng</option>
                <option value="return_supplier" @selected($type === 'return_supplier')>Trả nhà cung cấp</option>
                <option value="adjustment" @selected($type === 'adjustment')>Điều chỉnh</option>
                <option value="other" @selected($type === 'other')>Khác</option>
            </select>
        </div>
    </div>

    <div class="col-12">
        <div class="mb-3">
            <label class="form-label">Ghi chú</label>
            <textarea name="note" class="form-control" rows="3">{{ old('note', $outputSlip->note ?? '') }}</textarea>
        </div>
    </div>
</div>

<hr>

<h3 class="card-title mb-3">Danh sách hàng xuất</h3>

<div class="table-responsive">
    <table class="table table-bordered" id="items-table">
        <thead>
            <tr>
                <th style="min-width: 280px">SKU</th>
                <th style="width: 140px">Số lượng</th>
                <th style="width: 180px">Giá bán</th>
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
                                    {{ $sku->sku }} - {{ $sku->name }} | Tồn: {{ $sku->inventory?->quantity ?? 0 }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="number" name="items[{{ $index }}][quantity]" class="form-control" min="1"
                               value="{{ $item['quantity'] ?? 1 }}" required>
                    </td>
                    <td>
                        <input type="number" name="items[{{ $index }}][sale_price]" class="form-control" min="0" step="1000"
                               value="{{ $item['sale_price'] ?? 0 }}" required>
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

<button type="button" class="btn btn-outline-primary" onclick="addOutputRow()">
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
    let outputIndex = {{ count($oldItems) }};

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

    function skuOptions() {
        return `
            <option value="">-- Chọn SKU --</option>
            @foreach ($skus as $sku)
                <option value="{{ $sku->id }}">{{ $sku->sku }} - {{ $sku->name }} | Tồn: {{ $sku->inventory?->quantity ?? 0 }}</option>
            @endforeach
        `;
    }

    function addOutputRow() {
        const tbody = document.querySelector('#items-table tbody');

        const row = document.createElement('tr');
        row.innerHTML = `
            <td>
                <select name="items[${outputIndex}][sku_id]" class="form-select tom-select" required>
                    ${skuOptions()}
                </select>
            </td>
            <td>
                <input type="number" name="items[${outputIndex}][quantity]" class="form-control" min="1" value="1" required>
            </td>
            <td>
                <input type="number" name="items[${outputIndex}][sale_price]" class="form-control" min="0" step="1000" value="0" required>
            </td>
            <td>
                <input type="text" name="items[${outputIndex}][note]" class="form-control">
            </td>
            <td>
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeRow(this)">Xóa</button>
            </td>
        `;

        tbody.appendChild(row);
        
        const newSelect = tbody.lastElementChild.querySelector('.tom-select');
        if (newSelect) initTomSelect(newSelect);

        outputIndex++;
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
