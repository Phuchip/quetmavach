<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | Log in</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="/assets/admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/assets/admin/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="/assets/admin/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="/assets/admin/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="/assets/admin/plugins/iCheck/square/blue.css">
  <link rel="stylesheet" href="assets/css/validator.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <style>
    .has-feedback label~.form-control-feedback{top: 0;}
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a><b>Admin</b></a>
  </div>
  <div class="login-box-body">
    <form id="admin-login">
      <fieldset>
        <div class="form-group has-feedback t-form-group">
            <input type="text" class="form-control" placeholder="Username" name="username" rules="required" autofocus>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            <span class="form-message"></span>
        </div>
        <div class="form-group has-feedback t-form-group">
          <input type="password" class="form-control" placeholder="Password" id="password" name="password" rules="required">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          <span class="form-message err_com_pass"></span>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <button type="submit" class="btn btn-primary btn-block btn-flat loginAdminUser">Đăng nhập</button>
          </div>
        </div>
      </fieldset>
    </form>
  </div>
</div>
<script src="/assets/admin/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/assets/admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/assets/admin/plugins/iCheck/icheck.min.js"></script>
<script src="assets/js/validator.js"></script>
<script type="text/javascript">
    var formAdmin = new validator('#admin-login');
    formAdmin.onSubmit = function (AdminData) {
      var adminData = AdminData;
      if (adminData) {
        $.ajax({
          url:'Admin/admin_login', 
          type: 'POST',
          dataType: 'json',
          data: {
            adminData: adminData
          },
          success:function(data){
            console.log(data);
           if(data.kq == true){
              window.location.href = 'admin/list_account';
           }else{
              $(".err_com_pass").html("Tên hoặc mật khẩu không đúng.");
              $("#password").val("");
           }
          }
        });
      }
    }
</script>
</body>
</html>
