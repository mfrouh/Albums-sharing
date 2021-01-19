<!-- main-sidebar -->
		<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
		<aside class="app-sidebar sidebar-scroll">
			<div class="main-sidebar-header active">

				<a class="desktop-logo logo-light active" href="{{ url('/') }}"><img src="{{URL::asset('images/logo-m.png')}}" class="main-logo" alt="logo"></a>
				<a class="desktop-logo logo-dark active" href="{{ url('/') }}"><img src="{{URL::asset('images/logo-m.png')}}" class="main-logo dark-theme" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-light active" href="{{ url('/') }}"><img src="{{URL::asset('images/logo-m.png')}}" class="logo-icon" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-dark active" href="{{ url('/') }}"><img src="{{URL::asset('images/logo-m.png')}}" class="logo-icon dark-theme" alt="logo"></a>
			</div>
			<div class="main-sidemenu">
				<div class="app-sidebar__user clearfix">
					<div class="dropdown user-pro-body">
						<div class="">
							<img class="avatar avatar-xl brround" src="{{URL::asset('images/1.jpg')}}"><span class="avatar-status profile-status bg-green"></span>
						</div>
						<div class="user-info">
							<h4 class="font-weight-semibold mt-3 mb-0">{{auth()->user()->name}}</h4>
						</div>
					</div>
				</div>
				<ul class="side-menu">
					<li class="slide">
						<a class="side-menu__item" href="{{ url('/dashboard' ) }}"><span class="side-menu__label">Dashboard</a>
                    </li>
                    @can('view roles')
                    <li class="slide">
						<a class="side-menu__item" href="{{ url('/roles' ) }}"><span class="side-menu__label">Roles</a>                        </li>
                    @endcan
                    @can('view permissions')
                    <li class="slide">
						<a class="side-menu__item" href="{{ url('/permissions' ) }}"><span class="side-menu__label">Permissions</a>                        </li>
                    @endcan
                    @can('view all admins')
                    <li class="slide">
						<a class="side-menu__item" href="{{ url('/admins' ) }}"><span class="side-menu__label">Admins</a>
                    </li>
                    @endcan
                    @can('view all users')
                    <li class="slide">
						<a class="side-menu__item" href="{{ url('/users' ) }}"><span class="side-menu__label">Users</a>
                    </li>
                    @endcan
                    @can('view all albums')
                    <li class="slide">
						<a class="side-menu__item" href="{{ url('/albums' ) }}"><span class="side-menu__label">Albums</a>
                    </li>
                    @endcan
                    @can('setting')
                    <li class="slide">
						<a class="side-menu__item" href="{{ url('/setting' ) }}"><span class="side-menu__label">Setting</a>
                    </li>
                    @endcan
				</ul>
			</div>
		</aside>
<!-- main-sidebar -->
