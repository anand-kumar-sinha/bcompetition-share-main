<?php
if (isset($StudentDetail)) {
    $id = $StudentDetail->id;
    $school_name = $StudentDetail->school_name;
    $name = $StudentDetail->name;
    $email = $StudentDetail->email;
    $date_of_birth = date("d-m-Y", strtotime($StudentDetail->date_of_birth));
    $gender = $StudentDetail->gender;
    $mobile_number = $StudentDetail->mobile_number;
    $address = $StudentDetail->address;
    $country_id = $StudentDetail->country_id;
    $state_id = $StudentDetail->state_id;
    $city_id = $StudentDetail->city_id;
    $pin_code = $StudentDetail->pin_code;
    $mode          = 'Edit';
    $readonly = "readonly";
} else {
    $id = '';
    $school_name = '';
    $name = '';
    $email = '';
    $date_of_birth = '';
    $gender = '';
    $mobile_number = '';
    $address = '';
    $country_id = '';
    $state_id = '';
    $city_id = '';
    $pin_code = '';
    $mode      = 'Add';
    $readonly = "";
}
?>

<!-- Start content -->
<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">

                <div class="col-sm-6">
                    <h4 class="page-title">Student </h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/Dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Student List</li>
                    </ol>

                </div>
            </div>
        </div>
        <!-- end row -->

                <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <table id="DataTableComman1" class="table table-sm table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                   <th>Profile Photo</th>
                                   <th>Name</th>
                                    <th>Contact Number</th>
                                   <th>Status</th>
                                   <th>Creted Date</th>
                                   <th class="no-sort center-text-table" style="width: 15%;">Action</th>
                                   </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($AllStudent as $_AllStudent) {
                                    $studentProfile = 'default.png';
                                   if(!empty($_AllStudent->profile_pic)){
                                    $studentProfile = $_AllStudent->profile_pic;
                                   }
                                    ?>
                                    <tr> 
                                        <td><img src="<?php echo base_url('uploads/student_profile/'.$studentProfile)?>" width="50px;"></td>
                                        <td><?php echo $_AllStudent->name; ?></td>
                                        <td><?php echo $_AllStudent->mobile_number; ?></td>
                                        <td><span class="badge badge-success">Active</td>
                                        <td><?php echo $_AllStudent->created; ?></td>
                                        <td class="no-sort center-text-table">
                                            <a href="<?php echo base_url('admin/manage_package_info/removeSub?id='.$_AllStudent->subid.'&courseid='.$store_id)?>" data-toggle="tooltip" >
                                                <button class="btn btn-danger btn-sm"><i class="fas fa-minus"></i></button>
                                            </a>                                           
                                           
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>






        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <table id="DataTableComman" class="table table-sm table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                   <th>Profile Photo</th>
                                   <th>Name</th>
                                    <th>Contact Number</th>
                                   <th>Status</th>
                                   <th>Creted Date</th>
                                   <th class="no-sort center-text-table" style="width: 15%;">Action</th>
                                   </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($AllNewStudent as $_AllStudent) {
                                      $studentProfile = 'default.png';
                                   if(!empty($_AllStudent->profile_pic)){
                                    $studentProfile = $_AllStudent->profile_pic;
                                   }
                                    ?>
                                    <tr> 
                                       <td><img src="<?php echo base_url('uploads/student_profile/'.$studentProfile)?>" width="50px;"></td>
                                        <td><?php echo $_AllStudent->name; ?></td>
                                        <td><?php echo $_AllStudent->mobile_number; ?></td>
                                        <td><span class="badge badge-success">Active</td>
                                        <td><?php echo $_AllStudent->created; ?></td>
                                        <td class="no-sort center-text-table">
                                            <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add">
                                                <a href="<?php echo base_url('admin/manage_package_info/addSub?id='.$_AllStudent->id.'&courseid='.$store_id)?>" data-toggle="tooltip" >
                                                <button class="btn btn-primary btn-sm"><i class="fas fa-plus"></i></button>
                                            </a>                                           
                                           
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- container-fluid -->

</div>
<!-- content -->
<style>
.custom_ul ul {
  columns: 2;
  -webkit-columns: 2;
  -moz-columns: 2;
}
</style>
<script>

</script>