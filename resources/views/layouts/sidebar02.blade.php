<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="/">
          <i class="bi bi-grid"></i>
          <span>Dashboard Reviewer</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>FLP</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/flp">
              <i class="bi bi-circle"></i><span>Master List</span>
            </a>
          </li>
          <li>
            <a href="/newflp">
              <i class="bi bi-circle"></i><span>Create</span>
            </a>
          </li>
          
          <li>
            <a href="components-badges.html">
              <i class="bi bi-circle"></i><span>Print Preview</span>
            </a>
          </li>
          <li>
            <a href="components-badges.html">
              <i class="bi bi-circle"></i><span>Workflow</span>
            </a>
          </li>
        </ul>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>LUP</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/lup/masterlist">
              <i class="bi bi-circle"></i><span>Master List</span>
            </a>
          </li>
          <li>
            <a href="/lup/new">
              <i class="bi bi-circle"></i><span>Create</span>
            </a>
          </li>          
          <li>
            <a href="components-badges.html">
              <i class="bi bi-circle"></i><span>Print Preview</span>
            </a>
          </li>
          <li>
            <a href="components-badges.html">
              <i class="bi bi-circle"></i><span>Workflow</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>LUPD</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/lupd">
              <i class="bi bi-circle"></i><span>Master List</span>
            </a>
          </li>
          <li>
            <a href="/lup/newd">
              <i class="bi bi-circle"></i><span>Create</span>
            </a>
          </li>          
          <li>
            <a href="components-badges.html">
              <i class="bi bi-circle"></i><span>Print Preview</span>
            </a>
          </li>
          <li>
            <a href="components-badges.html">
              <i class="bi bi-circle"></i><span>Workflow</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart"></i><span>RDMS</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/masterpart">
              <i class="bi bi-circle"></i><span>Master Parts</span>
            </a>
          </li>
          <li>
            <a href="charts-apexcharts.html">
              <i class="bi bi-circle"></i><span>ApexCharts</span>
            </a>
          </li>
          <li>
            <a href="charts-echarts.html">
              <i class="bi bi-circle"></i><span>ECharts</span>
            </a>
          </li>
        </ul>
      </li><!-- End Charts Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gem"></i><span>NIE</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="icons-bootstrap.html">
              <i class="bi bi-circle"></i><span>Bootstrap Icons</span>
            </a>
          </li>
          <li>
            <a href="icons-remix.html">
              <i class="bi bi-circle"></i><span>Remix Icons</span>
            </a>
          </li>
          <li>
            <a href="icons-boxicons.html">
              <i class="bi bi-circle"></i><span>Boxicons</span>
            </a>
          </li>
        </ul>
      </li><!-- End Icons Nav -->

      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        @php
          $id= Crypt::encryptString(Auth::user()->id);
        @endphp
        <a class="nav-link collapsed" href="/users-profile/{{$id}}/edit">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->
      <li class="nav-item">       
        <a class="nav-link collapsed" href="/users-profile/{{$id}}/edit/changepassword">
          <i class="bi bi-person-lines-fill"></i>
          <span>Change Password</span>
        </a>
      </li><!-- End Change Password Page Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#setting-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gear"></i><span>Settings</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="setting-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a class="nav-link collapsed" href="/listusers">
              <i class="bi bi-circle"></i>
              <span>List Users</span>
            </a>
          </li>
          <li>
            <a class="nav-link collapsed" href="/department">
              <i class="bi bi-circle"></i>
              <span>List Department</span>
            </a>
          </li>
          <li>
            <a class="nav-link collapsed" href="/grade">
              <i class="bi bi-circle"></i>
              <span>List Grade</span>
            </a>
          </li>
          <li>
            <a class="nav-link collapsed" href="/grade">
              <i class="bi bi-circle"></i>
              <span>List Storage</span>
            </a>
          </li>
        </ul>
      </li><!-- End Setting Page Nav -->     

      <li class="nav-item">
        <!-- Authentication -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <x-responsive-nav-link : class="nav-link collapsed" href="route('logout')"
                    onclick="event.preventDefault();
                                this.closest('form').submit();">
            <i class="bi bi-box-arrow-in-left"></i>
            <span>Log Out</span>
            </x-responsive-nav-link>
        </form>
        
      </li><!-- End Login Page Nav -->
    </ul>

  </aside><!-- End Sidebar-->
