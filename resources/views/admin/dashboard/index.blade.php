@extends('layouts.admin.app')

@section('admin-content')
    <div class="container mt-4">
        <h1 class="mb-4">Dashboard - Hoa Gỗ Mộc Hương</h1>

        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">
                            Overview
                        </div>
                        <h2 class="page-title">
                            Dashboard
                        </h2>
                    </div>

                    <div class="col-12 col-md-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <a href="{{ route('frontend.home.index') }}" class="btn btn-primary d-none d-sm-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <line x1="12" y1="5" x2="12" y2="19" />
                                    <line x1="5" y1="12" x2="19" y2="12" />
                                </svg>
                                Trang khách
                            </a>
                            @if (auth()->check() && auth()->user()->hasRole('super-admin'))
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary d-none d-sm-inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <line x1="12" y1="5" x2="12" y2="19" />
                                        <line x1="5" y1="12" x2="19" y2="12" />
                                    </svg>
                                    Quản lý Kho
                                </a>

                                <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                                    data-bs-target="#modal-editCategory" aria-label="Quản lý kho">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <line x1="12" y1="5" x2="12" y2="19" />
                                        <line x1="5" y1="12" x2="19" y2="12" />
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body" hidden>
            <div class="container-xl">
                <div class="row row-deck row-cards">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Invoices</h3>
                            </div>
                            <div class="card-body border-bottom py-3">
                                <div class="d-flex">
                                    <div class="text-muted">
                                        Show
                                        <div class="mx-2 d-inline-block">
                                            <input type="text" class="form-control form-control-sm" value="8" size="3"
                                                aria-label="Invoices count">
                                        </div>
                                        entries
                                    </div>
                                    <div class="ms-auto text-muted">
                                        Search:
                                        <div class="ms-2 d-inline-block">
                                            <input type="text" class="form-control form-control-sm"
                                                aria-label="Search invoice">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table card-table table-vcenter text-nowrap datatable">
                                    <thead>
                                        <tr>
                                            <th class="w-1">
                                                <input class="form-check-input m-0 align-middle" type="checkbox"
                                                    aria-label="Select all invoices">
                                            </th>
                                            <th class="w-1">No.</th>
                                            <th>Invoice Subject</th>
                                            <th>Client</th>
                                            <th>VAT No.</th>
                                            <th>Created</th>
                                            <th>Status</th>
                                            <th>Price</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input class="form-check-input m-0 align-middle" type="checkbox"
                                                    aria-label="Select invoice"></td>
                                            <td><span class="text-muted">001401</span></td>
                                            <td><a href="#" class="text-reset">Design Works</a></td>
                                            <td><span class="flag flag-country-us"></span> Carlson Limited</td>
                                            <td>87956621</td>
                                            <td>15 Dec 2017</td>
                                            <td><span class="badge bg-success">Paid</span></td>
                                            <td>$887</td>
                                            <td class="text-end">
                                                <div class="dropdown">
                                                    <button class="btn dropdown-toggle align-text-top"
                                                        data-bs-toggle="dropdown">Actions</button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">View</a>
                                                        <a class="dropdown-item" href="#">Edit</a>
                                                        <a class="dropdown-item text-danger" href="#">Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer d-flex align-items-center">
                                <p class="m-0 text-muted">Showing <span>1</span> to <span>8</span> of <span>16</span>
                                    entries</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.dashboard.edit')
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tables = document.querySelectorAll('.datatable');
            tables.forEach(table => {
                if (typeof Tabler !== 'undefined' && typeof Tabler.Table !== 'undefined') {
                    new Tabler.Table(table);
                }
            });

            const searchInput = document.querySelector('input[aria-label="Search invoice"]');
            if (searchInput) {
                searchInput.addEventListener('input', function () {
                    const keyword = this.value.toLowerCase();
                    document.querySelectorAll('.datatable tbody tr').forEach(row => {
                        row.style.display = row.textContent.toLowerCase().includes(keyword) ? '' : 'none';
                    });
                });
            }
        });
    </script>
@endsection