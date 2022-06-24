<!-- State Report -->
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

    <div class="card-body pb-0">
      <h5 class="card-title">State Report <span>| All</span></h5>

      <div id="stateChart" style="min-height: 400px;" class="echart"></div>

      <script>
        document.addEventListener("DOMContentLoaded", () => {
          var stateChart = echarts.init(document.querySelector("#stateChart")).setOption({
            legend: {
              data: ['LUP', 'LUPD', 'FLP', ' ']
            },
            radar: {
              // shape: 'circle',
              indicator: [{
                  name: 'Closed',
                  max: {{ $maxflp }}
                },
                {
                  name: 'Overdue',
                  max: {{ $maxflp }}
                },
                {
                  name: 'Open',
                  max: {{ $maxflp }}
                },
                {
                  name: 'On Approval',
                  max: {{ $maxflp }}
                },
                {
                  name: 'On Review',
                  max: {{ $maxflp }}
                },
                {
                  name: 'On Process',
                  max: {{ $maxflp }}
                }
              ]
            },
            series: [{
              name: 'Budget vs spending',
              type: 'radar',
              data: [{
                  value: [16, 8, 16, 8, 16, 8],
                  name: 'LUP'
                },
                {
                  value: [10, 20, 10, 20, 10, 20],
                  name: 'LUPD'
                },
                {
                  value: [16, 20, 16, 20, 16, 20],
                  name: 'FLP'
                },
                {
                  value: [4, 4, 4, 4, 4, 4],
                  name: ' '
                }
              ]
            }]
          });
        });
      </script>

    </div>
  </div><!-- End Budget Report -->