@include('doanvien.header')

    <div class="animated fadeIn">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <strong class="card-title mt-1" style="font-size:20px">Kết quả đánh giá chi đoàn</strong>
            </div>
            <div class="card-body">
              <div class="custom-tab">
                <nav>
                  <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link px-3 active" id="nav-tatca-tab" data-toggle="tab" href="#nav-tatca" role="tab" aria-controls="nav-tatca" aria-selected="true" style="font-size:13px">Tất cả</a>
                    <a class="nav-item nav-link px-3" id="nav-canhan-tab" data-toggle="tab" href="#nav-canhan" role="tab" aria-controls="nav-canhan" aria-selected="false" style="font-size:13px">Chi đoàn</a>
                  </div>
                </nav>
                <div class="tab-content pl-3 pt-3" id="nav-tabContent">
                  <div class="tab-pane fade show active" id="nav-tatca" role="tabpanel" aria-labelledby="nav-tatca-tab">
                    <table id="bootstrap-data-table" class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Kỳ</th>
                          <th>Chi đoàn</th>
                          <th>Loại</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                          $stt = 1;
                        @endphp
                        @foreach($danhgia as $dg)
                          <tr>
                            <th class="text-center align-middle">{{ $stt++ }}.</th>
                            <td class="align-middle">{{$dg->tendot}}</td>
                            <td class="align-middle">{{$dg->macd}}</td>
                            <td class="align-middle">{{$dg->tenloaicd}}</td>
                          </tr>
                        @endforeach  
                      </tbody>
                    </table>
                  </div>
                  
                  <!--Cá nhân-->
                  <div class="tab-pane fade" id="nav-canhan" role="tabpanel" aria-labelledby="nav-canhan-tab">
                    <table id="" class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Kỳ</th>
                          <th>Chi đoàn</th>
                          <th>Loại</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                          $stt = 1;
                        @endphp
                        @foreach($chidoan as $dg)
                          <tr>
                            <th class="text-center align-middle">{{ $stt++ }}.</th>
                            <td class="align-middle">{{$dg->tendot}}</td>
                            <td class="align-middle">{{$dg->macd}}</td>
                            <td class="align-middle">{{$dg->tenloaicd}}</td>
                          </tr>
                        @endforeach  
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>   
      </div>

    </div>
  </div>
  <div class="clearfix"></div>
</div>

@include('doanvien.footer')