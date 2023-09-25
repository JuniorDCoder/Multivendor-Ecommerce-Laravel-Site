@extends('admin.layouts.master')

@section('content')
      <!-- Main Content -->
        <section class="section">
          <div class="section-header">
            <h1>Product</h1>

          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Create Product</h4>
                  </div>
                  <div class="card-body">
                    <form action="{{route('admin.products.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" class="form-control" name="image">
                        </div>

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="{{old('name')}}">
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputState">Category</label>
                                    <select id="inputState" class="form-control main-category" name="category">
                                      <option value="">Select</option>
                                      @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                      @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputState">Sub Category</label>
                                    <select id="inputState" class="form-control sub-category" name="sub_category">
                                        <option value="">Select</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputState">Child Category</label>
                                    <select id="inputState" class="form-control child-category" name="child_category">
                                        <option value="">Select</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="inputState">Brand</label>
                            <select id="inputState" class="form-control" name="brand">
                                <option value="">Select</option>
                                @foreach ($brands as $brand)
                                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>SKU</label>
                            <input type="text" class="form-control" name="sku" value="{{old('sku')}}">
                        </div>

                        <div class="form-group">
                            <label>Price</label>
                            <input type="text" class="form-control" name="price" value="{{old('price')}}">
                        </div>

                        <div class="form-group">
                            <label>Offer Price</label>
                            <input type="text" class="form-control" name="offer_price" value="{{old('offer_price')}}">
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Offer Start Date</label>
                                    <input type="text" class="form-control datepicker" name="offer_start_date" value="{{old('offer_start_date')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Offer End Date</label>
                                    <input type="text" class="form-control datepicker" name="offer_end_date" value="{{old('offer_end_date')}}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Stock Quantity</label>
                            <input type="number" min="0" class="form-control" name="qty" value="{{old('qty')}}">
                        </div>

                        <div class="form-group">
                            <label>Video Link</label>
                            <input type="text" class="form-control" name="video_link" value="{{old('video_link')}}">
                        </div>


                        <div class="form-group">
                            <label>Short Description</label>
                            <textarea name="short_description" class="form-control"></textarea>
                        </div>


                        <div class="form-group">
                            <label>Long Description</label>
                            <textarea name="long_description" class="form-control summernote"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="inputState">Product Type</label>
                            <select id="inputState" class="form-control" name="product_type">
                                <option value="">Select</option>
                                <option value="new_arrival">New Arrival</option>
                                <option value="featured_product">Featured</option>
                                <option value="top_product">Top Product</option>
                                <option value="best_product">Best Product</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Seo Title</label>
                            <input type="text" class="form-control" name="seo_title" value="{{old('seo_title')}}">
                        </div>

                        <div class="form-group">
                            <label>Seo Description</label>
                            <textarea name="seo_description" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="inputState">Status</label>
                            <select id="inputState" class="form-control" name="status">
                              <option value="1">Active</option>
                              <option value="0">Inactive</option>
                            </select>
                        </div>
                        <button type="submmit" class="btn btn-primary">Create</button>
                    </form>
                  </div>

                </div>
              </div>
            </div>

          </div>
        </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            $('body').on('change', '.main-category', function(e){
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
