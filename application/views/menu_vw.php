<aside class="main-sidebar">
<!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?=base_url()?>media/comp_logo/epLabel.png" class="img-circle-25" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p style="white-space:normal;  max-width:155px;">EPAMS</p>
            </div>
        </div>
<!-- /.search form -->
<!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header"><h5>Menu</h5></li>
            <?php if( $this->session->utype == 1 || $this->session->utype == 2 ): ?>
            <li class="treeview active"><a href="javascript:void(0);" onclick="loader('panel','dashboard');"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            <li class="treeview"><a href="javascript:void(0);"><i class="fa fa-gears"></i> <span>Setup</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="javascript:void(0);"><i class="fa fa-hand-o-right"></i> <span>References</span><i class="fa fa-angle-left pull-right"></i></a>
                      <ul class="treeview-menu">
                          <li><a href="javascript:void(0);" onclick="loader('category','index');"><i class="fa fa-cog"></i> <span>Category Setup</span></a></li>
                          <li><a href="javascript:void(0);" onclick="loader('condition','index');"><i class="fa fa-cog"></i> <span>Condition Setup</span></a></li>
                          <li><a href="javascript:void(0);" onclick="loader('status','index');"><i class="fa fa-cog"></i> <span>Status Setup</span></a></li>
                          <li><a href="javascript:void(0);" onclick="loader('shift','index');"><i class="fa fa-cog"></i> <span>Shift Setup</span></a></li>
                          <li><a href="javascript:void(0);" onclick="loader('client','index');"><i class="fa fa-cog"></i> <span>Client Setup</span></a></li>
                      </ul>
                    </li>
                    <li><a href="javascript:void(0);" onclick="loader('asset','index');"><i class="fa fa-hand-o-right"></i> <span>Assets Setup</span></a></li>
                  <?php if( $this->session->utype == 1 ): ?>
                    <li><a href="javascript:void(0);" onclick="loader('user','index');"><i class="fa fa-hand-o-right"></i> <span>Users Setup</span></a></li>
                    <li><a href="javascript:void(0);" onclick="loader('employee','index');"><i class="fa fa-hand-o-right"></i> <span>Employees Setup</span></a></li>
                  <?php endif; ?>
                </ul>
            </li>
            <?php endif; ?>
            <li class=""><a href="javascript:void(0);" onclick="loader('panel','inventory');"><i class="fa fa-table"></i> <span>Inventory Page</span></a></li>
          <?php if( $this->session->utype == 1 || $this->session->utype == 2  ): ?>
            <li class=""><a href="javascript:void(0);" onclick="loader('panel','emp_records');"><i class="fa fa-table"></i> <span>Employee Records</span></a></li>
            <li class=""><a href="javascript:void(0);" onclick="loader('panel','history');"><i class="fa fa-file"></i> <span>History Page</span></a></li>
          <?php endif; ?>
            <li class=""><a href="javascript:void(0);" onclick="loader('release','index');"><i class="fa fa-link"></i> <span>Release Page</span></a></li>
            <li class=""><a href="javascript:void(0);" onclick="loader('out','index');"><i class="fa fa-link"></i> <span>Out Page</span></a></li>
        </ul>
    </section>
<!-- /.sidebar -->
</aside>
<script type="text/javascript">
    function loader(a,b){
        $('.loader').modal('show');
        $.ajax({type:'POST',
            url: '<?=base_url()?>index.php/'+a+'/'+b,
            cache: false,
            //dataType:'json',
            success: function (data) {
            //console.log(data);
              $("#framer").html(data);
              $('.loader').modal('hide');
            },
        });
    }
</script>
