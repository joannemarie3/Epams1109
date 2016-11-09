<div class="col-sm-12">
  <div class="box box-success">
    <div class="box-header with-border">
      <section class="content-header">
        <h1>Inventory Page</h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Dashboard</a></li>
          <li class="active"><a href="#">Inventory</a></li>
        </ol>
      </section>
      <br>
    </div><!-- box-body -->
    <div ><!-- /.box-header -->
      <div class="box-body">
        <div class="row">
          <div class="col-sm-12">
              <h3>Inventory Table</h3>
              <br />
              <br />
              <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <style type="text/css">
                thead th {min-width: 130px;}
              </style>
                  <thead>
                      <tr>
                        <th>Device ID</th>
                        <th>Name</th>
                        <th>Model</th>
                        <th>Resolution</th>
                        <th>Processor</th>
                        <th>Ram</th>
                        <th>Os</th>
                        <th>Gpu</th>
                        <th>x32/x64</th>
                        <th>Sim Support</th>
                        <th>Category</th>
                        <th>Condition</th>
                      </tr>
                  </thead>
                  <tfoot>
                      <tr>
                        <th>Device ID</th>
                        <th>Name</th>
                        <th>Model</th>
                        <th>Resolution</th>
                        <th>Processor</th>
                        <th>Ram</th>
                        <th>Os</th>
                        <th>Gpu</th>
                        <th>x32/x64</th>
                        <th>Sim Support</th>
                        <th>Category</th>
                        <th>Condition</th>
                      </tr>
                  </tfoot>
                  <tbody>
                    <?php foreach ($inventory as $inv_item): ?>
                      <tr>
                        <td><?=$inv_item['device_id'] ?></td>
                        <td><?=$inv_item['name'] ?></td>
                        <td><?=$inv_item['model'] ?></td>
                        <td><?=$inv_item['resolution'] ?></td>
                        <td><?=$inv_item['processor'] ?></td>
                        <td><?=$inv_item['ram'] ?></td>
                        <td><?=$inv_item['os'] ?></td>
                        <td><?=$inv_item['gpu'] ?></td>
                        <td><?=$inv_item['bit'] ?></td>
                        <td><?=$inv_item['simSupport'] ?></td>
                        <td><?=$inv_item['category_name'] ?></td>
                        <td><?=$inv_item['condition_name'] ?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
              </table>
          </div>

        </div>
      </div><!-- box-body -->
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
  $('#table').DataTable({
    "scrollX": true,
  });
  } );
</script>
