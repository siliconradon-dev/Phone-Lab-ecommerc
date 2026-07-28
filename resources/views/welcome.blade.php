<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<header class="header_section">
   

    <div class="header_bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col col-md-3 col-6">
                    <div class="allcategories_dropdown">
                        <button class="allcategories_btn" type="button" data-bs-toggle="collapse"
                            data-bs-target="#allcategories_collapse" aria-expanded="false"
                            aria-controls="allcategories_collapse">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="15" height="13" viewBox="0 0 15 13">
                                <image width="15" height="13"
                                    xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA8AAAANAgMAAAALcNzSAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAACVBMVEX+//3+//0AAABvRd2oAAAAAXRSTlMAQObYZgAAAAFiS0dEAmYLfGQAAAAJcEhZcwAACxIAAAsSAdLdfvwAAAAHdElNRQflBwIBIhVZ2fz2AAAAGUlEQVQI12MIDQ0NYQATaAAshEUcJgvVBgDy4QdJZv6kzwAAAABJRU5ErkJggg==" />
                            </svg>
                            All Categories
                        </button>
                        <div class="allcategories_collapse collapse" id="allcategories_collapse">
                            <div class="card card-body">
                                <ul class="allcategories_list ul_li_block">
                                    @foreach ($globalCategories as $gCategory)
                                        <li>
                                            <a
                                                href="{{ route('phone_lab.shop_grid', ['category' => $gCategory->id]) }}">
                                                <i
                                                    class="{{ $gCategory->icon_class ?? 'fa-duotone fa-list-alt' }}"></i>
                                                {{ $gCategory->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col col-md-6">
                    <form method="GET" id="searchForm" action="{{ route('phone_lab.shop_grid') }}">
                        <div class="advance_serach position-relative">

                            <div class="form_item">
                                <input type="search" id="searchInput" name="search" placeholder="Search Products..."
                                    value="{{ request('search') }}" autocomplete="off">

                                <!-- suggestion box -->
                                <div id="suggestions" class="list-group position-absolute w-100"
                                    style="z-index: 999; display:none;">
                                </div>
                            </div>

                            <button type="submit" class="search_btn">
                                <i class="far fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>




                <div class="col col-md-3 col-6">
                    <button type="button" class="cart_btn"
                        onclick="window.location.href='{{ route('cart.index') }}'">
                        <span class="cart_icon">
                            <i class="icon icon-ShoppingCart"></i>
                            <small class="cart_counter">{{ $globalCartCount ?? 0 }}</small>
                        </span>
                        <span class="cart_amount">LKR {{ number_format($globalCartTotal ?? 0, 2) }}</span>
                    </button>
                </div>
            </div>
        </div>
    </div>




    <script>
        $(document).ready(function() {

            $('#searchInput').on('keyup', function() {
                let query = $(this).val();

                if (query.length < 2) {
                    $('#suggestions').hide();
                    return;
                }

                $.ajax({
                    url: "{{ route('products.search') }}",
                    type: "GET",
                    data: {
                        query: query
                    },
                    success: function(data) {

                        let html = '';

                        if (data.length > 0) {
                            data.forEach(product => {
                                html += `
                            <a href="/shop/${product.id}"
                               class="list-group-item list-group-item-action">
                                ${product.name}
                            </a>
                        `;
                            });
                        } else {
                            html = `<div class="list-group-item">No results</div>`;
                        }

                        $('#suggestions').html(html).show();
                    }
                });
            });

            // hide when click outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('#searchInput').length) {
                    $('#suggestions').hide();
                }
            });

        });
    </script>
</header>
