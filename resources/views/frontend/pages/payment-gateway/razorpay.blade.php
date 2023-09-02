<div class="tab-pane fade" id="v-pills-razorpay" role="tabpanel"
aria-labelledby="v-pills-home-tab">
    <div class="row">
        <div class="col-xl-12 m-auto">
            <div class="wsus__payment_area">
                @php
                    $razorpaySetting = \App\Models\RazorpaySetting::first();
                    $total = getFinalPayableAmount();
                    $payableAmount = round($total * $razorpaySetting->currency_rate, 2);

                @endphp
                <form action="{{route('user.razorpay.payment')}}" method="POST">
                    @csrf
                    <script src="https://checkout.razorpay.com/v1/checkout.js"

                        data-key="{{$razorpaySetting->razorpay_key}}"
                        data-amount="{{$payableAmount * 100}}"
                        data-buttontext="Pay With Razorpay"
                        data-name="payment"
                        data-description="Payment for product"
                        data-prefill.name="{{Auth::user()->name}}"
                        data-prefill.email="{{Auth::user()->email}}"
                        data-theme.color="#ff7529"
                    >

                    </script>
                </form>
            </div>
        </div>
    </div>
</div>
