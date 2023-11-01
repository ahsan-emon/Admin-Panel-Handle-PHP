<?php
include('include/login/header.php');
session_start();
?>
<div class="login-box">
  <div class="login-logo">
    <a href="index2.html"><b>Login</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>
      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="sign_in" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <?php
      if (isset($_POST['sign_in'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $dec_password = sha1($password);
        $user_data_match = "SELECT * FROM user WHERE email = '$email' && password='$dec_password'";
        $user_match = mysqli_query($db, $user_data_match);
        $count = mysqli_num_rows($user_match);
        if ($count == 1) {
          while ($row = mysqli_fetch_array($user_match)) {
            $_SESSION['user_id']        = $row['user_id'];
            $_SESSION['user_name']      = $row['user_name'];
            $_SESSION['email']          = $row['email'];
            $_SESSION['phone']          = $row['phone'];
            $_SESSION['address']        = $row['user_address'];
            $_SESSION['role']           = $row['user_role'];
            $_SESSION['status']         = $row['user_status'];
            $_SESSION['profile']        = $row['profile'];
            $_SESSION['join_date']      = $row['join_date'];
            $password                   = $row['password'];
            if ($_SESSION['email'] == $email && $password == $dec_password) {
              header('location:dashboard.php');
            } else if ($_SESSION['email'] != $email && $password != $dec_password) {
              header('location:index.php');
            } else {
              header('location:index.php');
            }
          }
        } else {
          echo "<p class='text-danger'>User not match with email or password</p>";
        }
      }
      ?>

      <p class="mb-1">
        <a href="recover-password.php">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.php" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<?php
include('include/login/footer.php')
?>