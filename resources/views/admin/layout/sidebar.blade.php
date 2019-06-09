<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
  <!-- Sidebar user panel -->
  <div class="user-panel">
    <div class="pull-left image">
      <img src="upload/avatar/{{Auth::user()->avatar}}" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
      <p>{{Auth::user()->name}}</p>
      <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
  </div>
  <!-- search form -->
  <form action="#" method="get" class="sidebar-form">
    <div class="input-group">
      <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
          </span>
    </div>
  </form>
  <!-- /.search form -->
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
    <li>
      <?php
        $role = 'member'; 

        if(Auth::user()->role == 1){
          $role = 'admin';
        }elseif(Auth::user()->role == 2){
          $role = 'staff';
        }

        $OnlyAdmin='list-item';
        if(Auth::user()->role != 1){
          $OnlyAdmin = 'none';
        }

        $PreventMember='list-item';
        if(Auth::user()->role != 1){
          $PreventMember = 'none';
        }

      ?>
      <a href="{{$role}}/index">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
      </a>
    </li>
    <li class="treeview" style="display: {{$PreventMember}}">
      <a href="#">
        <i class="fa fa-users"></i>
        <span>Users</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="{{$role}}/users/list"><i class="fa fa-circle-o"></i> List</a></li>
        <li style="display: {{$OnlyAdmin}}"><a href="admin/register"><i class="fa fa-circle-o"></i> Add</a></li>
      </ul>
    </li> 
    <li class="treeview" style="display: {{$PreventMember}}">
      <a href="#">
        <i class="fa fa-users"></i>
        <span>Projects</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="{{$role}}/users/list"><i class="fa fa-circle-o"></i> List</a></li>
        <li style="display: {{$OnlyAdmin}}"><a href="admin/register"><i class="fa fa-circle-o"></i> Add</a></li>
      </ul>
    </li> 
  </ul>
</section>
<!-- /.sidebar -->
</aside>
