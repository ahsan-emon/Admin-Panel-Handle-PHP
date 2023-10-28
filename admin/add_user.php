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
                        <h3 class="card-title">Add User</h3>

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
                                        <input type="text" name="name" id="inputName" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputDescription">Email Address</label>
                                        <input type="email" name="email" id="inputName" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputDescription">Phone Number</label>
                                        <input type="text" name="phone" id="inputName" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputDescription">Password</label>
                                        <input type="password" name="password" id="inputName" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputDescription">Re-type Password</label>
                                        <input type="password" name="repassword" id="inputName" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputDescription">Address</label>
                                        <input type="text" name="address" id="inputName" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputStatus">User Role</label>
                                        <select class="form-control custom-select" name="role">
                                            <option selected="" disabled="" value="">Select Role</option>
                                            <option value="1">Admin</option>
                                            <option value="2">Editor</option>
                                            <option value="3">Author</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputStatus">User Status</label>
                                        <select class="form-control custom-select" name="status">
                                            <option selected="" disabled="" value="">Select Status</option>
                                            <option value="1">Active</option>
                                            <option value="2">Inactive</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputClientCompany">Profile Picture</label>
                                        <input type="file" name="image" id="inputClientCompany" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="add_user" class="btn btn-primary">
                                    </div>
                                </div>
                            </div>
                        </form>
                        <?php
                        if (isset($_POST['add_user'])) {
                            $name       = $_POST['name'];
                            $email      = $_POST['email'];
                            $phone      = $_POST['phone'];
                            $password   = $_POST['password'];
                            $repassword = $_POST['repassword'];

                            if ($password == $repassword) {
                                $address    = $_POST['address'];
                                $role       = $_POST['role'];
                                $status     = $_POST['status'];
                                // image upload 
                                $image       = $_FILES['image']['name'];
                                $temp_locat = $_FILES['image']['tmp_name'];
                                $rand = rand(0, 99999);
                                $rand_two = rand(0, 99999);
                                $final_img = $image;
                                if (!empty($image)) {
                                    $final_img = $rand . "_" . $rand_two . "_" . $image;
                                }
                                //move image
                                move_uploaded_file($temp_locat, "dist/img/user/" . $final_img);

                                $data_insert = "INSERT INTO user(user_name,email,phone,password,user_address,user_role,user_status,profile,join_date) VALUES('$name','$email','$phone','$password','$address','$role','$status','$final_img', now())";

                                $sql = mysqli_query($db, $data_insert);
                            } else {
                                echo "Your Password is wrong";
                            }
                        }
                        ?>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- footer include  -->
<?php
include('include/dashboard/footer.php')
?>