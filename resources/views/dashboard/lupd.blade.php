<!-- LUPD Dashboard for User -->
<div class="col-xxl-4 col-md-6">
  <div class="card info-card customers-card">      

    <div class="card-body">
      <h5 class="card-title">LUPD <span>| Today</span></h5>

      <div class="d-flex align-items-center flex-wrap">   <!-- First Row  -->             
          <nav class="header-nav ">
            <ul class="d-flex align-items-center">
              <li class="nav-item dropdown">
                <a class="nav-link card-icon rounded-circle d-flex align-items-center justify-content-center" href="#" 
                  data-bs-toggle="tooltip" data-bs-placement="left" title="My Subordinate LUPD for Sign">
                  <i class="bi bi-file-earmark-person"></i>
                  <span class="badge bg-secondary badge-number">{{ $flpsubordinate }}</span>
                </a><!-- End Notification Icon -->
              </li>
            </ul>
          </nav>
          <nav class="header-nav ">
            <ul class="d-flex align-items-center">
              <li class="nav-item dropdown">
                <a class="nav-link card-icon rounded-circle d-flex align-items-center justify-content-center" href="#" 
                  data-bs-toggle="tooltip" data-bs-placement="left" title="My LUPD On Process">
                  <i class="bi bi-file-earmark-play"></i>
                  <span class="badge bg-secondary badge-number">{{ $flponprocess }}</span>
                </a><!-- End Notification Icon -->
              </li>
            </ul>
          </nav>
          <nav class="header-nav ">
            <ul class="d-flex align-items-center">
              <li class="nav-item dropdown">
                <a class="nav-link card-icon rounded-circle d-flex align-items-center justify-content-center" href="#" 
                  data-bs-toggle="tooltip" data-bs-placement="left" title="Action LUPD for Sign">
                  <i class="bi bi-cursor-fill"></i>
                  <span class="badge bg-secondary badge-number">{{ $flpactionreview }}</span>
                </a><!-- End Notification Icon -->
              </li>
            </ul>
          </nav>
          <nav class="header-nav ">
            <ul class="d-flex align-items-center">
              <li class="nav-item dropdown">
                <a class="nav-link card-icon rounded-circle d-flex align-items-center justify-content-center" href="#" 
                  data-bs-toggle="tooltip" data-bs-placement="left" title="My Action LUPD - OPEN">
                  <i class="bi bi-door-open-fill"></i>
                  <span class="badge bg-secondary badge-number">{{ $myflpactionopen }}</span>
                </a><!-- End Notification Icon -->
              </li>
            </ul>
          </nav>    
      
        <nav class="header-nav ">
          <ul class="d-flex align-items-center">
            <li class="nav-item dropdown">
              <a class="nav-link card-icon rounded-circle d-flex align-items-center justify-content-center" href="#" 
                data-bs-toggle="tooltip" data-bs-placement="left" title="My Action LUPD - OVERDUE">
                <i class="bi bi-exclamation-diamond-fill"></i>
                <span class="badge bg-danger badge-number">{{ $myflpactionoverdue }}</span>
              </a><!-- End Notification Icon -->
            </li>
          </ul>
        </nav>  
        <nav class="header-nav ">
          <ul class="d-flex align-items-center">
            <li class="nav-item dropdown">
              <a class="nav-link card-icon rounded-circle d-flex align-items-center justify-content-center" href="#" 
                data-bs-toggle="tooltip" data-bs-placement="left" title="My Action LUPD - ON EXTENSION">
                <i class="bi bi-distribute-vertical"></i>
                <span class="badge bg-secondary badge-number">{{ $myflpactionextension }}</span>
              </a><!-- End Notification Icon -->
            </li>
          </ul>
        </nav>     
        <nav class="header-nav ">
          <ul class="d-flex align-items-center">
            <li class="nav-item dropdown">
              <a class="nav-link card-icon rounded-circle d-flex align-items-center justify-content-center" href="#" 
                data-bs-toggle="tooltip" data-bs-placement="left" title="My Dept Action LUPD - OPEN">
                <i class="bi bi-diagram-2-fill"></i>
                <span class="badge bg-secondary badge-number">{{ $mydeptflpactionopen }}</span>
              </a><!-- End Notification Icon -->
            </li>
          </ul>
        </nav>   
        <nav class="header-nav ">
          <ul class="d-flex align-items-center">
            <li class="nav-item dropdown">
              <a class="nav-link card-icon rounded-circle d-flex align-items-center justify-content-center" href="#" 
                data-bs-toggle="tooltip" data-bs-placement="left" title="My Dept Action LUPD - OVERDUE">
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
        
        
        