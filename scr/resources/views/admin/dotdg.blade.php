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
              <strong class="card-title mt-1" style="font-size:20px">Kỳ xếp loại</strong>
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#them-dot-Modal" style="font-size: 16px">
                <i class="fa fa-plus mr-2"></i> Thêm
              </button>
            </div>
            <div class="card-body">
              <table id="bootstrap-data-table" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <!-- <th>Mã</th> -->
                    <th>Tên</th>
                    <th>Bắt đầu</th>
                    <th>Kết thúc</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                    $stt = 1;
                  @endphp
                  @foreach($dotdg as $dot)
                    <tr>
                      <th class="text-center align-middle">{{ $stt++ }}.</th>
                      <!-- <td class="align-middle">{{$dot->madot}}</td> -->
                      <td class="align-middle">{{$dot->tendot}}</td>
                      <td class="align-middle">{{date('d/m/Y', strtotime($dot->tgbatdau))}}</td>
                      <td class="align-middle">{{date('d/m/Y', strtotime($dot->tgketthuc))}}</td>
                      <td class="align-middle">{{$dot->trangthai}}</td>
                      <td class="align-middle">
                        <a href="#" class="btn btn-primary mr-2 py-1 px-2 sua-dot" onclick="suadot('{{$dot->madot}}', '{{$dot->tendot}}', '{{$dot->tgbatdau}}', '{{$dot->tgketthuc}}', '{{$dot->trangthai}}')" 
                          data-toggle="modal" data-target="#sua-dot-Modal">
                          <i class="fa fa-edit" style="font-size: 18px"></i>
                        </a>   
                              
                        <a href="#" class="btn btn-danger py-1 px-2" onclick="xoadot('{{$dot->madot}}')" data-toggle="modal" data-target="#xoa-dot-Modal">
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
      <div class="modal fade" id="them-dot-Modal" tabindex="-1" role="dialog" aria-labelledby="them-ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header d-flex">
              <h5 class="modal-title h5" id="them-ModalLabel">Thêm</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form action="/admin/themdot" method="POST">
              <div class="modal-body">
                @csrf
                <div class="row">
                  <div class="col-3 d-flex align-items-center"><label for="txtmadot">Mã: </label></div>
                  <div class="col-9"><input type="text" class="form-control mb-3" id="txtmadot" name="txtmadot" required autocomplete="off"></div>
                </div>
                <div class="row">
                  <div class="col-3 d-flex align-items-center"><label for="txttendot">Tên đợt: </label></div>
                  <div class="col-9"><input type="text" class="form-control mb-3" id="txttendot" name="txttendot" required autocomplete="off"></div>
                </div>
                <div class="row">
                  <div class="col-3 d-flex align-items-center"><label for="txtbd">Bắt đầu: </label></div>
                  <div class="col-9"><input type="date" class="form-control mb-3" id="txtbd" name="txtbd"></div>
                </div>
                <div class="row mb-3">
                  <div class="col-3 d-flex align-items-center"><label for="txtkt">Kết thúc: </label></div>
                  <div class="col-9">
                    <input type="date" class="form-control mb-1" id="txtkt" name="txtkt">
                    <div id="error-message" class="error-message text-danger"></div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-3 d-flex align-items-center"><label for="txtnganh">Trạng thái: </label></div>
                  <div class="col-9">
                    <select name="sltrangthai" id="sltrangthai" class="form-control mb-3">
                      <option value="Khóa">Khóa</option>
                      <option value="Đoàn viên đánh giá">Đoàn viên đánh giá</option>
                      <option value="Chi đoàn đánh giá">Chi đoàn đánh giá</option>
                      <option value="Đoàn khoa đánh giá">Đoàn khoa đánh giá</option>
                    </select>
                  </div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                  <button type="submit" id="btnLuu" class="btn btn-primary">Lưu</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Modal sửa-->
      <div class="modal fade" id="sua-dot-Modal" tabindex="-1" role="dialog" aria-labelledby="sua-ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header d-flex">
              <h5 class="modal-title h5" id="sua-ModalLabel">Cập nhật</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="/admin/suadot" method="POST">
              <div class="modal-body">
                @csrf
                <div class="row d-none">
                  <div class="col-3 d-flex align-items-center"><label for="txtmadot-sua">Mã: </label></div>
                  <div class="col-9"><input type="text" class="form-control mb-3" id="txtmadot-sua" name="txtmadot-sua" required autocomplete="off" readonly></div>
                </div>
                <div class="row">
                  <div class="col-3 d-flex align-items-center"><label for="txttendot-sua">Tên đợt: </label></div>
                  <div class="col-9"><input type="text" class="form-control mb-3" id="txttendot-sua" name="txttendot-sua" required autocomplete="off"></div>
                </div>
                <div class="row">
                  <div class="col-3 d-flex align-items-center"><label for="txtbd-sua">Bắt đầu: </label></div>
                  <div class="col-9"><input type="date" class="form-control mb-3" id="txtbd-sua" name="txtbd-sua"></div>
                </div>
                <div class="row mb-3">
                  <div class="col-3 d-flex align-items-center"><label for="txtkt-sua">Kết thúc: </label></div>
                  <div class="col-9">
                    <input type="date" class="form-control mb-1" id="txtkt-sua" name="txtkt-sua">
                    <div id="error-message-sua" class="error-message text-danger"></div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-3 d-flex align-items-center"><label for="txtnganh-sua">Trạng thái: </label></div>
                  <div class="col-9">
                    <select name="sltrangthai-sua" id="sltrangthai-sua" class="form-control mb-3">
                      <option value="Khóa">Khóa</option>
                      <option value="Đoàn viên đánh giá">Đoàn viên đánh giá</option>
                      <option value="Chi đoàn đánh giá">Chi đoàn đánh giá</option>
                      <option value="Đoàn khoa đánh giá">Đoàn khoa đánh giá</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Xóa -->
      <div class="modal fade" id="xoa-dot-Modal" tabindex="-1" role="dialog" aria-labelledby="xoa-ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header d-flex">
              <h5 class="modal-title h5" id="xoa-ModalLabel">Xóa</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="/admin/xoadot" method="POST">
                @csrf
                @method('DELETE')
                <div class="form-group">
                  <label for="txtmadot-xoa">Bạn có chắc muốn xóa không?</label>
                  <input type="text" class="form-control d-none" id="txtmadot-xoa" name="txtmadot-xoa" readonly>
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
    document.getElementById('txtbd').addEventListener('change', function () {
      validateDates();
    });
    document.getElementById('txtkt').addEventListener('change', function () {
      validateDates();
    });

    document.getElementById('txtbd-sua').addEventListener('change', function () {
      validateDates_sua();
    });
    document.getElementById('txtkt-sua').addEventListener('change', function () {
      validateDates_sua();
    });

    function validateDates() {
      var tgBatDau = new Date(document.getElementById('txtbd').value);
      var tgKetThuc = new Date(document.getElementById('txtkt').value);
      var thongBao = document.getElementById('error-message');

      if (tgBatDau && tgKetThuc && tgKetThuc < tgBatDau) {
        thongBao.innerHTML = '*Thời gian kết thúc không hợp lệ';
        btnLuu.disabled = true;
      } else {
        thongBao.innerHTML = '';
        btnLuu.disabled = false;
      }
    }

    function validateDates_sua() {
      var tgBatDau = new Date(document.getElementById('txtbd-sua').value);
      var tgKetThuc = new Date(document.getElementById('txtkt-sua').value);
      var thongBao = document.getElementById('error-message-sua');

      if (tgBatDau && tgKetThuc && tgKetThuc < tgBatDau) {
        thongBao.innerHTML = '*Thời gian kết thúc không hợp lệ';
        btnLuu.disabled = true;
      } else {
        thongBao.innerHTML = '';
        btnLuu.disabled = false;
      }
    }

    function suadot(ma, ten, bd, kt, tt){
      $('#txtmadot-sua').val(ma);
      $('#txttendot-sua').val(ten);
      $('#txtbd-sua').val(bd);
      $('#txtkt-sua').val(kt);
      $('#sltrangthai-sua').val(tt);
    };
    
    function xoadot(ma){
      $('#txtmadot-xoa').val(ma);
    }
  </script>


@include('admin.footer')