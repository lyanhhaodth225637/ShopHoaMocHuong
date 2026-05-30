@extends('layouts.admin.app')

@section('title', 'Bai viet')

@section('admin-content')
    @php
        $typeLabels = [
            'tip' => ['label' => 'Meo', 'class' => 'bg-green-lt'],
            'news' => ['label' => 'Tin tuc', 'class' => 'bg-blue-lt'],
            'guide' => ['label' => 'Huong dan', 'class' => 'bg-yellow-lt'],
            'event' => ['label' => 'Su kien', 'class' => 'bg-purple-lt'],
        ];

        $statusLabels = [
            'draft' => ['label' => 'Ban nhap', 'class' => 'bg-warning-lt'],
            'published' => ['label' => 'Da dang', 'class' => 'bg-success-lt'],
            'hidden' => ['label' => 'An', 'class' => 'bg-secondary-lt'],
        ];
    @endphp

    <div class="container mt-4">
        <h1 class="mb-4">Bai viet - Moc Huong Flower Shop</h1>

        <div>
            @include('admin.partials.alert')
        </div>

        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">Bai viet</h2>
                    </div>

                    <div class="col-12 col-md-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-create-post-category">
                                Them chu de
                            </a>
                            <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-create-post">
                                Them bai viet
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                <div class="row row-deck row-cards">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a href="#tab-post-categories" class="nav-link active" data-bs-toggle="tab" aria-selected="true" role="tab">
                                            Danh muc bai viet
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a href="#tab-posts" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab">
                                            Bai viet
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="tab-content">
                                <div class="tab-pane active show" id="tab-post-categories" role="tabpanel">
                                    <div class="card-body border-bottom py-3">
                                        <div class="d-flex">
                                            <div class="text-muted">
                                                Show
                                                <div class="mx-2 d-inline-block">
                                                    <input type="text" class="form-control form-control-sm" value="{{ $postCategories->count() }}" size="3" readonly>
                                                </div>
                                                entries
                                            </div>

                                            <div class="ms-auto text-muted">
                                                Search:
                                                <div class="ms-2 d-inline-block">
                                                    <input type="text" class="form-control form-control-sm js-table-search" data-target="#postCategoryTable">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table card-table table-vcenter text-nowrap datatable" id="postCategoryTable">
                                            <thead>
                                                <tr>
                                                    <th>Ten danh muc</th>
                                                    <th>Slug</th>
                                                    <th>Tieu de SEO</th>
                                                    <th>Thu tu</th>
                                                    <th>Trang thai</th>
                                                    <th class="text-end">Thao tac</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($postCategories as $item)
                                                    <tr>
                                                        <td>
                                                            <div class="fw-semibold">{{ $item->name }}</div>
                                                            @if ($item->description)
                                                                <div class="text-muted small text-truncate" style="max-width: 260px;">
                                                                    {{ $item->description }}
                                                                </div>
                                                            @endif
                                                        </td>
                                                        <td><span class="text-muted">{{ $item->slug }}</span></td>
                                                        <td><span class="text-muted">{{ $item->meta_title }}</span></td>
                                                        <td>{{ $item->sort_order }}</td>
                                                        <td>
                                                            <form action="{{ route('admin.post.category.toggle-status', ['id' => $item->id]) }}" method="POST">
                                                                @csrf
                                                                @method('PATCH')
                                                                <label class="form-check form-switch form-check-inline">
                                                                    <input onchange="this.form.submit()" class="form-check-input cursor-pointer" type="checkbox" name="is_active" value="1" {{ $item->is_active ? 'checked' : '' }}>
                                                                </label>
                                                            </form>
                                                        </td>
                                                        <td class="text-end">
                                                            <div class="dropdown">
                                                                <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                                                                    Thao tac
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <a
                                                                        href="#"
                                                                        class="dropdown-item btn-edit-post-category"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#modal-edit-post-category"
                                                                        data-id="{{ $item->id }}"
                                                                        data-update-url="{{ route('admin.post.update_category', ['id' => $item->id, 'slug' => $item->slug]) }}"
                                                                        data-name="{{ $item->name }}"
                                                                        data-description="{{ $item->description }}"
                                                                        data-meta-title="{{ $item->meta_title }}"
                                                                        data-meta-description="{{ $item->meta_description }}"
                                                                        data-sort-order="{{ $item->sort_order }}"
                                                                        data-is-active="{{ $item->is_active ? 1 : 0 }}"
                                                                    >
                                                                        Cap nhat
                                                                    </a>
                                                                    <a class="dropdown-item text-danger btn-delete-post-category" href="#" data-delete-url="{{ route('admin.post.destroy_category', ['id' => $item->id]) }}">
                                                                        Xoa
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="6" class="text-center text-muted py-4">Chua co chu de nao.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="tab-pane" id="tab-posts" role="tabpanel">
                                    <div class="card-body border-bottom py-3">
                                        <div class="d-flex">
                                            <div class="text-muted">
                                                Show
                                                <div class="mx-2 d-inline-block">
                                                    <input type="text" class="form-control form-control-sm" value="{{ $posts->count() }}" size="3" readonly>
                                                </div>
                                                entries
                                            </div>

                                            <div class="ms-auto text-muted">
                                                Search:
                                                <div class="ms-2 d-inline-block">
                                                    <input type="text" class="form-control form-control-sm js-table-search" data-target="#postTable">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table card-table table-vcenter text-nowrap datatable" id="postTable">
                                            <thead>
                                                <tr>
                                                    <th>Anh</th>
                                                    <th>Bai viet</th>
                                                    <th>Chu de</th>
                                                    <th>Loai</th>
                                                    <th>Trang thai</th>
                                                    <th>Noi bat</th>
                                                    <th>Luot xem</th>
                                                    <th>Ngay dang</th>
                                                    <th class="text-end">Thao tac</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($posts as $post)
                                                    <tr>
                                                        <td>
                                                            @if ($post->thumbnail)
                                                                <span class="avatar avatar-md" style="background-image: url('{{ asset('storage/' . $post->thumbnail) }}')"></span>
                                                            @else
                                                                <span class="avatar avatar-md"></span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="fw-semibold">{{ $post->title }}</div>
                                                            <div class="text-muted small">{{ $post->slug }}</div>
                                                            @if ($post->excerpt)
                                                                <div class="text-muted small text-truncate" style="max-width: 320px;">
                                                                    {{ $post->excerpt }}
                                                                </div>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <span class="badge bg-azure-lt">
                                                                {{ $post->category?->name ?? 'Chua gan chu de' }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            @php($type = $typeLabels[$post->type] ?? ['label' => $post->type, 'class' => 'bg-secondary-lt'])
                                                            <span class="badge {{ $type['class'] }}">{{ $type['label'] }}</span>
                                                        </td>
                                                        <td>
                                                            @php($status = $statusLabels[$post->status] ?? ['label' => $post->status, 'class' => 'bg-secondary-lt'])
                                                            <span class="badge {{ $status['class'] }}">{{ $status['label'] }}</span>
                                                        </td>
                                                        <td>
                                                            {!! $post->is_featured ? '<span class="badge bg-yellow-lt">Co</span>' : '<span class="text-muted">Khong</span>' !!}
                                                        </td>
                                                        <td>{{ $post->view_count }}</td>
                                                        <td>{{ $post->published_at?->format('d/m/Y H:i') ?? 'Chua dang' }}</td>
                                                        <td class="text-end">
                                                            <div class="dropdown">
                                                                <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                                                                    Thao tac
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <a
                                                                        href="#"
                                                                        class="dropdown-item btn-edit-post"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#modal-edit-post"
                                                                        data-update-url="{{ route('admin.post.update', ['id' => $post->id, 'slug' => $post->slug]) }}"
                                                                        data-title="{{ e($post->title) }}"
                                                                        data-post-category-id="{{ $post->post_category_id }}"
                                                                        data-type="{{ $post->type }}"
                                                                        data-status="{{ $post->status }}"
                                                                        data-published-at="{{ $post->published_at?->format('Y-m-d\\TH:i') }}"
                                                                        data-video-url="{{ e($post->video_url) }}"
                                                                        data-excerpt="{{ e($post->excerpt) }}"
                                                                        data-content="{{ e($post->content) }}"
                                                                        data-meta-title="{{ e($post->meta_title) }}"
                                                                        data-meta-description="{{ e($post->meta_description) }}"
                                                                        data-is-active="{{ $post->is_active ? 1 : 0 }}"
                                                                        data-is-featured="{{ $post->is_featured ? 1 : 0 }}"
                                                                        data-thumbnail-url="{{ $post->thumbnail ? asset('storage/' . $post->thumbnail) : '' }}"
                                                                        data-gallery-images='@json($post->images->map(fn($image) => ["id" => $image->id, "url" => asset("storage/" . $image->image)])->values())'
                                                                    >
                                                                        Cap nhat
                                                                    </a>
                                                                    <form action="{{ route('admin.post.destroy', ['id' => $post->id]) }}" method="POST" onsubmit="return confirm('Ban co chac muon xoa bai viet nay?')">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="dropdown-item text-danger">Xoa</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="9" class="text-center text-muted py-4">Chua co bai viet nao.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>

                                    @if ($posts->hasPages())
                                        <div class="card-footer d-flex align-items-center">
                                            {{ $posts->links() }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.post.create-category')
    @include('admin.post.edit-category')
    @include('admin.post.create-post')
    @include('admin.post.edit-post')
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.js-table-search').forEach(input => {
                input.addEventListener('input', function () {
                    const keyword = this.value.toLowerCase();
                    const table = document.querySelector(this.dataset.target);

                    if (!table) return;

                    table.querySelectorAll('tbody tr').forEach(row => {
                        row.style.display = row.textContent.toLowerCase().includes(keyword) ? '' : 'none';
                    });
                });
            });

            const editPostCategoryForm = document.getElementById('editPostCategoryForm');
            const deletePostCategoryForm = document.getElementById('deletePostCategoryForm');
            const editPostForm = document.getElementById('editPostForm');

            document.querySelectorAll('.btn-edit-post-category').forEach(button => {
                button.addEventListener('click', function () {
                    if (!editPostCategoryForm) return;

                    editPostCategoryForm.action = this.dataset.updateUrl;
                    document.getElementById('edit_post_category_id').value = this.dataset.id || '';
                    document.getElementById('edit_post_category_name').value = this.dataset.name || '';
                    document.getElementById('edit_post_category_description').value = this.dataset.description || '';
                    document.getElementById('edit_post_category_meta_title').value = this.dataset.metaTitle || '';
                    document.getElementById('edit_post_category_meta_description').value = this.dataset.metaDescription || '';
                    document.getElementById('edit_post_category_sort_order').value = this.dataset.sortOrder || 0;
                    document.getElementById('edit_post_category_is_active').checked = this.dataset.isActive == 1;
                });
            });

            document.querySelectorAll('.btn-delete-post-category').forEach(button => {
                button.addEventListener('click', function (event) {
                    event.preventDefault();

                    if (!deletePostCategoryForm || !this.dataset.deleteUrl) return;
                    if (!confirm('Ban co chac muon xoa chu de nay?')) return;

                    deletePostCategoryForm.action = this.dataset.deleteUrl;
                    deletePostCategoryForm.submit();
                });
            });

            document.querySelectorAll('.btn-edit-post').forEach(button => {
                button.addEventListener('click', function () {
                    if (!editPostForm) return;

                    editPostForm.action = this.dataset.updateUrl;
                    document.getElementById('edit_post_category_id').value = this.dataset.postCategoryId || '';
                    document.getElementById('edit_post_title').value = this.dataset.title || '';
                    document.getElementById('edit_post_type').value = this.dataset.type || 'news';
                    document.getElementById('edit_post_status').value = this.dataset.status || 'draft';
                    document.getElementById('edit_post_published_at').value = this.dataset.publishedAt || '';
                    document.getElementById('edit_post_video_url').value = this.dataset.videoUrl || '';
                    document.getElementById('edit_post_excerpt').value = this.dataset.excerpt || '';
                    document.getElementById('edit_post_content').value = this.dataset.content || '';
                    document.getElementById('edit_post_meta_title').value = this.dataset.metaTitle || '';
                    document.getElementById('edit_post_meta_description').value = this.dataset.metaDescription || '';
                    document.getElementById('edit_post_is_active').checked = this.dataset.isActive == 1;
                    document.getElementById('edit_post_is_featured').checked = this.dataset.isFeatured == 1;
                    document.getElementById('edit_post_thumbnail').value = '';
                    document.getElementById('edit_post_images').value = '';

                    renderCurrentThumbnail(this.dataset.thumbnailUrl || '');
                    renderCurrentGallery(this.dataset.galleryImages || '[]');
                });
            });

            function renderCurrentThumbnail(url) {
                const container = document.getElementById('edit-post-thumbnail-current');

                if (!container) return;
                if (!url) {
                    container.innerHTML = '<span class="text-muted small">Chua co thumbnail</span>';
                    return;
                }

                container.innerHTML = '<img src="' + url + '" alt="Thumbnail hien tai" class="img-fluid rounded" style="max-height: 140px;">';
            }

            function renderCurrentGallery(json) {
                const container = document.getElementById('edit-post-gallery-current');

                if (!container) return;

                let images = [];

                try {
                    images = JSON.parse(json);
                } catch (error) {
                    images = [];
                }

                if (!images.length) {
                    container.innerHTML = '<div class="col-12"><span class="text-muted small">Chua co anh phu</span></div>';
                    return;
                }

                container.innerHTML = images.map(image => `
                    <div class="col-md-3">
                        <label class="form-check">
                            <input class="form-check-input" type="checkbox" name="remove_image_ids[]" value="${image.id}">
                            <span class="form-check-label small text-danger">Xoa anh nay</span>
                        </label>
                        <img src="${image.url}" alt="Anh bai viet" class="img-fluid rounded border mt-2" style="height: 120px; width: 100%; object-fit: cover;">
                    </div>
                `).join('');
            }
        });
    </script>

    <form id="deletePostCategoryForm" method="POST" class="d-none">
        @csrf
        @method('DELETE')
    </form>
@endsection
