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
    <div class="container">
        <?php
        if ($_SESSION['role'] == 1) {
        ?>
            <div class="row">
                <div class="col-md-6">
                    <h1>Manange All Users</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <?php
                    $select_data = "SELECT * FROM user";
                    $sql = mysqli_query($db, $select_data);
                    $i = 0;
                    $count_user = mysqli_num_rows($sql);
                    if ($count_user <= 0) {
                        echo "<div class='alert alert-danger'>There are no data</div>";
                    } else {
                    ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">SI</th>
                                    <th scope="col">Profile</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Join Date</th>
                                    <th scope="col">Update</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_assoc($sql)) {
                                    $user_id        = $row['user_id'];
                                    $user_name      = $row['user_name'];
                                    $email          = $row['email'];
                                    $phone          = $row['phone'];
                                    $address        = $row['user_address'];
                                    $role           = $row['user_role'];
                                    $status         = $row['user_status'];
                                    $profile        = $row['profile'];
                                    $join_date      = $row['join_date'];
                                    $i++;
                                ?>
                                    <tr>
                                        <th scope="row"><?php echo $i ?></th>
                                        <td>
                                            <?php
                                            if (!empty($profile)) {
                                            ?>
                                                <img class="img-fluid" width="50px" src="dist/img/user/<?php echo $profile ?>" alt="">
                                            <?php
                                            } else {
                                            ?>
                                                <img class="img-fluid" width="50px" src="dist/img/user/avatar.png" alt="">
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo $user_name ?></td>
                                        <td><?php echo $email ?></td>
                                        <td><?php echo $phone ?></td>
                                        <td><?php echo $address ?></td>
                                        <td>
                                            <?php
                                            if ($role == 1) {
                                                echo "<div class='badge badge-success'>Admin</div>";
                                            } else if ($role == 2) {
                                                echo "<div class='badge badge-warning'>Editor</div>";
                                            } else if ($role == 3) {
                                                echo "<div class='badge badge-warning'>Author</div>";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($status == 1) {
                                                echo "<div class='badge badge-success'>Active</div>";
                                            } else if ($status == 2) {
                                                echo "<div class='badge badge-danger'>Inactive</div>";
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo $join_date ?></td>
                                        <td>
                                            <a href="update_user.php?edit_id=<?php echo $user_id ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#id<?php echo $user_id ?>">Delete</a>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="id<?php echo $user_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Do you want to delete <?php echo $user_name ?>?</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="btn-group">
                                                        <a href="" class="btn btn-dark btn-sm" data-dismiss="modal">Close</a>
                                                        <a href="user.php?delete_id=<?php echo $user_id ?>" class="btn btn-danger btn-sm">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    <?php }
                    ?>
                </div>
            </div>
        <?php
        } else {
            echo "<p class='text-danger'>User not have permission to access this page!</p>";
        }
        ?>
    </div>
</div>

<!-- delete user code  -->
<?php
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM user WHERE user_id = '$delete_id'";
    $sql = mysqli_query($db, $delete_query);
    if ($sql) {
        header("location:user.php");
    } else {
        die("Error" . mysqli_error($db));
    }
}
?>
<!-- footer include  -->
<?php
include('include/dashboard/footer.php')
?>