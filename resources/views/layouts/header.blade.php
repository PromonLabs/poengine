<header class="main-header">
    <!-- Logo -->
    <a href="{{url('/home')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>P</b>S</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>PO Engine</span>
    </a>
 <!-- Header Navbar: style can be found in header.less -->
 <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
   {{--  <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a> --}}
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <li class="{{ ( Request::segment(1) == 'home' ) ? 'active' :'' }}">
                <a href="{{url('/home')}}"><span>Dashboard</span></a>
            </li>
            <li class="{{ ( Request::segment(1) == 'order' ) ? 'active' :'' }}">
                    <a href="{!! route('order') !!}"><span>Order</span></a>
                </li>
            <li class="{{ ( Request::segment(1) == 'process' ) ? 'active' :'' }}">
                <a href="{!! route('process') !!}"><span>Process</span></a>
            </li>
        </ul>
    </div>
    <ul class="nav navbar-nav"  style="float:right;">
        <li class="{{ ( Request::segment(1) == 'logout' ) ? 'active' :'' }}">
            <a href="{!! route('logout') !!}"><i class="glyphicon glyphicon-off"></i></a>
        </li>
    </ul>
  </nav>
</header>

