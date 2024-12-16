<?php
if (isset($StudentDetail)) {
    $id            = $StudentDetail->id;
    $gr_no    = $StudentDetail->gr_no;
    $roll_no    = $StudentDetail->roll_no;
    $birth_date    = date('d-m-Y',strtotime($StudentDetail->birth_date));
    $first_name    = $StudentDetail->first_name;
    $middle_name   = $StudentDetail->middle_name;
    $last_name    = $StudentDetail->last_name;
    $address   = $StudentDetail->address;
    $street    = $StudentDetail->street;
    $area    = $StudentDetail->area;
    $city    = $StudentDetail->city;
    $state    = $StudentDetail->state;
    $country    = $StudentDetail->country;
    $pin_code    = $StudentDetail->pin_code;
    $contact_name_1    = $StudentDetail->contact_name_1;
    $contact_relation_1    = $StudentDetail->contact_relation_1;
    $contact_no_1    = $StudentDetail->contact_no_1;
    $contact_name_2    = $StudentDetail->contact_name_2;
    $contact_relation_2    = $StudentDetail->contact_relation_2;
    $contact_no_2    = $StudentDetail->contact_no_2;
    $is_active    = $StudentDetail->is_active;
    $mode          = 'View';
     
           
            
} else {

}
?>  
<section class="content-header">
    <small>&nbsp;</small>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>admin/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url(); ?>admin/Student">Student</a></li>
        <li class="active"><?php echo $mode; ?></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo $mode; ?> Student</h3>
                </div>
                <form id="student-form" method="post" action="<?php echo base_url() ?>admin/Student/action" enctype="multipart/form-data">
                    <input type="hidden" id="id" name="id" value="<?php echo $id; ?>" />
                    <div class="box-body">
                        <!-- Start ROW -->
                        <div class="row">
                            <div class="col-md-6">
                                <table id="example1" class="table table-bordered table-striped">
                                    <tr>
                                        <td><label>Gr No</label></td>
                                        <td> <?php echo $gr_no; ?></td>
                                    </tr>
                                    <tr>
                                        <td><label>Roll No</label></td>
                                        <td> <?php echo $roll_no; ?></td>
                                    </tr>
                                    <tr>
                                        <td><label>Birth Date</label></td>
                                        <td> <?php echo $birth_date; ?></td>
                                    </tr>
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
                                        <td><label>Last Name</label></td>
                                        <td> <?php echo $last_name; ?></td>
                                    </tr>
                                    <tr>
                                        <td><label>Address</label></td>
                                        <td> <?php echo $address; ?></td>
                                    </tr>
                                    <tr>
                                        <td><label>Street</label></td>
                                        <td> <?php echo $street; ?></td>
                                    </tr>
                                    <tr>
                                        <td><label>Area</label></td>
                                        <td> <?php echo $area; ?></td>
                                    </tr>
                                    <tr>
                                        <td><label>City</label></td>
                                        <td> <?php echo $city; ?></td>
                                    </tr>
                                    <tr>
                                        <td><label>State</label></td>
                                        <td> <?php echo $state; ?></td>
                                    </tr>
                                    <tr>
                                        <td><label>Country</label></td>
                                        <td> <?php echo $country; ?></td>
                                    </tr>
                                    <tr>
                                        <td><label>Pin Code</label></td>
                                        <td> <?php echo $pin_code; ?></td>
                                    </tr>
                                    <tr>
                                        <td><label>Contact Name 1</label></td>
                                        <td> <?php echo $contact_name_1; ?></td>
                                    </tr>
                                    <tr>
                                        <td><label>Contact Relation 1</label></td>
                                        <td> <?php echo $contact_relation_1; ?></td>
                                    </tr>
                                    <tr>
                                        <td><label>Contact No 1</label></td>
                                        <td> <?php echo $contact_no_1; ?></td>
                                    </tr>
                                     <tr>
                                        <td><label>Contact Name 2</label></td>
                                        <td> <?php echo $contact_name_2; ?></td>
                                    </tr>
                                    <tr>
                                        <td><label>Contact Relation 2</label></td>
                                        <td> <?php if($contact_name_2 != '' || $contact_no_2 != ''){echo $contact_relation_2; } else {echo "";} ?></td>
                                    </tr>
                                    <tr>
                                        <td><label>Contact No 2</label></td>
                                        <td> <?php echo $contact_no_2; ?></td>
                                    </tr>
                                </table>
                            </div>
                            
                        </div>
                        <!-- End ROW -->
                    </div>
                    <div class="box-footer">
                            <a href="<?php echo base_url() . 'admin/Student/' ?>"><button type="button" class="btn btn-defalt"> << Back </button></a>
                        </div>
                </form>
                </div>
            </div>
        </div>
</section>



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