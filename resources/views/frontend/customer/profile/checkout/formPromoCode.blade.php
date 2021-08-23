  <div class="col-md-12 mb-4">

      <div class="promocode">
          @if (!session()->has('coupon'))
          {{-- @include('partials._errors') --}}
          <form action="{{route('customer.checkout.applyPromo')}}" method="post">
              {{ csrf_field() }}
              {{ method_field('post') }}
              <div class="input-group mb-3">
                  <input type="text" class="form-control {{ $errors->has('code') ? ' is-invalid' : '' }}" name="code"
                      placeholder="Gift card or discount code" aria-label="Gift card or discount code" />

                  @if ($errors->has('code'))
                  <span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('code') }}</strong></span>
                  @endif
                  <button type="submit">Apply</button>
              </div>
          </form>
          @endif
      </div> {{-- */  promocode --}}
  </div>
