<nav class="sidebar sidebar-offcanvas p-0" id="sidebar" style="background-color: #2D2F32;color: #ffff;">
  <h6 class="pl-3 pt-4">Navigation Bar</h6>
  <ul class="nav">
    
    <li class="p-3 nav-item {{ in_array(Route::currentRouteName(), array('system.dashboard')) ? 'active' : ''}}">
      <a class="nav-link" href="{{route('system.dashboard')}}">
        <i class="fa fa-home menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    @if(in_array($auth->type,['super_user','admin','processor']))
    <li class="p-3 nav-item {{ in_array(Route::currentRouteName(), array('system.processor.list','system.processor.show' )) ? 'active' : ''}}">
      <a class="nav-link" href="{{route('system.processor.list')}}">
        <i class="fa fa-user-circle menu-icon"></i>
        <span class="menu-title">Processors</span>
      </a>
    </li>
    <li class="p-3 nav-item {{ in_array(Route::currentRouteName(), array('system.transaction.index','system.transaction.show')) ? 'active' : ''}}">
      <a class="nav-link" href="{{route('system.transaction.index')}}">
        <i class="fa fa-file menu-icon"></i>
        <span class="menu-title">Transactions</span>
      </a>
    </li>
    <li class="p-3 nav-item {{ in_array(Route::currentRouteName(), array('system.other_customer.index','system.other_customer.create','system.other_transaction.index','system.other_transaction.show','system.other_customer.show')) ? 'active' : ''}}">
      <a class="nav-link" href="{{route('system.other_customer.index')}}">
        <i class="fa fa-file menu-icon"></i>
        <span class="menu-title">Local Record</span>
      </a>
    </li>
    <li class="p-3 nav-item {{ in_array(Route::currentRouteName(), array('system.application.index','system.application.create','system.application.edit')) ? 'active' : ''}}">
      <a class="nav-link" href="{{route('system.application.index')}}">
        <i class="fa fa-bookmark menu-icon"></i>
        <span class="menu-title">Applications</span>
      </a>
    </li>
    <li class="p-3 nav-item {{ in_array(Route::currentRouteName(), array('system.department.index','system.department.create','system.department.edit')) ? 'active' : ''}}">
      <a class="nav-link" href="{{route('system.department.index')}}">
        <i class="fa fa-globe menu-icon"></i>
        <span class="menu-title">Peza Units</span>
      </a>
    </li>
    @if(in_array($auth->type,['super_user','admin']))
    <li class="p-3 nav-item {{ in_array(Route::currentRouteName(), array('system.application_requirements.index','system.application_requirements.create','system.application_requirements.edit')) ? 'active' : ''}}">
      <a class="nav-link" href="{{route('system.application_requirements.index')}}">
        <i class="fa fa-check-circle menu-icon"></i>
        <span class="menu-title">Application Requirements</span>
      </a>
    </li>
    <li class="p-3 nav-item">
      <a class="nav-link" href="">
        <i class="fa fa-chart-line menu-icon"></i>
        <span class="menu-title">Reporting</span>
      </a>
    </li>
    <li class="p-3 nav-item {{ in_array(Route::currentRouteName(), array('system.processor.index','system.processor.create','system.processor.edit','system.processor.reset')) ? 'active' : ''}}">
      <a class="nav-link" href="{{route('system.processor.index')}}">
        <i class="fa fa-user-plus menu-icon"></i>
        <span class="menu-title">Accounts</span>
      </a>
    </li>
    @endif
    @endif
  </ul>

</nav>