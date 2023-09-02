@php
    $sliderSectionThree = json_decode($sliderSectionThree->value, true);

@endphp
<div class="tab-pane fade" id="list-slider-three" role="tabpanel" aria-labelledby="list-settings-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{route('admin.product-slider-section-three')}}" method="POST">
                @csrf
                @method('PUT')

                <h5>Part 1</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Category</label>
                            <select name="cat_one" class="form-control main-category">
                                <option value="">Select</option>
                                @foreach ($categories as $category)
                                    <option {{$category->id == $sliderSectionThree[0]['category'] ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            @php
                             $subCategories = \App\Models\SubCategory::where('category_id', $sliderSectionThree[0]['category'])->get();
                            @endphp

                            <label>Sub Category</label>
                            <select name="sub_cat_one" id="" class="form-control sub-category">
                                <option value="">select</option>
                                @foreach ($subCategories as $subCategory)
                                <option {{$subCategory->id == $sliderSectionThree[0]['sub_category'] ? 'selected' : ''}} value="{{$subCategory->id}}">{{ $subCategory->name }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            @php
                            $childCategories = \App\Models\ChildCategory::where('sub_category_id', $sliderSectionThree[0]['sub_category'])->get();
                            @endphp
                            <label>Child Category</label>
                            <select name="child_cat_one" id="" class="form-control child-category">
                                <option value="">select</option>
                                @foreach ($childCategories as $childCategory)
                                    <option {{$childCategory->id ==  $sliderSectionThree[0]['child_category'] ? 'selected' : ''}} value="{{$childCategory->id}}">{{ $childCategory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <h5>Part 2</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Category</label>
                            <select name="cat_two" class="form-control main-category">
                                <option value="">Select</option>
                                @foreach ($categories as $category)
                                    <option {{$category->id == $sliderSectionThree[1]['category'] ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            @php
                             $subCategories = \App\Models\SubCategory::where('category_id', $sliderSectionThree[1]['category'])->get();
                            @endphp

                            <label>Sub Category</label>
                            <select name="sub_cat_two" id="" class="form-control sub-category">
                                <option value="">select</option>
                                @foreach ($subCategories as $subCategory)
                                <option {{$subCategory->id == $sliderSectionThree[1]['sub_category'] ? 'selected' : ''}} value="{{$subCategory->id}}">{{ $subCategory->name }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            @php
                            $childCategories = \App\Models\ChildCategory::where('sub_category_id', $sliderSectionThree[1]['sub_category'])->get();
                            @endphp
                            <label>Child Category</label>
                            <select name="child_cat_two" id="" class="form-control child-category">
                                <option value="">select</option>
                                @foreach ($childCategories as $childCategory)
                                    <option {{$childCategory->id ==  $sliderSectionThree[1]['child_category'] ? 'selected' : ''}} value="{{$childCategory->id}}">{{ $childCategory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>


                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('body').on('change', '.main-category', function(e) {
                let id = $(this).val();
                let row = $(this).closest('.row');

                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.get-subcategories') }}",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        let selector = row.find('.sub-category');
                        selector.html('<option value="">Select</option>')

                        $.each(data, function(i, item) {
                            selector.append(
                                `<option value="${item.id}">${item.name}</option>`)
                        })
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                })
            })

            /** get child categories **/
            $('body').on('change', '.sub-category', function(e) {
                let id = $(this).val();
                let row = $(this).closest('.row');
                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.product.get-child-categories') }}",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        let selector = row.find('.child-category');
                        selector.html('<option value="">Select</option>')

                        $.each(data, function(i, item) {
                            selector.append(
                                `<option value="${item.id}">${item.name}</option>`)
                        })
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                })
            })

        })
    </script>
@endpush
