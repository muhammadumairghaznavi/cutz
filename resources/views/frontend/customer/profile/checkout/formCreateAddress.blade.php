     @include('partials._errors')
    <form action="{{route('customer.checkout.create_address')}}" method="POST">
        @csrf
        <div class="form-chkout">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label for="">@lang('site.first_name') *</label>
                    <input type="text" class="form-control {{ $errors->has('frirstName') ? ' is-invalid' : '' }}"
                        placeholder="@lang('site.first_name')" value="{{old('frirstName',$f_name)}}" name="frirstName" id="">
                </div>
                <div class="col-md-6 mb-4">
                    <label for="">@lang('site.last_name') *</label>
                    <input type="text" class="form-control {{ $errors->has('lastName') ? ' is-invalid' : '' }}"
                        placeholder="@lang('site.last_name')" value="{{old('lastName',$l_name)}}" name="lastName" id="">
                </div>
                <div class="col-md-12 mb-4">
                    <label for=""> @lang('site.phone') *</label>
                    <input type="text"  class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}"
                        placeholder="@lang('site.phone')" value="{{old('phone',$phone)}}"  name="phone" id="">
                </div>
                <div class="col-md-6 mb-4">
                    <label>@lang('site.cities')</label>
                    <select name='city_id'
                        class="form-control {{ $errors->has('city_id') ? ' is-invalid' : '' }} city_id"
                        required="required">
                        <option value="">@lang('site.cities')</option>
                        @foreach($cities as $city )
                        <option value="{{$city->id}}" @if(old('city_id')==$city->id ) selected
                            @endif>{{$city->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-4">
                    <label>@lang('site.states')</label>
                    <input type="text" name="customer_region"   class="form-control {{ $errors->has('customer_region') ? ' is-invalid' : '' }} "  required="required">
                    {{-- <select name='state_id' id="state_id"
                        class="form-control {{ $errors->has('state_id') ? ' is-invalid' : '' }} " required="required">
                        <option value="">@lang('site.states')</option>
                    </select> --}}
                </div>
                  <div class="col-md-3 mb-4">
                    <label>@lang('site.street')</label>
                    <input type="text" value="{{old('street')}}" name="street" class="form-control {{$errors->has('street')?'is-invalid':''}}">
                </div>

                  <div class="col-md-3 mb-4">
                    <label>@lang('site.home_number')</label>
                    <input type="text" value="{{old('home_number')}}" name="home_number" class="form-control {{$errors->has('home_number')?'is-invalid':''}}">
                </div>
                  <div class="col-md-3 mb-4">
                    <label>@lang('site.floor_number')</label>
                    <input type="text" value="{{old('floor_number')}}" name="floor_number" class="form-control {{$errors->has('floor_number')?'is-invalid':''}}">
                </div>

                 {{-- <div class="col-md-3 mb-4">
                    <label>@lang('site.postal_code')</label>
                    <input type="text" value="{{old('postal_code')}}" name="postal_code" class="form-control {{$errors->has('postal_code')?'is-invalid':''}}">
                </div> --}}


                <div class="col-md-12 mb-4">
                    <label for="">@lang('site.ST.Name / Building number / Apartment number') *</label>
                    <textarea class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}" name="address"
                        placeholder="@lang('site.ST.Name / Building number / Apartment number')"></textarea>
                </div>

                <div class="col-md-12 mb-4">
                    <label for="">@lang('site.notes')</label>
                    <textarea class="form-control {{ $errors->has('notes') ? ' is-invalid' : '' }}" name="notes"
                        placeholder="@lang('site.notes')"></textarea>
                </div>



                <div class="col-md-12 mb-4 text-end">
                    <input type="submit" class="btn btn-primary btn-chkout" value="@lang('site.Continue to Processing')">
                </div>
            </div>
        </div>
    </form>
