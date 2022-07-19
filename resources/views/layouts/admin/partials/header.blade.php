<div class="page-main-header">
  <div class="main-header-right row m-0">
    <div class="main-header-left">
      <div class="logo-wrapper"><a href="/"><img class="img-fluid" src="{{asset('assets/images/logo/logoiccs-light.png')}}" alt="{{ env('APP_NAME') }}" style="height: 35px"></a>
        <span class="mt-3 f-14 f-w-600 text-black">{{ env('APP_NAME') }}</span>
      </div>
      <div class="dark-logo-wrapper"><a href="/"><img class="img-fluid" src="{{asset('assets/images/logo/logoiccs-dark.png')}}" alt="{{ env('APP_NAME') }}" style="height: 35px"></a>{{ env('APP_NAME') }}</div>
      <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="slack" id="sidebar-toggle">    </i></div>
    </div>
    <div class="left-menu-header col">
      <ul>
        <li>
          <form class="form-inline search-form" action="/tcodeiccs" method="POST">
            @csrf
            <div class="search-bg"><i class="fa fa-search"></i>
              <input class="form-control-plaintext" name="tcode" placeholder="Search here....." autofocus>
            </div>
          </form>
          <span class="d-sm-none mobile-search search-bg"><i class="fa fa-search"></i></span>
        </li>
      </ul>
    </div>
    <div class="nav-right col pull-right right-menu p-0">
      <ul class="nav-menus">
        <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
        <li class="onhover-dropdown">
          <div class="bookmark-box"><i data-feather="star"></i></div>
          <div class="bookmark-dropdown onhover-show-div">
            <div class="form-group mb-0">
              <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                <input class="form-control" type="text" placeholder="Search for bookmark...">
              </div>
            </div>
            <ul>
              <li class="add-to-bookmark"><i class="bookmark-icon" data-feather="inbox"></i>Email<span class="pull-right"><i data-feather="star"></i></span></li>
              <li class="add-to-bookmark"><i class="bookmark-icon" data-feather="message-square"></i>Chat<span class="pull-right"><i data-feather="star"></i></span></li>
              <li class="add-to-bookmark"><i class="bookmark-icon" data-feather="command"></i>Feather Icon<span class="pull-right"><i data-feather="star"></i></span></li>
              <li class="add-to-bookmark"><i class="bookmark-icon" data-feather="airplay"></i>Widgets<span class="pull-right"><i data-feather="star">   </i></span></li>
            </ul>
          </div>
        </li>
        <li class="onhover-dropdown">
          @php
              $emaillog = DB::table('email_log')->get();
            @endphp
          <div class="notification-box"><i data-feather="bell"></i><span class="dot-animated"></span></div>
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
        <li>
            <div class="mode"><i class="fa fa-moon-o"></i></div>
        </li>
        <li class="onhover-dropdown">
          @php
          $onlineusers = DB::table('users')->where('last_seen','<>',null)->orderBy('last_seen', 'desc')->get();
          @endphp
          <div class="notification-box"><i data-feather="user"></i><span class="badge badge-primary badge-pill">{{ $onlineusers->count() }}</span></div>          
          <ul class="chat-dropdown onhover-show-div">
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
        <li class="onhover-dropdown">
          <i data-feather="message-square"></i>
          <ul class="chat-dropdown onhover-show-div">
            <li>
              <div class="media">
                <img class="img-fluid rounded-circle me-3" src="{{asset('assets/images/user/4.jpg')}}" alt="">
                <div class="media-body">
                  <span>Ain Chavez</span>
                  <p class="f-12 light-font">Lorem Ipsum is simply dummy...</p>
                </div>
                <p class="f-12">32 mins ago</p>
              </div>
            </li>
            <li>
              <div class="media">
                <img class="img-fluid rounded-circle me-3" src="{{asset('assets/images/user/1.jpg')}}" alt="">
                <div class="media-body">
                  <span>Erica Hughes</span>
                  <p class="f-12 light-font">Lorem Ipsum is simply dummy...</p>
                </div>
                <p class="f-12">58 mins ago</p>
              </div>
            </li>
            <li>
              <div class="media">
                <img class="img-fluid rounded-circle me-3" src="{{asset('assets/images/user/2.jpg')}}" alt="">
                <div class="media-body">
                  <span>Kori Thomas</span>
                  <p class="f-12 light-font">Lorem Ipsum is simply dummy...</p>
                </div>
                <p class="f-12">1 hr ago</p>
              </div>
            </li>
            <li class="text-center"> <a class="f-w-700" href="javascript:void(0)">See All     </a></li>
          </ul>
        </li>
        <li class="onhover-dropdown p-0">
          <a href="/logout" class="btn btn-primary-light" type="button"><i data-feather="log-out"></i>Log out</a>
        </li>
      </ul>
    </div>
    <div class="d-lg-none mobile-toggle pull-right w-auto"><i data-feather="more-horizontal"></i></div>
  </div>
</div>
