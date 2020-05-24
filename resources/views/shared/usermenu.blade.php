<ul class="navbar-nav ml-auto">
    <!-- Authentication Links -->
    @guest
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
        @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
        @endif
    @else
        <li class="nav-item dropdown">
            <a id="navbarDropdownRight" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->getEmail() }} <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownRight">
            	@can('dashboard')
            	<a class="dropdown-item" href="{{ route('admin.index') }}">{{ __('Dashboard') }}</a>
            	@else
                <a class="dropdown-item" href="{{ route('home.index') }}">{{ __('Home') }}</a>
                @endcan
                @if (Route::has('profile.edit'))
                <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Your Profile') }}</a>
                @endif
                @if (Route::has('password.edit'))
            	<a class="dropdown-item" href="{{ route('password.edit') }}">{{ __('Change Password') }}</a>
            	@endif
            	@if (Route::has('email.edit'))
            	<a class="dropdown-item" href="{{ route('email.edit') }}">{{ __('Change Email') }}</a>
            	@endif
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    @endguest
</ul>