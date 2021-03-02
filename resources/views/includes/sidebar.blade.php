<!-- Brand Logo -->
<div  style="background-color:#0F749D;">
<a href="#" class="brand-link">
      <img src="{{asset('assets/dist/img/logo.jpg')}}" alt="GST Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"><b>GTMS</b></span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar" >
      <!-- Sidebar user panel (optional) -->
      <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin</a>
        </div>
      </div> -->
      <!-- Sidebar Menu -->
      
      <nav class="mt-2" >
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" >
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="{{route('home')}}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p> 
                Home
                
              </p>
            </a> 
          </li>
          <li class="nav-item has-treeview">
            <a href="{{route('activity.index')}}" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                  Activities
                </p>
            </a>
          </li>
         
         
          @if ( Auth::user()->role_id == '1') 
          <!-- Admin -->

          <li class="nav-item has-treeview">
            <a href="{{ route('user.index') }}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users Management
              </p>
            </a>
          </li>
         
          <li class="nav-item has-treeview">
            <a href="{{ route('department.index') }}" class="nav-link">
              <i class="nav-icon fa fa-university"></i>
              <p>
                Departments
              </p>
            </a>
          </li>

          

          <li class="nav-item has-treeview">
            <a href="{{ route('section.index') }}" class="nav-link">
              <i  class="nav-icon fas fa-sitemap"></i>
              <p>
                Sections
              </p>
            </a>
          </li>

          @elseif ( Auth::user()->role_id == '2')
          <!-- Manager -->
          <li class="nav-item has-treeview">
            <a href="{{ route('individual') }}" class="nav-link">
              <i class="nav-icon fa fa-copy"></i>
              <p>
                Individual Reports
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="{{ route('department.index') }}" class="nav-link">
              <i class="nav-icon fa fa-copy"></i>
              <p>
                Section Reports
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="{{ route('department.index') }}" class="nav-link">
              <i class="nav-icon fa fa-copy"></i>
              <p>
                Departments Reports
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="{{ route('assign.index') }}" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                  Assign Tasks
                </p>
            </a>
          </li>
          
          
          @endif
          

          <li class="nav-item has-treeview">
            <a href=" {{ route('change') }}" class="nav-link">
              <i class="nav-icon fas fa-key"></i>
              <p>
                change Password
              </p>
            </a>
          </li>

          

          <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
              <i class="nav-icon fas fa-power-off"></i>
              <p>
                {{ __('Logout') }}
              </p>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
             </form>
          </li>          

          
        </ul>
      </nav>
      
    </div>
    </div>
    <!-- /.sidebar -->
  