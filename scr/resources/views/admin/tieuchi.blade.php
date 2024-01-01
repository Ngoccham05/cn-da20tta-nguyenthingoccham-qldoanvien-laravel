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
              <strong class="card-title mt-1" style="font-size:20px">Danh sách tiêu chí đánh giá</strong>
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#them-Modal" style="font-size: 16px">
                <i class="fa fa-plus mr-2"></i> Thêm
              </button>
            </div>
            <div class="card-body">
              <table id="bootstrap-data-table" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th style="width: 50px">#</th>
                    <th>Tiêu chí</th>
                    <th>Hành động</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                    $stt = 1;
                  @endphp
                  @foreach($tieuchi as $tc)
                    <tr>
                      <th class="text-center align-middle">{{ $stt++ }}.</th>
                      <td class="align-middle">{{$tc->tentc}}</td>
                      <td class="align-middle">
                        <a href="#" class="btn btn-primary mr-2 py-1 px-2" data-toggle="modal" data-target="#sua-Modal"
                          onclick="suatc('{{$tc->id}}', '{{$tc->tentc}}')">
                          <i class="fa fa-edit" style="font-size: 18px"></i>
                        </a>   
                              
                        <a href="#" class="btn btn-danger py-1 px-2" onclick="xoatc('{{$tc->id}}')" data-toggle="modal" data-target="#xoa-Modal">
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

            <form action="/admin/themtc" method="POST">
              <div class="modal-body">
                @csrf
                <div class="row">
                  <div class="col-2 d-flex align-items-center"><label for="txtten">Tiêu chí: </label></div>
                  <div class="col-10"><input type="text" class="form-control mb-3" id="txtten" name="txtten" required autocomplete="off"></div>
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

            <form action="/admin/suatc" method="POST">
              <div class="modal-body">
                @csrf
                <div class="row">
                  <div class="col-12"><input type="text" class="form-control mb-3 d-none" id="txtma-sua" name="txtma-sua" readonly></div>
                </div>

                <div class="row">
                  <div class="col-2 d-flex align-items-center"><label for="txtten">Tiêu chí: </label></div>
                  <div class="col-10"><input type="text" class="form-control mb-3" id="txtten-sua" name="txtten-sua" required autocomplete="off"></div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                  <button type="submit" class="btn btn-primary">Cập nhật</button>
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
              <form action="/admin/xoatc" method="POST">
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
    function suatc(ma, ten){
      $('#txtma-sua').val(ma);
      $('#txtten-sua').val(ten);
    };

    function xoatc(ma){
      $('#txtma-xoa').val(ma);
    }
  </script>

@include('admin.footer')