<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
<div class="card border">
    <div class="card-body">
        <form action="{{route('admin.homepage-banner-secion-one')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="">Status</label>
                <br>
                <label class="custom-switch mt-2">
                    <input type="checkbox" {{$homepage_secion_banner_one->banner_one->status == 1 ? 'checked':''}} name="status" class="custom-switch-input" >
                    <span class="custom-switch-indicator"></span>
                </label>
            </div>
            <div class="form-group">
                <img src="{{asset($homepage_secion_banner_one->banner_one->banner_image)}}" alt="" width="150px">
            </div>
            <div class="form-group">

                <label>Banner Image</label>
                <input type="file" class="form-control" name="banner_image" value="">
                <input type="hidden" class="form-control" name="banner_old_image" value="{{$homepage_secion_banner_one->banner_one->banner_image}}">
            </div>
            <div class="form-group">
                <label>Banner url</label>
                <input type="text" class="form-control" name="banner_url" value="{{$homepage_secion_banner_one->banner_one->banner_url}}">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
</div>
