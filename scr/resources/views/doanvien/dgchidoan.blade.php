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
              <strong class="card-title" style="font-size:20px">Đánh giá chi đoàn {{$dotdg->tendot}}</strong> 
            </div>

            <div class="card-body">
              <form action="/ktcn/cddg" method="post">
                @csrf
                <div class="row mb-3">
                  <div class="col-2 mt-2">
                    <b>Chi đoàn: {{$macd}}</b>
                    <input type="text" class="form-control d-none" value="{{$dotdg->madot}}" name="txtmadot">
                    <input type="text" class="form-control d-none" value="{{$macd}}" name="txtmacd">
                  </div>

                  <div class="col-3 mt-2 text-right"><b>Xếp loại:</b></div>
                  <div class="col-3">
                    <select name="slloai" id="slloai" class="form-control">
                      @foreach($loaicd as $loai)
                        <option value="{{$loai->id}}" @if($xeploaicd && $xeploaicd->loaicd->tenloaicd == $loai->tenloaicd) selected @endif>
                          {{$loai->tenloaicd}}
                        </option>
                      @endforeach
                    </select>
                  </div>
                  @if($dotdg->trangthai == 'Đoàn khoa đánh giá')
                  <div class="col-4 text-right"><button type="submit" class="btn btn-primary">Đánh giá</button></div>
                  @endif
                </div>                               
              </form>
              <hr>

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
            </div>
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