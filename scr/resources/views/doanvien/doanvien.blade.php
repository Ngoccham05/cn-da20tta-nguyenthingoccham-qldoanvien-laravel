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
            <div class="card-header d-flex justify-content-between align-items-center">
              <strong class="card-title mt-1 mr-auto" style="font-size:20px">Danh sách đoàn viên</strong>
              <!-- <a href="/ktcn/xuatdv">xuất</a> -->
              @if (Auth::guard('doanvien')->check() && Auth::guard('doanvien')->user()->role == 1)
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#them-Modal" style="font-size: 16px">
                <i class="fa fa-plus mr-2"></i> Thêm
              </button>
              @endif
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
                      <th class="align-middle text-center">{{$stt++}}.</th>
                      <td class="align-middle">{{$dv->madv}}</td>
                      <td class="align-middle">{{$dv->hoten}}</td>
                      <td class="align-middle">{{$dv->gioitinh}}</td>
                      <td class="align-middle">{{date('d/m/Y', strtotime($dv->ngaysinh))}}</td>
                      <td class="align-middle">{{$dv->macd}}</td>
                      <td class="align-middle">{{$dv->chucvu->tencv}}</td>
                      <td class="align-middle" style="width:40px !important">
                        <a href="#" class="btn btn-primary mr-2 py-1 px-2" data-toggle="modal" data-target="#sua-Modal"
                          onclick="suadv('{{$dv->madv}}', '{{$dv->hoten}}', '{{$dv->gioitinh}}', '{{$dv->ngaysinh}}', '{{$dv->sdt}}', 
                                         '{{$dv->diachi}}', '{{$dv->ngayvaodoan}}', '{{$dv->noivaodoan}}', '{{$dv->macd}}', '{{$dv->macv}}')">
                          <i class="fa fa-edit" style="font-size: 18px"></i>
                        </a>   
                        <!-- @if (Auth::guard('doanvien')->check() && Auth::guard('doanvien')->user()->role == 1)      
                        <a href="#" class="btn btn-danger py-1 px-2" onclick="xoadv('{{$dv->madv}}')" data-toggle="modal" data-target="#xoa-Modal">
                          <i class="fa fa-trash" style="font-size:18px"></i>
                        </a>
                        @endif -->
                      </td>
                    </tr>
                  @endforeach  
                </tbody>
              </table>
            </div>
          </div>
        </div>   
      </div>

      <div class="modal fade" id="them-Modal" tabindex="-1" role="dialog" aria-labelledby="them-ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header d-flex">
              <h5 class="modal-title h5" id="them-ModalLabel">Thêm</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body py-2">
              <div class="custom-tab">
                <nav>
                  <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link px-3 active" id="nav-default-tab" style="font-size:14px"
                      data-toggle="tab" href="#nav-default" role="tab" aria-controls="nav-default" aria-selected="true">Mặc định</a>
                    <a class="nav-item nav-link px-3" id="nav-file-tab" style="font-size:14px"
                      data-toggle="tab" href="#nav-file" role="tab" aria-controls="nav-file" aria-selected="false">Thêm bằng tệp</a>
                  </div>
                </nav>

                <div class="tab-content pl-3 pt-3" id="nav-tabContent">
                  <div class="tab-pane fade show active" id="nav-default" role="tabpanel" aria-labelledby="nav-default-tab">
                    <form action="/ktcn/themdv" method="POST">
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
                          <select name="slchidoan" class="form-control mb-3 w-75">
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
                        <div class="col-4"><input type="text" class="form-control" id="txtnoivd" name="txtnoivd" autocomplete="off"></div>
                      </div>

                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="submit" id="btnSave" class="btn btn-primary">Lưu</button>
                      </div>   
                    </form>
                  </div>

                  <div class="tab-pane fade show" id="nav-file" role="tabpanel" aria-labelledby="nav-file-tab">
                    <form action="/ktcn/nhapdv" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="row">
                        <div class="col-2 mt-2"><label for="filemc">Chọn tệp: </label></div>
                        <div class="col-10 mb-3">
                          <input type="file" class="custom-file-input" id="file" name="file" accept=".xlsx">
                          <label class="custom-file-label mx-3" for="file"></label>
                        </div>
                      </div>

                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="submit" id="btnNhap" class="btn btn-primary">Lưu</button>
                      </div>           
                    </form>
                  </div>
                </div>
              </div><!-- custom-tab -->
            </div>            
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

            <form action="/ktcn/suadv" method="POST">
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
                    <input type="date" class="form-control w-75" id="txtngaysinh-sua" name="txtngaysinh-sua" required>
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
              <form action="/ktcn/xoadv" method="POST">
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


  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script type="text/javascript">

    $(".custom-file-input").on("change", function() { 
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

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


@include('doanvien.footer')