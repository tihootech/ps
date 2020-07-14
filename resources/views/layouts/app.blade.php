<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8" />
        <title>@yield('title', 'PS')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('img/favicon.jpg')}}">


        <!-- App css -->
        <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/jquery-ui.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/metisMenu.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/app.css')}}" rel="stylesheet" type="text/css" />

    </head>

    <body data-layout="horizontal">

        @auth
            <div class="topbar">

               <div class="navbar-custom-menu">
                   <div class="container-fluid">
                       <div id="navigation">
                           <!-- Navigation Menu-->
                           <ul class="navigation-menu">

                               <li>
                                   <a href="{{route('home')}}">
                                       <i class="dripicons-home"></i>
                                       <span>Home</span>
                                   </a>
                               </li>

                               <li>
                                   <a href="{{route('results')}}">
                                       <i class="dripicons-graph-bar"></i>
                                       <span>Results</span>
                                   </a>
                               </li>

                               <li>
                                   <a href="{{route('star.index')}}">
                                       <i class="dripicons-star"></i>
                                       <span>Stars</span>
                                   </a>
                               </li>

                               <li>
                                   <a href="{{route('point.index')}}">
                                       <i class="dripicons-folder-open"></i>
                                       <span>Points</span>
                                   </a>
                               </li>

                               <li>
                                   <a href="{{route('prixes')}}">
                                       <i class="dripicons-graph-line"></i>
                                       <span>Prixes</span>
                                   </a>
                               </li>

                               <li class="has-submenu">
                                   <a href="#">
                                       <i class="dripicons-view-thumb"></i>
                                       <span>More Actions</span>
                                   </a>
                                   <ul class="submenu">

                                       <li><a href="{{route('statics')}}"><i class="dripicons-dot"></i> Statics </a></li>
                                       <li><a href="{{route('award.assign')}}"><i class="dripicons-dot"></i> Assign Award </a></li>
                                       <li><a href="{{route('image.upload_form')}}"><i class="dripicons-dot"></i> Upload Image </a></li>
                                       <li><a href="{{route('settings')}}"><i class="dripicons-dot"></i> Settings </a></li>
                                       <div class="dropdown-divider"></div>
                                       <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                           @csrf
                                       </form>
                                       <li><a href="javascript:void" onclick="$('#logout-form').submit()"><i class="dripicons-dot"></i> Logout </a></li>

                                   </ul>
                               </li>

                           </ul>

                           <div class="float-right">
                               <form class="pt-2 mt-1" action="{{route('home')}}" method="get">
                                   <input type="text" name="search" class="form-control" placeholder="Search..." id="header-search">
                               </form>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
        @endauth

        <div class="page-wrapper">
            <!-- Page Content-->
            <div class="page-content">

                <div class="container-fluid">


                    @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            {!! session('message') !!}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {!! session('error') !!}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul class="mt-3">
                                @foreach ($errors->all() as $error)
                                    <li> {{$error}} </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('messages') && is_array(session('messages')))
                        <div class="alert alert-success" role="alert">
                            <ul class="mt-3">
                                @foreach (session('messages') as $msg)
                                    <li> {!!$msg!!} </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @yield('content')

                </div>

                {{-- <footer class="footer text-center text-sm-left">
                    <div class="boxed-footer">
                        &copy; 2020 Crovex <span class="text-muted d-none d-sm-inline-block float-right">Crafted with <i class="mdi mdi-heart text-danger"></i> by Mannatthemes</span>
                   </div>
                </footer> --}}

            </div>

        </div>




        <!-- jQuery  -->
        <script src="{{asset('assets/js/jquery.min.js')}}"></script>
        <script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>
        <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/js/metismenu.min.js')}}"></script>
        <script src="{{asset('assets/js/waves.js')}}"></script>
        <script src="{{asset('assets/js/feather.min.js')}}"></script>
        <script src="{{asset('assets/js/jquery.slimscroll.min.js')}}"></script>

        <script src="{{asset('plugins/dropify/js/dropify.min.js')}}"></script>
        <script src="{{asset('plugins/moment/moment.js')}}"></script>
        <script src="{{asset('plugins/filter/isotope.pkgd.min.js')}}"></script>
        <script src="{{asset('plugins/filter/masonry.pkgd.min.js')}}"></script>
        <script src="{{asset('plugins/filter/jquery.magnific-popup.min.js')}}"></script>
        <script src="{{asset('plugins/chartjs/chart.min.js')}}"></script>
        <script src="{{asset('plugins/chartjs/roundedBar.min.js')}}"></script>
        <script src="{{asset('plugins/lightpick/lightpick.js')}}"></script>
        <script src="{{asset('assets/pages/jquery.profile.init.js')}}"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <!-- App js -->
        <script src="{{asset('assets/js/app.js')}}"></script>
        <script src="{{asset('assets/js/custom.js')}}"></script>

        @yield('charts')

    </body>

</html>
