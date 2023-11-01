<?php
// header include 
include('include/dashboard/header.php');
// navbar include 
include('include/dashboard/navbar.php');
// sidebar include 
include('include/dashboard/sidebar.php');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container p-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <?php
                        if (isset($_GET['edit_id'])) {
                            $edit_id = $_GET['edit_id'];
                            $edit_query = "SELECT * FROM user WHERE user_id = '$edit_id'";
                            $sql = mysqli_query($db, $edit_query);
                            $data = mysqli_fetch_assoc($sql);
                        }
                        ?>
                        <h3 class="card-title">Update <?php echo $data['user_name'] ?></h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputName">User Name</label>
                                        <input type="text" name="name" id="inputName" class="form-control" value="<?php echo $data['user_name'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputDescription">Email Address</label>
                                        <input type="email" name="email" id="inputName" class="form-control" value="<?php echo $data['email'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputDescription">Phone Number</label>
                                        <input type="text" name="phone" id="inputName" class="form-control" value="<?php echo $data['phone'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputDescription">Password</label>
                                        <input type="password" name="password" disabled="true" id="inputName" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputDescription">Re-type Password</label>
                                        <input type="password" name="repassword" disabled="true" id="inputName" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputDescription">Address</label>
                                        <input type="text" name="address" id="inputName" class="form-control" value="<?php echo $data['user_address'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputStatus">User Role</label>
                                        <select class="form-control custom-select" name="role">
                                            <option selected="" disabled="" value="">Select Role</option>
                                            <option value="1" <?php if ($data['user_role'] == 1) {
                                                                    echo 'selected';
                                                                } ?>>Admin</option>
                                            <option value="2" <?php if ($data['user_role'] == 2) {
                                                                    echo 'selected';
                                                                } ?>>Editor</option>
                                            <option value="3" <?php if ($data['user_role'] == 3) {
                                                                    echo 'selected';
                                                                } ?>>Author</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputStatus">User Status</label>
                                        <select class="form-control custom-select" name="status">
                                            <option selected="" disabled="" value="">Select Status</option>
                                            <option value="1" <?php if ($data['user_status'] == 1) {
                                                                    echo 'selected';
                                                                } ?>>Active</option>
                                            <option value="2" <?php if ($data['user_status'] == 2) {
                                                                    echo 'selected';
                                                                } ?>>Inactive</option>
                                        </select>
                                    </div>
                                    <?php
                                    if ($data['profile'] != null) {
                                    ?>
                                        <div>
                                            <img width="100px" src="dist/img/user/<?php echo  $data['profile'] ?>" alt="Profile">
                                        </div>
                                    <?php } ?>
                                    <div class="form-group">
                                        <label for="inputClientCompany">Profile Picture</label>
                                        <input type="file" name="image" id="inputClientCompany" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="update_user" class="btn btn-warning" value="Update">
                                    </div>
                                </div>
                            </div>
                        </form>
                        <?php
                        if (isset($_POST['update_user'])) {
                            $name       = $_POST['name'];
                            $email      = $_POST['email'];
                            $phone      = $_POST['phone'];

                            $user_id   = $data['user_id'];
                            $password   = $data['password'];
                            $profile   = $data['profile'];

                            $address    = $_POST['address'];
                            $role       = $_POST['role'];
                            $status     = $_POST['status'];
                            // image upload 
                            $image       = $_FILES['image']['name'];
                            $temp_locat = $_FILES['image']['tmp_name'];
                            $final_img = $profile;
                            if (!empty($image)) {
                                $rand = rand(0, 99999);
                                $rand_two = rand(0, 99999);
                                $final_img = $rand . "_" . $rand_two . "_" . $image;
                            }
                            //move image
                            move_uploaded_file($temp_locat, "dist/img/user/" . $final_img);

                            $data_update = "UPDATE user SET user_name='$name',email='$email',phone='$phone',user_address='$address',user_role='$role',user_status='$status',profile='$final_img' WHERE user_id = '$user_id'";

                            $sql = mysqli_query($db, $data_update);
                            if ($sql) {
                                header('location:user.php');
                            } else {
                                mysqli_error($db);
                            }
                        }
                        ?>
                    </div>
                    <!-- /.card-body -->
                </div>\
            </div>
        </div>
    </div>
</div>
<!-- footer include  -->
<?php
include('include/dashboard/footer.php')
?>