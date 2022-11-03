<div class="main-sidebar">
{{-- <div class="main-sidebar"> --}}

        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href=" / ">FUTAMI</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="/"></a>
          </div>
          <ul class="sidebar-menu">
              <li class="menu-header"></li>
              <li class="nav-item dropdown">
              <a href="/" ><i class="fas fa-home"></i><span>Dashboard</span></a>
              </li>
              <li class="menu-header"></li>
              <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="far fa fa-city"></i> <span>Produksi</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="{{ url('statuses') }}">status</a></li>
                  <li><a class="nav-link" href="{{ url('projects') }}">project</a></li>
                </ul>
              </li>
        </aside>
      </div>