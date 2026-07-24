@extends('admin.layouts.app')

@push('title')
    <title>Testimonials</title>
@endpush

@push('styles')
    <link rel="stylesheet" href="{{ asset('admin_assets/css/pos.css') }}">
    <style>
        /* ── Stat cards ── */
        .stat-card { border-radius: 10px; border: 1px solid #e4e7ef; padding: 16px 18px; background: #fff; }
        .stat-card .label { font-size: 11px; text-transform: uppercase; letter-spacing: .06em; color: #7b8299; margin-bottom: 4px; }
        .stat-card .value { font-size: 20px; font-weight: 700; }
        .stat-card .sub   { font-size: 12px; color: #7b8299; margin-top: 2px; }

        /* ── Status badges ── */
        .badge-active   { background: #e6f9f0; color: #0d7a4e; border-radius: 20px; padding: 3px 10px; font-size: 11px; font-weight: 600; white-space: nowrap; }
        .badge-inactive { background: #fff4e5; color: #b45309; border-radius: 20px; padding: 3px 10px; font-size: 11px; font-weight: 600; white-space: nowrap; }

        /* ── Icon buttons ── */
        .icon-btn {
            width: 32px; height: 32px; border-radius: 7px;
            display: inline-flex; align-items: center; justify-content: center;
            border: 1px solid #e4e7ef; background: #fff; color: #7b8299;
            text-decoration: none; cursor: pointer; flex-shrink: 0;
        }
        .icon-btn.edit:hover { background: #e8f0fe; border-color: #2275fc; color: #2275fc; }

        /* ── Wrapper box ── */
        .wg-box { border-radius: 12px; border: 1px solid #e4e7ef; background: #fff; overflow: hidden; }

        /* ── Desktop table ── */
        .table-testimonials.table-all-user>* {
            min-width: auto !important;
        }
        .table-testimonials .table-title,
        .table-testimonials .user-item {
            display: flex;
            align-items: center;
            width: 100%;
            padding-left: 20px;
            padding-right: 20px;
        }
        .table-testimonials .table-title {
            background: #f8f9fc;
            border-bottom: 1px solid #e4e7ef;
            padding-top: 12px;
            padding-bottom: 12px;
            margin-bottom: 0 !important;
        }
        .table-testimonials .user-item {
            padding-top: 13px;
            padding-bottom: 13px;
            border-bottom: 1px solid #e4e7ef;
            transition: background-color 0.15s ease;
        }
        .table-testimonials .user-item:last-child {
            border-bottom: none;
        }
        .table-testimonials .user-item:hover {
            background-color: #f6f8ff;
        }

        .table-testimonials .col-photo {
            flex: 0 0 70px;
            width: 70px;
        }
        .table-testimonials .col-name {
            flex: 1 1 200px;
        }
        .table-testimonials .col-desc {
            flex: 2 1 350px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .table-testimonials .col-status {
            flex: 0 0 120px;
            width: 120px;
        }
        .table-testimonials .col-action {
            flex: 0 0 80px;
            width: 80px;
            display: flex;
            justify-content: flex-end;
        }

        .table-testimonials .user-item .image {
            height: 50px;
            width: 50px;
            border-radius: 50%;
            overflow: hidden;
            background: #f8f9fc;
            border: 2px solid #e4e7ef;
        }
        .table-testimonials .user-item .image img {
            width: 100%; height: 100%; object-fit: cover;
        }
        
        

  

    



        /* ── Testimonial avatar photo ── */
        .t-avatar {
            width: 40px; height: 40px; border-radius: 50%;
            object-fit: cover; border: 2px solid #e4e7ef; flex-shrink: 0;
        }

        /* ── Name cell ── */
        .name-cell { display: flex; align-items: center; gap: 8px; overflow: hidden; }
        .name-cell .name-text { overflow: hidden; text-overflow: ellipsis; white-space: nowrap; font-weight: 500; }

        /* ── Search bar ── */
        .search-group input,
        .search-group select {
            height: 38px; border: 1px solid #e4e7ef; border-radius: 7px;
            font-size: 13px; padding: 0 12px; outline: none;
            background: #fff; color: #1a1d2e; width: 100%;
        }
        .search-group input:focus,
        .search-group select:focus { border-color: #2275fc; box-shadow: 0 0 0 3px rgba(34,117,252,.1); }

        /* ── Mobile cards — hidden on desktop ── */
        .mobile-testimonial-cards { display: none; }
        .mobile-card { background: #fff; border-bottom: 1px solid #e4e7ef; padding: 14px 16px; }
        .mobile-card:last-child { border-bottom: none; }
        .mobile-card-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px; }
        .mobile-card-row    { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 6px; gap: 8px; }
        .mobile-card-label  { font-size: 11px; text-transform: uppercase; letter-spacing: .05em; color: #7b8299; font-weight: 600; flex-shrink: 0; }
        .mobile-card-value  { font-size: 13px; font-weight: 500; color: #1a1d2e; word-break: break-word; text-align: right; }
        .mobile-card-footer { display: flex; align-items: center; justify-content: space-between; margin-top: 10px; padding-top: 10px; border-top: 1px solid #f0f1f5; }

        /* ── Modal ── */
        .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.45); z-index: 9999; align-items: center; justify-content: center; }
        .modal-overlay.open { display: flex; }
        .modal-box { background: #fff; border-radius: 12px; width: 100%; max-width: 480px; margin: 16px; box-shadow: 0 8px 32px rgba(0,0,0,.18); max-height: 90vh; overflow-y: auto; }
        .modal-header { display: flex; align-items: center; justify-content: space-between; padding: 16px 20px; border-bottom: 1px solid #e4e7ef; position: sticky; top: 0; background: #fff; z-index: 1; }
        .modal-header h4 { margin: 0; font-size: 15px; font-weight: 600; }
        .modal-close { background: none; border: none; cursor: pointer; color: #7b8299; padding: 0; line-height: 1; font-size: 18px; }
        .modal-close:hover { color: #1a1d2e; }
        .modal-body { padding: 20px; display: flex; flex-direction: column; gap: 8px; }

        .styled-input {
            display: block; width: 100%; padding: 9px 12px;
            border: 1px solid #e4e7ef; border-radius: 7px; font-size: 13px;
            color: #1a1d2e; outline: none; box-sizing: border-box; background: #fff;
        }
        .styled-input:focus { border-color: #2275fc; box-shadow: 0 0 0 3px rgba(34,117,252,.1); }
        textarea.styled-input { resize: vertical; min-height: 90px; }

        /* file input styling */
        .file-input-wrapper { position: relative; }
        .file-input-wrapper input[type="file"] {
            display: block; width: 100%; padding: 8px 12px;
            border: 1px dashed #c4cadb; border-radius: 7px; font-size: 13px;
            color: #7b8299; background: #f8f9fc; box-sizing: border-box; cursor: pointer;
        }
        .file-input-wrapper input[type="file"]:focus { border-color: #2275fc; outline: none; }

        /* ── Responsive ── */
        @media (max-width: 767px) {
            .desktop-table { display: none !important; }
            .mobile-testimonial-cards { display: block; }
            .stat-card .value { font-size: 18px; }
            .stat-card { padding: 12px 14px; }
            .box-header-count { display: none; }
            .pagination-wrap { flex-direction: column; gap: 8px; align-items: flex-start !important; }
        }
    </style>
@endpush

@section('index_content')
<div class="p-3 main-content-wrap h-screen overflow-y-auto">

    {{-- Stats ── --}}
    @php
        $allT      = \App\Models\Testimonial::query();
        $total     = (clone $allT)->count();
        $active    = (clone $allT)->where('is_active', 1)->count();
        $inactive  = (clone $allT)->where('is_active', 0)->count();
    @endphp
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-4">
            <div class="stat-card">
                <div class="label">Total</div>
                <div class="value" style="color:#2275fc">{{ $total }}</div>
                <div class="sub">All testimonials</div>
            </div>
        </div>
        <div class="col-6 col-md-4">
            <div class="stat-card">
                <div class="label">Active</div>
                <div class="value" style="color:#0d7a4e">{{ $active }}</div>
                <div class="sub">Visible on site</div>
            </div>
        </div>
        <div class="col-6 col-md-4">
            <div class="stat-card">
                <div class="label">Inactive</div>
                <div class="value" style="color:#b45309">{{ $inactive }}</div>
                <div class="sub">Hidden from site</div>
            </div>
        </div>
    </div>

    {{-- Main box --}}
    <div class="wg-box">

        {{-- Box header --}}
        <div class="d-flex align-items-center justify-content-between px-3 py-3 border-bottom">
            <h5 class="mb-0" style="font-size:15px;font-weight:600">Testimonials List</h5>
            <div class="d-flex align-items-center gap-2">
                <button type="button" class="btn btn-primary d-flex align-items-center gap-1"
                    style="border-radius:7px;height:34px;font-size:13px;padding:0 14px;"
                    onclick="$('#addTestimonialModal').addClass('open')">
                    <i class="icon-plus"></i> Add New
                </button>
            </div>
        </div>

        {{-- Search & Filter --}}
        <form method="GET" action="{{ route('testimonials.index') }}">
            <div class="px-3 py-3 search-group" style="background:#f8f9fc;border-bottom:1px solid #e4e7ef">
                <div class="row g-2">
                    <div class="col-12 col-md-5">
                        <input type="text" name="search"
                            placeholder="Search by name…"
                            value="{{ request('search') }}">
                    </div>
                    <div class="col-12 col-md-3">
                        <select name="is_active">
                            <option value="">All Statuses</option>
                            <option value="1" {{ request('is_active') == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ request('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-2">
                        <button type="submit" class="btn btn-primary w-100"
                            style="border-radius:7px;height:38px;font-size:13px">
                            <i class="icon-search me-1"></i> Search
                        </button>
                    </div>
                    <div class="col-6 col-md-2">
                        <a href="{{ route('testimonials.index') }}"
                           class="btn btn-outline-secondary w-100 d-flex align-items-center justify-content-center"
                           style="border-radius:7px;height:38px;font-size:13px;">
                            Reset
                        </a>
                    </div>
                </div>
            </div>
        </form>

        {{-- DESKTOP TABLE --}}
        <div class="desktop-table d-none d-md-block">
            <div class="wg-table table-all-user table-testimonials">
                <ul class="table-title flex gap20 mb-14">
                    <li class="col-photo"><div class="body-title">Photo</div></li>
                    <li class="col-name"><div class="body-title">Name</div></li>
                    <li class="col-desc"><div class="body-title">Description</div></li>
                    <li class="col-status"><div class="body-title">Status</div></li>
                    <li class="col-action text-end"><div class="body-title">Actions</div></li>
                </ul>

                <ul class="flex flex-column">
                    @forelse ($testimonials as $t)
                        <li class="user-item gap20">
                            <div class="col-photo">
                                <div class="image">
                                    <img src="{{ asset($t->image) }}" alt="{{ $t->name }}">
                                </div>
                            </div>
                            <div class="col-name">
                                <div class="name-cell">
                                    <span class="name-text" style="font-weight:500;color:var(--Heading);" title="{{ $t->name }}">{{ $t->name }}</span>
                                </div>
                            </div>
                            <div class="col-desc body-text" title="{{ $t->description }}">
                                {{ Str::limit($t->description, 80) }}
                            </div>
                            <div class="col-status">
                                <span class="badge-{{ $t->is_active ? 'active' : 'inactive' }}">
                                    {{ $t->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                            <div class="col-action">
                                <button class="icon-btn edit" onclick="editTestimonial({{ json_encode($t) }})" title="Edit">
                                    <i class="icon-edit-3"></i>
                                </button>
                            </div>
                        </li>
                    @empty
                        <li class="user-item justify-center py-5">
                            <div class="text-center text-muted w-full">
                                <i class="icon-star" style="font-size:32px;display:block;margin-bottom:8px;opacity:.4"></i>
                                No testimonials found.
                            </div>
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>

        {{-- MOBILE CARDS --}}
        <div class="mobile-testimonial-cards">
            @forelse ($testimonials as $t)
                <div class="mobile-card">
                    <div class="mobile-card-header">
                        <div class="d-flex align-items-center gap-2">
                            <img src="{{ asset($t->image) }}" class="t-avatar" alt="{{ $t->name }}">
                            <div>
                                <div style="font-weight:600;font-size:13px">{{ $t->name }}</div>
                                <span class="badge-{{ $t->is_active ? 'active' : 'inactive' }}" style="margin-top:3px;display:inline-block">
                                    {{ $t->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                        </div>
                        <button class="icon-btn edit" onclick="editTestimonial({{ json_encode($t) }})" title="Edit">
                            <i class="icon-edit-3"></i>
                        </button>
                    </div>
                    <div class="mobile-card-row">
                        <span class="mobile-card-label">Description</span>
                        <span class="mobile-card-value" style="color:#7b8299;max-width:65%">
                            {{ Str::limit($t->description, 80) }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="text-center text-muted py-5">
                    <i class="icon-star" style="font-size:32px;display:block;margin-bottom:8px;opacity:.4"></i>
                    No testimonials found.
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if ($testimonials->hasPages())
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 px-3 py-3 pagination-wrap"
             style="background:#f8f9fc;border-top:1px solid #e4e7ef">
            <span class="text-muted" style="font-size:12px">
                Showing {{ $testimonials->firstItem() }} to {{ $testimonials->lastItem() }} of {{ $testimonials->total() }} results
            </span>
            {{ $testimonials->appends(request()->input())->links('pagination::bootstrap-5') }}
        </div>
        @endif

    </div>
</div>

{{-- ── Add Testimonial Modal ── --}}
<div id="addTestimonialModal" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-header">
            <h4>Add New Testimonial</h4>
            <button class="modal-close" onclick="$('#addTestimonialModal').removeClass('open')">
                <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M18 6 6 18M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <form action="{{ route('testimonials.store') }}" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div>
                    <label style="font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:.05em;color:#7b8299;margin-bottom:4px;display:block">Client Name *</label>
                    <input type="text" name="name" class="styled-input" placeholder="e.g. John Silva" required>
                </div>

                <div>
                    <label style="font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:.05em;color:#7b8299;margin-bottom:4px;display:block">Description *</label>
                    <textarea name="description" class="styled-input" placeholder="What did they say?" required></textarea>
                </div>

                <div>
                    <label style="font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:.05em;color:#7b8299;margin-bottom:4px;display:block">Photo *</label>
                    <div class="mb-3">

    <div class="input-group">
        <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
    </div>
</div>
                </div>

                <button type="submit" class="btn btn-primary mt-1" style="border-radius:7px;height:40px;font-size:13px;width:100%">
                    Save Testimonial
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ── Edit Testimonial Modal ── --}}
<div id="editTestimonialModal" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-header">
            <h4>Edit Testimonial</h4>
            <button class="modal-close" onclick="$('#editTestimonialModal').removeClass('open')">
                <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M18 6 6 18M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <form id="editTestimonialForm" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
                @csrf
                @method('PUT')

                {{-- Live preview --}}
                <div class="d-flex align-items-center gap-3 p-3 mb-1" style="background:#f8f9fc;border-radius:8px;border:1px solid #e4e7ef;">
                    <img id="edit_preview" src="" class="t-avatar" style="width:48px;height:48px;" alt="preview">
                    <div>
                        <div id="edit_preview_name" style="font-weight:600;font-size:13px"></div>
                        <div style="font-size:11px;color:#7b8299;margin-top:2px">Current photo</div>
                    </div>
                </div>

                <div>
                    <label style="font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:.05em;color:#7b8299;margin-bottom:4px;display:block">Client Name *</label>
                    <input type="text" name="name" id="edit_name" class="styled-input" required>
                </div>

                <div>
                    <label style="font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:.05em;color:#7b8299;margin-bottom:4px;display:block">Description *</label>
                    <textarea name="description" id="edit_description" class="styled-input" required></textarea>
                </div>

                <div>
                    <label style="font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:.05em;color:#7b8299;margin-bottom:4px;display:block">Status</label>
                    <select name="is_active" id="edit_is_active" class="styled-input">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>

                <div>
                    <label style="font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:.05em;color:#7b8299;margin-bottom:4px;display:block">Replace Photo</label>
                    <div class="file-input-wrapper">
                        <input type="file" name="image" id="edit_image_input" accept="image/*">
                    </div>
                    <small style="font-size:11px;color:#7b8299;margin-top:4px;display:block">Leave empty to keep current photo.</small>
                </div>

                <button type="submit" class="btn btn-primary mt-1" style="border-radius:7px;height:40px;font-size:13px;width:100%">
                    Update Testimonial
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    /* ── Close modals on overlay click ── */
    document.querySelectorAll('.modal-overlay').forEach(function(overlay) {
        overlay.addEventListener('click', function(e) {
            if (e.target === overlay) overlay.classList.remove('open');
        });
    });

    /* ── Open edit modal ── */
    function editTestimonial(t) {
        $('#editTestimonialForm').attr('action', '/admin/testimonials/update/' + t.id);
        $('#edit_name').val(t.name);
        $('#edit_description').val(t.description);
        $('#edit_is_active').val(t.is_active == 1 ? '1' : '0');

        // Live preview
        const base = '{{ asset('') }}';
        document.getElementById('edit_preview').src = base + t.image;
        document.getElementById('edit_preview_name').textContent = t.name;

        // Reset file input
        document.getElementById('edit_image_input').value = '';

        $('#editTestimonialModal').addClass('open');
    }

    /* ── Preview new image before upload ── */
    document.getElementById('edit_image_input').addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = e => document.getElementById('edit_preview').src = e.target.result;
            reader.readAsDataURL(file);
        }
    });

    /* ── Flash messages ── */
    @if (session('success'))
        Swal.fire({ icon: 'success', title: 'Success!', text: '{{ session('success') }}', timer: 2000, showConfirmButton: false });
    @endif

    @if (session('error') || $errors->any())
        Swal.fire({ icon: 'error', title: 'Oops…', text: '{{ session('error') ?? 'Please check your input data.' }}' });
    @endif
</script>
@endpush