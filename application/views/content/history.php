<div class="col-sm-12">
  <div class="box box-success">
    <div class="box-header with-border">
      <section class="content-header">
        <h1>History Page</h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Dashboard</a></li>
          <li class="active"><a href="#">History</a></li>
        </ol>
      </section>
      <br>
    </div><!-- box-body -->
    <div ><!-- /.box-header -->
      <div class="box-body">
        <div class="row">
          <div class="col-sm-12">
              <h3>History Table</h3>
              <br />
              <br />
              <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                        <th>Description</th>
                        <th>Date</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($history as $his_item): ?>
                      <tr>
                        <td><?=$his_item['description'] ?></td>
                        <td><?=$his_item['timestamp'] ?></td>
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
    "columnDefs": [
    {
        "width": "20%",
        "targets": -1
    },
    ]
  });
  } );
</script>
