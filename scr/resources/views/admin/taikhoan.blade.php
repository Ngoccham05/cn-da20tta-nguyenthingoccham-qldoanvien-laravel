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
              <strong class="card-title mt-1" style="font-size:20px">Tài khoản</strong>
              <!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#them-dot-Modal" style="font-size: 16px">
                <i class="fa fa-plus mr-2"></i> Thêm
              </button> -->
            </div>
            <div class="card-body">
              <table id="bootstrap-data-table" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>User Name</th>
                    <th>Password</th>
                    <th>Role</th>
                    <th>Active</th>
                    <th>Reset Password</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                    $stt = 1;
                  @endphp
                  @foreach($tkdoanvien as $tk)
                    <tr>
                      <th class="text-center align-middle">{{ $stt++ }}.</th>
                      <td class="align-middle">{{$tk->username}}</td>
                      <td class="align-middle">{{$tk->password}}</td>
                      <td class="align-middle">{{$tk->role}}</td>
                      <td class="align-middle">
                        <form action="{{ url('/admin/doitt', ['username' => $tk->username]) }}" method="POST">
                          @csrf
                          @if($tk->active == '1')
                            <button type="submit" class="btn btn-success py-1 px-2">Active</button>
                          @else
                            <button type="submit" class="btn btn-danger py-1 px-2">Inactive</button>
                          @endif
                        </form>
                      </td>
                      <td class="align-middle">
                        <a href="#" class="btn btn-success py-1 px-2" onclick="reset('{{$tk->username}}')" 
                          data-toggle="modal" data-target="#reset-Modal">Reset</a>
                      </td>
                    </tr>
                  @endforeach  
                </tbody>
              </table>
            </div>
          </div>
        </div>   
      </div>

      <!-- Reset pass -->
      <div class="modal fade" id="reset-Modal" tabindex="-1" role="dialog" aria-labelledby="reset-ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header d-flex">
              <h5 class="modal-title h5" id="reset-ModalLabel">Xóa</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="/admin/resetpass" method="POST">
                @csrf
                <div class="form-group">
                  <label for="txtusername-reset">Bạn có chắc muốn đặt lại mật khẩu không?</label>
                  <input type="text" class="form-control d-none" id="txtusername-reset" name="txtusername-reset" readonly>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                  <button type="submit" class="btn btn-primary">Reset</button>
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

<script type="text/javascript">
    $(document).ready(function() {
      $('#bootstrap-data-table-export').DataTable();
    } );

    function reset(ma){
      $('#txtusername-reset').val(ma);
    }
  </script>


@include('admin.footer')