<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // add product into cart
        $('.shopping-cart-form').on('submit', function(e) {
            e.preventDefault();
            let formData = $(this).serialize();

            $.ajax({
                method: 'POST',
                data: formData,
                url: "{{ route('add-to-cart') }}",
                success: function(data) {
                    if(data.status === 'success'){
                        getCartCount()
                        fetchSidebarCartProducts()
                        $('.mini_cart_actions').removeClass('d-none');
                        toastr.success(data.message);
                    }else if (data.status === 'error'){
                        toastr.error(data.message);
                    }
                },
                error: function(data) {

                }
            })
        })

        function getCartCount() {
            $.ajax({
                method: 'GET',
                url: "{{ route('cart-count') }}",
                success: function(data) {
                    $('#cart-count').text(data);
                },
                error: function(data) {

                }
            })
        }

        function fetchSidebarCartProducts() {
            $.ajax({
                method: 'GET',
                url: "{{ route('cart-products') }}",
                success: function(data) {
                    console.log(data);
                    $('.mini_cart_wrapper').html("");
                    var html = '';
                    for (let item in data) {
                        let product = data[item];
                        html += `
                        <li id="mini_cart_${product.rowId}">
                            <div class="wsus__cart_img">
                                <a href="{{ url('product-detail') }}/${product.options.slug}"><img src="{{ asset('/') }}${product.options.image}" alt="product" class="img-fluid w-100"></a>
                                <a class="wsis__del_icon remove_sidebar_product" data-id="${product.rowId}" href=""><i class="fas fa-minus-circle"></i></a>
                            </div>
                            <div class="wsus__cart_text">
                                <a class="wsus__cart_title" href="{{ url('product-detail') }}/${product.options.slug}">${product.name}</a>
                                <p>{{ $settings->currency_icon }}${product.price}</p>
                                <small>Variants total: {{ $settings->currency_icon }}${product.options.variants_total}</small>
                                <br>
                                <small>Qty: ${product.qty}</small>
                            </div>
                        </li>`
                    }

                    $('.mini_cart_wrapper').html(html);

                    getSidebarCartSubtoal();

                },
                error: function(data) {

                }
            })
        }

        // reomove product from sidebar cart
        $('body').on('click', '.remove_sidebar_product', function(e) {
            e.preventDefault()
            let rowId = $(this).data('id');
            $.ajax({
                method: 'POST',
                url: "{{ route('cart.remove-sidebar-product') }}",
                data: {
                    rowId: rowId
                },
                success: function(data) {
                    let productId = '#mini_cart_' + rowId;
                    $(productId).remove()

                    getSidebarCartSubtoal()

                    if ($('.mini_cart_wrapper').find('li').length === 0) {
                        $('.mini_cart_actions').addClass('d-none');
                        $('.mini_cart_wrapper').html(
                            '<li class="text-center">Cart Is Empty!</li>');
                    }
                    toastr.success(data.message)
                },
                error: function(data) {
                    console.log(data);
                }
            })
        })

        // get sidebar cart sub total
        function getSidebarCartSubtoal() {
            $.ajax({
                method: 'GET',
                url: "{{ route('cart.sidebar-product-total') }}",
                success: function(data) {
                    $('#mini_cart_subtotal').text("{{ $settings->currency_icon }}" + data);
                },
                error: function(data) {

                }
            })
        }

        // add product to wishlist
        $('.add_to_wishlist').on('click', function(e){
            e.preventDefault();
            let id = $(this).data('id');

            $.ajax({
                method: 'GET',
                url: "{{route('user.wishlist.store')}}",
                data: {id:id},
                success:function(data){
                    if(data.status === 'success'){
                        $('#wishlist_count').text(data.count)
                        toastr.success(data.message);
                    }else if(data.status === 'error'){
                        toastr.error(data.message);
                    }
                },
                error: function(data){
                    console.log(data);
                }
            })
        })

        // newsletter
        $('#newsletter').on('submit', function(e){
            e.preventDefault();
            let data = $(this).serialize();

            $.ajax({
                method: 'POST',
                url: "{{route('newsletter-request')}}",
                data: data,
                beforeSend: function(){
                    $('.subscribe_btn').text('Loading...');
                },
                success: function(data){
                    if(data.status === 'success'){
                        $('.subscribe_btn').text('Subscribe');
                        $('.newsletter_email').val('');
                        toastr.success(data.message);

                    }else if(data.status === 'error'){

                        $('.subscribe_btn').text('Subscribe');
                        toastr.error(data.message);
                    }
                },
                error: function(data){
                    let errors = data.responseJSON.errors;
                    if(errors){
                        $.each(errors, function(key, value){
                            toastr.error(value);
                        })
                    }
                    $('.subscribe_btn').text('Subscribe');
                }
            })
        })


    })
</script>
