@include('admin.header')

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
        </div> <!--row-->

        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header d-flex justify-content-between align-items-center">
                @foreach($hoatdong as $hd)
                  <strong class="card-title mt-1 mr-auto" style="font-size:20px">{{$hd->tenhd}}</strong>

                  <form action="/admin/themdvtg" method="post" class="d-flex">
                    @csrf
                    <input type="text" class="form-control d-none" id="txtmadh" name="txtmahd" value="{{$hd->id}}">

                    <select name="sldoanvien" id="sldoanvien" class="form-control mr-2 w-100">
                      <option value="" disabled selected>Mã đoàn viên</option>
                      @foreach($doanvien as $dv)
                        <option value="{{$dv->madv}}">{{$dv->madv}}</option>
                      @endforeach
                    </select>
                    <!-- <input type="text" class="form-control mr-2" id="txtmadv" name="txtmadv" required autocomplete="off" placeholder="Mã đoàn viên..."> -->
                    <button type="submit" class="btn btn-success" style="font-size: 16px"><i class="fa fa-plus mr-2"></i> Thêm</button>
                  </form>
                @endforeach
              </div>
              <div class="card-body">
                <table id="bootstrap-data-table" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Mã đoàn viên</th>
                      <th>Họ tên</th>
                      <th>Chi đoàn</th>
                      <th>Hành động</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $stt = 1;
                    @endphp
                    @foreach($thamgia as $tg)
                      <tr>
                        <th class="align-middle text-center">{{$stt++}}.</th>
                        <td class="align-middle">{{$tg->madv}}</td>
                        <td class="align-middle">{{$tg->hoten}}</td>
                        <td class="align-middle">{{$tg->macd}}</td>
                        <td class="align-middle">                              
                          <a href="#" class="btn btn-danger py-1 px-2" onclick="xoatg('{{$tg->mahd}}', '{{$tg->madv}}')" data-toggle="modal" data-target="#xoa-Modal">
                            <i class="fa fa-trash" style="font-size:18px"></i>
                          </a>
                        </td>
                      </tr>
                    @endforeach  
                  </tbody>
                </table>
              </div>
            </div>
          </div>   
        </div>

        <!-- Xóa -->
        <div class="modal fade" id="xoa-Modal" tabindex="-1" role="dialog" aria-labelledby="xoa-ModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header d-flex">
                <h5 class="modal-title h5" id="xoa-ModalLabel">Xóa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="/admin/xoadvtg" method="POST">
                  @csrf
                  @method('DELETE')
                  <div class="form-group">
                    <label>Bạn có chắc muốn xóa không?</label>
                    <input type="text" class="form-control d-none" id="txtmahd-xoa" name="txtmahd-xoa">
                    <input type="text" class="form-control d-none" id="txtmadv-xoa" name="txtmadv-xoa">
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Xóa</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
  </div>

  <script>
    function xoatg(hd, dv){
      $('#txtmahd-xoa').val(hd);
      $('#txtmadv-xoa').val(dv);
    }
  </script>

@include('admin.footer')