<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('dashboard/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p> {{auth()->user()->first_name .auth()->user()->last_name }} </p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <ul class="sidebar-menu" data-widget="tree">
        <li class=" @if($page =='dashboard')   active  @endif "><a href="{{ route('dashboard.index') }}"><i
        class="fa fa-th"></i><span>@lang('site.dashboard')</span></a></li>
            @foreach (getModels() as $index=>$section)
            @if (auth()->user()->hasPermission('read_'.$section))
            <li class=" @if($page ==$section)   active  @endif "><a
                    href="{{ route('dashboard.'.$section.'.index') }}"><i
                        class="fa fa-th"></i><span>@lang('site.'.$section)</span></a></li>
            @endif
            @endforeach
        <li class=""><a href="{{ route('clear') }}"><i
        class="fa fa-circle"></i><span>@lang('site.clear_cach')</span></a></li>
        </ul>
    </section>
</aside>
