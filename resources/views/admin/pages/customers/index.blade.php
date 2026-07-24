@extends('admin.layouts.app')

@push('title')
    <title>Customer List</title>
@endpush

@push('styles')
    <link rel="stylesheet" href="{{ asset('admin_assets/css/pos.css') }}">
    <style>
        /* ── Stat cards ── */
        .stat-card { border-radius: 10px; border: 1px solid #e4e7ef; padding: 16px 18px; background: #fff; }
        .stat-card .label { font-size: 11px; text-transform: uppercase; letter-spacing: .06em; color: #7b8299; margin-bottom: 4px; }
        .stat-card .value { font-size: 20px; font-weight: 700; }
        .stat-card .sub   { font-size: 12px; color: #7b8299; margin-top: 2px; }

        /* ── Avatar ── */
        .customer-avatar {
            width: 32px; height: 32px; border-radius: 50%;
            background: #e8f0fe; color: #2275fc;
            font-size: 11px; font-weight: 700;
            display: inline-flex; align-items: center; justify-content: center; flex-shrink: 0;
        }

        /* ── Status badges ── */
        .badge-active   { background: #e6f9f0; color: #0d7a4e; border-radius: 20px; padding: 3px 10px; font-size: 11px; font-weight: 600; white-space: nowrap; }
        .badge-inactive { background: #fce8e8; color: #c0392b; border-radius: 20px; padding: 3px 10px; font-size: 11px; font-weight: 600; white-space: nowrap; }

        /* ── Icon buttons ── */
        .icon-btn {
            width: 32px; height: 32px; border-radius: 7px;
            display: inline-flex; align-items: center; justify-content: center;
            border: 1px solid #e4e7ef; background: #fff; color: #7b8299; text-decoration: none; cursor: pointer;
        }
        .icon-btn.edit:hover  { background: #e8f0fe; border-color: #2275fc; color: #2275fc; }

        /* ── Wrapper box ── */
        .wg-box { border-radius: 12px; border: 1px solid #e4e7ef; background: #fff; overflow: hidden; }

        /* ── Desktop table ── */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        .table-responsive::-webkit-scrollbar {
            height: 6px;
        }
        .table-responsive::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }
        .table-responsive::-webkit-scrollbar-thumb {
            background: #c4cadb;
            border-radius: 4px;
        }
        .table-responsive::-webkit-scrollbar-thumb:hover {
            background: #a6b0cf;
        }
        .table-customers.table-all-user {
            min-width: 1100px;
        }
        .table-customers.table-all-user>* {
            min-width: 1100px !important;
        }
        .table-customers .table-title,
        .table-customers .user-item {
            display: flex;
            align-items: center;
            width: 100%;
            padding-left: 20px;
            padding-right: 20px;
        }
        .table-customers .table-title {
            background: #f8f9fc;
            border-bottom: 1px solid #e4e7ef;
            padding-top: 12px;
            padding-bottom: 12px;
            margin-bottom: 0 !important;
            position: sticky;
            top: 0;
            z-index: 2;
        }
        .table-customers .user-item {
            padding-top: 13px;
            padding-bottom: 13px;
            border-bottom: 1px solid #e4e7ef;
            transition: background-color 0.15s ease;
        }
        .table-customers .user-item:last-child {
            border-bottom: none;
        }
        .table-customers .user-item:hover {
            background-color: #f6f8ff;
        }

        /* ── Fixed-height body scroll: shows ~5 rows, rest scroll ── */
        .table-body-scroll {
            max-height: 265px; /* ~5 rows at current row height, tweak if row height changes */
            overflow-y: auto;
        }
        .table-body-scroll::-webkit-scrollbar {
            width: 6px;
        }
        .table-body-scroll::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }
        .table-body-scroll::-webkit-scrollbar-thumb {
            background: #c4cadb;
            border-radius: 4px;
        }
        .table-body-scroll::-webkit-scrollbar-thumb:hover {
            background: #a6b0cf;
        }

        /* Column flex settings */
        .table-customers .col-no {
            flex: 0 0 50px;
            width: 50px;
        }
        .table-customers .col-name {
            flex: 2 1 200px;
        }
        .table-customers .col-mobile {
            flex: 1 1 120px;
        }
        .table-customers .col-email {
            flex: 1.5 1 180px;
        }
        .table-customers .col-nic {
            flex: 1 1 120px;
        }
        .table-customers .col-status {
            flex: 0 0 100px;
            width: 100px;
        }
        .table-customers .col-joined {
            flex: 1 1 120px;
        }
        .table-customers .col-action {
            flex: 0 0 80px;
            width: 80px;
            display: flex;
            justify-content: flex-end;
        }

        /* Name cell keeps avatar + text in one line */
        .table-customers .name-cell {
            display: flex; align-items: center; gap: 8px;
            overflow: hidden;
        }
        .table-customers .name-cell span.name-text {
            overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
        }

        /* Mobile card value — break long strings safely */
        .mobile-card-value { word-break: break-word; }

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
        .mobile-customer-cards { display: none; }
        .mobile-card { background: #fff; border-bottom: 1px solid #e4e7ef; padding: 14px 16px; }
        .mobile-card:last-child { border-bottom: none; }
        .mobile-card-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px; }
        .mobile-card-row    { display: flex; align-items: center; justify-content: space-between; margin-bottom: 6px; }
        .mobile-card-label  { font-size: 11px; text-transform: uppercase; letter-spacing: .05em; color: #7b8299; font-weight: 600; }
        .mobile-card-value  { font-size: 13px; font-weight: 500; color: #1a1d2e; }
        .mobile-card-footer { display: flex; align-items: center; justify-content: space-between; margin-top: 10px; padding-top: 10px; border-top: 1px solid #f0f1f5; }

        /* ── Mobile cards fixed-height scroll: shows ~5 cards, rest scroll ── */
        .mobile-cards-scroll {
            max-height: 400px; /* ~5 cards, tweak if card height changes */
            overflow-y: auto;
        }
        .mobile-cards-scroll::-webkit-scrollbar {
            width: 6px;
        }
        .mobile-cards-scroll::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }
        .mobile-cards-scroll::-webkit-scrollbar-thumb {
            background: #c4cadb;
            border-radius: 4px;
        }
        .mobile-cards-scroll::-webkit-scrollbar-thumb:hover {
            background: #a6b0cf;
        }

        /* ── Modal ── */
        .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.45); z-index: 9999; align-items: center; justify-content: center; }
        .modal-overlay.open { display: flex; }
        .modal-box { background: #fff; border-radius: 12px; width: 100%; max-width: 460px; margin: 16px; box-shadow: 0 8px 32px rgba(0,0,0,.18); }
        .modal-header { display: flex; align-items: center; justify-content: space-between; padding: 16px 20px; border-bottom: 1px solid #e4e7ef; }
        .modal-header h4 { margin: 0; font-size: 15px; font-weight: 600; }
        .modal-close { background: none; border: none; cursor: pointer; color: #7b8299; padding: 0; }
        .modal-close:hover { color: #1a1d2e; }
        .styled-input {
            display: block; width: 100%; padding: 9px 12px;
            border: 1px solid #e4e7ef; border-radius: 7px; font-size: 13px;
            color: #1a1d2e; outline: none; box-sizing: border-box;
        }
        .styled-input:focus { border-color: #2275fc; box-shadow: 0 0 0 3px rgba(34,117,252,.1); }
        textarea.styled-input { resize: vertical; min-height: 72px; }

        /* ── Responsive ── */
        @media (max-width: 767px) {
            .desktop-table { display: none !important; }
            .mobile-customer-cards { display: block; }
            .stat-card .value { font-size: 18px; }
            .stat-card { padding: 12px 14px; }
            .box-header-count { display: none; }
            .pagination-wrap { flex-direction: column; gap: 8px; align-items: flex-start !important; }
        }
    </style>
@endpush

@section('index_content')
<div class="p-3 main-content-wrap overflow-auto">


    {{-- Stats --}}
    @php
        $allC       = \App\Models\Customer::query();
        $totalCount = (clone $allC)->count();
        $activeCount = (clone $allC)->where('status', 'active')->count();
        $inactiveCount = (clone $allC)->where('status', 'inactive')->count();
        $newThisMonth = (clone $allC)->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count();
    @endphp
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="label">Total Customers</div>
                <div class="value" style="color:#2275fc">{{ $totalCount }}</div>
                <div class="sub">All time</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="label">Active</div>
                <div class="value" style="color:#0d7a4e">{{ $activeCount }}</div>
                <div class="sub">Currently active</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="label">Inactive</div>
                <div class="value" style="color:#c0392b">{{ $inactiveCount }}</div>
                <div class="sub">Needs attention</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="label">New This Month</div>
                <div class="value" style="color:#b45309">{{ $newThisMonth }}</div>
                <div class="sub">{{ now()->format('F Y') }}</div>
            </div>
        </div>
    </div>

    {{-- Main box --}}
    <div class="wg-box">

        {{-- Box header --}}
        <div class="d-flex align-items-center justify-content-between px-3 py-3 border-bottom">
            <h5 class="mb-0" style="font-size:15px;font-weight:600">Customers</h5>
            <div class="d-flex align-items-center gap-2">

                <button type="button" class="btn btn-primary d-flex align-items-center gap-1"
                    style="border-radius:7px;height:34px;font-size:13px;padding:0 14px;"
                    onclick="$('#addCustomerModal').addClass('open')">
                    <i class="icon-plus"></i> Add New
                </button>
            </div>
        </div>

        {{-- Search & Filter --}}
        <form method="GET" action="{{ route('customers.index') }}">
            <div class="px-3 py-3 search-group" style="background:#f8f9fc;border-bottom:1px solid #e4e7ef">
                <div class="row g-2">
                    <div class="col-12 col-md-7">
                        <input type="text" name="search"
                            placeholder="Search by name, mobile, or email…"
                            value="{{ request('search') }}">
                    </div>
                    <div class="col-6 col-md-3">
                        <button type="submit" class="btn btn-primary w-100"
                            style="border-radius:7px;height:38px;font-size:13px">
                            <i class="icon-search me-1"></i> Search
                        </button>
                    </div>
                    <div class="col-6 col-md-2">
                        <a href="{{ route('customers.index') }}"
                           class="btn btn-outline-secondary w-100 d-flex align-items-center justify-content-center"
                           style="border-radius:7px;height:38px;font-size:13px;">
                            Reset
                        </a>
                    </div>
                </div>
            </div>
        </form>

        {{-- DESKTOP TABLE --}}
        <div class="desktop-table d-none d-md-block overflow-auto">
            <div class="table-responsive">
                <div class="wg-table table-all-user table-customers">
                    <ul class="table-title flex gap20 mb-14">
                        <li class="col-no"><div class="body-title">#</div></li>
                        <li class="col-name"><div class="body-title">Name</div></li>
                        <li class="col-mobile"><div class="body-title">Mobile</div></li>
                        <li class="col-email"><div class="body-title">Email</div></li>
                        <li class="col-nic"><div class="body-title">NIC</div></li>
                        <li class="col-status"><div class="body-title">Status</div></li>
                        <li class="col-joined"><div class="body-title">Joined</div></li>
                        <li class="col-action text-end"><div class="body-title">Actions</div></li>
                    </ul>

                    {{-- Scrollable body: shows ~5 rows, scrolls for the rest --}}
                    <div class="table-body-scroll">
                        <ul class="flex flex-column">
                            @forelse ($customers as $index => $customer)
                                @php
                                    $words    = array_filter(explode(' ', $customer->name));
                                    $initials = strtoupper(implode('', array_map(fn($w) => $w[0], array_slice($words, 0, 2))));
                                    $status   = strtolower($customer->status ?? 'active');
                                @endphp
                                <li class="user-item gap20">
                                    <div class="col-no body-text" style="color:#7b8299">{{ $customers->firstItem() + $index }}</div>
                                    <div class="col-name">
                                        <div class="name-cell">
                                            <span class="customer-avatar">{{ $initials }}</span>
                                            <span class="name-text" style="font-weight:500;color:var(--Heading);" title="{{ $customer->name }}">{{ $customer->name }}</span>
                                        </div>
                                    </div>
                                    <div class="col-mobile body-text" title="{{ $customer->mobile }}">{{ $customer->mobile }}</div>
                                    <div class="col-email body-text" style="color:#7b8299" title="{{ $customer->email ?? 'N/A' }}">{{ $customer->email ?? 'N/A' }}</div>
                                    <div class="col-nic body-text" style="color:#7b8299" title="{{ $customer->nic ?? 'N/A' }}">{{ $customer->nic ?? 'N/A' }}</div>
                                    <div class="col-status">
                                        <span class="badge-{{ $status }}">{{ ucfirst($status) }}</span>
                                    </div>
                                    <div class="col-joined body-text" style="color:#7b8299">{{ $customer->created_at->format('M d, Y') }}</div>
                                    <div class="col-action">
                                        <button class="icon-btn edit" onclick="openEditModal({{ json_encode($customer) }})" title="Edit Customer">
                                            <i class="icon-edit-3"></i>
                                        </button>
                                    </div>
                                </li>
                            @empty
                                <li class="user-item justify-center py-5">
                                    <div class="text-center text-muted w-full">
                                        <i class="icon-users" style="font-size:32px;display:block;margin-bottom:8px;opacity:.4"></i>
                                        No customers found.
                                    </div>
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        {{-- MOBILE CARDS --}}
        <div class="mobile-customer-cards mobile-cards-scroll">
            @forelse ($customers as $index => $customer)
                @php
                    $words    = array_filter(explode(' ', $customer->name));
                    $initials = strtoupper(implode('', array_map(fn($w) => $w[0], array_slice($words, 0, 2))));
                    $status   = strtolower($customer->status ?? 'active');
                @endphp
                <div class="mobile-card">
                    <div class="mobile-card-header">
                        <div class="d-flex align-items-center gap-2">
                            <span class="customer-avatar">{{ $initials }}</span>
                            <div>
                                <div style="font-weight:600;font-size:13px">{{ $customer->name }}</div>
                                <div style="font-size:12px;color:#7b8299">{{ $customer->mobile }}</div>
                            </div>
                        </div>
                        <button class="icon-btn edit" onclick="openEditModal({{ json_encode($customer) }})" title="Edit">
                            <i class="icon-edit-3"></i>
                        </button>
                    </div>

                    <div class="mobile-card-row">
                        <span class="mobile-card-label">Email</span>
                        <span class="mobile-card-value" style="color:#7b8299">{{ $customer->email ?? 'N/A' }}</span>
                    </div>
                    <div class="mobile-card-row">
                        <span class="mobile-card-label">NIC</span>
                        <span class="mobile-card-value" style="color:#7b8299">{{ Str::limit($customer->nic ?? 'N/A', 12) }}</span>
                    </div>
                    <div class="mobile-card-row">
                        <span class="mobile-card-label">Joined</span>
                        <span class="mobile-card-value" style="color:#7b8299">{{ $customer->created_at->format('M d, Y') }}</span>
                    </div>

                    <div class="mobile-card-footer">
                        <span class="badge-{{ $status }}">{{ ucfirst($status) }}</span>
                    </div>
                </div>
            @empty
                <div class="text-center text-muted py-5">
                    <i class="icon-users" style="font-size:32px;display:block;margin-bottom:8px;opacity:.4"></i>
                    No customers found.
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 px-3 py-3 pagination-wrap"
             style="background:#f8f9fc;border-top:1px solid #e4e7ef">
            <span class="text-muted" style="font-size:12px">
                Showing {{ $customers->firstItem() }} to {{ $customers->lastItem() }} of {{ $customers->total() }} results
            </span>
            {{ $customers->appends(request()->input())->links('pagination::bootstrap-5') }}
        </div>

    </div>
</div>

{{-- ── Add Customer Modal ── --}}
<div id="addCustomerModal" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-header">
            <h4>Add New Customer</h4>
            <button class="modal-close" onclick="$('#addCustomerModal').removeClass('open')">
                <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M18 6 6 18M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <div style="padding: 20px; display:flex; flex-direction:column; gap:6px;">
            <input type="text" id="new_cust_name" class="styled-input" placeholder="Customer Name *" required>
            <span id="err_name" style="color:red;font-size:11px;"></span>

            <input type="text" id="new_cust_mobile" class="styled-input" placeholder="Mobile Number *"
                inputmode="numeric" pattern="[0-9]{10,15}" minlength="10" maxlength="15" required>
            <span id="err_mobile" style="color:red;font-size:11px;"></span>

            <input type="text" id="new_cust_nic" class="styled-input" maxlength="12" placeholder="NIC (Optional)">
            <span id="err_nic" style="color:red;font-size:11px;"></span>

            <input type="email" id="new_cust_email" class="styled-input" placeholder="Email (Optional)">
            <span id="err_email" style="color:red;font-size:11px;"></span>

            <textarea id="new_cust_address" class="styled-input" placeholder="Address (Optional)"></textarea>
            <span id="err_address" style="color:red;font-size:11px;"></span>

            <button class="btn btn-primary mt-2" style="border-radius:7px;height:40px;font-size:13px;" onclick="saveCustomer()">
                Save Customer
            </button>
        </div>
    </div>
</div>

{{-- ── Edit Customer Modal ── --}}
<div id="editCustomerModal" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-header">
            <h4>Edit Customer</h4>
            <button class="modal-close" onclick="$('#editCustomerModal').removeClass('open')">
                <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M18 6 6 18M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <div style="padding: 20px; display:flex; flex-direction:column; gap:6px;">
            <input type="hidden" id="edit_cust_id">
            <input type="text" id="edit_cust_name" class="styled-input" placeholder="Customer Name *">
            <input type="text" id="edit_cust_mobile" class="styled-input" inputmode="numeric"
                pattern="[0-9]{10,15}" minlength="10" maxlength="15" placeholder="Mobile Number *">
            <input type="text" id="edit_cust_nic" class="styled-input" maxlength="12" placeholder="NIC (Optional)">
            <input type="email" id="edit_cust_email" class="styled-input" placeholder="Email (Optional)">
            <select id="edit_cust_status" class="styled-input">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
            <textarea id="edit_cust_address" class="styled-input" placeholder="Address (Optional)"></textarea>
            <button class="btn btn-primary mt-2" style="border-radius:7px;height:40px;font-size:13px;" onclick="updateCustomer()">
                Update Customer
            </button>
        </div>
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

    /* ── Save new customer ── */
    function saveCustomer() {
        document.querySelectorAll('.modal-box span[id^="err_"]').forEach(s => s.textContent = '');

        const formData = {
            name:    $('#new_cust_name').val(),
            mobile:  $('#new_cust_mobile').val(),
            nic:     $('#new_cust_nic').val(),
            email:   $('#new_cust_email').val(),
            address: $('#new_cust_address').val(),
            _token:  '{{ csrf_token() }}'
        };

        $.post('/admin/customers/create', formData)
            .done(function(res) {
                if (res.success) {
                    $('#new_cust_name, #new_cust_mobile, #new_cust_nic, #new_cust_email, #new_cust_address').val('');
                    $('#addCustomerModal').removeClass('open');
                    Swal.fire('Success', 'Customer added!', 'success').then(() => location.reload());
                }
            })
            .fail(function(xhr) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        $('#err_' + key).text(value[0]);
                    });
                } else {
                    Swal.fire('Error', 'Something went wrong.', 'error');
                }
            });
    }

    /* ── Open edit modal ── */
    function openEditModal(customer) {
        $('#edit_cust_id').val(customer.id);
        $('#edit_cust_name').val(customer.name);
        $('#edit_cust_mobile').val(customer.mobile);
        $('#edit_cust_nic').val(customer.nic);
        $('#edit_cust_email').val(customer.email);
        $('#edit_cust_address').val(customer.address);
        $('#edit_cust_status').val(customer.status ?? 'active');
        $('#editCustomerModal').addClass('open');
    }

    /* ── Update customer ── */
    function updateCustomer() {
        const id = $('#edit_cust_id').val();
        const formData = {
            name:    $('#edit_cust_name').val(),
            mobile:  $('#edit_cust_mobile').val(),
            nic:     $('#edit_cust_nic').val(),
            email:   $('#edit_cust_email').val(),
            address: $('#edit_cust_address').val(),
            status:  $('#edit_cust_status').val(),
            _token:  '{{ csrf_token() }}',
            _method: 'PUT'
        };

        $.post('/admin/customers/update/' + id, formData)
            .done(function(res) {
                if (res.success) {
                    $('#editCustomerModal').removeClass('open');
                    Swal.fire('Success', 'Customer updated!', 'success').then(() => location.reload());
                }
            })
            .fail(function() {
                Swal.fire('Error', 'Update failed.', 'error');
            });
    }

    /* ── Email validation (add modal) ── */
    document.getElementById('new_cust_email').addEventListener('input', function() {
        const val     = this.value.trim();
        const pattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9-]+\.[a-zA-Z]{2,}$/;
        document.getElementById('err_email').textContent =
            val.length && !pattern.test(val) ? 'Invalid email format' : '';
    });
</script>
@endpush