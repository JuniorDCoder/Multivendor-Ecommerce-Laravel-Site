<div class="tab-pane fade " id="list-razorpay" role="tabpanel" aria-labelledby="list-razorpay-list">
<div class="card border">
    <div class="card-body">
        <form action="{{route('admin.razorpay-setting.update', 1)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>RazorPay Status</label>
                <select name="status" id="" class="form-control">
                    <option {{$razorpaySetting->status === 1 ? 'selected' : ''}} value="1">Enable</option>
                    <option {{$razorpaySetting->status === 0 ? 'selected' : ''}} value="0">Disable</option>
                </select>
            </div>


            <div class="form-group">
                <label>Country Name</label>
                <select name="country_name" id="" class="form-control select2">
                    <option value="">Select</option>
                    @foreach (config('settings.country_list') as $country)
                        <option {{$country === $razorpaySetting->country_name ? 'selected' : ''}} value="{{$country}}">{{$country}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Currency Name</label>
                <select name="currency_name" id="" class="form-control select2">
                    <option value="">Select</option>
                    @foreach (config('settings.currecy_list') as $key => $currency)
                        <option {{$currency === $razorpaySetting->currency_name ? 'selected' : ''}} value="{{$currency}}">{{$key}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Currency rate ( Per {{$settings->currency_name}} )</label>
                <input type="text" class="form-control" name="currency_rate" value="{{$razorpaySetting->currency_rate}}">
            </div>

            <div class="form-group">
                <label>RazorPay Key</label>
                <input type="text" class="form-control" name="razorpay_key" value="{{$razorpaySetting->razorpay_key}}">
            </div>
            <div class="form-group">
                <label>Razorpay Secret Key</label>
                <input type="text" class="form-control" name="razorpay_secret_key" value="{{$razorpaySetting->razorpay_secret_key}}">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
</div>

@push('scripts')
    <script>
        $('.select2').select2()
    </script>
@endpush
