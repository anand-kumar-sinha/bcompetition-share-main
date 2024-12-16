<?php
if (isset($ClientDetail)) {
    $id            = $ClientDetail->id;
    $first_name    =  $ClientDetail->first_name;
    $middle_name    = $ClientDetail->middle_name;
    $last_name    = $ClientDetail->last_name;
    $family_name    = $ClientDetail->family_name;
    $company_name    = $ClientDetail->company_name;
    $date_of_birth    = $ClientDetail->date_of_birth;
    $anniversary_date    = $ClientDetail->anniversary_date;
    $notes    = $ClientDetail->notes;
    $mode          = 'View';
} else {
}
?>  


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>department_user/Dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>department_user/Client_master">Client List</a></li>
                        <li class="breadcrumb-item active"><?php echo $mode; ?> Client</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="col-sm-6 float-sm-left">
                                <h3 class="card-title"><?php echo $mode; ?> Client</h3>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <table id="" class="table table-bordered table-striped">
                                        <tr>
                                            <td><label>First Name</label></td>
                                            <td> <?php echo $first_name; ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>Middle Name</label></td>
                                            <td> <?php echo $middle_name; ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>Last Name</label></td>
                                            <td> <?php echo $last_name; ?></td>
                                        </tr>

                                        <tr>
                                            <td><label>Family Name</label></td>
                                            <td> <?php echo $family_name; ?></td>
                                        </tr>

                                        <tr>
                                            <td><label>Company Name</label></td>
                                            <td> <?php echo $company_name; ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>Date Of Birth</label></td>
                                            <td> <?php echo $date_of_birth; ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>Anniversary Date</label></td>
                                            <td> <?php echo $anniversary_date; ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>Notes</label></td>
                                            <td> <?php echo $notes; ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <!-- Start: Row -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <div class="col-sm-6 float-sm-left">
                                                        <h3 class="card-title">Contact Number List</h3>
                                                    </div>
                                                    <div class="col-sm-6 float-sm-right right-add">
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <table id="ContactNumber1" class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Type</th>
                                                                <th>Contact Number</th>
                                                            </tr>
                                                        </thead>
                                                        <?php
                                                        foreach ($AllClientContact as $_AllClientContact) {
                                                            if ($_AllClientContact->country_std_code != '') {
                                                                $country_std_code = $_AllClientContact->country_std_code . ' - ';
                                                            } else {
                                                                $country_std_code = '';
                                                            }
                                                            ?>
                                                            <tr id="ContactNumberRow<?php echo $_AllClientContact->id; ?>">    
                                                                <td><?php echo $_AllClientContact->contact_type; ?></td>
                                                                <td><?php echo $country_std_code . ' ' . $_AllClientContact->contact_number; ?></td>
                                                            </tr>
                                                        <?php } ?>
                                                    </table> 
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                    </div>
                                    <!-- End: Row -->
                                    <!-- Start: Row -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <div class="col-sm-6 float-sm-left">
                                                        <h3 class="card-title">Address List</h3>
                                                    </div>
                                                    <div class="col-sm-6 float-sm-right right-add">
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <table id="Address1" class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Type</th>
                                                                <th>Address</th>
                                                            </tr>
                                                        </thead>
                                                        <?php foreach ($AllClientAddress as $_AllClientAddress) { ?>
                                                            <tr id="AddressRow<?php echo $_AllClientAddress->id; ?>">    
                                                                <td><?php echo $_AllClientAddress->address_type; ?></td>
                                                                <td><?php echo $_AllClientAddress->address; ?></td>
                                                            </tr>
                                                        <?php } ?>
                                                    </table> 

                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                    </div>
                                    <!-- End: Row -->
                                    
                                    <!-- Start: Row -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <div class="col-sm-6 float-sm-left">
                                                        <h3 class="card-title">E-mail List</h3>
                                                    </div>
                                                    <div class="col-sm-6 float-sm-right right-add">
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <table id="ClientEmail1" class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Type</th>
                                                                <th>Client Email</th>
                                                            </tr>
                                                        </thead>
                                                        <?php foreach ($AllClientEmail as $_AllClientEmail) { ?>
                                                            <tr id="ClientEmailRow<?php echo $_AllClientEmail->id; ?>">    
                                                                <td><?php echo $_AllClientEmail->email_type; ?></td>
                                                                <td><?php echo $_AllClientEmail->email; ?></td>
                                                            </tr>
                                                        <?php } ?>
                                                    </table>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                    </div>
                                    <!-- End: Row -->
                                </div>
                            </div>
                            <hr>
                            <div class="box-footer">
                                <button type="button" class="btn btn-secondary" onclick="window.history.back();">Cancel</button>
                                <a href="<?php echo base_url() . 'department_user/Client_master/add_edit/' . $id; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="View">
                                    <button class="btn btn-primary">Edit</button>
                                </a>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->




<style>
      .error{
          color: red;
      }
</style>
<script>
$( document ).ready(function() {
    
          
    $('#birth_date').datepicker({
       format:'dd-mm-yyyy', 
       autoclose: true,
       todayHighlight:'TRUE',
       endDate: new Date(),
    });
        
        
    $(function() {
  
    // Setup form validation on the #register-form element
    $("#student-form").validate({
        // Specify the validation rules
        rules: {
            gr_no:"required",
            roll_no:"required",
            birth_date:"required",
            first_name:"required",
            middle_name:"required",
            last_name:"required",
            address:"required",
            contact_name_1:"required",
            pin_code: {
                required: true,
                number:true,
            },
            contact_no_1: {
                required: true,
                number:true,
            }
            
        },
        
        // Specify the validation error messages
        messages: {
            gr_no:"Please enter a GR No",
            roll_no:"Please enter a Roll no",
            birth_date:"Please enter a Birth date",
            first_name:"Please enter a First Name",
            middle_name:"Please enter a Midddle Name",
            last_name:"Please enter a Last Name",
            address:"Please enter a Address",
            contact_name_1:"Please enter a Contact Name",
            pin_code: {
                required: "Enter a Pin Code ",
                numeric: "Please enter numeric values only"
            },
            contact_no_1: {
                required: "Enter a Contact No ",
                numeric: "Please enter numeric values only"
            }
        }
        
    });

  });
});
</script>