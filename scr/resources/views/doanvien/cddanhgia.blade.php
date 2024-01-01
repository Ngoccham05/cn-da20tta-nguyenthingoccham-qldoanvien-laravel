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
              @if($dotdg && ($dotdg->trangthai == "Chi đoàn đánh giá" || $dotdg->trangthai == "Đoàn khoa đánh giá"))
              <div class="row">
                <div class="col-10">
                  <strong class="card-title" style="font-size:20px">Đánh giá chi đoàn {{$dotdg->tendot}}</strong>
                  <p class="mt-2">Chi đoàn xem hướng dẫn đánh giá
                    <a href="{{ asset('fileUploads/' . $bm->duongdan) }}" class="text-primary" target="_blank">tại đây</a>.
                  </p>
                </div>
                <div class="col-2 text-right">
                  @if($dotdg->trangthai == "Chi đoàn đánh giá")
                    @if($xeploaicd)
                      <button type="button" class="btn btn-primary" onclick="sua('{{$xeploaicd->loaicd->id}}')" 
                        data-toggle="modal" data-target="#themModal" style="font-size: 16px">Đánh giá</button>
                    @else
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#themModal" style="font-size: 16px">Đánh giá</button>
                    @endif  
                  @endif
                </div>
              </div>
              
              @else
              <strong class="card-title" style="font-size:20px">Ngoài thời gian đánh giá</strong>
              @endif
            </div>
            <!-- Bảng kết quả đã đánh giá -->
            @if($dotdg && ($dotdg->trangthai == "Chi đoàn đánh giá" || $dotdg->trangthai == "Đoàn khoa đánh giá"))
            <div class="card-body">
              @if($xeploaicd)
                <table id="" class="table table-bordered table-hover">
                  <tr>
                    <th>Chi đoàn</th>
                    <th>Xếp loại</th>
                    <th>Trạng Thái</th>
                  </tr>
                  <tr>
                    <td>{{$xeploaicd->chidoan->macd}}</td>
                    <td>{{$xeploaicd->loaicd->tenloaicd}}</th>
                    <td>{{$dotdg->trangthai}}</td>
                  </tr>
                </table><hr>
              @endif

              @if($dotdg->trangthai == 'Chi đoàn đánh giá')
                <div class="modal fade" id="themModal" tabindex="-1" role="dialog" aria-labelledby="themDataModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header d-flex">
                        <h5 class="modal-title h5" id="themDataModalLabel">Đánh giá</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="/ktcn/cddg" method="post">
                          @csrf
                          <div class="row">
                            <input type="text" class="form-control d-none" value="{{$dotdg->madot}}" name="txtmadot">
                          </div>
                          <div class="row mb-3">
                            <div class="col-3 mt-2">Chi đoàn:</div>
                            <div class="col-9"><input type="text" class="form-control bg-light" value="{{$macd}}" name="txtmacd" readonly></div>
                          </div>
                          <div class="row mb-3">
                            <div class="col-3 mt-2">Xếp loại:</div>
                            <div class="col-9">
                              <select name="slloai" id="slloai" class="form-control">
                                @foreach($loaicd as $loai)
                                  <option value="{{$loai->id}}">{{$loai->tenloaicd}}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary">Lưu</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              @endif

              <!-- Bảng tỉ lệ, tiêu chí -->
              <table id="" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Tiêu chí</th>
                    <th>Tỉ lệ</th>
                  </tr>
                </thead>
                <tbody>                
                  @php
                    $stt = 1;
                  @endphp
                  @foreach($xeploai as $item)
                  <tr>
                    <th class="align-middle">{{ $stt++ }}.</th>
                    <td class="align-middle">Tỉ lệ đoàn viên {{ $item['loaidv'] }}</td>
                    <td class="align-middle">{{ $item['tile'] }}%</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div><!--card body-->
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
    <script>
      function sua(loai){
        $('#slloai').val(loai);
      };
    </script>

@include('doanvien.footer')