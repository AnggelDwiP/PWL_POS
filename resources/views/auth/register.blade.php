<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registrasi Pengguna</title>

  <!-- Google Font: Source Sans Pro --> 
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> 
  <!-- Font Awesome --> 
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}"> 
  <!-- icheck bootstrap --> 
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}"> 
  <!-- SweetAlert2 --> 
  <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}"> 
  <!-- Theme style --> 
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}"> 
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="" class="h1"><b>Admin</b>LTE</a>
    </div>
    <div class="card-body">
      <form action="{{ url('register') }}" method="post" id="register">
        @csrf <!-- Token CSRF untuk keamanan -->
        <!-- Level Pengguna -->
        <div class="form-group">
            <div class="input-group mb-3">
                <select name="level_id" id="level_id" class="form-control" required>
                    <option value="">- Pilih Level -</option>
                    @foreach($level as $l)
                        <option value="{{ $l->level_id }}">{{ $l->level_nama }}</option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-layer-group"></span>
                    </div>
                </div>
            </div>
            <small id="error-level_id" class="error-text form-text text-danger"></small>
        </div>
        <!-- Nama -->
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="nama" placeholder="Nama" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user"></span>
                </div>
            </div>
        </div>
        <!-- Username -->
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="username" placeholder="Username" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-tag"></span>
                </div>
            </div>
        </div>
        <!-- Password -->
        <div class="input-group mb-3">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>
        <!-- Ulang Password -->
        <div class="input-group mb-3">
            <input type="password" class="form-control" name="password_confirmation" placeholder="Ulang Password" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>
        <!-- Submit -->
        <div class="row">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
        </div>
    </form>
    
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->
<a href="{{ url('login') }}" class="text-center">I already have a membership</a>

<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script> 
<!-- Bootstrap 4 --> 
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script> 
<!-- jquery-validation --> 
<script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script> 
<script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script> 
<!-- SweetAlert2 --> 
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script> 
<!-- AdminLTE App --> 
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
</body>
</html>
<script> 
  $(document).ready(function() { 
      $("#register").validate({ 
          rules: { 
              level_id: {required: true, number: true}, 
              username: {required: true, minlength: 3, maxlength: 20}, 
              nama: {required: true, minlength: 3, maxlength: 100}, 
              password: {required: true, minlength: 6, maxlength: 20} 
          }, 
          submitHandler: function(form) { 
              $.ajax({ 
                  url: form.action, 
                  type: form.method, 
                  data: $(form).serialize(), 
                  success: function(response) { 
                      if(response.status){ 
                          $('#myModal').modal('hide'); 
                          Swal.fire({ 
                            icon: 'success', 
                    title: 'Berhasil', 
                    text: response.message, 
                      }).then(function() { 
                          window.location = response.redirect; 
                      });  
                      }else{ 
                          $('.error-text').text(''); 
                          $.each(response.msgField, function(prefix, val) { 
                              $('#error-'+prefix).text(val[0]); 
                          }); 
                          Swal.fire({ 
                              icon: 'error', 
                              title: 'Terjadi Kesalahan', 
                              text: response.message 
                          }); 
                      } 
                  }             
              }); 
              return false; 
          }, 
          errorElement: 'span', 
          errorPlacement: function (error, element) { 
              error.addClass('invalid-feedback'); 
              element.closest('.form-group').append(error); 
          }, 
          highlight: function (element, errorClass, validClass) { 
              $(element).addClass('is-invalid'); 
          }, 
          unhighlight: function (element, errorClass, validClass) { 
              $(element).removeClass('is-invalid'); 
          } 
      }); 
  }); 
</script>