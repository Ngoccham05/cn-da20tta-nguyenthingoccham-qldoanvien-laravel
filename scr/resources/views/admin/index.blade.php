@include('admin.header')
    <div class="animated fadeIn">
    <!-- Widgets  -->
      <div class="row">
        <div class="col-lg-4 col-md-4">
          <div class="card">
            <div class="card-body">
              <div class="stat-widget-five">
                <div class="stat-icon dib flat-color-1">
                  <i class="fa fa-th" style="color: #17a2b8"></i>
                </div>
                <div class="stat-content">
                  <div class="text-left dib">
                    <div class="stat-text"><span class="">{{$slchidoan}}</span></div>
                    <div class="stat-heading">Chi đoàn</div>
                  </div>
                </div>
              </div><!--card-->
            </div><!--card-body-->
          </div><!--card-->
        </div>

        <div class="col-lg-4 col-md-4">
          <div class="card">
            <div class="card-body">
              <div class="stat-widget-five">
                <div class="stat-icon dib flat-color-2">
                  <i class="fa fa-users" style="color: #007bff"></i>
                </div>
                <div class="stat-content">
                  <div class="text-left dib">
                    <div class="stat-text"><span class="">{{$sldoanvien}}</span></div>
                    <div class="stat-heading">Đoàn viên</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-4">
          <div class="card">
            <div class="card-body">
              <div class="stat-widget-five">
                <div class="stat-icon dib flat-color-3">
                  <i class="fa fa-calendar" style="color: #e83e8c"></i>
                </div>
                <div class="stat-content">
                  <div class="text-left dib">
                    <div class="stat-text"><span class="">{{$slhoatdong}}</span></div>
                    <div class="stat-heading">Hoạt động</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /Widgets -->
      
      <div class="row d-flex align-items-stretch">
        <div class="col-lg-5 col-md-5">
          <div class="card">
            <div class="card-header">
              <h4>Tỉ lệ giới tính </h4>
            </div>
            <div class="card-body" style="height:350px !important">
              <canvas id="genderChart" style="height:100% !important"></canvas>
            </div>
          </div>
        </div><!-- /# column -->

        <div class="col-lg-7 col-md-7">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h4>Xếp loại đoàn viên</h4>              
              <!-- <select name="sldot" id="sldot" class="form-control-sm w-25">
                @foreach($chidoan as $cd)
                  <option value="{{$cd->macd}}">{{$cd->macd}}</option>
                @endforeach
              </select> -->
            </div>
            <div class="card-body" style="height:350px !important;">
              <canvas id="myChart" style="height:100% !important; width: 98% !important"></canvas>
            </div>
          </div>
        </div><!-- /# column -->
      </div>
            <!-- /#add-category -->
    </div>
            <!-- .animated -->
  </div>
        <!-- /.content -->
  <div class="clearfix"></div>
</div>
    <!-- /#right-panel -->


<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
//Biểu đồ tròn
    document.addEventListener('DOMContentLoaded', function () {
        var slgNam = {!! $slgnam !!};
        var slgNu = {!! $slgnu !!};
        var tong = slgNam + slgNu;

        var ctx = document.getElementById('genderChart').getContext('2d');
        var genderChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Nam', 'Nữ'],
                datasets: [{
                    data: [slgNam, slgNu],
                    backgroundColor: ['#007bff', '#e83e8c'],
                }],
            },
            options: {
                tooltips: {
                    callbacks: {
                        label: function (tooltipItem, data) {
                            var currentValue = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                            var percentage = ((currentValue / tong) * 100).toFixed(2);
                            return currentValue + ' (' + percentage + '%)';
                        }
                    }
                },
            },
        });
    });

//Biểu đồ cột
    var data = <?php echo json_encode($loaidv); ?>;

    var labels = [];
    var datasets = [];
    var pastelColors = ['#e83e8c', '#17a2b8', '#007bff', '#ffc107'];

    data.forEach(function (item) {
        var index = labels.indexOf(item.tendot);

        if (index === -1) {
            labels.push(item.tendot);
            index = labels.length - 1;
        }

        if (!datasets[item.tenloaidv]) {
            var colorIndex = Object.keys(datasets).length % pastelColors.length;
            datasets[item.tenloaidv] = {
                label: item.tenloaidv,
                data: Array(labels.length).fill(0),
                backgroundColor: pastelColors[colorIndex],
            };
        }

        datasets[item.tenloaidv].data[index] = item.soLuong;
    });

    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: Object.values(datasets),
        },
        options: {
            scales: {
                x: {
                    stacked: false,
                },
                y: {
                    stacked: false,
                },
            },
            barGroup: 'group1',
            categoryPercentage: 0.7, 
            barPercentage: 0.9,
        },
    });

    // document.addEventListener("DOMContentLoaded", function() {
    //   function vebdloc(data){
    //       var labels = [];
    //       var datasets = [];
    //       var pastelColors = ['#e83e8c', '#17a2b8', '#007bff', '#ffc107'];

    //       data.forEach(function (item) {
    //           var index = labels.indexOf(item.tendot);

    //           if (index === -1) {
    //               labels.push(item.tendot);
    //               index = labels.length - 1;
    //           }

    //           if (!datasets[item.tenloaidv]) {
    //               var colorIndex = Object.keys(datasets).length % pastelColors.length;
    //               datasets[item.tenloaidv] = {
    //                   label: item.tenloaidv,
    //                   data: Array(labels.length).fill(0),
    //                   backgroundColor: pastelColors[colorIndex],
    //               };
    //           }

    //           datasets[item.tenloaidv].data[index] = item.soLuong;
    //       });

    //       if (window.myChart) {
    //           window.myChart.destroy();
    //       }

    //       window.myChart = new Chart(ctx, {
    //           type: 'bar',
    //           data: {
    //               labels: labels,
    //               datasets: Object.values(datasets),
    //           },
    //           options: {
    //               scales: {
    //                   x: {
    //                       stacked: false,
    //                   },
    //                   y: {
    //                       stacked: false,
    //                       ticks: {
    //                           stepSize: 1,
    //                       },
    //                   },
    //               },
    //               barGroup: 'group1',
    //               categoryPercentage: 0.6, 
    //               barPercentage: 0.9,
    //           },
    //       });
    //   }

    
    //   function fetchDataAndDrawChart(macd) {
    //     const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    //     const bdloc = {
    //       macd: macd,
    //       _token: csrfToken
    //     };
    //     axios.post('/admin/bdloc', bdloc)
    //       .then(function (response) {    
    //         // console.log(response.data.loaidv);
    
    //         vebdloc(response.data.loaidv);
    //       })
    //       .catch(error => {
    //         console.error(error);
    //         alert("Thất bại");
    //     });
    //   }

    //   $(document).ready(function() {
    //       $('#sldot').change(function() {
    //           var macd = $(this).val();
    //           fetchDataAndDrawChart(macd);
    //       });
    //   });
    // });
</script>


@include('admin.footer')