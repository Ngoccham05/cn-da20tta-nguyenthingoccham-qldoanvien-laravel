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
      </div> <!--row-->

      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <strong class="card-title mt-1" style="font-size:20px">Biểu mẫu</strong>
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
                    <th>Tên</th>
                    <th>Đường dẫn</th>
                    @if (Auth::guard('doanvien')->check() && Auth::guard('doanvien')->user()->role == 1)
                    <th>Hành động</th>
                    @endif
                  </tr>
                </thead>
                <tbody>
                  @php
                    $stt = 1;
                  @endphp
                  @foreach($bieumau as $bm)
                    <tr>
                      <th class="text-center align-middle">{{ $stt++ }}.</th>
                      <td class="align-middle">{{$bm->tenbm}}</td>
                      <td>
                      @if($bm->duongdan)
                        <a href="{{ asset('fileUploads/' . $bm->duongdan) }}" target="_blank"><i>Tải về</i></a>
                      @endif
                      </td>
                      @if (Auth::guard('doanvien')->check() && Auth::guard('doanvien')->user()->role == 1)
                      <td class="align-middle">
                        <a href="#" class="btn btn-primary mr-2 py-1 px-2" onclick="suabm('{{$bm->id}}', '{{$bm->tenbm}}', '{{$bm->duongdan}}')" data-toggle="modal" data-target="#sua-Modal">
                          <i class="fa fa-edit" style="font-size: 18px"></i>
                        </a>
                              
                        <a href="#" class="btn btn-danger py-1 px-2" onclick="xoabm('{{$bm->id}}')" data-toggle="modal" data-target="#xoa-Modal">
                          <i class="fa fa-trash" style="font-size:18px"></i>
                        </a>
                      </td>
                      @endif
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
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header d-flex">
              <h5 class="modal-title h5" id="them-ModalLabel">Thêm</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form action="/ktcn/thembm" method="POST" enctype="multipart/form-data">
              <div class="modal-body">
                @csrf
                <div class="row">
                  <div class="col-3 d-flex align-items-center"><label for="txtten">Tên: </label></div>
                  <div class="col-9 mb-3"><input type="text" class="form-control" id="txtten" name="txtten" required autocomplete="off"></div>
                </div>
                <div class="row">
                  <div class="col-3 d-flex align-items-center"><label for="filemc">Chọn tệp: </label></div>
                  <div class="col-9 mb-3">
                    <input type="file" class="custom-file-input" id="filemc" name="filemc" accept=".doc, .docx, .docm, .dotx, .dotm">
                    <label class="custom-file-label mx-3" for="filemc">Choose file</label>
                  </div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                  <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Sửa -->
      <div class="modal fade " id="sua-Modal" tabindex="-1" role="dialog" aria-labelledby="sua-ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header d-flex">
              <h5 class="modal-title h5" id="sua-ModalLabel">Cập nhật</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form action="/ktcn/suabm" method="POST" enctype="multipart/form-data">
              <div class="modal-body">
                @csrf
                <div class="row">
                  <div class="col-2 d-flex align-items-center"><label for="txtma-sua">Mã: </label></div>
                  <div class="col-10 mb-3"><input type="text" class="form-control" id="txtma-sua" name="txtma-sua" readonly></div>
                </div>
                <div class="row">
                  <div class="col-2 d-flex align-items-center"><label for="txtten-sua">Tên: </label></div>
                  <div class="col-10 mb-3"><input type="text" class="form-control" id="txtten-sua" name="txtten-sua" required autocomplete="off"></div>
                </div>
                <div class="row">
                  <div class="col-2 d-flex align-items-center"><label for="filemc-sua">Chọn tệp: </label></div>
                  <div class="col-10 mb-3">
                    <input type="file" class="custom-file-input" id="filemc-sua" name="filemc-sua">
                    <label class="custom-file-label mx-3" id="file-info" for="filemc-sua">Choose file</label>
                  </div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                  <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
              </div>
            </form>
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
              <form action="/ktcn/xoabm" method="POST">
                @csrf
                @method('DELETE')
                <div class="form-group">
                  <label for="txtmadot-xoa">Bạn có chắc muốn xóa không?</label>
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
    </div>
  </div>
  <div class="clearfix"></div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script>
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
    function suabm(ma, ten, minhchung){
      $('#txtma-sua').val(ma);
      $('#txtten-sua').val(ten);
      $('#file-info').text(laytenfile(minhchung));
    };

    function laytenfile(chuoi) {
      var mangChuoi = chuoi.split('/');
      if (mangChuoi.length > 1) {
        return mangChuoi[1];
      }
      return chuoi;
    }

    function xoabm(ma){
      $('#txtma-xoa').val(ma);
    }
  </script>

@include('doanvien.footer')