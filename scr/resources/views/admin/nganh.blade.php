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
                <strong class="card-title mt-1" style="font-size:20px">Danh sách chuyên ngành</strong>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#themnganhModal" style="font-size: 16px">
                  <i class="fa fa-plus mr-2"></i> Thêm
                </button>
              </div>
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th class="text-center">#</th>
                      <th>Ngành</th>
                      <th>Hành động</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $stt = 1;
                    @endphp
                    @foreach($chuyennganh as $nganh)
                      <tr>
                        <th class="text-center align-middle" scope="row">{{ $stt++ }}.</th>
                        <td class="align-middle">{{$nganh->tennganh}}</td>
                        <td class="align-middle">
                          <a href="#" class="btn btn-primary mr-2 py-1 px-2" onclick="suanganh('{{$nganh->id}}', '{{$nganh->tennganh}}')" data-toggle="modal" data-target="#suanganhModal">
                            <i class="fa fa-edit" style="font-size: 18px"></i>
                          </a>  
                            
                          <a href="#" class="btn btn-danger py-1 px-2" onclick="xoanganh('{{$nganh->id}}')" data-toggle="modal" data-target="#xoanganhModal">
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
        <div class="modal fade" id="themnganhModal" tabindex="-1" role="dialog" aria-labelledby="themDataModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header d-flex">
                <h5 class="modal-title h5" id="themDataModalLabel">Thêm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="/admin/themnganh" method="POST">
                  @csrf
                  <div class="row mb-3">
                    <div class="col-2 d-flex align-items-center mt-2"><label for="tennganh">Ngành: </label></div>
                    <div class="col-10"><input type="text" class="form-control" id="txttennganh" name="txttennganh" required autocomplete="off"></div>
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

        <div class="modal fade" id="suanganhModal" tabindex="-1" role="dialog" aria-labelledby="suaDataModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header d-flex">
                <h5 class="modal-title h5" id="suaDataModalLabel">Cập nhật</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="/admin/suanganh" method="POST">
                  @csrf
                  <div class="row d-none">
                    <label for="txtma">Mã ngành: </label>
                    <input type="text" class="form-control" id="txtma" name="txtma" readonly>
                  </div>
                  <div class="row mb-3">
                    <div class="col-2 d-flex align-items-center mt-2"><label for="txtten">Ngành: </label></div>
                    <div class="col-10"><input type="text" class="form-control" id="txtten" name="txtten" required autocomplete="off"></div>
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

        <div class="modal fade" id="xoanganhModal" tabindex="-1" role="dialog" aria-labelledby="xoaDataModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header d-flex">
                <h5 class="modal-title h5" id="xoaDataModalLabel">Xóa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="/admin/xoanganh" method="POST">
                  @csrf
                  @method('DELETE')
                  <div class="form-group">
                    <label for="txtma">Bạn có chắc muốn xóa không?</label>
                    <input type="text" class="form-control d-none" id="txtxoama" name="txtxoama" readonly>
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
      function suanganh(id, tennganh){
      $('#txtma').val(id);
        $('#txtten').val(tennganh);
      };

      function xoanganh(id){
        $('#txtxoama').val(id);
      }
    </script>


  @include('admin.footer')