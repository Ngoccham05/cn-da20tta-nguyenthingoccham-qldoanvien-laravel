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
            <div class="card-header">
              @if($dotdg)
              <strong class="card-title" style="font-size:20px">Đánh giá {{$dotdg->tendot}}</strong></br>
              <p class="mt-2">Đoàn viên cung cấp minh chứng dạng link bằng cách upload minh chứng lên Google Drive cá nhân và sao chép đường dẫn 
                dán vào ô minh chứng tương ứng với tiêu chí đánh giá.</p>
              @else
              <strong class="card-title" style="font-size:20px">Ngoài thời gian đánh giá</strong>
              @endif  
            </div>
            @if($dotdg)
            <div class="card-body">
              @if($xeploai)
                <table id="" class="table table-bordered table-hover">
                  <tr>
                    <th>Mã Đoàn viên</th>
                    <th>Họ tên</th>
                    <th>Xếp loại</th>
                    <th>Trạng Thái</th>
                  </tr>
                  <tr>
                    <td>{{$xeploai->doanvien->madv}}</td>
                    <td>{{$xeploai->doanvien->hoten}}</td>
                    <td>{{$xeploai->loaidv->tenloaidv}}</th>
                    <td>{{$dotdg->trangthai}}</td>
                  </tr>
                </table><hr>
              @endif

              <table id="" class="table table-bordered table-hover">
                <thead class="thead-light">
                  <tr>
                    <th class="text-center align-middle" style="width: 60px">#</th>
                    <th>Tiêu chí</th>
                    <th class="text-center align-middle" style="width: 100px">Đánh giá</th>
                    <th class="text-center align-middle" style="width: 350px">Minh chứng</th>
                  </tr>
                </thead>
                <form action="/ktcn/tcdat" method="post">
                  @csrf
                  <tbody>                
                    @php
                      $stt = 1;
                    @endphp
                    @foreach($tieuchi as $tc)
                      <tr>
                        <th class="text-center align-middle">{{ $stt++ }}.</th>
                        <td class="align-middle">{{$tc->tentc}}</td>
                        <td class="text-center align-middle">
                          <input type="text" class="form-control d-none" value="{{$dotdg->madot}}" name="txtmadot[]">
                          <input type="checkbox" name="cbmatc[]" value="{{ $tc->id }}" {{ in_array($tc->id, $tcdat) ? 'checked' : '' }} style="width:20px; height:20px">
                        </td>
                        <td class="align-middle">
                          @if(in_array($tc->id, $tcdat))
                            @php
                                $index = array_search($tc->id, $tcdat);
                            @endphp
                            <input type="text" class="form-control" id="txtminhchung" name="txtminhchung[{{ $tc->id }}]" value="{{ $mcdat[$index] ?? '' }}" autocomplete="off">
                          @else
                            <input type="text" class="form-control" id="txtminhchung" name="txtminhchung[{{ $tc->id }}]" autocomplete="off">
                          @endif
                        </td>
                      </tr>
                    @endforeach
                    @if($dotdg->trangthai == "Đoàn viên đánh giá")
                    <tr>
                      <td colspan="4" class="text-right">
                        <button type="submit" class="btn btn-primary" onclick="return validateForm()">Đánh giá</button>
                      </td>
                    </tr>
                    @endif
                  </tbody>
                </form>
              </table>
            </div>
            @endif
          </div>
        </div>   
      </div>


    </div><!-- .animated -->
  </div>
  <!-- /.content -->
  <div class="clearfix"></div>
</div>
<!-- /#right-panel -->

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
  function validateForm() {
    var isValid = true;

    $('input[name="cbmatc[]"]').each(function() {
      var isChecked = $(this).prop('checked');
      var $minhChungInput = $(this).closest('tr').find('input[name^="txtminhchung["]');

      if (isChecked && !$minhChungInput.val()) {
        isValid = false;
        $minhChungInput.addClass('is-invalid');
      } else {
        $minhChungInput.removeClass('is-invalid');
      }
    });

    if (!isValid) {
      alert('Vui lòng cung cấp đầy đủ các minh chứng.');
    }

    return isValid;
  }
</script>

@include('doanvien.footer')