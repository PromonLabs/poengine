<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        {{-- <li class="header">MAIN NAVIGATION</li> --}}
        <li class="{{ ( Request::segment(1) == '' ) ? 'active' :'' }}">
            <a href="{{url('/home')}}"><i class="fa fa-dashboard"></i><span>Dashboard</span></a>
        </li>
        <li class="{{ ( Request::segment(1) == 'order' ) ? 'active' :'' }}">
                <a href="{!! route('order') !!}"><i class="fa fa-file-text-o"></i><span>Order</span></a>
            </li>
        <li class="{{ ( Request::segment(1) == 'process' ) ? 'active' :'' }}">
            <a href="{!! route('process') !!}"><i class="fa fa-list"></i><span>Process</span></a>
        </li>
        <li class="{{ ( Request::segment(1) == 'logout' ) ? 'active' :'' }}">
            <a href="{!! route('logout') !!}"><i class="fa fa-sign-out"></i><span>Logout</span></a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
