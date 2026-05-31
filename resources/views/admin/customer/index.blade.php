@extends('layouts.admin.app')

@section('admin-content')
    <div class="container mt-4">
        <h1 class="mb-4">Khách hàng - Hoa Gỗ Mộc Hương</h1>

       <h1>chức năng chưa phát triễn</h1>

    </div>
    @include('admin.dashboard.edit')
@endsection

{{-- ==================== JAVASCRIPT ==================== --}}
@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tables = document.querySelectorAll('.datatable');
            tables.forEach(table => {
                if (typeof Tabler !== 'undefined' && typeof Tabler.Table !== 'undefined') {
                    new Tabler.Table(table);
                }
            });
        });
        document.querySelector('input[aria-label="Search invoice"]')
            .addEventListener('input', function () {
                const keyword = this.value.toLowerCase();
                document.querySelectorAll('.datatable tbody tr').forEach(row => {
                    row.style.display = row.textContent.toLowerCase().includes(keyword) ? '' : 'none';
                });
            });
    </script>
@endsection