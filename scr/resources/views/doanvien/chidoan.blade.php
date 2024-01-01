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
              <strong class="card-title mt-1" style="font-size:20px">Danh sách chi đoàn</strong>
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#them-cd-Modal" style="font-size: 16px">
                <i class="fa fa-plus mr-2"></i> Thêm
              </button>
            </div>
            <div class="card-body">
              <table id="bootstrap-data-table" class="table table-bordered">
                <thead>
                  <tr>
                    <th class="text-center">#</th>
                    <th>Mã chi đoàn</th>
                    <th>Tên chi đoàn</th>
                    <th>Số ĐV</th>
                    <th>Ngành</th>
                    <th>Hành động</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                    $stt = 1;
                  @endphp
                  @foreach($chidoan as $cd)
                    <tr>
                      <th class="text-center align-middle" scope="row">{{ $stt++ }}.</th>
                      <td class="align-middle">{{$cd['chidoan']->macd}}</td>
                      <td class="align-middle">{{$cd['chidoan']->tencd}}</td>
                      <td class="align-middle">{{$cd['soluong']}}</td>
                      <td class="align-middle">{{$cd['chidoan']->nganh->tennganh}}</td>
                      <td class="align-middle">
                        <a href="/ktcn/dvchidoan?macd={{ $cd['chidoan']->macd }}" class="btn btn-secondary mr-2 py-1 px-2"><i class="fa fa-eye" style="font-size: 18px"></i></a>

                        <a href="#" class="btn btn-primary mr-2 py-1 px-2" onclick="suacd('{{$cd['chidoan']->macd}}', '{{$cd['chidoan']->tencd}}', '{{$cd['chidoan']->manganh}}')" data-toggle="modal" data-target="#sua-cd-Modal">
                          <i class="fa fa-edit" style="font-size: 18px"></i>
                        </a>  
                            
                        <!-- <a href="#" class="btn btn-danger py-1 px-2" onclick="xoacd('{{$cd['chidoan']->macd}}')" data-toggle="modal" data-target="#xoa-cd-Modal">
                          <i class="fa fa-trash" style="font-size:18px"></i>
                        </a> -->
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
      <div class="modal fade" id="them-cd-Modal" tabindex="-1" role="dialog" aria-labelledby="them-ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header d-flex">
              <h5 class="modal-title h5" id="them-ModalLabel">Thêm</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="/ktcn/themcd" method="POST">
                @csrf
                <div class="row mb-3">
                  <div class="col-4 mt-2"><label for="txtmacd">Mã chi đoàn: </label></div>
                  <div class="col-8"><input type="text" class="form-control" id="txtmacd" name="txtmacd" required autocomplete="off"></div>
                </div>
                <div class="row mb-3">
                  <div class="col-4 mt-2"><label for="txttencd">Tên chi đoàn: </label></div>
                  <div class="col-8"><input type="text" class="form-control" id="txttencd" name="txttencd" required autocomplete="off"></div>
                </div>
                <div class="row mb-3">
                  <div class="col-4 mt-2"><label for="txtnganh">Ngành: </label></div>
                  <div class="col-8">
                    <select name="slnganh" class="form-control">
                      @foreach ($nganh as $nganh_them)
                        <option value="{{ $nganh_them->id }}">{{ $nganh_them->tennganh }}</option>
                      @endforeach
                    </select>
                  </div>
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

      <div class="modal fade" id="sua-cd-Modal" tabindex="-1" role="dialog" aria-labelledby="sua-ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header d-flex">
              <h5 class="modal-title h5" id="sua-ModalLabel">Cập nhật</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="/ktcn/suacd" method="POST">
                @csrf
                <div class="row mb-3">
                  <div class="col-4 mt-2"><label for="txtmacd-sua">Mã chi đoàn: </label></div>
                  <div class="col-8"><input type="text" class="form-control" id="txtmacd-sua" name="txtmacd-sua" required autocomplete="off"></div>
                </div>
                <div class="row mb-3">
                  <div class="col-4 mt-2"><label for="txttencd-sua">Tên chi đoàn: </label></div>
                  <div class="col-8"><input type="text" class="form-control" id="txttencd-sua" name="txttencd-sua" required autocomplete="off"></div>
                </div>
                <div class="row mb-3">
                  <div class="col-4 mt-2"><label for="slnganh-sua">Ngành: </label></div>
                  <div class="col-8">
                    <select name="slnganh-sua" class="form-control" id="slnganh-sua">
                      @foreach ($nganh as $nganh)
                        <option value="{{ $nganh->id }}">{{ $nganh->tennganh }}</option>
                      @endforeach
                    </select>
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
      </div>

      <div class="modal fade" id="xoa-cd-Modal" tabindex="-1" role="dialog" aria-labelledby="xoa-ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header d-flex">
              <h5 class="modal-title h5" id="xoa-ModalLabel">Xóa</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="/ktcn/xoacd" method="POST">
                @csrf
                @method('DELETE')
                <div class="form-group">
                  <label for="txtmacd-xoa">Bạn có chắc muốn xóa không?</label>
                  <input type="text" class="form-control d-none" id="txtmacd-xoa" name="txtmacd-xoa" readonly>
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
    function suacd(macd, tencd, manganh){
      $('#txtmacd-sua').val(macd);
      $('#txttencd-sua').val(tencd);
      $('#slnganh-sua').val(manganh);
    };

    function xoacd(macd){
      $('#txtmacd-xoa').val(macd);
    }
  </script>


@include('doanvien.footer')