<header class="main-nav">
    <div class="sidebar-user text-center">
        <a class="setting-primary" href="/users-profile/{{Crypt::encryptString(Auth::user()->id)}}/edit"><i data-feather="settings"></i></a><img class="img-90 rounded-circle" src="{{asset('assets/images/dashboard/1.png')}}" alt="" />
        <div class="badge-bottom"><span class="badge badge-primary">{{ auth()->user()->level==1 ? 'User' : (auth()->user()->level==2 ? 'Reviewer' : (auth()->user()->level==3 ? 'Approver' : '')) }}</span></div>
        <a href="/users-profile/{{Crypt::encryptString(Auth::user()->id)}}/edit"> <h6 class="mt-3 f-14 f-w-600">{{ Auth::user()->name }}</h6></a>
        <p class="mb-0 font-roboto">{{ Auth::user()->department }}</p>
        
    </div>
    <nav>
        <div class="main-navbar">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">
                    <li class="back-btn">
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                    </li>
                    <li class="sidebar-main-title">
                        <a class="nav-link {{ prefixActive('/') }}" href="/"><i data-feather="home"></i>
                            <span>{{Auth::user()->level==1 ? 'Dashboard User' : 
                                (Auth::user()->level==2 ? 'Dashboard Reviewer' : 
                                (Auth::user()->level==3 ? 'Dashboard Approver' : 'Dashboard'))}}
                              </span></a>      
                    </li>         
                    
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Applications</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title {{ prefixActive('/lup') }}" href="javascript:void(0)"><i data-feather="box"></i><span>LUP</span></a>
                        <ul class="nav-submenu menu-content" style="display: {{ prefixBlock('/lup') }};">
                            <li><a href="/lup/masterlist" class="{{routeActive('lup/masterlist')}}">Master List</a></li>
                            <li><a href="/lup/new" class="{{routeActive('lup')}}">Create</a></li>                            
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title {{ prefixActive('/flp') }}" href="javascript:void(0)"><i data-feather="folder-plus"></i><span>FLP</span></a>
                        <ul class="nav-submenu menu-content" style="display: {{ prefixBlock('/flp') }};">
                            <li><a href="/flp/masterlist" class="{{routeActive('flp')}}">Master List</a></li>
                            <li><a href="/flp/new" class="{{routeActive('flp')}}">Create</a></li>                            
                        </ul>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Settings</h6>
                        </div>
                    </li>
                               
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header>
