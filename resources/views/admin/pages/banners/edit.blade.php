@extends('admin.layouts.app')

@push('title')
    <title>Edit Banner</title>
@endpush

@section('index_content')
<div class="main-content-wrap">
    <div class="flex items-center flex-wrap justify-between gap20 mb-27">
        <h3>Edit Home Banner</h3>
        <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
            <li><a href="{{ route('admin.dashboard') }}"><div class="text-tiny">Dashboard</div></a></li>
            <li><i class="icon-chevron-right"></i></li>
            <li><a href="{{ route('banners.index') }}"><div class="text-tiny">Banners</div></a></li>
            <li><i class="icon-chevron-right"></i></li>
            <li><div class="text-tiny">Edit</div></li>
        </ul>
    </div>

    <div class="wg-box">
        <form action="{{ route('banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <fieldset class="name mb-24">
                        <div class="body-title mb-10">Banner Title</div>
                        <input type="text" name="title" placeholder="Ex: UP TO 30% OFF Speakers" value="{{ old('title', $banner->title) }}">
                        @error('title') <span class="text-danger text-tiny">{{ $message }}</span> @enderror
                    </fieldset>
                </div>
                <div class="col-md-6">
                    <fieldset class="name mb-24">
                        <div class="body-title mb-10">Banner Subtitle</div>
                        <input type="text" name="subtitle" placeholder="Ex: Tech Products" value="{{ old('subtitle', $banner->subtitle) }}">
                        @error('subtitle') <span class="text-danger text-tiny">{{ $message }}</span> @enderror
                    </fieldset>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <fieldset class="name mb-24">
                        <div class="body-title mb-10">Description / Offer Text</div>
                        <input type="text" name="offer_text" placeholder="Ex: The Best Gadgets Collection 2026" value="{{ old('offer_text', $banner->offer_text) }}">
                        @error('offer_text') <span class="text-danger text-tiny">{{ $message }}</span> @enderror
                    </fieldset>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <fieldset class="name mb-24">
                        <div class="body-title mb-10">Original Price (LKR / Optional)</div>
                        <input type="number" step="0.01" name="price_del" placeholder="Ex: 10520.00" value="{{ old('price_del', $banner->price_del) }}">
                        @error('price_del') <span class="text-danger text-tiny">{{ $message }}</span> @enderror
                    </fieldset>
                </div>
                <div class="col-md-6">
                    <fieldset class="name mb-24">
                        <div class="body-title mb-10">Sale Price (LKR / Optional)</div>
                        <input type="number" step="0.01" name="price_sale" placeholder="Ex: 10460.00" value="{{ old('price_sale', $banner->price_sale) }}">
                        @error('price_sale') <span class="text-danger text-tiny">{{ $message }}</span> @enderror
                    </fieldset>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <fieldset class="name mb-24">
                        <div class="body-title mb-10">Redirect Link (URL / Optional)</div>
                        <input type="text" name="link" placeholder="Ex: /shop or full URL" value="{{ old('link', $banner->link) }}">
                        @error('link') <span class="text-danger text-tiny">{{ $message }}</span> @enderror
                    </fieldset>
                </div>
                <div class="col-md-6">
                    <fieldset class="name mb-24">
                        <div class="body-title mb-10">Display Order <span class="tf-color-1">*</span></div>
                        <input type="number" name="order" placeholder="Ex: 1" value="{{ old('order', $banner->order) }}" required>
                        @error('order') <span class="text-danger text-tiny">{{ $message }}</span> @enderror
                    </fieldset>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <fieldset class="image mb-24">
                        <div class="body-title mb-10">Banner Image</div>
                        <div class="upload-image">
                            <div class="item up-load">
                                <label class="uploadfile" for="banner_image">
                                    <span class="icon"><i class="icon-upload-cloud"></i></span>
                                    <span class="text-tiny">Click to replace banner image</span>
                                    <input type="file" id="banner_image" name="image" accept="image/*">
                                </label>
                            </div>
                            <div class="mt-3">
                                <img id="bannerPreview" src="{{ asset($banner->image) }}" style="max-width: 100%; max-height: 250px; object-fit: contain; border-radius: 8px; border: 1px solid #e5e7ef; padding: 5px;">
                                <div class="form-text mt-1 text-muted">Current image displayed. Upload a new image to replace it.</div>
                            </div>
                        </div>
                        @error('image') <span class="text-danger text-tiny">{{ $message }}</span> @enderror
                    </fieldset>
                </div>
            </div>

            <div class="row mb-24 align-items-center">
                <div class="col-md-12">
                    <div class="d-flex align-items-center gap-3">
                        <label class="body-title mb-0" for="is_active" style="cursor: pointer;">Active Status</label>
                        <label class="switch-toggle">
                            <input type="checkbox" id="is_active" name="is_active" value="1" {{ $banner->is_active ? 'checked' : '' }}>
                            <span class="slider-toggle"></span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 d-flex gap-3">
                    <button class="tf-button w-full" type="submit" style="max-width: 200px;">Update Banner</button>
                    <a href="{{ route('banners.index') }}" class="tf-button style-1 w-full" style="max-width: 150px; justify-content: center; background: #e5e7ef; color: #495057;">Cancel</a>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const fileInput = document.getElementById('banner_image');
        if (fileInput) {
            fileInput.addEventListener('change', function (e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (event) {
                        const img = document.getElementById('bannerPreview');
                        img.src = event.target.result;
                        img.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    });
</script>
@endpush

@push('styles')
<style>
    .switch-toggle {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 26px;
    }
    .switch-toggle input {
        opacity: 0;
        width: 0;
        height: 0;
        position: absolute;
    }
    .slider-toggle {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #cbd5e1;
        transition: .3s;
        border-radius: 34px;
    }
    .slider-toggle:before {
        position: absolute;
        content: "";
        height: 20px;
        width: 20px;
        left: 3px;
        bottom: 3px;
        background-color: #fff;
        transition: .3s;
        border-radius: 50%;
        box-shadow: 0 2px 5px rgba(0,0,0,0.15);
    }
    .switch-toggle input:checked + .slider-toggle {
        background-color: #2275fc;
    }
    .switch-toggle input:checked + .slider-toggle:before {
        transform: translateX(24px);
    }
</style>
@endpush
