<!-- FLP Dashboard for User -->
<div class="col-xxl-4 col-md-6">
  <div class="card info-card revenue-card">      

    <div class="card-body">
      <h5 class="card-title">FLP <span>| Today</span></h5>

      <div class="d-flex align-items-center flex-wrap">   <!-- First Row  -->             
          <nav class="header-nav ">
            <ul class="d-flex align-items-center">
              <li class="nav-item dropdown">
                <a class="nav-link card-icon rounded-circle d-flex align-items-center justify-content-center" href="/queryflpleader" 
                  data-bs-toggle="tooltip" data-bs-placement="left" title="My Subordinate FLP for Sign">
                  <i class="bi bi-file-earmark-person"></i>
                  <span class="badge bg-success badge-number">{{ $flpsubordinate }}</span>
                </a><!-- End Notification Icon -->
              </li>
            </ul>
          </nav>
          <nav class="header-nav ">
            <ul class="d-flex align-items-center">
              <li class="nav-item dropdown">
                <a class="nav-link card-icon rounded-circle d-flex align-items-center justify-content-center" href="/queryflponprocess" 
                  data-bs-toggle="tooltip" data-bs-placement="left" title="My FLP On Process">
                  <i class="bi bi-file-earmark-play"></i>
                  <span class="badge bg-success badge-number">{{ $flponprocess }}</span>
                </a><!-- End Notification Icon -->
              </li>
            </ul>
          </nav>
          <nav class="header-nav ">
            <ul class="d-flex align-items-center">
              <li class="nav-item dropdown">
                <a class="nav-link card-icon rounded-circle d-flex align-items-center justify-content-center" href="/queryflpsignaction" 
                  data-bs-toggle="tooltip" data-bs-placement="left" title="Action FLP for Sign">
                  <i class="bi bi-cursor-fill"></i>
                  <span class="badge bg-success badge-number">{{ $flpactionreview }}</span>
                </a><!-- End Notification Icon -->
              </li>
            </ul>
          </nav>
          <nav class="header-nav ">
            <ul class="d-flex align-items-center">
              <li class="nav-item dropdown">
                <a class="nav-link card-icon rounded-circle d-flex align-items-center justify-content-center" href="/queryflpactionopen" 
                  data-bs-toggle="tooltip" data-bs-placement="left" title="My Action FLP - OPEN">
                  <i class="bi bi-door-open-fill"></i>
                  <span class="badge bg-success badge-number">{{ $myflpactionopen }}</span>
                </a><!-- End Notification Icon -->
              </li>
            </ul>
          </nav>    
      
        <nav class="header-nav ">
          <ul class="d-flex align-items-center">
            <li class="nav-item dropdown">
              <a class="nav-link card-icon rounded-circle d-flex align-items-center justify-content-center" href="/queryflpactionoverdue" 
                data-bs-toggle="tooltip" data-bs-placement="left" title="My Action FLP - OVERDUE">
                <i class="bi bi-exclamation-diamond-fill"></i>
                <span class="badge bg-danger badge-number">{{ $myflpactionoverdue }}</span>
              </a><!-- End Notification Icon -->
            </li>
          </ul>
        </nav>  
        <nav class="header-nav ">
          <ul class="d-flex align-items-center">
            <li class="nav-item dropdown">
              <a class="nav-link card-icon rounded-circle d-flex align-items-center justify-content-center" href="/queryflpactionextension" 
                data-bs-toggle="tooltip" data-bs-placement="left" title="My Action FLP - ON EXTENSION">
                <i class="bi bi-distribute-vertical"></i>
                <span class="badge bg-success badge-number">{{ $myflpactionextension }}</span>
              </a><!-- End Notification Icon -->
            </li>
          </ul>
        </nav>     
        <nav class="header-nav ">
          <ul class="d-flex align-items-center">
            <li class="nav-item dropdown">
              <a class="nav-link card-icon rounded-circle d-flex align-items-center justify-content-center" href="#" 
                data-bs-toggle="tooltip" data-bs-placement="left" title="My Dept Action FLP - OPEN">
                <i class="bi bi-diagram-2-fill"></i>
                <span class="badge bg-success badge-number">{{ $mydeptflpactionopen }}</span>
              </a><!-- End Notification Icon -->
            </li>
          </ul>
        </nav>   
        <nav class="header-nav ">
          <ul class="d-flex align-items-center">
            <li class="nav-item dropdown">
              <a class="nav-link card-icon rounded-circle d-flex align-items-center justify-content-center" href="#" 
                data-bs-toggle="tooltip" data-bs-placement="left" title="My Dept Action FLP - OVERDUE">
                <i class="bi bi-diagram-3-fill"></i>
                <span class="badge bg-danger badge-number">{{ $mydeptflpactionoverdue }}</span>
              </a><!-- End Notification Icon -->
            </li>
          </ul>
        </nav>        
      </div><!-- End First Row  --> 
    </div>

  </div>
</div><!-- End Sales Card -->
        
        
        