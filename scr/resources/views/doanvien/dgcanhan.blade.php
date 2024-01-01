@include('doanvien.header')
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-12">
          @if(session('error'))
            <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
              <span class="badge badge-pill badge-danger mr-2">Fail</span>{{ session('error') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>          
          @endif

          @if(session('success'))
            <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
              <span class="badge badge-pill badge-success mr-2">Success</span> {{ session('success') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              @if($dotdg)
              <strong class="card-title" style="font-size:20px">Đánh giá đoàn viên {{$dotdg->tendot}}</strong>
              @else
              <strong class="card-title" style="font-size:20px">Ngoài thời gian đánh giá</strong>
              @endif  
            </div>
            @if($dotdg)
            <div class="card-body">
              @if($xeploai)
                <table id="" class="table table-bordered table-hover">
                  <tr>
                    <th>Mã Đoàn viên</th>
                    <th>Họ tên</th>
                    <th>Xếp loại</th>
                    <th>Trạng Thái</th>
                  </tr>
                  <tr>
                    <td>{{$xeploai->doanvien->madv}}</td>
                    <td>{{$xeploai->doanvien->hoten}}</td>
                    <td>{{$xeploai->loaidv->tenloaidv}}</th>
                    <td>{{$dotdg->trangthai}}</td>
                  </tr>
                </table><hr>
              @endif

              <table id="" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th class="text-center align-middle" style="width: 60px">#</th>
                    <th>Tiêu chí</th>
                    <th class="text-center align-middle" style="width: 100px">Đánh giá</th>
                    <th class="text-center align-middle">Minh chứng</th>
                  </tr>
                </thead>
                <form action="/ktcn/bchdanhgia" method="post">
                  @csrf
                  <tbody>                
                    @php
                      $stt = 1;
                    @endphp
                    @foreach($tieuchi as $tc)
                      <tr>
                        <th class="text-center align-middle">{{ $stt++ }}.</th>
                        <td class="align-middle">{{$tc->tentc}}</td>
                        <td class="text-center align-middle">
                          <input type="text" class="form-control d-none" value="{{$madv}}" name="txtmadv[]">
                          <input type="text" class="form-control d-none" value="{{$dotdg->madot}}" name="txtmadot[]">
                          <input type="checkbox" name="cbmatc[]" value="{{ $tc->id }}" {{ in_array($tc->id, $tcdat) ? 'checked' : '' }} style="width:20px; height:20px">

                        </td>
                        <td class="align-middle">
                          @if(in_array($tc->id, $tcdat))
                            @php
                                $index = array_search($tc->id, $tcdat);
                            @endphp
                            <a href="{{$mcdat[$index]}}" target="_blank"><i>Xem minh chứng</i></a>
                            <input type="text" class="form-control d-none" id="txtminhchung" name="txtminhchung[{{ $tc->id }}]" value="{{ $mcdat[$index] ?? '' }}" autocomplete="off">
                          @else
                            <input type="text" class="form-control d-none" id="txtminhchung" name="txtminhchung[{{ $tc->id }}]" autocomplete="off">
                          @endif
                        </td>
                      </tr>
                    @endforeach

                    @if(Auth::guard('doanvien')->user()->role == 1)
                      @if($dotdg->trangthai == "Đoàn khoa đánh giá")
                        <tr><td colspan="4" class="text-right"><button type="submit" class="btn btn-primary">Đánh giá</button></td></tr>
                      @endif
                    @elseif(Auth::guard('doanvien')->user()->role == 2)
                      @if($dotdg->trangthai == "Chi đoàn đánh giá")
                      <tr><td colspan="4" class="text-right"><button type="submit" class="btn btn-primary">Đánh giá</button></td></tr>
                      @endif
                    @endif
                  </tbody>
                </form>
              </table>
            </div>
            @endif
          </div>
        </div>   
      </div>


    </div><!-- .animated -->
  </div>
  <!-- /.content -->
  <div class="clearfix"></div>
</div>
<!-- /#right-panel -->

@include('doanvien.footer')