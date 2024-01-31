<!DOCTYPE html>
<html>
   <head>
      <base href="/">
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Admin | Log in</title>
      <!-- Tell the browser to be responsive to screen width -->
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <!-- Bootstrap 3.3.7 -->
      <link rel="stylesheet" href="admin_assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="admin_assets/bower_components/font-awesome/css/font-awesome.min.css">
      <!-- Ionicons -->
      <link rel="stylesheet" href="admin_assets/bower_components/Ionicons/css/ionicons.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="admin_assets/dist/css/AdminLTE.min.css">
      <!-- iCheck -->
      <link rel="stylesheet" href="admin_assets/plugins/iCheck/square/blue.css">
      <link rel="stylesheet" href="assets/css/customize.css">
      <!-- Google Font -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
      <link rel="shortcut icon" type="image/x-icon" href="uploads/favicon.png">
   </head>
   <body class="hold-transition login-page">
      <div class="login-box">
         <div class="login-logo">
            <a href="admin_assets/index2.html"><b>Admin</b> Bemet</a>
         </div>
         <!-- /.login-logo -->
         <div class="login-box-body">
            <p class="login-box-msg">Sign in now!</p>
            <form action="" method="post">
               @csrf
               <div class="form-group has-feedback">
                  <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email">
                  <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
               </div>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror

               <div class="form-group has-feedback">
                  <input type="password" name="password" class="form-control" placeholder="Password">
                  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
               </div>
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror

               <div class="row">
                  <div class="col-xs-8">
                     <div class="checkbox">
                        <label>
                        <input type="checkbox"> Remember Me
                        </label>
                     </div>
                  </div>
                  <!-- /.col -->
                  <div class="col-xs-4">
                     <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                  </div>
                  <!-- /.col -->
               </div>
            </form>
            <!-- /.social-auth-links -->
            <a href="#">I forgot my password</a><br>
         </div>
         <!-- /.login-box-body -->
      </div>
      <!-- /.login-box -->
   </body>
</html>
