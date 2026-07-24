@extends('admin.layouts.app')

@push('title')
    <title>Manage Banners</title>
@endpush

@section('index_content')
<div class="main-content-wrap">
    <div class="flex items-center flex-wrap justify-between gap20 mb-27">
        <h3>Manage Homepage Banners</h3>
       
    </div>

    @if (session('status'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    <!-- banners-list -->
    <div class="wg-box">
        <div class="flex items-center justify-between gap10 flex-wrap mb-20">
            <div class="body-title">All Banners</div>
            <a class="tf-button style-1 w208" href="{{ route('banners.create') }}">
                <i class="icon-plus"></i> Add New Banner
            </a>
        </div>

        <div class="wg-table table-all-user table-banners">
            <ul class="table-title flex gap20 mb-14">
                <li class="col-image"><div class="body-title">Banner Image</div></li>
                <li class="col-details"><div class="body-title">Banner Details</div></li>
                <li class="col-price"><div class="body-title">Prices</div></li>
                <li class="col-order text-center"><div class="body-title">Order</div></li>
                <li class="col-status text-center"><div class="body-title">Status</div></li>
                <li class="col-action text-end"><div class="body-title">Action</div></li>
            </ul>

            <ul class="flex flex-column">
                @forelse ($banners as $banner)
                    <li class="user-item gap20">
                        <div class="image col-image">
                            <img src="{{ asset($banner->image) }}" alt="Banner">
                        </div>

                        <div class="col-details">
                            <span class="body-title-2 fw-bold d-block">{{ $banner->title ?? 'Untitled Banner' }}</span>
                            <span class="text-tiny d-block mt-3">Subtitle: {{ $banner->subtitle ?? 'N/A' }}</span>
                            <span class="text-tiny d-block">Offer Text: {{ $banner->offer_text ?? 'N/A' }}</span>
                            @if($banner->link)
                                <span class="text-tiny d-block">Link: <a href="{{ $banner->link }}" target="_blank">{{ Str::limit($banner->link, 30) }}</a></span>
                            @endif
                        </div>

                        <div class="col-price body-text">
                            @if($banner->price_sale)
                                <span class="fw-semibold text-danger">Rs. {{ number_format($banner->price_sale, 2) }}</span>
                                @if($banner->price_del)
                                    <del class="text-tiny d-block">Rs. {{ number_format($banner->price_del, 2) }}</del>
                                @endif
                            @else
                                <span class="text-tiny">—</span>
                            @endif
                        </div>

                        <div class="col-order text-center">
                            <span class="badge-status neutral">{{ $banner->order }}</span>
                        </div>

                        <div class="col-status text-center">
                            @if ($banner->is_active)
                                <span class="badge-status active">Active</span>
                            @else
                                <span class="badge-status inactive">Inactive</span>
                            @endif
                        </div>

                        <div class="col-action list-icon-function justify-content-end">
                            <a href="{{ route('banners.edit', $banner->id) }}" class="item edit" title="Edit">
                                <i class="icon-edit-3"></i>
                            </a>
                            <form action="{{ route('banners.destroy', $banner->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this banner?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="item trash" title="Delete">
                                    <i class="icon-trash-2"></i>
                                </button>
                            </form>
                        </div>
                    </li>
                @empty
                    <li class="user-item gap20 justify-center">
                        <div class="body-text w-full text-center">No banners found. Add a banner to display on the homepage slider.</div>
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
    <!-- /banners-list -->
</div>
@endsection

@push('styles')
<style>
    /* Prevent table children from forcing a 1515px width and causing horizontal scroll */
    .table-banners.table-all-user>* {
        min-width: auto !important;
    }

    /* Column widths / alignment for the banners table */
    .table-banners .table-title,
    .table-banners .user-item {
        display: flex;
        align-items: center;
        width: 100%;
    }

    .table-banners .col-image {
        flex: 0 0 140px;
    }
    .table-banners .col-details {
        flex: 1 1 300px;
        flex-direction: column;
        align-items: flex-start !important;
        justify-content: center;
    }
    .table-banners .col-price {
        flex: 1 1 150px;
        flex-direction: column;
        align-items: flex-start !important;
        justify-content: center;
    }
    .table-banners .col-order {
        flex: 0 0 100px;
        display: flex;
        justify-content: center;
    }
    .table-banners .col-status {
        flex: 0 0 120px;
        display: flex;
        justify-content: center;
    }
    .table-banners .col-action {
        flex: 0 0 120px;
        display: flex;
        justify-content: flex-end;
    }

    .table-banners .image.col-image {
        width: 140px;
        height: 70px;
        border-radius: 6px;
        overflow: hidden;
        background: #f8f9fc;
        border: 1px solid #eceef2;
    }
    .table-banners .image.col-image img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .badge-status {
        display: inline-block;
        padding: 3px 12px;
        font-size: 11px;
        font-weight: 600;
        border-radius: 20px;
        color: #fff;
    }
    .badge-status.active { background: #28a745; }
    .badge-status.inactive { background: #dc3545; }
    .badge-status.neutral { background: #6c757d; }

    .table-banners del {
        color: #9aa1ab;
        font-size: 12px;
    }

    .table-banners .list-icon-function {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .table-banners .list-icon-function form {
        margin: 0;
        display: flex;
    }
    .table-banners .list-icon-function .item {
        cursor: pointer;
        border: none;
        background: transparent;
    }
</style>
@endpush