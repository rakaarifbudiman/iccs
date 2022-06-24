<!-- LUP Dashboard for User -->
<div class="col-xxl-4 col-md-6">
  <div class="card info-card sales-card">      

    <div class="card-body">
      <h5 class="card-title">LUP<span> | User</span></h5>

      <div class="d-flex align-items-center flex-wrap">   <!-- First Row  -->
          
          <nav class="header-nav ">
            <ul class="d-flex align-items-center">
              <li class="nav-item dropdown">
                <a class="nav-link card-icon rounded-circle d-flex align-items-center justify-content-center" href="/querylupmyonprocess" 
                  data-bs-toggle="tooltip" data-bs-placement="left" title="My LUP On Process">
                  <i class="bi bi-file-earmark-play"></i>
                  <span class="badge bg-success badge-number">{{ $myluponprocess }}</span>
                </a><!-- End Notification Icon -->
              </li>
            </ul>
          </nav>
          <nav class="header-nav ">
            <ul class="d-flex align-items-center">
              <li class="nav-item dropdown">
                <a class="nav-link card-icon rounded-circle d-flex align-items-center justify-content-center" href="/querylupsignaction" 
                  data-bs-toggle="tooltip" data-bs-placement="left" title="Sign for Action LUP">
                  <i class="bi bi-cursor-fill"></i>
                  <span class="badge {{ $mylupactionreview==0 ? 'bg-success' : 'bg-danger' }} badge-number">{{ $mylupactionreview }}</span>
                </a><!-- End Notification Icon -->
              </li>
            </ul>
          </nav>
          <nav class="header-nav ">
            <ul class="d-flex align-items-center">
              <li class="nav-item dropdown">
                <a class="nav-link card-icon rounded-circle d-flex align-items-center justify-content-center" href="/querylupmyactionopen" 
                  data-bs-toggle="tooltip" data-bs-placement="left" title="My Action LUP - OPEN">
                  <i class="bi bi-door-open-fill"></i>
                  <span class="badge bg-success badge-number">{{ $mylupactionopen }}</span>
                </a><!-- End Notification Icon -->
              </li>
            </ul>
          </nav>    
      
        <nav class="header-nav ">
          <ul class="d-flex align-items-center">
            <li class="nav-item dropdown">
              <a class="nav-link card-icon rounded-circle d-flex align-items-center justify-content-center" href="/querylupmyactionoverdue" 
                data-bs-toggle="tooltip" data-bs-placement="left" title="My Action LUP - OVERDUE">
                <i class="bi bi-exclamation-diamond-fill"></i>
                <span class="badge {{ $mylupactionoverdue==0 ? 'bg-success' : 'bg-danger' }} badge-number">{{ $mylupactionoverdue }}</span>
              </a><!-- End Notification Icon -->
            </li>
          </ul>
        </nav>  
        <nav class="header-nav ">
          <ul class="d-flex align-items-center">
            <li class="nav-item dropdown">
              <a class="nav-link card-icon rounded-circle d-flex align-items-center justify-content-center" href="/querylupmyactionextension" 
                data-bs-toggle="tooltip" data-bs-placement="left" title="My Action LUP - ON EXTENSION">
                <i class="bi bi-distribute-vertical"></i>
                <span class="badge bg-success badge-number">{{ $mylupactionextension }}</span>
              </a><!-- End Notification Icon -->
            </li>
          </ul>
        </nav>     
        <nav class="header-nav ">
          <ul class="d-flex align-items-center">
            <li class="nav-item dropdown">
              <a class="nav-link card-icon rounded-circle d-flex align-items-center justify-content-center" href="/querylupmydeptactionopen" 
                data-bs-toggle="tooltip" data-bs-placement="left" title="My Dept Action LUP - OPEN">
                <i class="bi bi-diagram-2-fill"></i>
                <span class="badge bg-success badge-number">{{ $mydeptlupactionopen }}</span>
              </a><!-- End Notification Icon -->
            </li>
          </ul>
        </nav>   
        <nav class="header-nav ">
          <ul class="d-flex align-items-center">
            <li class="nav-item dropdown">
              <a class="nav-link card-icon rounded-circle d-flex align-items-center justify-content-center" href="/querylupmydeptactionoverdue" 
                data-bs-toggle="tooltip" data-bs-placement="left" title="My Dept Action LUP - OVERDUE">
                <i class="bi bi-diagram-3-fill"></i>
                <span class="badge {{ $mydeptlupactionoverdue==0 ? 'bg-success' : 'bg-danger' }} badge-number">{{ $mydeptlupactionoverdue }}</span>
              </a><!-- End Notification Icon -->
            </li>
          </ul>
        </nav>        
      </div><!-- End First Row  --> 
    </div>

  </div>
</div><!-- End User -->

<!-- LUP Dashboard for Leader & Related Departments -->
<div class="col-xxl-4 col-md-6">
  <div class="card info-card sales-card">      

    <div class="card-body">
      <h5 class="card-title">LUP<span> | Leader & Related Departments</span></h5>

      <div class="d-flex align-items-center flex-wrap">   <!-- First Row  -->             
          <nav class="header-nav ">
            <ul class="d-flex align-items-center">
              <li class="nav-item dropdown">
                <a class="nav-link card-icon rounded-circle d-flex align-items-center justify-content-center" href="/querylupleader" 
                  data-bs-toggle="tooltip" data-bs-placement="left" title="Sign for Leader LUP">
                  <i class="bi bi-file-earmark-person"></i>
                  <span class="badge {{ $mylupsubordinate==0 ? 'bg-success' : 'bg-danger' }} badge-number">{{ $mylupsubordinate}}</span>
                </a><!-- End Notification Icon -->
              </li>
            </ul>
          </nav>
          <nav class="header-nav ">
            <ul class="d-flex align-items-center">
              <li class="nav-item dropdown">
                <a class="nav-link card-icon rounded-circle d-flex align-items-center justify-content-center" href="/queryluprelateddepartments" 
                  data-bs-toggle="tooltip" data-bs-placement="left" title="Sign for Related Departments LUP ">
                  <i class="bi bi-file-earmark-play"></i>
                  <span class="badge {{ $mylupdisposisi==0 ? 'bg-success' : 'bg-danger' }} badge-number">{{ $mylupdisposisi }}</span>
                </a><!-- End Notification Icon -->
              </li>
            </ul>
          </nav>
          <nav class="header-nav ">
            <ul class="d-flex align-items-center">
              <li class="nav-item dropdown">
                <a class="nav-link card-icon rounded-circle d-flex align-items-center justify-content-center" href="/querylupregulatoryreview" 
                  data-bs-toggle="tooltip" data-bs-placement="left" title="Review LUP for Regulatory">
                  <i class="bi bi-cursor-fill"></i>
                  <span class="badge {{ $mylupregulatory_review==0 ? 'bg-success' : 'bg-danger' }} badge-number">{{ $mylupregulatory_review }}</span>
                </a><!-- End Notification Icon -->
              </li>
            </ul>
          </nav>
          <nav class="header-nav ">
            <ul class="d-flex align-items-center">
              <li class="nav-item dropdown">
                <a class="nav-link card-icon rounded-circle d-flex align-items-center justify-content-center" href="/querylupregulatoryapproval" 
                  data-bs-toggle="tooltip" data-bs-placement="left" title="Approval LUP for Regulatory">
                  <i class="bi bi-door-open-fill"></i>
                  <span class="badge {{ $mylupregulatory_approval==0 ? 'bg-success' : 'bg-danger' }} badge-number">{{ $mylupregulatory_approval }}</span>
                </a><!-- End Notification Icon -->
              </li>
            </ul>
          </nav>        
        
      </div><!-- End First Row  --> 
    </div>

  </div>
</div><!-- End User -->

<!-- LUP Dashboard for Reviewer -->
<div class="col-xxl-4 col-md-6">
  <div class="card info-card sales-card">      

    <div class="card-body">
      <h5 class="card-title">LUP<span> | Reviewer</span></h5>

      <div class="d-flex align-items-center flex-wrap">   <!-- First Row  -->             
          <nav class="header-nav ">
            <ul class="d-flex align-items-center">
              <li class="nav-item dropdown">
                <a class="nav-link card-icon rounded-circle d-flex align-items-center justify-content-center" href="/queryluponprocess" 
                  data-bs-toggle="tooltip" data-bs-placement="left" title="LUP ON PROCESS">
                  <i class="bi bi-file-earmark-person"></i>
                  <span class="badge {{ $luponprocess==0 ? 'bg-success' : 'bg-danger' }}  badge-number">{{ $luponprocess}}</span>
                </a><!-- End Notification Icon -->
              </li>
            </ul>
          </nav>                   
          <nav class="header-nav ">
            <ul class="d-flex align-items-center">
              <li class="nav-item dropdown">
                <a class="nav-link card-icon rounded-circle d-flex align-items-center justify-content-center" href="/queryluponapproved" 
                  data-bs-toggle="tooltip" data-bs-placement="left" title="LUP APPROVED">
                  <i class="bi bi-door-open-fill"></i>
                  <span class="badge {{ $luponapproved==0 ? 'bg-success' : 'bg-danger' }}  badge-number">{{ $luponapproved}}</span>
                </a><!-- End Notification Icon -->
              </li>
            </ul>
          </nav>          
        <nav class="header-nav ">
          <ul class="d-flex align-items-center">
            <li class="nav-item dropdown">
              <a class="nav-link card-icon rounded-circle d-flex align-items-center justify-content-center" href="/querylupactionoverdue" 
                data-bs-toggle="tooltip" data-bs-placement="left" title="Action LUP - OVERDUE">
                <i class="bi bi-exclamation-diamond-fill"></i>
                <span class="badge {{ $lupactionoverdue==0 ? 'bg-success' : 'bg-danger' }}  badge-number">{{ $lupactionoverdue }}</span>
              </a><!-- End Notification Icon -->
            </li>
          </ul>
        </nav>  
        <nav class="header-nav ">
          <ul class="d-flex align-items-center">
            <li class="nav-item dropdown">
              <a class="nav-link card-icon rounded-circle d-flex align-items-center justify-content-center" href="/querylupactionextension" 
                data-bs-toggle="tooltip" data-bs-placement="left" title="Action LUP - ON EXTENSION">
                <i class="bi bi-distribute-vertical"></i>
                <span class="badge {{ $lupactionextension==0 ? 'bg-success' : 'bg-danger' }}  badge-number">{{ $lupactionextension }}</span>
              </a><!-- End Notification Icon -->
            </li>
          </ul>
        </nav>           
        <nav class="header-nav ">
          <ul class="d-flex align-items-center">
            <li class="nav-item dropdown">
              <a class="nav-link card-icon rounded-circle d-flex align-items-center justify-content-center" href="/querylupmydeptactionoverdue" 
                data-bs-toggle="tooltip" data-bs-placement="left" title="My Dept Action LUP - OVERDUE">
                <i class="bi bi-diagram-3-fill"></i>
                <span class="badge bg-danger badge-number">{{ $mydeptlupactionoverdue }}</span>
              </a><!-- End Notification Icon -->
            </li>
          </ul>
        </nav>        
      </div><!-- End First Row  --> 
    </div>

  </div>
</div><!-- End Reviewer Card -->

<!-- LUP Dashboard for Approver -->
<div class="col-xxl-4 col-md-6">
  <div class="card info-card sales-card">      

    <div class="card-body">
      <h5 class="card-title">LUP<span> | Approver</span></h5>

      <div class="d-flex align-items-center flex-wrap">   <!-- First Row  -->         
          <nav class="header-nav ">
            <ul class="d-flex align-items-center">
              <li class="nav-item dropdown">
                <a class="nav-link card-icon rounded-circle d-flex align-items-center justify-content-center" href="/queryluponreview" 
                  data-bs-toggle="tooltip" data-bs-placement="left" title="LUP ON REVIEW">
                  <i class="bi bi-file-earmark-play"></i>
                  <span class="badge {{ $luponreview==0 ? 'bg-success' : 'bg-danger' }}  badge-number">{{ $luponreview }}</span>
                </a><!-- End Notification Icon -->
              </li>
            </ul>
          </nav>
          <nav class="header-nav ">
            <ul class="d-flex align-items-center">
              <li class="nav-item dropdown">
                <a class="nav-link card-icon rounded-circle d-flex align-items-center justify-content-center" href="/queryluponapproval" 
                  data-bs-toggle="tooltip" data-bs-placement="left" title="LUP ON APPROVAL">
                  <i class="bi bi-cursor-fill"></i>
                  <span class="badge {{ $luponapproval==0 ? 'bg-success' : 'bg-danger' }}  badge-number">{{ $luponapproval }}</span>
                </a><!-- End Notification Icon -->
              </li>
            </ul>
          </nav>
          <nav class="header-nav ">
            <ul class="d-flex align-items-center">
              <li class="nav-item dropdown">
                <a class="nav-link card-icon rounded-circle d-flex align-items-center justify-content-center" href="/queryluponapproved" 
                  data-bs-toggle="tooltip" data-bs-placement="left" title="LUP APPROVED">
                  <i class="bi bi-door-open-fill"></i>
                  <span class="badge {{ $luponapproved==0 ? 'bg-success' : 'bg-danger' }}  badge-number">{{ $luponapproved}}</span>
                </a><!-- End Notification Icon -->
              </li>
            </ul>
          </nav>        
        <nav class="header-nav ">
          <ul class="d-flex align-items-center">
            <li class="nav-item dropdown">
              <a class="nav-link card-icon rounded-circle d-flex align-items-center justify-content-center" href="/querylupactionextensionapproval" 
                data-bs-toggle="tooltip" data-bs-placement="left" title="Action LUP - ON EXTENSION APPROVAL">
                <i class="bi bi-diagram-2-fill"></i>
                <span class="badge bg-success badge-number">{{ $lupactionextensionapproval }}</span>
              </a><!-- End Notification Icon -->
            </li>
          </ul>
        </nav>           
      </div><!-- End First Row  --> 
    </div>

  </div>
</div><!-- End Approver Card -->
        
        
        
        
        
        