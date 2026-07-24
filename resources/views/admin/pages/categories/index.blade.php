@extends('admin.layouts.app')

@section('index_content')
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Product Categories</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li><a href="{{ route('admin.dashboard') }}">
                        <div class="text-tiny">Dashboard</div>
                    </a></li>
                <li><i class="icon-chevron-right"></i></li>
                <li>
                    <div class="text-tiny">Categories</div>
                </li>
            </ul>
        </div>

        <div class="categories-layout">

            {{-- LEFT: Add New Category (sticky sidebar on desktop) --}}
            <div class="categories-form-col">
                <div class="wg-box category-form-box">
                    <div class="body-title mb-10">Add New Category</div>

                    @if (session('status'))
                        <div class="alert alert-success py-2 px-3 mb-16">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <fieldset class="name mb-24">
                            <div class="body-title mb-10">Category Name <span class="tf-color-1">*</span></div>
                            <input type="text" name="name" placeholder="Ex: Mobile Phones" value="{{ old('name') }}"
                                required>
                            @error('name')
                                <span class="text-danger text-tiny">{{ $message }}</span>
                            @enderror
                        </fieldset>

                        <fieldset class="image mb-24">
                            <div class="body-title mb-10">Category Image</div>
                            <div class="upload-image">
                                <div class="item up-load d-flex justify-content-center align-items-center" id="addUploadBox">
    <label class="uploadfile d-flex flex-column justify-content-center align-items-center text-center"
        for="cat_image">
        <span class="icon mb-2">
            <i class="icon-upload-cloud"></i>
        </span>
        <span class="text-tiny">Click to browse</span>
        <span class="text-tiny d-block mt-1" style="opacity:.6;">
            PNG, JPG up to 2MB
        </span>
        <input type="file" id="cat_image" name="image" accept="image/*">
    </label>
</div>
                            </div>
                            <div id="addImagePreviewWrap" class="d-none align-items-center gap-2 mt-10">
                                <img id="addImagePreview" class="m-3" src="" style=" width:42px;height:42px;border-radius:8px;object-fit:cover;border:1px solid #eef0f2;">
                                <span class="text-tiny text-muted text-truncate d-inline-block" 
      style="max-width: 200px;" 
      id="addImageFileName">
</span>
                            </div>
                            @error('image')
                                <span class="text-danger text-tiny">{{ $message }}</span>
                            @enderror
                        </fieldset>

                        <button class="tf-button w-full mb-4" type="submit">
                            <i class="icon-plus me-1"></i> Add Category
                        </button>
                      <button type="button" class=" button btn-danger w-full mt-10" id="clearCategoryForm">
    <i class="icon-refresh me-1"></i> Clear
</button>
                    </form>
                </div>
            </div>

            {{-- RIGHT: Existing Categories --}}
            <div class="categories-table-col">
                <div class="wg-box">
                    <div class="categories-table-header mb-20">
                        <div class="body-title mb-0">Existing Categories</div>

                        <div class="search-wrap">
                            <i class="icon-search search-icon"></i>
                            <input
                                class="form-control search-input"
                                type="text"
                                id="searchInput"
                                placeholder="Search categories..."
                                name="search"
                            >
                            <span class="search-spinner d-none" id="searchSpinner"></span>
                        </div>
                    </div>

                    {{-- Table on tablet/desktop --}}
                    <div class="categories-table-wrap">
                        <div class="wg-table table-all-user table-categories">
                            <ul class="table-title flex gap20 mb-14">
                                <li class="col-image"><div class="body-title">Image</div></li>
                                <li class="col-name"><div class="body-title">Category Name</div></li>
                                <li class="col-action text-end"><div class="body-title">Action</div></li>
                            </ul>

                            <ul class="flex flex-column" id="categoryTable">
                                @include('admin.components.table', ['categories' => $categories])
                            </ul>
                        </div>
                    </div>

                    <div class="divider"></div>
                    <div class="flex items-center justify-between flex-wrap gap10 pagination-bar">
                        <div class="text-tiny text-muted">
                            Showing {{ $categories->firstItem() ?? 0 }} to {{ $categories->lastItem() ?? 0 }} of
                            {{ $categories->total() }} entries
                        </div>
                        <div class="wg-pagination">
                            {{ $categories->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Edit Category Modal --}}
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content wg-box" style="border: none;">
                <div class="modal-header border-0 pb-0">
                    <div class="body-title">Edit Category</div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editCategoryForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="alert alert-danger d-none" id="modal-error"></div>

                        <fieldset class="name mb-24">
                            <div class="body-title mb-10">Category Name <span class="tf-color-1">*</span></div>
                            <input type="text" name="name" id="edit_name" required>
                        </fieldset>

                        <fieldset class="image mb-24">
                            <div class="body-title mb-10">Category Image (Leave blank to keep current)</div>
                            <div class="d-flex align-items-center gap-3 mb-10">
                                <img id="edit-img-preview" src=""
                                    style="width:50px;height:50px;border-radius:8px;object-fit:cover;background:#f5f5f5;border:1px solid #eef0f2;">
                                <label class="uploadfile-sm" for="edit_image">
                                    <i class="icon-upload-cloud"></i>
                                    <span class="text-tiny">Change image</span>
                                </label>
                                <input type="file" name="image" id="edit_image" accept="image/*" class="d-none">
                            </div>
                        </fieldset>

                        <div class="d-flex gap-2">
                            <button type="button" class="tf-button-secondary w-50" data-bs-dismiss="modal">Cancel</button>
                            <button class="tf-button w-50" type="submit" id="editSubmitBtn">
                                <span class="btn-label">Update Category</span>
                                <span class="spinner-border spinner-border-sm d-none" id="editSpinner"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        /* ===== Layout: form + table ===== */
        .categories-layout {
            display: grid;
            grid-template-columns: 340px 1fr;
            gap: 24px;
            align-items: start;
        }

        .categories-form-col {
            position: sticky;
            top: 20px;
        }

        .category-form-box {
            margin-top: 0;
        }

        @media (max-width: 991px) {
            .categories-layout {
                grid-template-columns: 1fr;
            }
            .categories-form-col {
                position: static;
            }
        }

        /* ===== Table header / search ===== */
        .categories-table-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }

        .search-wrap {
            position: relative;
            width: 260px;
            max-width: 100%;
        }

        .search-input {
            padding: 8px 14px 8px 36px;
            border-radius: 8px;
            font-size: 14px;
            box-shadow: none;
            border: 1px solid #e3e6ea;
        }

        .search-input:focus {
            border-color: #c9cdd3;
            box-shadow: 0 0 0 3px rgba(0,0,0,0.04);
        }

        .search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 14px;
            opacity: .5;
            pointer-events: none;
        }

        .search-spinner {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            width: 14px;
            height: 14px;
            border: 2px solid #ddd;
            border-top-color: #888;
            border-radius: 50%;
            animation: spin .6s linear infinite;
        }

        @keyframes spin { to { transform: translateY(-50%) rotate(360deg); } }

        @media (max-width: 575px) {
            .search-wrap { width: 100%; }
            .categories-table-header { flex-direction: column; align-items: stretch; }
        }

        /* ===== Table styling ===== */
        .table-categories.table-all-user>* {
            min-width: auto !important;
        }

        .table-categories .table-title,
        .table-categories .user-item {
            display: flex;
            align-items: center;
            width: 100%;
        }

        .table-categories .col-image {
            flex: 0 0 60px;
            width: 60px;
        }

        .table-categories .col-name {
            flex: 1 1 auto;
        }

        .table-categories .col-action {
            flex: 0 0 100px;
            width: 100px;
            display: flex;
            justify-content: flex-end;
        }

        .table-categories .user-item .image {
            height: 50px;
            width: 50px;
            border-radius: 6px;
            overflow: hidden;
            background: #f8f9fc;
            border: 1px solid #eceef2;
        }
        .table-categories .user-item .image img {
            width: 100%; height: 100%; object-fit: contain;
        }

        .table-categories .list-icon-function {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .table-categories .list-icon-function .item {
            cursor: pointer;
            border: none;
            background: transparent;
        }

        .object-fit-cover {
            object-fit: cover;
        }

        .pagination-bar {
            font-size: 13px;
        }

         

        /* ===== Upload box ===== */
        .upload-image .uploadfile {
            cursor: pointer;
            display: block;
            text-align: center;
            border: 1.5px dashed #d8dce1;
            border-radius: 10px;
            padding: 18px 10px;
            transition: border-color .15s, background-color .15s;
        }

        .upload-image .uploadfile:hover {
            border-color: #adb3bb;
            background-color: #fafbfc;
        }

        .uploadfile-sm {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: 1px dashed #d8dce1;
            border-radius: 8px;
            padding: 6px 12px;
            cursor: pointer;
            font-size: 13px;
        }

        .uploadfile-sm:hover {
            border-color: #adb3bb;
            background-color: #fafbfc;
        }

        .tf-button-secondary {
            border: 1px solid #e3e6ea;
            background: #fff;
            border-radius: 8px;
            padding: 10px 16px;
            font-weight: 500;
        }

        .tf-button-secondary:hover {
            background: #f8f9fa;
        }

        #editSubmitBtn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

         .categories-table-wrap {
    max-height: 400px;
    overflow-y: auto;
}
    </style>
@endpush

@push('scripts')
    <script>


document.getElementById("clearCategoryForm").addEventListener("click", function () {
    const form = this.closest("form");

    // reset form fields
    form.reset();

    // file input reset
    document.getElementById("cat_image").value = "";

    // hide preview section
    document.getElementById("addImagePreviewWrap").classList.add("d-none");

    // clear image + filename
    document.getElementById("addImagePreview").src = "";
    document.getElementById("addImageFileName").textContent = "";

    // show upload box again (if hidden dynamically later)
    document.getElementById("addUploadBox").classList.remove("d-none");
});


        $(document).ready(function() {

            // ----- Edit modal -----
            $(document).on('click', '.edit-category', function() {
                let catId = $(this).data('id');

                let editUrl = "{{ route('categories.edit', ':id') }}".replace(':id', catId);
                let updateUrl = "{{ route('categories.update', ':id') }}".replace(':id', catId);

                $('#editCategoryForm').attr('action', updateUrl);
                $('#modal-error').addClass('d-none').text('');

                $.ajax({
                    url: editUrl,
                    type: 'GET',
                    success: function(response) {
                        $('#edit_name').val(response.name);

                        let img = response.image ?
                            "{{ asset('') }}" + response.image :
                            "{{ asset('assets/images/placeholder/category-placeholder.png') }}";

                        $('#edit-img-preview').attr('src', img);
                        $('#editCategoryModal').modal('show');
                    },
                    error: function() {
                        $('#modal-error').removeClass('d-none').text('Unable to load category. Please try again.');
                        $('#editCategoryModal').modal('show');
                    }
                });
            });

            $('#edit_image').on('change', function() {
                let reader = new FileReader();
                reader.onload = (e) => $('#edit-img-preview').attr('src', e.target.result);
                if (this.files[0]) reader.readAsDataURL(this.files[0]);
            });

            // ----- Edit form submit (loading state) -----
            $('#editCategoryForm').on('submit', function() {
                $('#editSubmitBtn').prop('disabled', true);
                $('#editSubmitBtn .btn-label').addClass('d-none');
                $('#editSpinner').removeClass('d-none');
            });

            // ----- Add category: image preview -----
            $('#cat_image').on('change', function() {
                let reader = new FileReader();
                let fileName = this.files[0]?.name || '';
                reader.onload = (e) => {
                    $('#addImagePreview').attr('src', e.target.result);
                    $('#addImageFileName').text(fileName);
                    $('#addImagePreviewWrap').removeClass('d-none').addClass('d-flex');
                };
                if (this.files[0]) reader.readAsDataURL(this.files[0]);
            });

            // ----- Live search -----
            let searchTimer;
            $('#searchInput').on('input', function() {
                clearTimeout(searchTimer);
                let query = $(this).val();
                $('#searchSpinner').removeClass('d-none');

                searchTimer = setTimeout(() => {
                    $.ajax({
                        url: "{{ route('categories.index') }}",
                        type: "GET",
                        data: { search: query },
                        success: function(response) {
                            $('#categoryTable').html(response);
                        },
                        complete: function() {
                            $('#searchSpinner').addClass('d-none');
                        }
                    });
                }, 300);
            });

        });
    </script>
@endpush