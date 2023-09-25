<div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{route('admin.logo-setting-update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <img src="{{asset(@$logoSetting->logo)}}" width="150px" alt="">
                    <br>
                    <label>Logo</label>
                    <input type="file" class="form-control" name="logo" value="">
                    <input type="hidden" class="form-control" name="old_logo" value="{{@$logoSetting->logo}}">

                </div>

                <div class="form-group">
                    <img src="{{asset(@$logoSetting->favicon)}}" width="150px" alt="">
                    <br>
                    <label>Favicon</label>
                    <input type="file" class="form-control" name="favicon" value="">
                    <input type="hidden" class="form-control" name="old_favicon" value="{{@$logoSetting->favicon}}">

                </div>

            

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
