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
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-6">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="card card-success">
                                    <div class="card-header">
                                        <h3 class="card-title">Add Category</h3>

                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                                <i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="inputName">Category Name</label>
                                                        <input type="text" name="cat_name" id="inputName" class="form-control" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputDescription">Category Description</label>
                                                        <textarea name="cat_desc" id="inputName" class="form-control" rows="4"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputStatus">Category Status</label>
                                                        <select class="form-control custom-select" name="cat_status" required>
                                                            <option selected="" disabled="" value="">Select Status</option>
                                                            <option value="1">Active</option>
                                                            <option value="2">Draft</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="submit" name="add_cat" class="btn btn-success" value="Add Category">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- footer include  -->
<?php
include('include/dashboard/footer.php')
?>