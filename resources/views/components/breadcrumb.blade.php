<div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-lg-8">
          {{ $breadcrumb_title ?? '' }}
          <nav style="--bs-breadcrumb-divider: '|';" id="LUPHeader">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
                {{ $slot ?? ''}}
            </ol>
          </nav>
        </div>
        <div class="col-lg-4">
          <!-- Bookmark Start-->
          <div class="bookmark">
            <ul>
              {{ $bookmark ?? ''}}
            </ul>
          </div>
          <!-- Bookmark Ends-->
        </div>
      </div>
    </div>
</div>