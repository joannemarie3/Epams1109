<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

</head>

<div class="col-sm-12">
  <div class="box box-success">
    <div class="box-header with-border">
      <section class="content-header">
        <h1>Release Page</h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Dashboard</a></li>
          <li class="active"><a href="#">Release</a></li>
        </ol>
      </section>
      <br>
    </div><!-- box-body -->
    <div ><!-- /.box-header -->
      <div class="box-body">
        <div class="row">
          <div class="col-sm-12">
              <h3>Release Table</h3>
              <br />
              <br />
              <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
                          <th>Category</th>
                          <th>Condition</th>
                          <th>Status</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                  </tbody>
              </table>
          </div>

        </div>
      </div><!-- box-body -->
    </div>
  </div>
</div>




<script type="text/javascript">

var save_method; //for save method string
var table;

$(document).ready(function() {

//datatables
table = $('#table').DataTable({

    "scrollX": true,
    "processing": true, //Feature control the processing indicator.
    "serverSide": true, //Feature control DataTables' server-side processing mode.
    "order": [], //Initial no order.

    // Load data for the table's content from an Ajax source
    "ajax": {
        "url": "<?php echo site_url('release/ajax_list')?>",
        "type": "POST"
    },

    //Set column definition initialisation properties.
    "columnDefs": [
    {
        "targets": [ -1 ], //last column
        "orderable": false, //set not orderable
    },
    ],

});

var select = $("#select-item").change(function() {
  var product_code = $("#select-item").val();
  $.ajax({
        type: "POST",
        url: <?php echo site_url('release/ajax_list_assets')?>,
        dataType:'text',
        // data:{product_code:product_code},
        success: function(result) {
         console.log("hey");
        }
      });
 });

$('.select-item')form_dropdown('shirts', $options, $shirts_on_sale);

//datepicker
$('.datepicker').datepicker({
    autoclose: true,
    format: "yyyy-mm-dd",
    todayHighlight: true,
    orientation: "top auto",
    todayBtn: true,
    todayHighlight: true,
});

//set input/textarea/select event when change value, remove class error and remove text help block
$("input").change(function(){
    $(this).parent().parent().removeClass('has-error');
    $(this).next().empty();
});
$("textarea").change(function(){
    $(this).parent().parent().removeClass('has-error');
    $(this).next().empty();
});
$("select").change(function(){
    $(this).parent().parent().removeClass('has-error');
    $(this).next().empty();
});

});


</script>
