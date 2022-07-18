<header id="header" class="header fixed-top d-flex align-items-center">
  
  <div class="d-flex align-items-center justify-content-between text-indigo">
    <a href="/" class="logo d-flex align-items-center">
      <img src="/assets/img/logoiccsnew.svg" alt="">
      <span class="d-none d-lg-block text-indigo">ICCS</span>
    </a>
    <i class="bi-grid-3x3-gap toggle-sidebar-btn"></i>
  </div><!-- End Logo -->

  <div class="search-bar">
    <form class="search-form d-flex align-items-center" method="POST" action="/tcodeiccs">
      @csrf
      <input type="text" name="tcode" placeholder="Shortcut Menu" title="Enter Keyword to Direct Transaction" autofocus autocomplete="off">
      <button type="submit" title="Go"><i class="bi-arrow-return-right"></i></button>
    </form>
  </div><!-- End Search Bar -->
  
  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">            
      <li class="nav-item dropdown">
            @php
              $emaillog = DB::table('email_log')->get();
            @endphp
        <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
          <i class="bi bi-bell"></i>
          <span class="badge bg-primary badge-number">{{$emaillog->count()}}</span>
        </a><!-- End Notification Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
          <li class="dropdown-header">
            You have {{$emaillog->count()}} new notifications
            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>
              @forelse ($emaillog as $log)
                <li class="notification-item">
                  <i class="bi bi-exclamation-circle text-warning"></i>
                  <a href="#" data-bs-toggle="modal" data-bs-target="#modalheadernotification{{ $log->id }}">
                    <h4>{{$log->subject}}</h4>                    
                    <p>{{getDiffFromMinute($log->date)}}</p>
                  </a>
                </li>                            
              @empty            
              @endforelse
          <li>
            <hr class="dropdown-divider">
          </li>          
          <li class="dropdown-footer">
            <a href="/listnotification">Show all notifications</a>
          </li>

        </ul><!-- End Notification Dropdown Items -->

      </li><!-- End Notification Nav -->


      <li class="nav-item dropdown"> {{-- Online User --}}
            @php
              $onlineusers = DB::table('users')->where('last_seen','<>',null)->orderBy('last_seen', 'desc')->get();
            @endphp
        <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
          <i class="ri ri-user-2-fill"></i>
          <span class="badge bg-success badge-number">{{ $onlineusers->count() }}</span>
        </a><!-- End Messages Icon -->        
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <li class="dropdown-header">
              {{ $onlineusers->count() }} Login User
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
              @forelse ($onlineusers->take(10) as $onlineuser)                                             
                  <li class="message-item">
                    <a href="#">
                      {{-- <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle"> --}}
                      <div>
                        <button type="button" class="btn btn-white position-relative text-left">
                          {{ $onlineuser->username }}
                          <span class="position-absolute top-20 start-100 translate-middle p-1 {{ Cache::has('user-is-online-' . $onlineuser->id) ? 'bg-success' : 'bg-danger'}} border border-light rounded-circle">
                                         
                        </button>               
                        <p>{{getDiffFromMinute($onlineuser->last_seen)}} ago</p>                                        
                      </div>
                    </a>
                  </li>
                @empty                  
              @endforelse           
            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="dropdown-footer">
              <a href="#">Show all online users</a>
            </li>

          </ul><!-- End Messages Dropdown Items -->

      </li><!-- End Messages Nav -->


      <li class="nav-link nav-profile d-flex align-items-center pe-0" id="jam" >
      </li>   
      
      <li class="nav-item dropdown pe-3">

        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">          
          <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
        </a><!-- End Profile Iamge Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li class="dropdown-header">
            <h6>{{ Auth::user()->username }}</h6>
            <span>{{ Auth::user()->email }}</span><br>
            <span>{{ auth()->user()->level==1 ? 'User' : (auth()->user()->level==2 ? 'Reviewer' : (auth()->user()->level==3 ? 'Approver' : '')) }}</span>            
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            @php
            $id= Crypt::encryptString(Auth::user()->id);
            @endphp
            <a class="dropdown-item d-flex align-items-center" href="/users-profile/{{Crypt::encryptString(Auth::user()->id)}}/edit">
              <i class="bi bi-person"></i>
              <span>My Profile</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="/users-profile/{{$id}}/edit/changepassword">
              <i class="bi bi-person-lines-fill"></i>
              <span>Change Password</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
              <i class="bi bi-question-circle"></i>
              <span>Need Help?</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
              <!-- Authentication -->              
                  <a class="dropdown-item d-flex align-items-center" href="/logout">
                   <i class="bi bi-box-arrow-right"></i>                   
                   <span>Log Out</span>           
          </li>

        </ul><!-- End Profile Dropdown Items -->
      </li><!-- End Profile Nav -->
      <li class="nav-link nav-profile d-flex align-items-center pe-0">
        <a href="https://apps6.sohoglobalhealth.com/HRIS/Login.aspx" title="Go to Pro-Int">
          <img src="/assets/img/logo-sgh.png" alt="Logo SGH">          
        </a>        
      </li>
    </ul>
  </nav><!-- End Icons Navigation -->
</header><!-- End Header -->