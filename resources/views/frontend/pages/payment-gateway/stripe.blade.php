<div class="tab-pane fade show" id="v-pills-stripe" role="tabpanel"
aria-labelledby="v-pills-home-tab">
    <div class="row">
        <div class="col-xl-12 m-auto">
            <div class="wsus__payment_area">
                <form action="{{route('user.stripe.payment')}}" method="POST" id="checkout-form">
                    @csrf
                    <input type="hidden" name="stripe_token" id="stripe-token-id">
                    <div id="card-element" class="form-control"></div>
                    <br>
                    <button class="nav-link common_btn" id="pay-btn" onclick="createToken()" type="button">Pay with Stripe</button>
                </form>
            </div>
        </div>
    </div>
</div>
@php
    $stripeSetting = \App\Models\StripeSetting::first();
@endphp
@push('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
    var stripe = Stripe("{{$stripeSetting->client_id}}");
    var elements = stripe.elements();
    var cardElement = elements.create('card');
    cardElement.mount('#card-element');

    function createToken() {
            document.getElementById("pay-btn").disabled = true;
            stripe.createToken(cardElement).then(function(result) {


                if(typeof result.error != 'undefined') {
                    document.getElementById("pay-btn").disabled = false;
                    alert(result.error.message);
                }

                // creating token success
                if(typeof result.token != 'undefined') {
                    document.getElementById("stripe-token-id").value = result.token.id;
                    document.getElementById('checkout-form').submit();
                }
            });
    }
</script>
@endpush
