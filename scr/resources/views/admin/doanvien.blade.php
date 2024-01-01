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
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <strong class="card-title mt-1" style="font-size:20px">Danh sách đoàn viên</strong>
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#them-Modal" style="font-size: 16px">
                <i class="fa fa-plus mr-2"></i> Thêm
              </button>
            </div>
            <div class="card-body">
              <table id="bootstrap-data-table" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Mã</th>
                    <th>Tên</th>
                    <th>Giới</th>
                    <th>Ngày sinh</th>
                    <th>Chi đoàn</th>
                    <th>Chức vụ</th>
                    <th>Hành động</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                    $stt = 1;
                  @endphp
                  @foreach($doanvien as $dv)
                    <tr>
                      <th class="text-center align-middle">{{ $stt++ }}.</th>
                      <td class="align-middle">{{$dv->madv}}</td>
                      <td class="align-middle">{{$dv->hoten}}</td>
                      <td class="align-middle">{{$dv->gioitinh}}</td>
                      <td class="align-middle">{{date('d/m/Y', strtotime($dv->ngaysinh))}}</td>
                      <td class="align-middle">{{$dv->macd}}</td>
                      <td class="align-middle">{{$dv->chucvu->tencv}}</td>
                      <td class="align-middle">
                        <a href="#" class="btn btn-primary mr-2 py-1 px-2" data-toggle="modal" data-target="#sua-Modal"
                          onclick="suadv('{{$dv->madv}}', '{{$dv->hoten}}', '{{$dv->gioitinh}}', '{{$dv->ngaysinh}}', '{{$dv->sdt}}', 
                                         '{{$dv->diachi}}', '{{$dv->ngayvaodoan}}', '{{$dv->noivaodoan}}', '{{$dv->macd}}', '{{$dv->macv}}')">
                          <i class="fa fa-edit" style="font-size: 18px"></i>
                        </a>   
                              
                        <a href="#" class="btn btn-danger py-1 px-2" onclick="xoadv('{{$dv->madv}}')" data-toggle="modal" data-target="#xoa-Modal">
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

      <!-- Modal thêm-->
      <div class="modal fade" id="them-Modal" tabindex="-1" role="dialog" aria-labelledby="them-ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header d-flex">
              <h5 class="modal-title h5" id="them-ModalLabel">Thêm</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form action="/admin/themdv" method="POST">
              <div class="modal-body">
                @csrf
                <div class="row">
                  <div class="col-2 d-flex align-items-center"><label for="txtma">Mã: </label></div>
                  <div class="col-3"><input type="text" class="form-control mb-3" id="txtma" name="txtma" required autocomplete="off"></div>

                  <div class="col-2 d-flex align-items-center ml-5"><label for="txtten">Họ tên: </label></div>
                  <div class="col-4"><input type="text" class="form-control mb-3" id="txtten" name="txtten" required autocomplete="off"></div>
                </div>

                <div class="row mb-3">
                  <div class="col-2 d-flex align-items-center"><label for="slgioi">Giới tính: </label></div>
                  <div class="col-3">
                    <select name="slgioi" class="form-control w-75">
                      <option value="Nam">Nam</option>
                      <option value="Nữ">Nữ</option>
                    </select>
                  </div>

                  <div class="col-2 d-flex align-items-center ml-5"><label for="txtngaysinh">Ngày sinh: </label></div>
                  <div class="col-4">
                    <input type="date" class="form-control w-75" id="txtngaysinh" name="txtngaysinh" required>
                    <div id="error-msg-ngaysinh" style="color: red;"></div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-2 d-flex align-items-center"><label for="txtsdt">SĐT: </label></div>
                  <div class="col-3"><input type="text" class="form-control mb-3" id="txtsdt" name="txtsdt" autocomplete="off"></div>

                  <div class="col-2 d-flex align-items-center ml-5"><label for="txtdiachi">Địa chỉ: </label></div>
                  <div class="col-4"><input type="text" class="form-control mb-3" id="txtdiachi" name="txtdiachi" autocomplete="off"></div>
                </div>

                <div class="row">
                  <div class="col-2 d-flex align-items-center"><label for="slchidoan">Chi đoàn: </label></div>
                  <div class="col-3">
                    <select name="slchidoan" class="form-control mb-3">
                      @foreach($chidoan as $cd)
                        <option value="{{$cd->macd}}">{{$cd->macd}}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="col-2 d-flex align-items-center ml-5"><label for="slchucvu">Chức vụ: </label></div>
                  <div class="col-4">
                    <select name="slchucvu" class="form-control mb-3">
                      @foreach($chucvu as $cv)
                        <option value="{{$cv->id}}">{{$cv->tencv}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-2 d-flex align-items-center"><label for="txtngayvd">Ngày vào Đoàn: </label></div>
                  <div class="col-3">
                    <input type="date" class="form-control" id="txtngayvd" name="txtngayvd">
                    <div id="error-msg-ngayvd" style="color: red;"></div>
                  </div>

                  <div class="col-2 d-flex align-items-center ml-5"><label for="txtnoivd">Nơi vào Đoàn: </label></div>
                  <div class="col-4"><input type="text" class="form-control mb-3" id="txtnoivd" name="txtnoivd" autocomplete="off"></div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                  <button type="submit" id="btnSave" class="btn btn-primary">Lưu</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Modal sửa-->
      <div class="modal fade" id="sua-Modal" tabindex="-1" role="dialog" aria-labelledby="sua-ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header d-flex">
              <h5 class="modal-title h5" id="sua-ModalLabel">Cập nhật</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form action="/admin/suadv" method="POST">
              <div class="modal-body">
                @csrf
                <div class="row">
                  <div class="col-2 d-flex align-items-center"><label for="txtma-sua">Mã: </label></div>
                  <div class="col-3"><input type="text" class="form-control mb-3" id="txtma-sua" name="txtma-sua" readonly></div>

                  <div class="col-2 d-flex align-items-center ml-5"><label for="txtten">Họ tên: </label></div>
                  <div class="col-4"><input type="text" class="form-control mb-3" id="txtten-sua" name="txtten-sua" required autocomplete="off"></div>
                </div>

                <div class="row mb-3">
                  <div class="col-2 d-flex align-items-center"><label for="slgioi-sua">Giới tính: </label></div>
                  <div class="col-3">
                    <select name="slgioi-sua" id="slgioi-sua" class="form-control w-75">
                      <option value="Nam">Nam</option>
                      <option value="Nữ">Nữ</option>
                    </select>
                  </div>
                  <div class="col-2 d-flex align-items-center ml-5"><label for="txtngaysinh-sua">Ngày sinh: </label></div>
                  <div class="col-4">
                    <input type="date" class="form-control" id="txtngaysinh-sua" name="txtngaysinh-sua" required>
                    <div id="error-msg-ngaysinh-sua" style="color: red;"></div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-2 d-flex align-items-center"><label for="txtsdt-sua">SĐT: </label></div>
                  <div class="col-3"><input type="text" class="form-control mb-3" id="txtsdt-sua" name="txtsdt-sua" autocomplete="off"></div>

                  <div class="col-2 d-flex align-items-center ml-5"><label for="txtdiachi-sua">Địa chỉ: </label></div>
                  <div class="col-4"><input type="text" class="form-control mb-3" id="txtdiachi-sua" name="txtdiachi-sua" autocomplete="off"></div>
                </div>

                <div class="row">
                  <div class="col-2 d-flex align-items-center"><label for="slchidoan-sua">Chi đoàn: </label></div>
                  <div class="col-3">
                    <select name="slchidoan-sua" id="slchidoan-sua" class="form-control mb-3 w-75">
                      @foreach($chidoan as $cd)
                        <option value="{{$cd->macd}}">{{$cd->macd}}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="col-2 d-flex align-items-center ml-5"><label for="slchucvu-sua">Chức vụ: </label></div>
                  <div class="col-4">
                    <select name="slchucvu-sua" id="slchucvu-sua" class="form-control mb-3">
                      @foreach($chucvu as $cv)
                        <option value="{{$cv->id}}">{{$cv->tencv}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-2 d-flex align-items-center"><label for="txtngayvd-sua">Ngày vào Đoàn: </label></div>
                  <div class="col-3">
                    <input type="date" class="form-control" id="txtngayvd-sua" name="txtngayvd-sua">
                    <div id="error-msg-ngayvd-sua" style="color: red;"></div>
                  </div>

                  <div class="col-2 d-flex align-items-center ml-5"><label for="txtnoivd-sua">Nơi vào Đoàn: </label></div>
                  <div class="col-4"><input type="text" class="form-control" id="txtnoivd-sua" name="txtnoivd-sua" autocomplete="off"></div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                  <button type="submit" id="btnUpDate" class="btn btn-primary">Cập nhật</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      
      <!--xóa-->
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
              <form action="/admin/xoadv" method="POST">
                @csrf
                @method('DELETE')
                <div class="form-group">
                  <label for="txtma-xoa">Bạn có chắc muốn xóa không?</label>
                  <input type="text" class="form-control d-none" id="txtma-xoa" name="txtma-xoa" readonly>
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

    </div><!-- .animated -->
  </div>
  <!-- /.content -->
  <div class="clearfix"></div>
</div>
<!-- /#right-panel -->

  <script type="text/javascript">
    var btnSave = document.getElementById('btnSave');
    var btnUpDate = document.getElementById('btnUpDate');

    function validateDate(inputId, errorMsgId, errorMsg) {
        var selectedDate = new Date(document.getElementById(inputId).value);
        var currentDate = new Date();

        if (selectedDate > currentDate) {
            document.getElementById(errorMsgId).innerHTML = errorMsg;
            return false;
        } else {
            document.getElementById(errorMsgId).innerHTML = '';
            return true;
        }
    }

    function upBtnSave() {
        var ngaySinh = validateDate('txtngaysinh', 'error-msg-ngaysinh', 'Ngày sinh không hợp lệ');
        var ngayVD = validateDate('txtngayvd', 'error-msg-ngayvd', 'Ngày vào Đoàn không hợp lệ');
        btnSave.disabled = !(ngaySinh && ngayVD);
    }

    function upBtnUpdate() {
        var ngaySinhSua = validateDate('txtngaysinh-sua', 'error-msg-ngaysinh-sua', 'Ngày sinh không hợp lệ');
        var ngayVDSua = validateDate('txtngayvd-sua', 'error-msg-ngayvd-sua', 'Ngày vào Đoàn không hợp lệ');
        btnUpDate.disabled = !(ngaySinhSua && ngayVDSua);
    }

    document.getElementById('txtngaysinh').addEventListener('change', upBtnSave);
    document.getElementById('txtngayvd').addEventListener('change', upBtnSave);
    document.getElementById('txtngaysinh-sua').addEventListener('change', upBtnUpdate);
    document.getElementById('txtngayvd-sua').addEventListener('change', upBtnUpdate);

    function suadv(ma, ten, gioi, ngaysinh, sdt, dc, ngayvd, noivd, macd, macv){
      $('#txtma-sua').val(ma);
      $('#txtten-sua').val(ten);
      $('#slgioi-sua').val(gioi);
      $('#txtngaysinh-sua').val(ngaysinh);
      $('#txtsdt-sua').val(sdt);
      $('#txtdiachi-sua').val(dc);
      $('#txtngayvd-sua').val(ngayvd);
      $('#txtnoivd-sua').val(noivd);
      $('#slchidoan-sua').val(macd);
      $('#slchucvu-sua').val(macv);
    };

    function xoadv(ma){
      $('#txtma-xoa').val(ma);
    }
  </script>


@include('admin.footer')