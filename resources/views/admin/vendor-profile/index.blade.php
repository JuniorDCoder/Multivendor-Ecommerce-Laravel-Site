@extends('admin.layouts.master')

@section('content')
      <!-- Main Content -->
        <section class="section">
          <div class="section-header">
            <h1>Vendor Profile</h1>

          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Update Vendor Profile</h4>
                  </div>
                  <div class="card-body">
                    <form action="{{route('admin.vendor-profile.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Preview</label>
                            <br>
                            <img width="200px" src="{{asset($profile->banner)}}" alt="">
                        </div>
                        <div class="form-group">
                            <label>Banner</label>
                            <input type="file" class="form-control" name="banner">
                        </div>

                        <div class="form-group">
                            <label>Shop Name</label>
                            <input type="text" class="form-control" name="shop_name" value="{{$profile->shop_name}}">
                        </div>

                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" class="form-control" name="phone" value="{{$profile->phone}}">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email"  value="{{$profile->email}}">
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" class="form-control" name="address" value="{{$profile->address}}">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="summernote" name="description">{{$profile->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Facebook</label>
                            <input type="text" class="form-control" name="fb_link" value="{{$profile->fb_link}}">
                        </div>
                        <div class="form-group">
                            <label>Twitter</label>
                            <input type="text" class="form-control" name="tw_link" value="{{$profile->tw_link}}">
                        </div>
                        <div class="form-group">
                            <label>Instagram</label>
                            <input type="text" class="form-control" name="insta_link" value="{{$profile->insta_link}}">
                        </div>

                        <button type="submmit" class="btn btn-primary">Update</button>
                    </form>
                  </div>

                </div>
              </div>
            </div>

          </div>
        </section>
@endsection

