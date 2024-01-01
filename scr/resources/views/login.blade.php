<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đoàn khoa KT&CN</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <style>
        .box-area{
          width: 930px;
        }

        .right-box{
          padding: 30px;
        }
    </style>
</head>
<body>

  <div class="container d-flex justify-content-center align-items-center min-vh-100">  
    <div class="row border rounded-5 p-5 bg-white shadow box-area">
      <!-- left-->
      <div class="col-md-4 rounded-4 d-flex justify-content-center align-items-center flex-column left-box">
        <div class="fictured-image">
          <img src="/images/logo-doan.png" class="img-fluid" style="max-width: 220px"/>
         </div>
      </div>

      <!-- right-->
      <div class="col-md-8 px-5 py-3 align-items-center">
        <div class="row align-items-center">
          <div class="header-text">
            <h3 class="mb-4"><strong>Đăng nhập</strong></h3>

            <form method="POST" action="/home">
              @csrf
              <!-- Tên đăng nhập-->
              <div class="input-group mb-3">
                <input type="text" id="txtName" name="txtName" required class="form-control form-control-lg bg-light fs-6" placeholder="Tên đăng nhập" Autocomplete ="off">
              </div>

              <!-- Mật khẩu-->
              <div class="input-group">
                <input type="password" id="txtPwd" name="txtPwd" required class="form-control form-control-lg bg-light fs-6" placeholder="Mật khẩu" Autocomplete ="off">
              </div>

              @if(session('error'))
                <div class="input-group mt-2 text-danger">
                    {{ session('error') }}
                </div>
              @endif
              
              <!-- Checkbox-->
              <div class="input-group d-flex justify-content-between mt-3">
                <div class="form-check col-12 p-0">
                  <input type="submit" class="btn btn-lg btn-primary w-100 fs-6 p-1" name="btnDN" value="Đăng nhập"/>
                </div>
              </div>
            </form>  

          <div><!-- header-text-->
        </div><!-- row align-items-center-->
      </div><!-- right-box-->
    </div><!-- row box-area-->
  </div><!-- container-->
 
</body>
</html>