          <!-- Recent Activity -->
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

            <div class="card-body">
              <h5 class="card-title">Recent Activity</h5>              
              <div class="activity">
                @forelse ($lastActivity as $activity)
                @php                                 
                  $getdiff = getDiffFromMinute($activity->created_at);                
                  
                @endphp   
                  <div class="activity-item d-flex">
                    <div class="activite-label">{{$getdiff}} ago</div>
                    <i class='bi bi-circle-fill activity-badge 
                    {{$activity->event=='created' ? 'text-primary' : (
                      $activity->event=='edited' ? 'text-warning' : (
                      $activity->event=='sign' ? 'text-success' :  (
                      $activity->event=='deleted' ? 'text-danger' : 'text-secondary' 
                      )
                      )
                    )}} 
                    align-self-start'>
                    </i>
                    <div class="activity-content">
                      {{$activity->user->username}} - {{$activity->description}}
                    </div>
                  </div><!-- End activity item-->   
                @empty                  
                @endforelse        

              </div>

            </div>
          </div><!-- End Recent Activity -->




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