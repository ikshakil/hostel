<?php require_once('include/header.php'); ?>
<?php require_once('include/sidebar.php'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Add Student Facility</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= $base_url ?>dashboard">Home</a></li>
            <li class="breadcrumb-item active">Add New</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">

          <div class="card card-danger">
            <form enctype="multipart/form-data" action="" method="post">
              <div class="card-header">
                <h3 class="card-title">Add Student Facility Details</h3>
              </div>
              <div class="card-body">
                <div class="row ">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Student ID:</label>
                      <select class="custom-select mr-sm-2" id="" name="student_id">
                        <?php
                        $data = $mysqli->common_select('student');
                        if (!$data['error']) {
                          foreach ($data['data'] as $dt) {
                        ?>
                            <option value="<?= $dt->id ?>"><?= $dt->id ?></option>
                        <?php }
                        } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Facility ID:</label>
                      <select class="custom-select mr-sm-2" id="" name="facility_id">
                        <?php
                        $data = $mysqli->common_select('facility');
                        if (!$data['error']) {
                          foreach ($data['data'] as $dt) {
                        ?>
                            <option value="<?= $dt->id ?>"><?= $dt->id ?></option>
                        <?php }
                        } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                  </div>
                </div>
                <!-- Date dd/mm/yyyy -->

                <?php
                if ($_POST) {
                  if ($_FILES['image']['name']) {
                    $imgname = time() . rand(1111, 9999) . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                    $rs = move_uploaded_file($_FILES['image']['tmp_name'], "upload/users/$imgname");
                    if ($rs)
                      $_POST['image'] = $imgname;
                  }
                  if ($_POST['password']) {
                    $_POST['password'] = sha1(md5($_POST['password']));
                  }

                  $rs = $mysqli->common_create('student_facility', $_POST);
                  if (!$rs['error']) {
                    echo "<script>window.location='student_facility_view.php'</script>";
                  } else {
                    echo $rs['error'];
                  }
                }
                ?>
              </div>

            </form>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        </div>
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<?php require_once('include/footer.php'); ?>