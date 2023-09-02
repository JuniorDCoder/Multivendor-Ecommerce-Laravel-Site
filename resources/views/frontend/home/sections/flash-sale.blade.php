<section id="wsus__flash_sell" class="wsus__flash_sell_2">
    <div class=" container">
        <div class="row">
            <div class="col-xl-12">
                <div class="offer_time" style="background: url({{asset('frontend/images/flash_sell_bg.jpg')}})">
                    <div class="wsus__flash_coundown">
                        <span class=" end_text">Flash Sale</span>
                        <div class="simply-countdown simply-countdown-one"></div>
                        <a class="common_btn" href="{{route('flash-sale')}}">see more <i class="fas fa-caret-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row flash_sell_slider">
            @foreach ($flashSaleItems as $item)
            @php
                $product = \App\Models\Product::with('reviews')->find($item->product_id);
            @endphp
            <div class="col-xl-3 col-sm-6 col-lg-4">
                <div class="wsus__product_item">
                    <span class="wsus__new">{{productType($product->product_type)}}</span>
                    @if(checkDiscount($product))
                        <span class="wsus__minus">-{{calculateDiscountPercent($product->price, $product->offer_price)}}%</span>
                    @endif
                    <a class="wsus__pro_link" href="{{route('product-detail', $product->slug)}}">
                        <img src="{{asset($product->thumb_image)}}" alt="product" class="img-fluid w-100 img_1" />
                        <img src="
                        @if(isset($product->productImageGalleries[0]->image))
                            {{asset($product->productImageGalleries[0]->image)}}
                        @else
                            {{asset($product->thumb_image)}}
                        @endif
                        " alt="product" class="img-fluid w-100 img_2" />
                    </a>
                    <ul class="wsus__single_pro_icon">
                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$product->id}}"><i
                                    class="far fa-eye"></i></a></li>
                        <li><a href="" class="add_to_wishlist" data-id="{{$product->id}}"><i class="far fa-heart"></i></a></li>
                        {{-- <li><a href="#"><i class="far fa-random"></i></a> --}}
                    </ul>
                    <div class="wsus__product_details">
                        <a class="wsus__category" href="#">{{$product->category->name}} </a>

                        <p class="wsus__pro_rating">
                            @php
                                $avgRating = $product->reviews()->avg('rating');
                                $fullRating = round($avgRating);
                            @endphp

                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $fullRating)
                                <i class="fas fa-star"></i>
                                @else
                                <i class="far fa-star"></i>
                                @endif
                            @endfor

                            <span>({{count($product->reviews)}} review)</span>
                        </p>
                        <a class="wsus__pro_name" href="{{route('product-detail', $product->slug)}}">{{limitText($product->name, 52)}}</a>
                        @if(checkDiscount($product))
                            <p class="wsus__price">{{$settings->currency_icon}}{{$product->offer_price}} <del>{{$settings->currency_icon}}{{$product->price}}</del></p>
                        @else
                            <p class="wsus__price">{{$settings->currency_icon}}{{$product->price}}</p>
                        @endif
                        <form class="shopping-cart-form">
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            @foreach ($product->variants as $variant)
                            @if ($variant->status != 0)
                                <select class="d-none" name="variants_items[]">
                                    @foreach ($variant->productVariantItems as $variantItem)
                                        @if ($variantItem->status != 0)
                                            <option value="{{$variantItem->id}}" {{$variantItem->is_default == 1 ? 'selected' : ''}}>{{$variantItem->name}} (${{$variantItem->price}})</option>
                                        @endif
                                    @endforeach
                                </select>
                            @endif
                            @endforeach
                            <input class="" name="qty" type="hidden" min="1" max="100" value="1" />
                            <button class="add_cart" type="submit">add to cart</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>

<!--==========================
    PRODUCT MODAL VIEW START
===========================-->
@foreach ($flashSaleItems as $item)
@php
    $product = \App\Models\Product::with('reviews')->find($item->product_id);
@endphp

<section class="product_popup_modal">
    <div class="modal fade" id="exampleModal-{{$product->id}}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                            class="far fa-times"></i></button>
                    <div class="row">
                        <div class="col-xl-6 col-12 col-sm-10 col-md-8 col-lg-6 m-auto display">
                            <div class="wsus__quick_view_img">
                                @if ($product->video_link)
                                    <a class="venobox wsus__pro_det_video" data-autoplay="true" data-vbtype="video"
                                        href="{{$product->video_link}}">
                                        <i class="fas fa-play"></i>
                                    </a>
                                @endif
                                <div class="row modal_slider">
                                    <div class="col-xl-12">
                                        <div class="modal_slider_img">
                                            <img src="{{asset($product->thumb_image)}}" alt="product" class="img-fluid w-100">
                                        </div>
                                    </div>

                                    @if(count($product->productImageGalleries) === 0)
                                        <div class="col-xl-12">
                                            <div class="modal_slider_img">
                                                <img src="{{asset($product->thumb_image)}}" alt="product" class="img-fluid w-100">
                                            </div>
                                        </div>
                                    @endif

                                    @foreach ($product->productImageGalleries as $productImage)
                                    <div class="col-xl-12">
                                        <div class="modal_slider_img">
                                            <img src="{{asset($productImage->image)}}" alt="{{$product->name}}" class="img-fluid w-100">
                                        </div>
                                    </div>
                                    @endforeach


                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="wsus__pro_details_text">
                                <a class="title" href="#">{{$product->name}}</a>
                                <p class="wsus__stock_area"><span class="in_stock">in stock</span> (167 item)</p>
                                @if (checkDiscount($product))
                                    <h4>{{$settings->currency_icon}}{{$product->offer_price}} <del>{{$settings->currency_icon}}{{$product->price}}</del></h4>
                                @else
                                    <h4>{{$settings->currency_icon}}{{$product->price}}</h4>
                                @endif
                                <p class="review">
                                @php
                                    $avgRating = $product->reviews()->avg('rating');
                                    $fullRating = round($avgRating);
                                @endphp

                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $fullRating)
                                    <i class="fas fa-star"></i>
                                    @else
                                    <i class="far fa-star"></i>
                                    @endif
                                @endfor

                                <span>({{count($product->reviews)}} review)</span>
                                </p>
                                <p class="description">{!! $product->short_description !!}</p>

                                <form class="shopping-cart-form">
                                    <div class="wsus__selectbox">
                                        <div class="row">
                                            <input type="hidden" name="product_id" value="{{$product->id}}">
                                            @foreach ($product->variants as $variant)
                                            @if ($variant->status != 0)
                                            <div class="col-xl-6 col-sm-6">
                                                <h5 class="mb-2">{{$variant->name}}: </h5>
                                                <select class="select_2" name="variants_items[]">
                                                    @foreach ($variant->productVariantItems as $variantItem)
                                                    @if ($variantItem->status != 0)
                                                        <option value="{{$variantItem->id}}" {{$variantItem->is_default == 1 ? 'selected' : ''}}>{{$variantItem->name}} (${{$variantItem->price}})</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            @endif
                                            @endforeach

                                        </div>
                                    </div>

                                    <div class="wsus__quentity">
                                        <h5>quentity :</h5>
                                        <div class="select_number">
                                            <input class="number_area" name="qty" type="text" min="1" max="100" value="1" />
                                        </div>

                                    </div>

                                    <ul class="wsus__button_area">
                                        <li><button type="submit" class="add_cart" href="#">add to cart</button></li>
                                        
                                        <li><a href="" class="add_to_wishlist" data-id="{{$product->id}}"><i class="fal fa-heart"></i></a></li>
                                        {{-- <li><a href="#"><i class="far fa-random"></i></a></li> --}}
                                    </ul>
                                </form>

                                <p class="brand_model"><span>brand :</span> {{$product->brand->name}}</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endforeach
<!--==========================
    PRODUCT MODAL VIEW END
===========================-->

@push('scripts')
<script>
    $(document).ready(function(){
        simplyCountdown('.simply-countdown-one', {
            year: {{date('Y', strtotime($flashSaleDate->end_date))}},
            month: {{date('m', strtotime($flashSaleDate->end_date))}},
            day: {{date('d', strtotime($flashSaleDate->end_date))}},
        });
    })
</script>
@endpush
