@forelse ($categories as $category)
<li class="user-item gap20">
    <div class="image col-image">
        <img src="{{ asset($category->image ?? 'assets/images/placeholder/category-placeholder.png') }}" alt="{{ $category->name }}">
    </div>

    <div class="col-name name">
        <a href="#" class="body-title-2">{{ $category->name }}</a>
        <div class="text-tiny mt-3 flex items-center gap-1 text-muted">
            <i class="icon-tag" style="font-size:10px;"></i>
            <span>{{ $category->brands->count() }} {{ Str::plural('Brand', $category->brands->count()) }}</span>
        </div>
    </div>

    <div class="col-action list-icon-function justify-content-end">
        <button type="button" class="item edit edit-category"
                data-id="{{ $category->id }}"
                title="Edit Category"
                style="border: none; background: transparent; cursor: pointer;">
            <i class="icon-edit-3"></i>
        </button>
    </div>
</li>
@empty
<li class="user-item gap20 justify-center">
    <div class="body-text w-full text-center py-4">
        <i class="icon-folder d-block mb-2" style="font-size:28px;opacity:0.4;"></i>
        No categories found
    </div>
</li>
@endforelse