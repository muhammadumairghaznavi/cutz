<form method="post" action="{{route('customer.checkout')}}" class="checkout-form">
    @csrf
    @method('POST')
    <div class="form-chkout form-chkout2">
        <div class="row">
            <div class="col-md-12 mb-4">

                {{-- <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment_method" checked value="cach" id="dis-shipping">
                    <label class="form-check-label" for="dis-shipping">Cash On Delivery</label>
                </div> --}}

                <div class="form-group">
                    <div class="custom-control custom-radio border-0">
                        <input type="radio" class="custom-control-input" name="payment_method" checked value="cach" id="dis-shipping">
                        <label class="custom-control-label" for="dis-shipping">
                            Cash On Delivery
                        </label>
                    </div>
                </div>

                <!-- <script>
                    let freeShipping = document.querySelector("#free-shipping");
                    let disShipping = document.querySelector("#dis-shipping");
                    let boxDisShipping = document.querySelector(".dis_shipping");
                    let boxFreeShipping = document.querySelector(".free_shipping");
                    freeShipping.addEventListener('change', () => {
                        boxFreeShipping.style.display = 'block';
                        boxDisShipping.style.display = 'none';
                    });
                    disShipping.addEventListener('change', () => {
                        boxDisShipping.style.display = 'block';
                        boxFreeShipping.style.display = 'none';
                    });
                </script> -->


            </div>



            <div class="col-md-12 mb-4 text-center">
                  <a href="{{route('customer.cart.index')}}" class="btn btn-primary btn-chkout mx-4"><i class="fas fa-sync"></i> @lang('site.chage_my_cart')</a>
                <input type="submit" class="btn btn-primary btn-chkout btn_to_chkout px-5" value="Confirm Order">
            </div>
        </div>
    </div>

</form>
