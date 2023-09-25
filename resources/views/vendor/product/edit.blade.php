@extends('vendor.layouts.master')

@section('title')
{{$settings->site_name}} || Product
@endsection

@section('content')
  <!--=============================
    DASHBOARD START
  ==============================-->
  <section id="wsus__dashboard">
    <div class="container-fluid">
        @include('vendor.layouts.sidebar')

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-user"></i> Create Product</h3>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                <form action="{{route('vendor.products.update', $product->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group wsus__input">
                        <label>Preview</label>
                        <br>
                        <img src="{{asset($product->thumb_image)}}" style="width:200px" alt="">
                    </div>
                    <div class="form-group wsus__input">
                        <label>Image</label>
                        <input type="file" class="form-control" name="image">
                    </div>

                    <div class="form-group wsus__input">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="{{$product->name}}">
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group wsus__input">
                                <label for="inputState">Category</label>
                                <select id="inputState" class="form-control main-category" name="category">
                                  <option value="">Select</option>
                                  @foreach ($categories as $category)
                                    <option {{$category->id == $product->category_id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                                  @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group wsus__input">
                                <label for="inputState">Sub Category</label>
                                <select id="inputState" class="form-control sub-category" name="sub_category">
                                    <option value="">Select</option>
                                    @foreach ($subCategories as $subCategory)
                                        <option {{$subCategory->id == $product->sub_category_id ? 'selected' : ''}} value="{{$subCategory->id}}">{{$subCategory->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group wsus__input">
                                <label for="inputState">Child Category</label>
                                <select id="inputState" class="form-control child-category" name="child_category">
                                    <option value="">Select</option>
                                    @foreach ($childCategories as $childCategory)
                                        <option {{$childCategory->id == $product->child_category_id ? 'selected' : ''}} value="{{$childCategory->id}}">{{$childCategory->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="form-group wsus__input">
                        <label for="inputState">Brand</label>
                        <select id="inputState" class="form-control" name="brand">
                            <option value="">Select</option>
                            @foreach ($brands as $brand)
                                <option {{$brand->id == $product->brand_id ? 'selected' : ''}} value="{{$brand->id}}">{{$brand->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group wsus__input">
                        <label>SKU</label>
                        <input type="text" class="form-control" name="sku" value="{{$product->sku}}">
                    </div>

                    <div class="form-group wsus__input">
                        <label>Price</label>
                        <input type="text" class="form-control" name="price" value="{{$product->price}}">
                    </div>

                    <div class="form-group wsus__input">
                        <label>Offer Price</label>
                        <input type="text" class="form-control" name="offer_price" value="{{$product->offer_price}}">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group wsus__input">
                                <label>Offer Start Date</label>
                                <input type="text" class="form-control datepicker" name="offer_start_date" value="{{$product->offer_start_date}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group wsus__input">
                                <label>Offer End Date</label>
                                <input type="text" class="form-control datepicker" name="offer_end_date" value="{{$product->offer_end_date}}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group wsus__input">
                        <label>Stock Quantity</label>
                        <input type="number" min="0" class="form-control" name="qty" value="{{$product->qty}}">
                    </div>

                    <div class="form-group wsus__input">
                        <label>Video Link</label>
                        <input type="text" class="form-control" name="video_link" value="{{$product->video_link}}">
                    </div>


                    <div class="form-group wsus__input">
                        <label>Short Description</label>
                        <textarea name="short_description" class="form-control">{!! $product->short_description !!}</textarea>
                    </div>


                    <div class="form-group wsus__input">
                        <label>Long Description</label>
                        <textarea name="long_description" class="form-control summernote">{!! $product->long_description !!}</textarea>
                    </div>


                    <div class="form-group wsus__input">
                        <label>Seo Title</label>
                        <input type="text" class="form-control" name="seo_title" value="{{$product->seo_title}}">
                    </div>

                    <div class="form-group wsus__input">
                        <label>Seo Description</label>
                        <textarea name="seo_description" class="form-control">{!!$product->seo_description!!}</textarea>
                    </div>

                    <div class="form-group wsus__input">
                        <label for="inputState">Status</label>
                        <select id="inputState" class="form-control" name="status">
                          <option {{$product->status == 1 ? 'selected' : ''}} value="1">Active</option>
                          <option {{$product->status == 0 ? 'selected' : ''}} value="0">Inactive</option>
                        </select>
                    </div>
                    <button type="submmit" class="btn btn-primary">Update</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--=============================
    DASHBOARD START
  ==============================-->
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            $('body').on('change', '.main-category', function(e){

                $('.child-category').html('<option value="">Select</option>')

                let id = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: "{{route('admin.product.get-subcategories')}}",
                    data: {
                        id:id
                    },
                    success: function(data){
                        $('.sub-category').html('<option value="">Select</option>')

                        $.each(data, function(i, item){
                            $('.sub-category').append(`<option value="${item.id}">${item.name}</option>`)
                        })
                    },
                    error: function(xhr, status, error){
                        console.log(error);
                    }
                })
            })


            /** get child categories **/
            $('body').on('change', '.sub-category', function(e){
                let id = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: "{{route('admin.product.get-child-categories')}}",
                    data: {
                        id:id
                    },
                    success: function(data){
                        $('.child-category').html('<option value="">Select</option>')

                        $.each(data, function(i, item){
                            $('.child-category').append(`<option value="${item.id}">${item.name}</option>`)
                        })
                    },
                    error: function(xhr, status, error){
                        console.log(error);
                    }
                })
            })
        })
    </script>
@endpush
