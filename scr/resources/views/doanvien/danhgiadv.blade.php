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
              @if(!$dotdg)
                <strong class="card-title" style="font-size:20px">Ngoài thời gian đánh giá</strong>
              @else
                <strong class="card-title" style="font-size:20px">Đánh giá đoàn viên</strong>
              @endif
            </div>
            @if($dotdg)
            <div class="card-body">
              <table id="bootstrap-data-table" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Chi đoàn</th>
                    <th>Mã</th>
                    <th>Đoàn viên</th>
                    <th>Loại</th>
                    <th>Chi tiết</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                    $stt = 1;
                  @endphp
                  @foreach($danhgia as $dg)
                    <tr>
                      <th class="text-center align-middle">{{ $stt++ }}.</th>
                      <td class="align-middle">{{$dg->macd}}</td>
                      <td class="align-middle">{{$dg->madv}}</td>
                      <td class="align-middle">{{$dg->hoten}}</td>
                      <td class="align-middle">{{$dg->tenloaidv}}</td>
                      <td class="align-middle">
                        <a href="/ktcn/dgcanhan?dv={{$dg->madv}}" class="btn btn-secondary mr-2 py-1 px-2"><i class="fa fa-eye" style="font-size: 18px"></i></a>
                      </td>
                    </tr>
                  @endforeach  
                </tbody>
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