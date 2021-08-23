  <div class="sidebar-profile">
      <!-- <strong class="h3 title__profile text-center d-block mb-4"> <span>User Profile</span> <span class="btn-toggle-menu"><i class="fas fa-bars"></i></span></strong> -->
      <ul>
          <li><a href="{{route('customer.profile.index')}}"  class=" {{$profile_page=="profile"?'active':''}} "> <i class="far fa-user fa-lg"></i>@lang('site.Basic Info')</a></li>
          <li><a href="{{route('customer.profile.orders')}} "  class=" {{$profile_page=="orders"?'active':''}} " > <i class="icon-box fa-lg"></i> @lang('site.orders')</a></li>
          <li><a href="{{route('customer.profile.password.change')}}"  class=" {{$profile_page=="Change_password"?'active':''}} " > <i class="fas fa-lock fa-lg"></i>@lang('site.Change_password') </a></li>
          <li><a href="{{route('customer.profile.logout')}}"> <i class="fas fa-sign-out-alt fa-lg"  class=" {{$profile_page=="logout"?'active':''}}"  ></i> @lang('site.Logout')</a></li>
      </ul>
  </div>
