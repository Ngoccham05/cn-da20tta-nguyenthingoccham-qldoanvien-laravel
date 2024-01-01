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
      </div> <!--row-->

      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <strong class="card-title mt-1" style="font-size:20px">Xếp loại chi đoàn</strong>
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#them-Modal" style="font-size: 16px">
                <i class="fa fa-plus mr-2"></i> Thêm
              </button>
            </div>
            <div class="card-body">
              <table id="bootstrap-data-table" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Kỳ</th>
                    <th>Chi đoàn</th>
                    <th>Loại</th>
                    <th>Hành động</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                    $stt = 1;
                  @endphp
                  @foreach($danhgia as $dg)
                    <tr>
                    <th class="text-center align-middle">{{ $stt++ }}.</th>
                      <td class="align-middle">{{$dg->tendot}}</td>
                      <td class="align-middle">{{$dg->macd}}</td>
                      <td class="align-middle">{{$dg->tenloaicd}}</td>
                      <td class="align-middle">
                        <a href="#" class="btn btn-primary mr-2 py-1 px-2"
                          data-toggle="modal" data-target="#sua-Modal" onclick="suadg('{{$dg->madot}}', '{{$dg->macd}}', '{{$dg->maloaicd}}')">
                          <i class="fa fa-edit" style="font-size: 18px"></i>
                        </a>   
                              
                        <a href="#" class="btn btn-danger py-1 px-2" 
                          data-toggle="modal" data-target="#xoa-Modal" onclick="xoadg('{{$dg->madot}}', '{{$dg->macd}}')">
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
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header d-flex">
              <h5 class="modal-title h5" id="them-ModalLabel">Thêm</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form action="/admin/themdgcd" method="POST">
              <div class="modal-body">
                @csrf
                <div class="row">
                  <div class="col-4 d-flex align-items-center"><label for="sldotdg">Kỳ đánh giá: </label></div>
                  <div class="col-8">
                    <select name="sldotdg" id="sldotdg" class="form-control mb-3">
                      @foreach($dotdg as $dot)
                        <option value="{{$dot->madot}}">{{$dot->tendot}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="row">
                  <div class="col-4 d-flex align-items-center"><label for="slchidoan">Chi đoàn: </label></div>
                  <div class="col-8">
                    <select name="slchidoan" id="slchidoan" class="form-control mb-3">
                      @foreach($chidoan as $cd)
                        <option value="{{$cd->macd}}">{{$cd->macd}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="row">
                  <div class="col-4 d-flex align-items-center"><label for="slloai">Xếp loại: </label></div>
                  <div class="col-8">
                    <select name="slloai" id="slloai" class="form-control mb-3">
                      @foreach($loaicd as $loai)
                        <option value="{{$loai->id}}">{{$loai->tenloaicd}}</option>
                      @endforeach
                    </select>
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

      <!-- Modal sửa-->
      <div class="modal fade" id="sua-Modal" tabindex="-1" role="dialog" aria-labelledby="sua-ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header d-flex">
              <h5 class="modal-title h5" id="sua-ModalLabel">Cập nhật</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form action="/admin/suadgcd" method="POST">
              <div class="modal-body">
                @csrf
                <div class="row">
                  <div class="col-4 d-flex align-items-center"><label for="txtdotdg-sua">Kỳ đánh giá: </label></div>
                  <div class="col-8"><input name="txtdotdg-sua" id="txtdotdg-sua" class="form-control mb-3" readonly></div>
                </div>

                <div class="row">
                  <div class="col-4 d-flex align-items-center"><label for="txtchidoan-sua">Chi đoàn: </label></div>
                  <div class="col-8"><input name="txtchidoan-sua" id="txtchidoan-sua" class="form-control mb-3" readonly></div>
                </div>

                <div class="row">
                  <div class="col-4 d-flex align-items-center"><label for="slloai-sua">Xếp loại: </label></div>
                  <div class="col-8">
                    <select name="slloai-sua" id="slloai-sua" class="form-control mb-3">
                      @foreach($loaicd as $loai)
                        <option value="{{$loai->id}}">{{$loai->tenloaicd}}</option>
                      @endforeach
                    </select>
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

      <!--Xóa đánh giá-->
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
              <form action="/admin/xoadgcd" method="POST">
                @csrf
                @method('DELETE')
                <div class="form-group">
                  <label>Bạn có chắc muốn xóa không?</label>
                  <input type="text" class="form-control d-none" id="txtdotdg-xoa" name="txtdotdg-xoa" readonly>
                  <input type="text" class="form-control d-none" id="txtchidoan-xoa" name="txtchidoan-xoa" readonly>
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

  <script type="text/javascript">
    function suadg(madot, macd, maloai){
      $('#txtdotdg-sua').val(madot);
      $('#txtchidoan-sua').val(macd);
      $('#slloai-sua').val(maloai);
    }

    function xoadg(madot, macd){
      $('#txtdotdg-xoa').val(madot);
      $('#txtchidoan-xoa').val(macd);
    }
  </script>

@include('admin.footer')