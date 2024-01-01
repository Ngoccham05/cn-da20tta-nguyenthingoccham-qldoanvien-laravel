@include('doanvien.header')
    <div class="animated fadeIn">
      <!-- alert thông báo khi thêm sửa-->
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
              <strong class="card-title mt-1 mr-auto" style="font-size:20px">Thông tin cá nhân</strong>

              <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#suatt-Modal" style="font-size: 16px"
                onclick="suatt('{{$thongtin->madv}}', '{{$thongtin->hoten}}', '{{$thongtin->gioitinh}}', '{{$thongtin->ngaysinh}}', '{{$thongtin->sdt}}', 
                               '{{$thongtin->diachi}}', '{{$thongtin->ngayvaodoan}}', '{{$thongtin->noivaodoan}}', '{{$thongtin->macd}}', '{{$thongtin->chucvu->tencv}}')">
                <i class="fa fa-edit mr-1"></i> Cập nhật
              </button>

              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#doimk-Modal" style="font-size: 16px">
                <i class="fa fa-unlock-alt mr-1"></i> Đổi mật khẩu
              </button>
            </div>
            <div class="card-body pl-5">
            
              <div class="row pb-4">
                <div class="col-2">Mã đoàn viên:</div>
                <div class="col-3">{{$thongtin->madv}}</div>
                <div class="col-2">Họ tên:</div>
                <div class="col-4">{{$thongtin->hoten}}</div>
              </div>

              <div class="row pb-4">
                <div class="col-2">Giới tính:</div>
                <div class="col-3">{{$thongtin->gioitinh}}</div>
                <div class="col-2">Ngày sinh:</div>
                <div class="col-4">{{date('d/m/Y', strtotime($thongtin->ngaysinh))}}</div>
              </div>

              <div class="row pb-4">
                <div class="col-2">Số điện thoại:</div>
                <div class="col-3">{{$thongtin->sdt}}</div>
                <div class="col-2">Địa chỉ:</div>
                <div class="col-4">{{$thongtin->diachi}}</div>
              </div>

              <div class="row pb-4">
                <div class="col-2">Chi đoàn:</div>
                <div class="col-3">{{$thongtin->macd}}</div>
                <div class="col-2">Chức vụ:</div>
                <div class="col-4">{{$thongtin->chucvu->tencv}}</div>
              </div>

              <div class="row pb-4">
                <div class="col-2">Ngày vào đoàn:</div>
                <div class="col-3">@if($thongtin->ngayvaodoan){{date('d/m/Y', strtotime($thongtin->ngayvaodoan))}}@endif</div>                
                <div class="col-2">Nơi vào đoàn:</div>
                <div class="col-4">{{$thongtin->noivaodoan}}</div>
              </div>
            </div>
          </div>
        </div>   
      </div>

      <!-- Modal sửa-->
      <div class="modal fade" id="suatt-Modal" tabindex="-1" role="dialog" aria-labelledby="suatt-ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header d-flex">
              <h5 class="modal-title h5" id="suatt-ModalLabel">Cập nhật thông tin cá nhân</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form action="/ktcn/suatt" method="POST">
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
                    <input type="text" class="form-control bg-light mb-3" id="slchucvu-sua" name="slchucvu-sua" readonly>
                    <!-- <select name="slchucvu-sua" id="slchucvu-sua" class="form-control mb-3">
                      @foreach($chucvu as $cv)
                        <option value="{{$cv->id}}">{{$cv->tencv}}</option>
                      @endforeach
                    </select> -->
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-2 d-flex align-items-center"><label for="txtngayvd-sua">Ngày vào Đoàn: </label></div>
                  <div class="col-3">
                    <input type="date" class="form-control" id="txtngayvd-sua" name="txtngayvd-sua">
                    <div id="error-msg-ngayvd-sua" style="color: red;">
                  </div>
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

      <!-- Modal đổi mk-->
      <div class="modal fade" id="doimk-Modal" tabindex="-1" role="dialog" aria-labelledby="doimk-ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header d-flex">
              <h5 class="modal-title h5" id="doimk-ModalLabel">Đổi mật khẩu</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form action="/ktcn/doimk" method="POST">
              <div class="modal-body">
                @csrf
                <div class="row">
                  <div class="col-12">
                    <input type="text" class="form-control d-none" id="txttruepwd" name="txttruepwd" value="{{Auth::guard('doanvien')->user()->password}}">
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-5 d-flex align-items-center"><label for="txtoldpwd">Mật khẩu hiện tại: </label></div>
                  <div class="col-7">
                    <input type="password" class="form-control" id="txtoldpwd" name="txtoldpwd" onkeyup="kiemtramk()" required autocomplete="off">
                    <div id="error_kt" class="text-danger"></div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-5 d-flex align-items-center"><label for="txtnewpwd">Mật khẩu mới: </label></div>
                  <div class="col-7">
                    <input type="password" class="form-control mb-3" id="txtnewpwd" name="txtnewpwd" onkeyup="xacnhanmk()" required autocomplete="off">
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-5 d-flex align-items-center"><label for="txtrenewpwd">Xác nhận mật khẩu: </label></div>
                  <div class="col-7">
                    <input type="password" class="form-control" id="txtrenewpwd" name="txtrenewpwd" onkeyup="xacnhanmk()" required autocomplete="off">
                    <div id="error_xn" class="text-danger"></div>
                  </div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                  <button type="submit" class="btn btn-primary" id="btnsubmit">Cập nhật</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

    </div><!-- .animated -->
  </div><!-- /.content -->
  
  <div class="clearfix"></div>
</div>

<!-- Mã hóa mật khẩu bằng md5 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>
<script type="text/javascript">
    function suatt(ma, ten, gioi, ngaysinh, sdt, dc, ngayvd, noivd, macd, macv){
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

    function upBtnUpdate() {
      var ngaySinhSua = validateDate('txtngaysinh-sua', 'error-msg-ngaysinh-sua', 'Ngày sinh không hợp lệ');
      var ngayVDSua = validateDate('txtngayvd-sua', 'error-msg-ngayvd-sua', 'Ngày vào Đoàn không hợp lệ');
      btnUpDate.disabled = !(ngaySinhSua && ngayVDSua);
    }

    document.getElementById('txtngaysinh-sua').addEventListener('change', upBtnUpdate);
    document.getElementById('txtngayvd-sua').addEventListener('change', upBtnUpdate);

    function kiemtramk(){      
      var mk = $('#txttruepwd').val();
      var mkhientai = $('#txtoldpwd').val();
      var mh_mk = CryptoJS.MD5(mkhientai).toString();

      if(mk != mh_mk){
        $('#error_kt').text("*Mật khẩu không đúng");
        $('#btnsubmit').prop('disabled', true);
      }
      else{
        $('#error_kt').text("");
        var loixn = $('#error_xn').text();
        var loikt = $('#error_kt').text();
        if(loixn == "" && loikt == "")
        {
          $('#btnsubmit').prop('disabled', false);
        }
      }
    }

    function xacnhanmk() {
      var mkmoi = $('#txtnewpwd').val();
      var xacnhanmk = $('#txtrenewpwd').val();
      
      if (mkmoi != "" && xacnhanmk!= "" && mkmoi !== xacnhanmk) {
        $('#error_xn').text("*Mật khẩu không trùng khớp");
        $('#btnsubmit').prop('disabled', true);
      } else {
        $('#error_xn').text("");
        var loixn = $('#error_xn').text();
        var loikt = $('#error_kt').text();
        if(loixn == "" && loikt == "")
        {
          $('#btnsubmit').prop('disabled', false);
        }
      }
    }

  </script>
@include('doanvien.footer')