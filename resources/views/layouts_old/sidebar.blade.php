<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="/">
          <i class="bi bi-grid"></i>
          <span>{{Auth::user()->level==1 ? 'Dashboard User' : 
            (Auth::user()->level==2 ? 'Dashboard Reviewer' : 
            (Auth::user()->level==3 ? 'Dashboard Approver' : 'Dashboard'))}}
          </span>
        </a>
      </li><!-- End Dashboard Nav -->
@if (Auth::user()->active==1) 
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="ri ri-quill-pen-line"></i><span>FLP</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/flp/masterlist">
              <i class="bi bi-circle"></i><span>Master List</span>
            </a>
          </li>
          <li>
            <a href="/flp/new">
              <i class="bi bi-circle"></i><span>Create</span>
            </a>
          </li>          
        </ul>           
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi-hurricane"></i><span>LUP</span><i class="bi bi-chevron-down ms-auto"></i>
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
        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi-book"></i><span>LUPD</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/lupd/masterlist">
              <i class="bi bi-circle"></i><span>Master List</span>
            </a>
          </li>
          <li>
            <a href="/lupd/new">
              <i class="bi bi-circle"></i><span>Create</span>
            </a>
          </li>          
        </ul>
      </li><!-- End Tables Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="bi-easel"></i><span>RDMS</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/rdms/dashboard">
              <i class="bi bi-circle"></i><span>Dashboard</span>
            </a>
          </li>   
          <li>
            <a href="/masterpart">
              <i class="bi bi-circle"></i><span>Master Parts</span>
            </a>
          </li>          
        </ul>
      </li><!-- End Charts Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
          <i class="bi-layers"></i><span>NIE</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/">
              <i class="bi bi-circle"></i><span>Coming soon</span>
            </a>
          </li>
          <li>
            <a href="/">
              <i class="bi bi-circle"></i><span>Coming soon</span>
            </a>
          </li>
          <li>
            <a href="/">
              <i class="bi bi-circle"></i><span>Coming soon</span>
            </a>
          </li>
        </ul>
      </li><!-- End Icons Nav -->
@endif
      <li class="nav-heading">Pages</li>
      <li class="nav-item">
        @php
          $id= Crypt::encryptString(Auth::user()->id);
        @endphp
        <a class="nav-link collapsed" href="/users-profile/{{Crypt::encryptString(Auth::user()->id)}}/edit">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="/users-profile/{{Crypt::encryptString(Auth::user()->id)}}/edit/changepassword">
          <i class="bi bi-person-lines-fill"></i>
          <span>Change Password</span>
        </a>
      </li><!-- End Change Password Page Nav -->

@if (Auth::user()->level>1) 
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
          <li>
            <a class="nav-link collapsed" href="/mail/setting/edit">
              <i class="bi bi-circle"></i>
              <span>Mail Settings</span>
            </a>
          </li>
        </ul>
      </li><!-- End Setting Page Nav -->
@endif
      <li class="nav-item">
        <!-- Authentication -->
        <a class="nav-link collapsed" href="/logout">
          <i class="bi bi-box-arrow-left"></i>
          <span>Logout</span>
        </a>        
      </li><!-- End Login Page Nav -->    
    </ul>
  </aside><!-- End Sidebar-->
