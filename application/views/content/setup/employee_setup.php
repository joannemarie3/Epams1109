<div class="col-sm-12">
  <div class="box box-success">
    <div class="box-header with-border">
      <section class="content-header">
        <h1>Employees Table</h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Dashboard</a></li>
          <li><a href="#">Setup</a></li>
          <li class="active"><a href="#">Employees</a></li>
        </ol>
      </section>
      <br>
    </div><!-- box-body -->
    <div ><!-- /.box-header -->
      <div class="box-body">
          <div class="row">
            <div class="col-sm-12">
              <h3>Employees Datatable</h3>
              <br />
              <button class="btn btn-success" onclick="add_employee()"><i class="glyphicon glyphicon-plus"></i> Add Employee</button>
              <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
              <br />
              <br />
              <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                          <th>Employee ID</th>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Shift</th>
                          <th style="width:130px;">Action</th>
                      </tr>
                  </thead>

                  <tbody>
                  </tbody>

                  <tfoot>
                      <tr>
                          <th>Employee ID</th>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Shift</th>
                          <th>Action</th>
                      </tr>
                  </tfoot>
              </table>
            </div>
            <div class="col-sm-12">
              <div class="buttons" id="buttons-container"></div>
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

    "processing": true, //Feature control the processing indicator.
    "serverSide": true, //Feature control DataTables' server-side processing mode.
    "order": [], //Initial no order.

    // Load data for the table's content from an Ajax source
    "ajax": {
        "url": "<?php echo site_url('employee/ajax_list')?>",
        "type": "POST"
    },

    //Set column definition initialisation properties.
    "columnDefs": [
    {
        "targets": [ -1 ], //last column
        "orderable": false, //set not orderable
    },
    ],
    initComplete: function() {
      new $.fn.dataTable.Buttons(table, {
          buttons: [{
            extend: 'excelHtml5',
            text: 'Download as (.xls)'
          }]
      });
      table.buttons().container().appendTo( $('#buttons-container') );
    }

});

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



function add_employee()
{
save_method = 'add';
$('#form')[0].reset(); // reset form on modals
$('.form-group').removeClass('has-error'); // clear error class
$('.help-block').empty(); // clear error string
$('#modal_form').modal('show'); // show bootstrap modal
$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
}

function edit_employee(id)
{
save_method = 'update';
$('#form')[0].reset(); // reset form on modals
$('.form-group').removeClass('has-error'); // clear error class
$('.help-block').empty(); // clear error string

//Ajax Load data from ajax
$.ajax({
    url : "<?php echo site_url('employee/ajax_edit/')?>/" + id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
        $('[name="id"]').val(data.id);
        $('[name="empId"]').val(data.empId);
        $('[name="firstName"]').val(data.firstName);
        $('[name="lastName"]').val(data.lastName);
        $('[name="shift_id"]').select2('data',{id:data.shift_id,text:data.shift_name});
        $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
        $('.modal-title').text('Edit Employee'); // Set title to Bootstrap modal title



    },
    error: function (jqXHR, textStatus, errorThrown)
    {
        alert('Error get data from ajax');
    }
});
}

function reload_table()
{
table.ajax.reload(null,false); //reload datatable ajax
}

function save()
{
$('#btnSave').text('saving...'); //change button text
$('#btnSave').attr('disabled',true); //set button disable
var url;

if(save_method == 'add') {
    url = "<?php echo site_url('employee/ajax_add')?>";
} else {
    url = "<?php echo site_url('employee/ajax_update')?>";
}

// ajax adding data to database
$.ajax({
    url : url,
    type: "POST",
    data: $('#form').serialize(),
    dataType: "JSON",
    success: function(data)
    {

        if(data.status) //if success close modal and reload ajax table
        {
            $('#modal_form').modal('hide');
            reload_table();
        }
        else
        {
            for (var i = 0; i < data.inputerror.length; i++)
            {
                $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
            }
        }
        $('#btnSave').text('save'); //change button text
        $('#btnSave').attr('disabled',false); //set button enable


    },
    error: function (jqXHR, textStatus, errorThrown)
    {
        alert('Error adding / update data');
        $('#btnSave').text('save'); //change button text
        $('#btnSave').attr('disabled',false); //set button enable

    }
});
}

function delete_employee(id)
{
if(confirm('Are you sure delete this data?'))
{
    // ajax delete data to database
    $.ajax({
        url : "<?php echo site_url('employee/ajax_delete')?>/"+id,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
            //if success reload ajax table
            $('#modal_form').modal('hide');
            reload_table();

            $.notify({
                icon:'fa fa-check',
                message: "Successfully Deleted!"
              },{
                type: 'success'
            });
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error deleting data');
        }
    });
  }
}

$('#shift_id').select2({
  ajax:{
    url:'<?=base_url()?>/employee/select_shift',
    dataType: 'json',
    data: function (name, page) {
          return { name: name };
      },
    results: function (data,page){
      return {results: data};
    }
  }
});

</script>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title">Employee Form</h3>
        </div>
        <div class="modal-body form">
            <form action="#" id="form" class="form-horizontal">
                <input type="hidden" value="" name="id"/>
                <div class="form-body">
                    <div class="form-group">
                      <label class="control-label col-md-3">Employee Id</label>
                      <div class="col-md-9">
                          <input name="empId" placeholder="Employee Id" class="form-control" type="text">
                          <span class="help-block"></span>
                      </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">First Name</label>
                        <div class="col-md-9">
                            <input name="firstName" placeholder="First Name" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Last Name</label>
                        <div class="col-md-9">
                            <input name="lastName" placeholder="Last Name" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sel1" class="control-label col-md-3">Shift</label>
                        <div class="col-md-9">
                            <input type="hidden" name="shift_id" id="shift_id" class="form-control">
                      </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
