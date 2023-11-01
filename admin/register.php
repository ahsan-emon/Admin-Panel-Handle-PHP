<?php
include('include/login/header.php')
?>
<div class="register-box">
  <div class="register-logo">
    <a href="index2.html"><b>Admin</b>LTE</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="text" name="name" class="form-control" placeholder="Full name" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
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
        <div class="input-group mb-3">
          <input type="password" name="repassword" class="form-control" placeholder="Retype password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree" required>
              <label for="agreeTerms">
                I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <!-- <button type="submit" name="register" class="btn btn-primary btn-block">Register</button> -->
            <input type="submit" name="register" class="btn btn-primary" value="Register">
          </div>
          <!-- /.col -->
        </div>
      </form>
      <?php
      if (isset($_POST['register'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $repassword = $_POST['repassword'];

        $email_data_check = "SELECT * FROM user WHERE email = '$email'";
        $check_email = mysqli_query($db, $email_data_check);
        $count = mysqli_num_rows($check_email);
        if ($count == 0) {
          if ($password == $repassword) {
            $hash_password = sha1($password); //password encription method strong more than md5
            // md5($password); //password encription method
            $create_user = "INSERT INTO user(user_name,email,password,join_date) VALUES('$name','$email','$hash_password',now())";
            $sql = mysqli_query($db, $create_user);
            if ($sql) {
              header('location:index.php');
            } else {
              // mysqli_error($db);
              echo "There is a error " . die($db);
            }
          } else {
            echo "<p class='text-danger'>Password Not match</p>";
          }
        } else {
          echo "<p class='text-danger'>User exist with this email address.</p>";
        }
      }
      ?>

      <a href="index.php" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<?php
include('include/login/footer.php')
?>