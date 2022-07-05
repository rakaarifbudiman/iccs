<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="/">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->


      <li class="nav-item">
        @php
          $id= Crypt::encryptString(Auth::user()->id);
        @endphp
        <a class="nav-link collapsed" href="/users-profile/{{$id}}/edit/changepassword">
          <i class="bi bi-person-lines-fill"></i>
          <span>Change Password</span>
        </a>
      </li><!-- End Change Password Page Nav -->

      

      <li class="nav-item">
        <!-- Authentication -->
        <a class="nav-link collapsed" href="/logout">
          <i class="bi bi-box-arrow-left"></i>
          <span>Logout</span>
        </a>
        
        
      </li><!-- End Login Page Nav -->

     
    </ul>

  </aside><!-- End Sidebar-->
