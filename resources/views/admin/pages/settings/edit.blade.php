@extends('admin.layouts.app')

@push('title')
    <title>General Settings | Admin</title>
@endpush

@section('index_content')



   

    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>General Settings</h3>
        </div>

        <form class="form-add-product" action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">           
            @csrf
            <div class="wg-box">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                
                @endif

                <div class="gap22 cols">
                    <fieldset>
                        <div class="body-title mb-10">Website Name <span class="tf-color-1">*</span></div>
                        <input type="text" name="site_name" value="{{ \App\Models\Setting::get('site_name') }}" required>
                    </fieldset>

                    <fieldset>
                        <div class="body-title mb-10">Website Email</div>
                        <input type="email" name="site_email" value="{{ \App\Models\Setting::get('site_email') }}">
                    </fieldset>
                </div>

                <div class="gap22 cols">
                    <fieldset>
                        <div class="body-title mb-10">Contact Number</div>
                        <input type="text" name="site_phone" value="{{ \App\Models\Setting::get('site_phone') }}">
                    </fieldset>

                    <fieldset>
                        <div class="body-title mb-10">Address</div>
                        <input type="text" name="site_address" value="{{ \App\Models\Setting::get('site_address') }}">
                    </fieldset>
                </div>

                <div class="divider"></div>

                <div class="body-title mb-20">Social Media Links (Optional)</div>

                <div class="gap22 cols">
                    <fieldset>
                        <div class="body-title mb-10">Facebook URL</div>
                        <input type="url" name="social_facebook"
                            value="{{ \App\Models\Setting::get('social_facebook') }}"
                            placeholder="https://facebook.com/yourpage">
                    </fieldset>

                    <fieldset>
                        <div class="body-title mb-10">Instagram URL</div>
                        <input type="url" name="social_instagram"
                            value="{{ \App\Models\Setting::get('social_instagram') }}"
                            placeholder="https://instagram.com/yourprofile">
                    </fieldset>
                </div>

                <div class="gap22 cols">
                    <fieldset>
                        <div class="body-title mb-10">YouTube Channel URL</div>
                        <input type="url" name="social_youtube" value="{{ \App\Models\Setting::get('social_youtube') }}"
                            placeholder="https://youtube.com/c/yourchannel">
                    </fieldset>

                    <fieldset>
                        <div class="body-title mb-10">TikTok URL</div>
                        <input type="url" name="social_tiktok" value="{{ \App\Models\Setting::get('social_tiktok') }}"
                            placeholder="https://tiktok.com/@yourprofile">
                    </fieldset>
                </div>

                <div class="divider"></div>

                <div class="gap22 cols">
                    <fieldset>
                        <div class="body-title mb-10">Website Logo</div>
                        <div class="upload-image flex-grow">
                            <div class="item up-load">
                                <label class="uploadfile">
                                    <span class="tf-color-1">*</span>
                                    <input type="file" name="site_logo" id="site_logo" accept="image/*">
                                    <div class="btn-up">
                                        @if (\App\Models\Setting::get('site_logo'))
                                            <img id="logo-preview" src="{{ asset(\App\Models\Setting::get('site_logo')) }}"
                                                style="max-height: 60px;">
                                        @else
                                            <img id="logo-preview" src="" style="display:none; max-height: 60px;">
                                            <span>Upload Logo</span>
                                        @endif
                                    </div>
                                </label>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="body-title mb-10">Website Favicon (16x16 or 32x32)</div>
                        <div class="upload-image flex-grow">
                            <div class="item up-load">
                                <label class="uploadfile">
                                    <input type="file" name="site_favicon" id="site_favicon"
                                        accept="image/x-icon, image/png">
                                    <div class="btn-up">
                                        @if (\App\Models\Setting::get('site_favicon'))
                                            <img id="favicon-preview"
                                                src="{{ asset(\App\Models\Setting::get('site_favicon')) }}"
                                                style="max-height: 32px;">
                                        @else
                                            <img id="favicon-preview" src=""
                                                style="display:none; max-height: 32px;">
                                            <span>Upload Favicon</span>
                                        @endif
                                    </div>
                                </label>
                            </div>
                        </div>
                    </fieldset>
                </div>

                

                <div class="mt-20">
                 
@if(session('status'))
    <p style="color: green; font-weight: 500; margin-bottom: 15px;">
        {{ session('status') }}
    </p>
@endif
                    <button class="tf-button w208" type="submit">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('styles')
    <style>
        .upload-image {
            width: 100%;
        }

        .uploadfile {
            position: relative;
            display: block;
            border: 2px dashed #ddd;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            background: #fcfcfc;
        }

        .uploadfile input {
            display: none;
        }

        .btn-up {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>
@endpush

@push('scripts')
    <script>
        function previewImage(input, previewId) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $(previewId).attr('src', e.target.result).show();
                    $(previewId).siblings('span').hide(); // Hide the "Upload" text
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $('#site_logo').change(function() {
            previewImage(this, '#logo-preview');
        });

        $('#site_favicon').change(function() {
            previewImage(this, '#favicon-preview');
        });
    </script>
@endpush
