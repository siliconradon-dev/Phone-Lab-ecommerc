@extends('admin.layouts.app')

@section('index_content')
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <div class="main-content-wrap">
        {{-- Breadcrumbs Section (කලින් තිබූ පරිදිම) --}}
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Product Brands</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li><a href="{{ route('admin.dashboard') }}"><div class="text-tiny">Dashboard</div></a></li>
                <li><i class="icon-chevron-right"></i></li>
                <li><div class="text-tiny">Brands</div></li>
            </ul>
        </div>

      @if (session('status'))
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: @json(session('status')),
                confirmButtonColor: '#28a745',
                
            });
        });
    </script>
@endif

        <div class="tf-section-2">
            {{-- වම් පැත්තේ පෝරමය: Add New Brand Form --}}
            <div class="wg-box">
                <div class="body-title mb-10">Add New Brand</div>
                <form action="{{ route('brands.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <fieldset class="name mb-24">
                        <div class="body-title mb-10">Brand Name <span class="tf-color-1">*</span></div>
                        <input type="text" name="name" placeholder="Ex: Apple" value="{{ old('name') }}" required>
                        @error('name') <span class="text-danger text-tiny">{{ $message }}</span> @enderror
                    </fieldset>

                    <fieldset class="category mb-24">
    <div class="body-title mb-10">
        Assign to Categories <span class="tf-color-1">*</span>
    </div>

    <select name="category_id[]" class="form-control category-select" multiple required>
        @foreach ($all_categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>

    @error('category_id')
        <span class="text-danger text-tiny">{{ $message }}</span>
    @enderror
</fieldset>

                   <fieldset class="image mb-24">
    <div class="body-title mb-10">Brand Logo</div>

    <div class="upload-image">

        <div class="item up-load">
            <label class="uploadfile" for="brand_logo">
                <span class="icon"><i class="icon-upload-cloud"></i></span>
                <span class="text-tiny">Click to browse</span>
                <input type="file" id="brand_logo" name="image" accept="image/*">
            </label>
        </div>

        <!--  preview OUTSIDE label -->
        <div class="mt-2">
            <img id="logoPreview"
                 src=""
                 style="display:none; width:120px; height:120px; object-fit:cover; border-radius:8px;">
        </div>

    </div>

    @error('image')
        <span class="text-danger text-tiny">{{ $message }}</span>
    @enderror
</fieldset>

                    <button class="tf-button w-full" type="submit">Add Brand</button>
                </form>
            </div>

            {{-- දකුණු පැත්තේ පෝරමය: Existing Brands Table --}}
        <div class="wg-box">
    <div class="flex items-center justify-between gap10 flex-wrap mb-20">
        <div class="body-title">Existing Brands</div>
        <div class="wg-filter flex-grow">
            <form action="{{ route('brands.index') }}" method="GET" class="form-search flex gap10">
                <fieldset class="name">
                    <input type="text" name="search" placeholder="Search brands..." value="{{ request('search') }}">
                </fieldset>
                <div class="select w200">
                    <select name="category_id" onchange="this.form.submit()">
                        <option value="">All Categories</option>
                        @foreach ($all_categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
            <button class="btn btn-primary d-flex align-items-center justify-content-center" type="submit" style="border-radius: 12px; height: 48px; width: 48px; min-width: 48px; padding: 0;">
                <i class="icon-search" style="font-size: 16px;"></i>
            </button>
            </form>
        </div>
    </div>

    {{-- Brands Table Layout --}}
    <div class="wg-table table-all-user table-brands">
        <ul class="table-title flex gap20 mb-14">
            <li class="col-image"><div class="body-title">Logo</div></li>
            <li class="col-brand"><div class="body-title">Brand</div></li>
            <li class="col-category"><div class="body-title">Category</div></li>
            <li class="col-action text-end"><div class="body-title">Action</div></li>
        </ul>

        <ul class="flex flex-column">
            @forelse ($brands as $brand)
                <li class="user-item gap20">
                    <div class="image col-image">
                        @if ($brand->image)
                            <img src="{{ asset($brand->image) }}" alt="{{ $brand->name }}">
                        @else
                            <img src="{{ asset('assets/images/placeholder/category-placeholder.png') }}" alt="Default">
                        @endif
                    </div>
                    <div class="col-brand name">
                        <a href="#" class="body-title-2">{{ $brand->name }}</a>
                    </div>
                    <div class="col-category body-text">
                        <div class="d-flex flex-wrap gap-1">
                            @forelse ($brand->categories as $cat)
                                <span class="text-uppercase text-dark small text-secondary">
                                    {{ $cat->name }}@if(!$loop->last),@endif
                                </span>
                            @empty
                                <span class="text-muted small">—</span>
                            @endforelse
                        </div>
                    </div>
                    <div class="col-action list-icon-function justify-content-end">
                        <button type="button" class="item edit edit-brand" data-id="{{ $brand->id }}" title="Edit Brand" style="border: none; background: transparent; cursor: pointer;">
                            <i class="icon-edit-3"></i>
                        </button>
                    </div>
                </li>
            @empty
                <li class="user-item gap20 justify-center">
                    <div class="body-text w-full text-center py-4">No brands found.</div>
                </li>
            @endforelse
        </ul>
    </div>

    <div class="divider"></div>
    <div class="flex items-center justify-between flex-wrap gap10">
        <div class="text-tiny text-muted">Showing {{ $brands->firstItem() }} to {{ $brands->lastItem() }} of {{ $brands->total() }} entries</div>
        <div class="wg-pagination">{{ $brands->links('pagination::bootstrap-5') }}</div>
    </div>
</div>
        </div>
    </div>

    <div class="modal fade z" id="editBrandModal" tabindex="-1" aria-labelledby="editBrandModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content wg-box " style="border: none;">
                <div class="modal-header border-0 pb-0">
                    <div class="body-title">Edit Brand</div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editBrandForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <fieldset class="name mb-24">
                            <div class="body-title mb-10">Brand Name <span class="tf-color-1">*</span></div>
                            <input type="text" name="name" id="edit_brand_name" required>
                        </fieldset>

                        <fieldset class="category mb-24">
                            <div class="body-title mb-10">Assign to Categories <span class="tf-color-1">*</span></div>
                            <div class="select edit-select-box">
                                <select name="category_id[]" id="edit_brand_categories" multiple class="select2-multiple-edit w-full" required>
                                    @foreach ($all_categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </fieldset>

                        <fieldset class="mb-4">
    <label class="form-label fw-semibold">
        Brand Logo 
        <span class="text-muted fw-normal">(Leave blank to keep current)</span>
    </label>

    <div class="d-flex align-items-center gap-3 p-3 border rounded bg-light">

        <!-- Current Preview -->
        <div class="flex-shrink-0">
            <img 
                id="edit-brand-preview" 
                src="" 
                class="rounded border bg-white"
                style="width: 60px; height: 60px; object-fit: contain;"
            >
        </div>

        <!-- File Input -->
        <div class="flex-grow-1">
            <input 
                type="file" 
                name="image" 
                id="edit_brand_image" 
                accept="image/*"
                class="form-control"
            >
            <div class="form-text">
                Upload a new logo to replace current one
            </div>
        </div>

    </div>
</fieldset>

                        <button class="tf-button w-full" type="submit">Update Brand</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        /* ===== Table styling ===== */
        .table-brands.table-all-user>* {
            min-width: auto !important;
        }

        .table-brands .table-title,
        .table-brands .user-item {
            display: flex;
            align-items: center;
            width: 100%;
        }

        .table-brands .col-image {
            flex: 0 0 60px;
            width: 60px;
        }

        .table-brands .col-brand {
            flex: 1 1 200px;
        }

        .table-brands .col-category {
            flex: 2 1 300px;
            color: var(--Heading) !important;
        }

        .table-brands .col-action {
            flex: 0 0 100px;
            width: 100px;
            display: flex;
            justify-content: flex-end;
        }

        .table-brands .user-item .image {
            height: 50px;
            width: 50px;
            border-radius: 6px;
            overflow: hidden;
            background: #f8f9fc;
            border: 1px solid #eceef2;
        }
        .table-brands .user-item .image img {
            width: 100%; height: 100%; object-fit: contain;
        }

        .table-brands .list-icon-function {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .table-brands .list-icon-function .item {
            cursor: pointer;
            border: none;
            background: transparent;
        }

        .object-fit-cover { object-fit: cover; }
        .select { height: auto !important; }
        .select2-container--default .select2-selection--multiple { height: auto !important; min-height: 50px !important; padding: 5px 10px !important; display: flex !important; align-items: center !important; flex-wrap: wrap !important; }
        .select2-container--default .select2-selection--multiple .select2-selection__choice { margin: 4px 5px !important; padding: 2px 10px !important; display: flex !important; align-items: center !important; }
        .select2-search.select2-search--inline { display: contents !important; }
        .select2-container--default .select2-search--inline .select2-search__field { margin: 0 !important; height: 38px !important; }

        /* Modal එක ඇතුළේ ඇති select2 dropdown එක ඉහළින් පෙන්වීමට */
        .select2-container { z-index: 99999 !important; }

        .swal2-container {
    z-index: 99999 !important;
}
.z{
     z-index: 99999 !important;
}


        
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Add form එකේ Select2 එක
            $('.select2-multiple').select2({
                placeholder: "Select Categories",
                allowClear: true,
                width: '100%'
            });

            // Edit Button එක ක්ලික් කර දත්ත Modal එකට ගැනීම
            $('.edit-brand').on('click', function() {
                let brandId = $(this).data('id');
                let editUrl = "{{ route('brands.edit', ':id') }}".replace(':id', brandId);
                let updateUrl = "{{ route('brands.update', ':id') }}".replace(':id', brandId);

                $('#editBrandForm').attr('action', updateUrl);

                $.ajax({
                    url: editUrl,
                    type: 'GET',
                    success: function(response) {
                        $('#edit_brand_name').val(response.brand.name);

                        // ඩීටාබේස් එකෙන් ආපු Category IDs ටික Select2 එකේ තේරී පවතින ලෙස (Select) සකස් කිරීම
                        // පළමුව පැරණි ඒවා ක්ලීන් කර අලුත් ඒවා සින්ක් කරයි
                        $('.select2-multiple-edit').val(response.category_ids).trigger('change');

                        // Logo Preview
                        if(response.brand.image) {
                            $('#edit-brand-preview').attr('src', "{{ asset('') }}" + response.brand.image).show();
                        } else {
                            $('#edit-brand-preview').attr('src', "{{ asset('assets/images/placeholder/category-placeholder.png') }}").show();
                        }

                        $('#editBrandModal').modal('show');
                    }
                });
            });

            // Modal එක ඇතුළේ ඇති Select2 එක Initializing කිරීම (Modal එක පෙන්වූ පසු)
            $('#editBrandModal').on('shown.bs.modal', function () {
                $('.select2-multiple-edit').select2({
                    placeholder: "Select Categories",
                    allowClear: true,
                    dropdownParent: $('#editBrandModal'), 
                    width: '100%'
                });
            });




            
            // File Change Preview
           document.getElementById('brand_logo').addEventListener('change', function (e) {
    const file = e.target.files[0];

    if (file) {
        const reader = new FileReader();

        reader.onload = function (event) {
            const img = document.getElementById('logoPreview');
            img.src = event.target.result;
            img.style.display = 'block';
        };

        reader.readAsDataURL(file);
    }
});
        });
    </script>

    <!-- jQuery (required) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function () {
        $('.category-select').select2({
            placeholder: "Select categories",
            allowClear: true,
            width: '100%'
        });
    });
</script>
@endpush
