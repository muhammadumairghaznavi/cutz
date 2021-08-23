

     @include('partials._errors')
    <form action="{{route('customer.checkout.create_address')}}" method="POST">
        @csrf
        <div class="form-chkout">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label for="">First Name *</label>
                    <input type="text" class="form-control {{ $errors->has('frirstName') ? ' is-invalid' : '' }}"
                        placeholder="Full Name" name="frirstName" value="{{$address->frirstName}}" id="">
                </div>
                <div class="col-md-6 mb-4">
                    <label for="">Last Name *</label>
                    <input type="text" class="form-control {{ $errors->has('lastName') ? ' is-invalid' : '' }}"
                        placeholder="Full Name" name="lastName"  value="{{$address->lastName}}" id="">
                </div>
                <div class="col-md-12 mb-4">
                    <label for="">Mobile phone number *</label>
                    <input type="text" class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}"
                        placeholder="Phone" name="phone" value="{{$address->phone}}"  id="">
                </div>
                <div class="col-md-6 mb-4">
                    <label>@lang('site.cities')</label>
                    <select name='city_id'
                        class="form-control {{ $errors->has('city_id') ? ' is-invalid' : '' }} city_id"
                        required="required">
                        <option value="">@lang('site.cities')</option>
                        @foreach($cities as $city )
                        <option value="{{$city->id}}" {{$address->city_id==$city->id?"selected":''}}>{{$city->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-4">
                    <label>@lang('site.states')</label>
                    <select name='state_id' id="state_id"
                        class="form-control {{ $errors->has('state_id') ? ' is-invalid' : '' }} " required="required">
                        <option value="">@lang('site.states')</option>
                    </select>
                </div>
                <div class="col-md-12 mb-4">
                    <label for="">ST.Name / Building number / Apartment number *</label>
                    <textarea class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}" name="address"
                        placeholder="St.name/Building number/Apartment number *">{{$address->address}}</textarea>
                </div>
                <div class="col-md-12 mb-4">
                    <label for="">@lang('site.notes')</label>
                    <textarea class="form-control {{ $errors->has('notes') ? ' is-invalid' : '' }}" name="notes"
                        placeholder="@lang('site.notes')">{{$address->notes}}</textarea>
                </div>
                <div class="col-md-12 mb-4 text-end">
                    <input type="submit" class="btn btn-primary btn-chkout" value="Continue to Processing">
                </div>
            </div>
        </div>
    </form>

