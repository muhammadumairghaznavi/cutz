
<div class="sidebar-profile">
     <div class="user-info">
         <img src="{{authCustomer()->image_path}}" class="img-fluid" alt="">
         <strong>{{authCustomer()->full_name}}</strong>
             <p>{{authCustomer()->email}} </p>
     </div>
     <div class="links-profile">
         <span class="toggle-profile-links"><i class="fas fa-bars"></i> <b>@lang('site.Menu')</b></span>
         <ul>
         <li><a href="{{route('customer.profile.index')}}" class="{{$profile_bar=='profile'?'active':''}}"><i class="far fa-user"></i> @lang('site.Personal Information')</a></li>
             <li><a href="{{route('customer.profile.tickets')}}" class="{{$profile_bar=='tickets'?'active':''}}"><i class="fas fa-user-cog"></i> @lang('site.Technical Support')</a>
             </li>
             <li><a href="{{route('customer.invoices.websites')}}" class="{{$profile_bar=='websites'?'active':''}}"><i class="fas fa-file-invoice"></i> @lang('site.orders website')</a></li>
             <li><a href="{{route('customer.invoices.services')}}" class="{{$profile_bar=='services'?'active':''}}"><i class="fas fa-file-invoice"></i> @lang('site.orders services')</a></li>
             <li><a href="{{route('customer.invoices.apps')}}" class="{{$profile_bar=='apps'?'active':''}}"><i class="fas fa-file-invoice"></i> @lang('site.orders apps')</a></li>

             <li><a href="{{route('customer.profile.logout')}}"><i class="fas fa-sign-out-alt"></i> @lang('site.Logout')</a></li>
         </ul>
     </div>
 </div>

