<div class="page-main-header">
  <div class="main-header-right row m-0">
    <div class="main-header-left">
      <div class="logo-wrapper"><a href="/dashboard"><img class="img-fluid" src="{{asset('assets/images/logo/logoiccs-light.png')}}" alt="{{ env('APP_NAME') }}" style="height: 35px"></a>
        <span class="mt-3 f-14 f-w-600 text-black">{{ env('APP_NAME') }}</span>
      </div>
      <div class="dark-logo-wrapper"><a href="/dashboard"><img class="img-fluid" src="{{asset('assets/images/logo/logoiccs-dark.png')}}" alt="{{ env('APP_NAME') }}" style="height: 35px"></a>{{ env('APP_NAME') }}</div>
      <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="grid" id="sidebar-toggle">    </i></div>
    </div>
    <div class="left-menu-header col">
      <ul>
        <li>
          <form class="form-inline search-form" action="/tcodeiccs" method="POST" id="tcode">
            @csrf                       
            <div class="search-bg"><a href="#" data-container="body" data-bs-toggle="popover" data-placement="top" 
              onclick="event.preventDefault(); document.getElementById('tcode').submit();"><i class="fa fa-search"></i></a>
              <input class="form-control-plaintext" name="tcode" placeholder="Search here....." autofocus>              
            </div>
          </form>
          <span class="d-sm-none mobile-search search-bg"><i class="fa fa-search"></i></span>
        </li>
      </ul>
    </div>
    <div class="nav-right col pull-right right-menu p-0">
      <ul class="nav-menus">
        <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()" title="Full Screen"><i data-feather="maximize"></i></a></li>        
        <li class="onhover-dropdown">
            @php
              $emaillog = DB::table('email_log')->where('to','LIKE','%'.Auth::user()->email.'%')
                    ->orWhere('cc','LIKE','%'.Auth::user()->email.'%')->orderBy('date','desc')->get();
            @endphp
          <div class="notification-box"><i data-feather="bell"></i><span class="{{$emaillog->count()>0 ? 'dot-animated' :''}}"></span></div>
          <ul class="notification-dropdown onhover-show-div">
            <li>
              <p class="f-w-700 mb-0">You have {{$emaillog->count()}} Notifications<span class="pull-right badge badge-primary badge-pill">{{$emaillog->count()}}</span></p>
            </li>
            @forelse ($emaillog->take(5) as $log)
            <li class="noti-primary">
              <div class="media">                
                <span class="notification-bg bg-light-primary"><i data-feather="activity"> </i></span> 
                <a href="#" data-bs-toggle="modal" data-bs-target="#modalheadernotification{{ $log->id }}">              
                <div class="media-body">
                  <p>{{$log->subject}}</p>
                  <span>{{getDiffFromMinute($log->date)}}</span>
                </div>  
                </a>              
              </div>
            </li>
            @empty
            @endforelse    
            <li class="text-center"> <a class="f-w-700" href="javascript:void(0)">See All     </a></li>        
          </ul>
        </li>
        <li class="onhover-dropdown">
            <div class="mode" title="Change Dark/Light"><i class="fa fa-moon-o"></i></div>
        </li>    
        <li class="onhover-dropdown" id="hidecustomizer">
          <div class="color-mode" title="Show/Hide Color Customizer"><i class="fa fa-eye-slash"></i></div>
        </li>    
        <li class="onhover-dropdown">
          @php
          $onlineusers = DB::table('users')->where('last_seen','<>',null)->orderBy('last_seen', 'desc')->get();
          @endphp
          <div class="notification-box"><i data-feather="user"></i><span class="{{ $onlineusers->count()>0 ? 'dot-animated' : ''}}"></span></div>          
          <ul class="chat-dropdown onhover-show-div">
            <li>
              <p class="f-w-700 mb-0">{{ $onlineusers->count() }} login users<span class="pull-right badge badge-primary badge-pill">{{ $onlineusers->count() }}</span></p>
            </li>
            @forelse ($onlineusers->take(10) as $onlineuser)        
            <li>
              <div class="media">
                <img class="img-fluid rounded-circle me-3" src="{{asset('assets/images/dashboard/1.png')}}" alt="">
                <div class="media-body">
                  <span>{{ $onlineuser->name }}</span>
                  <p class="f-12 light-font">{{ Cache::has('user-is-online-' . $onlineuser->id) ? 'online' : 'offline'}}</p>
                </div>
                <p class="f-12">{{getDiffFromMinute($onlineuser->last_seen)}} ago</p>
              </div>
            </li>
            @empty
            @endforelse                         
            <li class="text-center"> <a class="f-w-700" href="javascript:void(0)">See All     </a></li>
          </ul>
        </li>   
        
        <li class="onhover-dropdown p-0" id="jam"></li>
        <li class="onhover-dropdown p-0">
          <a href="/logout" class="btn btn-primary-light" type="button"><i data-feather="log-out"></i>Log out</a>
        </li>
      </ul>
    </div>
    <div class="d-lg-none mobile-toggle pull-right w-auto"><i data-feather="more-horizontal"></i></div>
  </div>
</div>
