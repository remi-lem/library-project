@php
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Route;
    $containerNav = $containerNav ?? 'container-fluid';
    $navbarDetached = ($navbarDetached ?? '');
@endphp
    <!-- Navbar -->
@if(isset($navbarDetached) && $navbarDetached == 'navbar-detached')
    <nav class="layout-navbar {{$containerNav}} navbar navbar-expand-xl {{$navbarDetached}} align-items-center bg-navbar-theme" id="layout-navbar">
        @endif
        @if(isset($navbarDetached) && $navbarDetached == '')
            <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
                <div class="{{$containerNav}}">
                    @endif

                    <!--  Brand demo (display only for navbar-full and hide on below xl) -->
                    @if(isset($navbarFull))
                        <div class="navbar-brand app-brand d-none d-xl-flex py-0 me-4">
                            <a href="{{url('/')}}" class="app-brand-link gap-2">
                                <span class="app-brand-logo"><img src="{{ asset('Bibliothech.png') }}" alt="App logo"></span>
                                <span class="app-brand-text menu-text fw-bold text-heading">{{config('variables.templateName')}}</span>
                            </a>
                        </div>
                    @endif

                    <!-- ! Not required for layout-without-menu -->
                    @if(!isset($navbarHideToggle))
                        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0{{ isset($menuHorizontal) ? ' d-xl-none ' : '' }} {{ isset($contentNavbar) ?' d-xl-none ' : '' }}">
                            <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
                                <i class="bx bx-menu bx-md"></i>
                            </a>
                        </div>
                    @endif

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <!-- Search -->
                        {{--<div class="navbar-nav align-items-center">
                          <div class="nav-item d-flex align-items-center">
                            <i class="bx bx-search bx-md"></i>
                            <input type="text" class="form-control border-0 shadow-none ps-1 ps-sm-2" placeholder="Search..." aria-label="Search...">
                          </div>
                        </div>--}}
                        <!-- /Search -->
                        <ul class="navbar-nav flex-row align-items-center ms-auto">

                            <!-- Place this tag where you want the button to render. -->
                            {{--<li class="nav-item lh-1 me-4">
                              <a class="github-button" href="{{config('variables.repository')}}" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star themeselection/sneat-html-laravel-admin-template-free on GitHub">Star</a>
                            </li>--}}

                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                @auth
                                <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown">
                                    <div class="avatar">
                                        <i class="bx bx-user-circle me-3 w-px-40 h-auto rounded-circle" style="font-size: 40px;"></i>
                                    </div>
                                </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="{{route('profile.edit')}}">
                                                <i class="bx bx-user bx-md me-3"></i><span>Mon profil</span>
                                            </a>
                                        </li>
                                        <li>
                                            <div class="dropdown-divider my-1"></div>
                                        </li>
                                        <li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf

                                                <a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                                    <i class="bx bx-power-off bx-md me-3"></i><span>Se déconnecter</span>
                                                </a>
                                            </form>
                                        </li>

                                    </ul>
                                @endauth
                                @guest
                                    <a class="nav-link dropdown-toggle hide-arrow p-0" href="{{route('login')}}">
                                        <div class="avatar">
                                            <i class="bx bx-user-circle me-3 w-px-40 h-auto rounded-circle" style="font-size: 40px;"></i>
                                        </div>
                                    </a>
                                @endguest
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>

                    @if(!isset($navbarDetached))
                </div>
                @endif
            </nav>
            <!-- / Navbar -->
