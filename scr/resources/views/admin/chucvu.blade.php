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
              <strong class="card-title mt-1" style="font-size:20px">Danh sách chức vụ</strong>
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#them-cv-Modal" style="font-size: 16px">
                <i class="fa fa-plus mr-2"></i> Thêm
              </button>
            </div>
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="text-center">#</th>
                    <th>Chức vụ</th>
                    <th>Hành động</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                    $stt = 1;
                  @endphp
                  @foreach($chucvu as $cv)
                    <tr>
                      <th class="text-center align-middle" scope="row">{{ $stt++ }}.</th>
                      <td class="align-middle">{{$cv->tencv}}</td>
                      <td class="align-middle">
                        <a href="#" class="btn btn-primary mr-2 py-1 px-2" onclick="suachucvu('{{$cv->id}}', '{{$cv->tencv}}')" data-toggle="modal" data-target="#sua-cv-Modal">
                          <i class="fa fa-edit" style="font-size: 18px"></i>
                        </a>  
                            
                        <a href="#" class="btn btn-danger py-1 px-2" onclick="xoachucvu('{{$cv->id}}')" data-toggle="modal" data-target="#xoa-cv-Modal">
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

      <!-- Modal -->
      <div class="modal fade" id="them-cv-Modal" tabindex="-1" role="dialog" aria-labelledby="them-ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header d-flex">
              <h5 class="modal-title h5" id="them-ModalLabel">Thêm</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="/admin/themchucvu" method="POST">
                @csrf
                <div class="row mb-3">
                  <div class="col-3 mt-2"><label for="txttencv">Tên chức vụ: </label></div>
                  <div class="col-9"><input type="text" class="form-control" id="txttencv" name="txttencv" required autocomplete="off"></div>
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

      <div class="modal fade" id="sua-cv-Modal" tabindex="-1" role="dialog" aria-labelledby="sua-ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header d-flex">
              <h5 class="modal-title h5" id="sua-ModalLabel">Cập nhật</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="/admin/suachucvu" method="POST">
                @csrf
                <div class="row d-none">
                  <label for="txtmacv-sua">Mã chức vụ: </label>
                  <input type="text" class="form-control" id="txtmacv-sua" name="txtmacv-sua" readonly>
                </div>
                <div class="row mb-3">
                  <div class="col-3 mt-2"><label for="txttencv-sua">Tên chức vụ: </label></div>
                  <div class="col-9"><input type="text" class="form-control" id="txttencv-sua" name="txttencv-sua" required autocomplete="off"></div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                  <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="xoa-cv-Modal" tabindex="-1" role="dialog" aria-labelledby="xoa-ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header d-flex">
              <h5 class="modal-title h5" id="xoa-ModalLabel">Xóa</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="/admin/xoachucvu" method="POST">
                @csrf
                @method('DELETE')
                <div class="form-group">
                  <label for="txtmacv-xoa">Bạn có chắc muốn xóa không?</label>
                  <input type="text" class="form-control d-none" id="txtmacv-xoa" name="txtmacv-xoa" readonly>
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
  <script>
    function suachucvu(id, tencv){
      $('#txtmacv-sua').val(id);
      $('#txttencv-sua').val(tencv);
    };

    function xoachucvu(id){
      $('#txtmacv-xoa').val(id);
    }
  </script>


@include('admin.footer')