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
