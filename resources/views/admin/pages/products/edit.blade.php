@extends('admin.layouts.app')

@section('index_content')
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Edit Product: {{ $product->name }}</h3>
        </div>

        <form class="tf-section-2 form-add-product" action="{{ route('products.update', $product->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="wg-box">
                <div class="gap22 cols">
                    <fieldset class="name">
                        <div class="body-title mb-10">Product name <span class="tf-color-1">*</span></div>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}" required>
                    </fieldset>
                    <fieldset class="sku">
                        <div class="body-title mb-10">SKU</div>
                        <input type="text" name="sku" value="{{ old('sku', $product->sku) }}">
                    </fieldset>
                </div>

                <div class="gap22 cols">
                    <fieldset class="category">
                        <div class="body-title mb-10">Category <span class="tf-color-1">*</span></div>
                        <select name="category_id" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </fieldset>
                    <fieldset class="brand">
                        <div class="body-title mb-10">Brand <span class="tf-color-1">*</span></div>
                        <select name="brand_id" required>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}"
                                    {{ $product->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </fieldset>
                </div>

                <div class="gap22 cols">
                    <fieldset class="warranty">
                        <div class="body-title mb-10">Has Warranty?</div>
                        <div class="select">
                            <select name="has_warranty" id="has_warranty_select">
                                <option value="0" {{ $product->has_warranty == 0 ? 'selected' : '' }}>No Warranty</option>
                                <option value="1" {{ $product->has_warranty == 1 ? 'selected' : '' }}>Yes, Has Warranty</option>
                            </select>
                        </div>
                    </fieldset>
                    <fieldset class="warranty_period" id="warranty_period_field"
                        style="{{ $product->has_warranty ? '' : 'display:none;' }}">
                        <div class="body-title mb-10">Warranty Period</div>
                        <input type="text" name="warranty_period"
                            value="{{ old('warranty_period', $product->warranty_period) }}"
                            placeholder="e.g., 1 Year, 6 Months">
                    </fieldset>
                </div>

                <fieldset class="description">
                    <div class="body-title mb-10">Description <span class="tf-color-1">*</span></div>
                    <textarea name="description" id="description">{{ old('description', $product->description) }}</textarea>
                </fieldset>

                <div class="divider"></div>

                <div class="flex items-center justify-between mb-20">
                    <div class="body-title">Product Variations</div>
                    <div class="flex items-center gap10">
                        <span class="text-tiny">Has Variants?</span>
                        <input type="checkbox" name="has_variants" id="has_variants" value="1"
                            {{ $product->has_variants ? 'checked' : '' }}
                            style="width: 20px; height: 20px;">
                    </div>
                </div>

                <div id="variants-section" style="{{ $product->has_variants ? '' : 'display: none;' }}">
                    <div id="variants-container">
                        @foreach ($product->variants as $index => $variant)
                            <div class="variant-row border rounded p-3 mb-3 bg-light position-relative">

                                {{-- Hidden fields --}}
                                <input type="hidden" name="variants[{{ $index }}][id]" value="{{ $variant->id }}">
                                <input type="hidden" name="variants[{{ $index }}][old_variant_image]" value="{{ $variant->variant_image }}">

                                {{-- Delete button --}}
                                <button type="button"
                                    class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2 remove-variant">
                                    <i class="icon-trash-2"></i>
                                </button>

                                {{-- Row 1 --}}
                                <div class="row g-3 mb-2">
                                    <div class="col-md-4">
                                        <label class="form-label small">Color</label>
                                        <input type="text" class="form-control form-control-sm"
                                            name="variants[{{ $index }}][color]"
                                            value="{{ $variant->color }}" placeholder="Color">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label small">Storage</label>
                                        <input type="text" class="form-control form-control-sm"
                                            name="variants[{{ $index }}][storage]"
                                            value="{{ $variant->storage }}" placeholder="Storage">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label small">RAM</label>
                                        <input type="text" class="form-control form-control-sm"
                                            name="variants[{{ $index }}][ram]"
                                            value="{{ $variant->ram }}" placeholder="RAM">
                                    </div>
                                </div>

                                {{-- Row 2 --}}
                                <div class="row g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label class="form-label small">Price (LKR)</label>
                                        <input type="number" class="form-control form-control-sm"
                                            name="variants[{{ $index }}][price]"
                                            value="{{ $variant->price }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label small">Current Image</label>
                                        <div class="d-flex align-items-center gap-2">
                                            @if ($variant->variant_image)
                                                <img src="{{ asset($variant->variant_image) }}"
                                                    width="45" height="45"
                                                    class="rounded border"
                                                    style="object-fit: cover;">
                                            @else
                                                <span class="text-muted small">No image</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <label class="form-label small">Replace Image</label>
                                        <input type="file" class="form-control form-control-sm"
                                            name="variants[{{ $index }}][variant_image]">
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                    <button type="button" id="add-variant-btn" class="tf-button style-2 w-full">
                        <i class="icon-plus"></i> Add More Variant Combination
                    </button>
                </div>
            </div>

            <div class="wg-box">
                <fieldset id="base-price-field" style="{{ $product->has_variants ? 'display: none;' : '' }}">
                    <div class="body-title mb-10">Base Price (LKR)</div>
                    <input type="number" name="base_price" value="{{ $product->base_price }}">
                </fieldset>

                {{-- ───────────────────────────────────────────
                     FEATURED IMAGE — single slot with change / remove
                ─────────────────────────────────────────────── --}}
                <fieldset>
                    <div class="body-title mb-10">Featured Image <span class="tf-color-1">*</span></div>

                    <div class="featured-upload-area" id="featured-upload-area">

                        {{-- Empty state: upload trigger --}}
                        <label class="featured-placeholder" for="featured_image" id="featured-placeholder"
                            style="{{ $product->featured_image ? 'display:none;' : '' }}">
                            <span class="fu-icon"><i class="icon-upload-cloud"></i></span>
                            <span class="fu-label">Click to upload</span>
                            <input type="file" id="featured_image" name="featured_image" accept="image/*" style="display:none;">
                        </label>

                        {{-- Filled state: preview + controls --}}
                        <div class="featured-preview-wrap" id="featured-preview-wrap"
                            style="{{ $product->featured_image ? '' : 'display:none;' }}">
                            <img id="featured-img-tag"
                                src="{{ $product->featured_image ? asset($product->featured_image) : '' }}"
                                alt="Featured Image">
                            <div class="featured-actions">
                                <button type="button" class="feat-btn feat-btn-change" id="featured-change-btn" title="Change image">
                                    <i class="icon-edit-3"></i> Change
                                </button>
                                <button type="button" class="feat-btn feat-btn-delete" id="featured-delete-btn" title="Remove image">
                                    <i class="icon-trash-2"></i> Remove
                                </button>
                            </div>
                            <input type="file" id="featured_image_change" accept="image/*" style="display:none;">
                        </div>

                        {{-- Track whether existing image was removed --}}
                        <input type="hidden" name="remove_featured_image" id="remove_featured_image" value="0">

                    </div>
                </fieldset>

                {{-- ───────────────────────────────────────────
                     GALLERY IMAGES — existing + add new (drag-to-reorder)
                ─────────────────────────────────────────────── --}}
                <fieldset>
                    <div class="body-title mb-10">
                        Gallery Images
                        <span class="text-tiny" style="font-weight:400; color:#888; margin-left:6px;">(Max 10 · drag to reorder)</span>
                    </div>

                    <div class="gallery-upload-area">
                        <div class="gallery-grid" id="gallery-grid">
                            {{-- Existing images rendered by JS from data attribute --}}
                            <label class="gallery-add-tile" id="gallery-add-tile" for="gallery_file_input" title="Add images">
                                <i class="icon-upload-cloud"></i>
                                <span>Add</span>
                            </label>
                        </div>
                    </div>

                    <input type="file" id="gallery_file_input" name="images[]" multiple accept="image/*" style="display:none;">

                    {{-- Existing gallery images as JSON for JS to render --}}
                    <div id="gallery-existing-data"
                        data-images='@json($product->images->map(fn($img) => ["id" => $img->id, "path" => asset($img->image_path)]))'
                        style="display:none;">
                    </div>

                    {{-- Hidden inputs to track which existing images to delete --}}
                    <div id="gallery-delete-inputs"></div>

                    <p class="text-tiny" style="color:#aaa; margin-top:6px;" id="gallery-count-label">0 / 10 images</p>
                </fieldset>

                <button class="tf-button w-full" type="submit">Update Product</button>
            </div>
        </form>
    </div>
@endsection

@push('styles')
    <style>
        /* ── CKEditor ───────────────────────────── */
        .ck-editor__editable_inline {
            min-height: 200px;
            border-radius: 0 0 10px 10px !important;
        }
        .ck-editor__top {
            border-radius: 10px 10px 0 0 !important;
        }

        /* ── Variant rows ───────────────────────── */
        .variant-row {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 10px;
        }

        /* ════════════════════════════════════════
           FEATURED IMAGE
        ════════════════════════════════════════ */
        .featured-upload-area {
            border: 2px dashed #d0d5dd;
            border-radius: 12px;
            overflow: hidden;
            transition: border-color .2s;
        }
        .featured-upload-area:hover {
            border-color: #aab4c2;
        }

        /* Empty state */
        .featured-placeholder {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 32px 20px;
            cursor: pointer;
            color: #888;
            transition: background .2s;
        }
        .featured-placeholder:hover {
            background: #f5f7fa;
        }
        .featured-placeholder .fu-icon {
            font-size: 28px;
            color: #b0b8c4;
        }
        .featured-placeholder .fu-label {
            font-size: 13px;
            font-weight: 500;
        }

        /* Filled state */
        .featured-preview-wrap {
            position: relative;
        }
        .featured-preview-wrap img {
            width: 100%;
            max-height: 280px;
            object-fit: contain;
            display: block;
            background: #f0f2f5;
        }
        .featured-actions {
            position: absolute;
            bottom: 10px;
            right: 10px;
            display: flex;
            gap: 8px;
        }
        .feat-btn {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 12px;
            border: none;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: opacity .15s;
        }
        .feat-btn:hover { opacity: .85; }
        .feat-btn-change {
            background: #fff;
            color: #333;
            box-shadow: 0 1px 4px rgba(0,0,0,.18);
        }
        .feat-btn-delete {
            background: #ff4d4f;
            color: #fff;
        }

        /* ════════════════════════════════════════
           GALLERY IMAGES
        ════════════════════════════════════════ */
        .gallery-upload-area {
            border: 1px solid #e5e9f0;
            border-radius: 12px;
            padding: 12px;
            background: #fafbfc;
        }

        .gallery-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            max-height: 320px;
            overflow-y: auto;
            padding-right: 4px;
        }
        .gallery-grid::-webkit-scrollbar { width: 5px; }
        .gallery-grid::-webkit-scrollbar-thumb { background: #d0d5dd; border-radius: 10px; }

        /* Individual thumbnail tile */
        .gallery-thumb {
            position: relative;
            width: 96px;
            height: 96px;
            border-radius: 10px;
            overflow: hidden;
            background: #eef0f3;
            flex-shrink: 0;
            cursor: grab;
            border: 2px solid transparent;
            transition: border-color .15s, box-shadow .15s;
            user-select: none;
        }
        .gallery-thumb:active { cursor: grabbing; }
        .gallery-thumb.drag-over {
            border-color: #4f7ef8;
            box-shadow: 0 0 0 3px rgba(79,126,248,.18);
        }
        /* Existing images get a subtle tint to distinguish */
        .gallery-thumb.is-existing {
            border-color: #d0e6ff;
        }
        .gallery-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            pointer-events: none;
        }

        /* Remove (×) button */
        .gallery-thumb .gallery-remove {
            position: absolute;
            top: 4px;
            right: 4px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: rgba(0,0,0,.55);
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 12px;
            line-height: 20px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            transition: background .15s;
        }
        .gallery-thumb .gallery-remove:hover { background: #ff4d4f; }

        /* Drag index badge */
        .gallery-thumb .gallery-order {
            position: absolute;
            bottom: 4px;
            left: 4px;
            background: rgba(0,0,0,.45);
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            border-radius: 4px;
            padding: 1px 5px;
            line-height: 1.4;
        }

        /* "Existing" label badge */
        .gallery-thumb .gallery-badge {
            position: absolute;
            top: 4px;
            left: 4px;
            background: rgba(79,126,248,.75);
            color: #fff;
            font-size: 9px;
            font-weight: 700;
            border-radius: 3px;
            padding: 1px 4px;
            line-height: 1.4;
            letter-spacing: .3px;
        }

        /* Add-more tile */
        .gallery-add-tile {
            width: 96px;
            height: 96px;
            border-radius: 10px;
            border: 2px dashed #c8cdd6;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 4px;
            cursor: pointer;
            color: #9aa3b0;
            font-size: 11px;
            font-weight: 600;
            flex-shrink: 0;
            transition: border-color .15s, background .15s;
        }
        .gallery-add-tile i { font-size: 20px; }
        .gallery-add-tile:hover {
            border-color: #8a94a6;
            background: #f0f2f5;
            color: #555;
        }
        .gallery-add-tile.hidden { display: none; }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('#description')).catch(error => console.error(error));

        $(document).ready(function () {

            // ── 1. Toggle Variants Section ──────────────────────────
            $('#has_variants').on('change', function () {
                if ($(this).is(':checked')) {
                    $('#variants-section').slideDown();
                    $('#base-price-field').fadeOut();
                } else {
                    $('#variants-section').slideUp();
                    $('#base-price-field').fadeIn();
                }
            });

            // ── 2. Add / Remove Variants ────────────────────────────
            let variantCount = {{ $product->variants->count() }};

            $('#add-variant-btn').click(function () {
                let newRow = `
                <div class="variant-row border-bottom mb-24 pb-24 animate__animated animate__fadeIn">
                    <div class="flex gap22 mb-10">
                        <fieldset class="flex-grow"><div class="body-title mb-10 text-tiny">Color</div><input type="text" name="variants[${variantCount}][color]"></fieldset>
                        <fieldset class="flex-grow"><div class="body-title mb-10 text-tiny">Storage</div><input type="text" name="variants[${variantCount}][storage]"></fieldset>
                        <fieldset class="flex-grow"><div class="body-title mb-10 text-tiny">RAM</div><input type="text" name="variants[${variantCount}][ram]"></fieldset>
                    </div>
                    <div class="flex gap22 items-end align-items-end">
                        <fieldset class="flex-grow"><div class="body-title mb-10 text-tiny">Price</div><input type="number" name="variants[${variantCount}][price]"></fieldset>
                        <fieldset class="flex-grow"><input type="file" name="variants[${variantCount}][variant_image]"></fieldset>
                        <button type="button" class="tf-button style-1 remove-variant"><i class="icon-trash-2"></i></button>
                    </div>
                </div>`;
                $('#variants-container').append(newRow);
                variantCount++;
            });

            $(document).on('click', '.remove-variant', function () {
                $(this).closest('.variant-row').remove();
            });

            // ── 3. Category → Brand AJAX ────────────────────────────
            $('select[name="category_id"]').on('change', function () {
                var categoryId  = $(this).val();
                var brandSelect = $('select[name="brand_id"]');
                brandSelect.html('<option value="">Loading...</option>');
                if (categoryId) {
                    $.ajax({
                        url: "{{ route('get.brands', '') }}/" + categoryId,
                        type: "GET",
                        success: function (data) {
                            brandSelect.html('<option value="">Choose brand</option>');
                            $.each(data, function (key, value) {
                                brandSelect.append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        }
                    });
                }
            });

            // ── 4. Variant image previews ───────────────────────────
            $(document).on('change', 'input[type="file"][name*="variant_image"]', function () {
                let input = this;
                let reader = new FileReader();
                let parentFieldset = $(input).closest('fieldset, .col-md-5');
                reader.onload = (e) => {
                    parentFieldset.find('.v-preview').remove();
                    parentFieldset.prepend(
                        `<img class="v-preview" src="${e.target.result}" style="width:40px; height:40px; object-fit:cover; border-radius:5px; margin-bottom:5px;">`
                    );
                };
                if (input.files[0]) reader.readAsDataURL(input.files[0]);
            });
        });

        /* ═══════════════════════════════════════════════════
           WARRANTY PERIOD TOGGLE
        ═══════════════════════════════════════════════════ */
        if ($('#has_warranty_select').val() == '1') {
            $('#warranty_period_field').show();
        }
        $('#has_warranty_select').on('change', function () {
            if ($(this).val() == '1') {
                $('#warranty_period_field').slideDown();
            } else {
                $('#warranty_period_field').slideUp();
                $('input[name="warranty_period"]').val('');
            }
        });

        /* ═══════════════════════════════════════════════════
           FEATURED IMAGE — single slot with change / remove
        ═══════════════════════════════════════════════════ */
        (function () {
            const mainInput     = document.getElementById('featured_image');
            const changeInput   = document.getElementById('featured_image_change');
            const placeholder   = document.getElementById('featured-placeholder');
            const previewWrap   = document.getElementById('featured-preview-wrap');
            const imgTag        = document.getElementById('featured-img-tag');
            const changeBtn     = document.getElementById('featured-change-btn');
            const deleteBtn     = document.getElementById('featured-delete-btn');
            const removeFlag    = document.getElementById('remove_featured_image');

            function showPreview(file) {
                if (!file) return;
                const reader = new FileReader();
                reader.onload = e => {
                    imgTag.src                = e.target.result;
                    placeholder.style.display = 'none';
                    previewWrap.style.display = 'block';
                    removeFlag.value          = '0';
                    try {
                        const dt = new DataTransfer();
                        dt.items.add(file);
                        mainInput.files = dt.files;
                    } catch (err) { /* Safari fallback */ }
                };
                reader.readAsDataURL(file);
            }

            // Upload via placeholder label
            mainInput.addEventListener('change', function () {
                if (this.files && this.files[0]) showPreview(this.files[0]);
            });

            // "Change" button
            changeBtn.addEventListener('click', () => changeInput.click());
            changeInput.addEventListener('change', function () {
                if (this.files && this.files[0]) showPreview(this.files[0]);
            });

            // "Remove" button — flags existing image for deletion on backend
            deleteBtn.addEventListener('click', function () {
                mainInput.value           = '';
                changeInput.value         = '';
                imgTag.src                = '';
                previewWrap.style.display = 'none';
                placeholder.style.display = '';
                removeFlag.value          = '1';
            });
        })();

        /* ═══════════════════════════════════════════════════
           GALLERY IMAGES — existing + new, drag-to-reorder
        ═══════════════════════════════════════════════════ */
        (function () {
            const MAX          = 10;
            const grid         = document.getElementById('gallery-grid');
            const addTile      = document.getElementById('gallery-add-tile');
            const fileInput    = document.getElementById('gallery_file_input');
            const countLabel   = document.getElementById('gallery-count-label');
            const deleteInputs = document.getElementById('gallery-delete-inputs');

            // Parse existing images from data attribute
            const existingRaw = document.getElementById('gallery-existing-data').dataset.images;
            const existing    = JSON.parse(existingRaw || '[]');

            // Unified item list:
            //   existing items: { type:'existing', id, url }
            //   new items:      { type:'new', file, dataUrl }
            let items = existing.map(img => ({ type: 'existing', id: img.id, url: img.path }));

            // ── Render ───────────────────────────────────
            function render() {
                grid.querySelectorAll('.gallery-thumb').forEach(el => el.remove());

                items.forEach((item, idx) => {
                    const tile = document.createElement('div');
                    tile.className     = 'gallery-thumb' + (item.type === 'existing' ? ' is-existing' : '');
                    tile.draggable     = true;
                    tile.dataset.index = idx;

                    const src = item.type === 'existing' ? item.url : item.dataUrl;

                    tile.innerHTML = `
                        <img src="${src}" alt="Gallery image ${idx + 1}">
                        ${item.type === 'existing' ? '<span class="gallery-badge">Saved</span>' : ''}
                        <button type="button" class="gallery-remove" title="Remove">×</button>
                        <span class="gallery-order">${idx + 1}</span>
                    `;

                    tile.querySelector('.gallery-remove').addEventListener('click', e => {
                        e.stopPropagation();
                        // If removing an existing image, track it for backend deletion
                        if (item.type === 'existing') {
                            const hiddenInput = document.createElement('input');
                            hiddenInput.type  = 'hidden';
                            hiddenInput.name  = 'delete_gallery_ids[]';
                            hiddenInput.value = item.id;
                            deleteInputs.appendChild(hiddenInput);
                        }
                        items.splice(idx, 1);
                        render();
                    });

                    tile.addEventListener('dragstart', onDragStart);
                    tile.addEventListener('dragover',  onDragOver);
                    tile.addEventListener('dragleave', onDragLeave);
                    tile.addEventListener('drop',      onDrop);
                    tile.addEventListener('dragend',   onDragEnd);

                    grid.insertBefore(tile, addTile);
                });

                addTile.classList.toggle('hidden', items.length >= MAX);
                countLabel.textContent = `${items.length} / ${MAX} images`;
            }

            // On submit: push new files (in order) to the file input
            document.querySelector('.form-add-product').addEventListener('submit', function () {
                const newItems = items.filter(i => i.type === 'new');
                if (newItems.length === 0) return;
                try {
                    const dt = new DataTransfer();
                    newItems.forEach(item => dt.items.add(item.file));
                    fileInput.files = dt.files;
                } catch (e) { /* Safari fallback */ }
            });

            // ── File input change ─────────────────────────
            fileInput.addEventListener('change', function () {
                const remaining = MAX - items.length;
                const toAdd     = Array.from(this.files).slice(0, remaining);
                let loaded = 0;
                toAdd.forEach(file => {
                    const reader = new FileReader();
                    reader.onload = e => {
                        items.push({ type: 'new', file, dataUrl: e.target.result });
                        loaded++;
                        if (loaded === toAdd.length) render();
                    };
                    reader.readAsDataURL(file);
                });
                this.value = '';
            });

            // ── Drag-and-drop reorder ─────────────────────
            let dragSrcIdx = null;

            function onDragStart(e) {
                dragSrcIdx = parseInt(this.dataset.index);
                e.dataTransfer.effectAllowed = 'move';
                this.style.opacity = '0.45';
            }
            function onDragOver(e) {
                e.preventDefault();
                e.dataTransfer.dropEffect = 'move';
                this.classList.add('drag-over');
            }
            function onDragLeave() {
                this.classList.remove('drag-over');
            }
            function onDrop(e) {
                e.preventDefault();
                this.classList.remove('drag-over');
                const targetIdx = parseInt(this.dataset.index);
                if (dragSrcIdx === null || dragSrcIdx === targetIdx) return;
                const moved = items.splice(dragSrcIdx, 1)[0];
                items.splice(targetIdx, 0, moved);
                render();
            }
            function onDragEnd() {
                this.style.opacity = '';
                grid.querySelectorAll('.gallery-thumb').forEach(el => el.classList.remove('drag-over'));
            }

            render();
        })();
    </script>
@endpush