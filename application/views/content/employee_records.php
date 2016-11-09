<div class="col-sm-12">
  <div class="box box-success">
    <div class="box-header with-border">
      <section class="content-header">
        <h1>Employees Records</h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Dashboard</a></li>
          <li class="active"><a href="#">Employees</a></li>
        </ol>
      </section>
      <br>
    </div><!-- box-body -->
    <div ><!-- /.box-header -->
      <div class="box-body">
        <div class="row">
          <div class="col-sm-12">
              <h3>Employees Table</h3>
              <br />
              <br />
              <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                          <th>Employee ID</th>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Shift</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($employees as $emp): ?>
                      <tr>
                        <td><?=$emp['empId'] ?></td>
                        <td><?=$emp['firstName'] ?></td>
                        <td><?=$emp['lastName'] ?></td>
                        <td><?=$emp['shift_name'] ?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
              </table>
          </div><!-- end of container -->
        </div>
      </div><!-- box-body -->
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
  $('#table').DataTable();
  } );
</script>
