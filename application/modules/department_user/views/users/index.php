<section class="content-header">
    <h1>&nbsp;</h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>admin/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Users</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <div class="box box-primary">
              <div class="row box-body">
                    <div class="col-xs-8">
                        <div class="box-header">
                            <h3 class="box-title">Users List</h3>
                        </div>
                    </div>
                    <div class="col-xs-4 text-right">
                        <a href="<?php echo base_url().'admin/Users/add_edit/';?>"><button class="btn btn-primary" class="btn btn-primary btn-lg">Add New</button></a>
                        
                    </div>
                </div>
              
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                       <th>Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>#</th>
                    </tr>
                </tfoot>
                <tbody>
                    
                <?php foreach ($Allusers as $_Allusers) { ?>
                    <tr>
                        <td><?php echo $_Allusers->name;?></td>
                        <td><?php echo $_Allusers->email;?></td>
                        <td><?php echo $_Allusers->contact;?></td>
                        
                        <td>
                            <a href="<?php echo base_url().'admin/Users/add_edit/'.$_Allusers->id;?>"><span class="glyphicon glyphicon-edit btn"></span></a>
                            <a href="<?php echo base_url().'admin/Users/delete/'.$_Allusers->id;?>" onclick="return confirm('Are you sure?');"><span class="glyphicon glyphicon-trash btn"></span></a>
                            <!--<a href="<?php // echo base_url().'admin/Users/view/'.$_AllStudents->id;?>"><span class="glyphicon glyphicon-list-alt btn"></span></a>-->
                        </td>
                    </tr>
                <?php } ?>
                                
                </tbody>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>