   <div class="form-group">
       <label>@lang('site.Our Best Sellers') </label>
       <select name="best_seller" class="form-control ">
           <option value="not_active">@lang('site.not_active')</option>
           <option value="active">@lang('site.active')</option>
       </select>
   </div>
   <div class="form-group">
       <label>@lang('site.BBQ') </label>
       <select name="falg" class="form-control ">
           <option value="no">@lang('site.no')</option>
           <option value="yes">@lang('site.yes')</option>
       </select>
   </div>
   <div class="form-group">
       <label>@lang('site.panSearing') </label>
       <select name="panSearing" class="form-control ">
           <option value="no">@lang('site.no')</option>
           <option value="yes">@lang('site.yes')</option>
       </select>
   </div>
   <div class="form-group">
       <label>@lang('site.chilies') </label>
       <select name="chilies" class="form-control ">
           <option value="no">@lang('site.no')</option>
           <option value="yes">@lang('site.yes')</option>
       </select>
   </div>
   <div class="form-group">
       <label>@lang('site.frozen') </label>
       <select name="frozen" class="form-control ">
           <option value="no">@lang('site.no')</option>
           <option value="yes">@lang('site.yes')</option>
       </select>
   </div>
   <div class="form-group">
       <label>@lang('site.hermonFree') </label>
       <select name="hermonFree" class="form-control ">
           <option value="yes">@lang('site.yes')</option>
           {{-- <option value="no">@lang('site.no')</option> --}}
       </select>
   </div>
   <div class="form-group">
       <label>@lang('site.spicail_pag') </label>
       <select name="spicail_pag" class="form-control ">
           <option value="not_active">@lang('site.not_active')</option>
           <option value="active">@lang('site.active')</option>
       </select>
   </div>
   <div class="form-group">
       <label>@lang('site.roasting') roasting </label>
       <select name="roasting" class="form-control ">
           <option value="no">@lang('site.no')</option>
           <option value="yes">@lang('site.yes')</option>
       </select>
   </div>
   <div class="form-group">
       <label>@lang('site.expiration') </label>
       <textarea name="expiration" class="form-control" cols="30" rows="10">{{old('expiration')}}</textarea>

   </div>
