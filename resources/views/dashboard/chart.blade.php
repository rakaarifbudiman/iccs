<!-- Reports -->
<div class="col-12">
    <div class="card">

      <div class="filter">
        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
          <li class="dropdown-header text-start">
            <h6>Filter</h6>
          </li>
          <li><a class="dropdown-item" href="#">Today</a></li>
          <li><a class="dropdown-item" href="#">This Month</a></li>
          <li><a class="dropdown-item" href="#">This Year</a></li>
        </ul>
      </div>
            @php
              $now = now();
              $weekStartDate = $now->startOfWeek()->format('Y-m-d');
              $weekEndDate = $now->endOfWeek()->format('d');
              
            @endphp
      
      <div class="card-body">
        <h5 class="card-title">Reports <span>/This Month</span></h5>

        <!-- Line Chart -->
        <div id="reportsChart"></div>
        
        <script>
          document.addEventListener("DOMContentLoaded", () => {
            new ApexCharts(document.querySelector("#reportsChart"), {
              series: [{
                name: 'LUP',
                data: [31, 40, 28, 51, 42, 82, 56, 95],
              }, {
                name: 'FLP',
                data: [11, 32, 45, 32, 34, 52, 120, 25]
              }, {
                name: 'LUPD',
                data: [15, 11, 32, 18, 9, 24, 11, 50]
              }],
              chart: {
                height: 350,
                type: 'area',
                toolbar: {
                  show: false
                },
              },
              markers: {
                size: 4
              },
              colors: ['#4154f1', '#2eca6a', '#ff771d'],
              fill: {
                type: "gradient",
                gradient: {
                  shadeIntensity: 1,
                  opacityFrom: 0.3,
                  opacityTo: 0.4,
                  stops: [0, 90, 100]
                }
              },
              dataLabels: {
                enabled: false
              },
              stroke: {
                curve: 'smooth',
                width: 2
              },
              xaxis: {
                type: 'datetime',
                categories: ["2018-09-01T00:00:00.000Z", "2018-09-02T00:00:00.000Z", "2018-09-03T00:00:00.000Z", "2018-09-04T00:00:00.000Z", "2018-09-05T00:00:00.000Z", "2018-09-06T00:00:00.000Z", "2018-09-07T00:00:00.000Z", "2018-09-08T00:00:00.000Z"]
              },
              tooltip: {
                x: {
                  format: 'dd-MMM-y'
                },
              }
            }).render();
          });
        </script>
        <!-- End Line Chart -->

      </div>

    </div>
  </div><!-- End Reports -->