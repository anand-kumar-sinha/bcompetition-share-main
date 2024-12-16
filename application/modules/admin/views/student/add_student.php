<?php
if (isset($ClassDetail)) {
    $id = $ClassDetail->id;
    $class_title = $ClassDetail->class_title;
    $class_date = date("d-m-Y", strtotime($ClassDetail->class_date));
    $class_time = $ClassDetail->class_time;
    $mode          = 'Edit';
} else {
    $id = '';
    $class_title = '';
    $class_date = '';
    $class_time = '';
    $mode      = 'Add';
}
?>

<!-- Start content -->
<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">

                <div class="col-sm-6">
                    <h4 class="page-title">Assign Student</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/Dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/Class_master">Class List</a></li>
                        <li class="breadcrumb-item active">Assign Student</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="txtLastNameBilling">Level</label>                                                                  
                                    <select id="level_id" name="level_id" class="custom-select" onchange="SetLevelClass(this.value);">
                                        <option value="">-- Select --</option>
                                        <?php foreach ($AllLevel as $_AllLevel) { ?>
                                        <option value="<?php echo $_AllLevel->id;?>"><?php echo $_AllLevel->level_name;?></option>
                                        <?php } ?>
                                    </select>                                                                   
                                </div>
                                <div id="ResponceMessage"></div>
                            </div>
                        </div>
                        <h5>Remove Student from <?php echo $class_title;?></h5>
                        <table id="DataTableComman" class="table table-sm table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                   <th>Name</th>
                                   <th>Email</th>
                                   <th>Phone</th>
                                   <th>Registration Date</th>
                                   <th>Status</th>
                                   <th class="no-sort center-text-table" style="width: 10%;">Action</th>
                                   </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ClassAllStudent as $_ClassAllStudent) { 
                                     if($_ClassAllStudent->status == "Active"){
                                        $btnClass = "badge-success";
                                    }else{
                                        $btnClass = "badge-danger";
                                    }
                                ?>
                                    <tr>
                                        <td><?php echo $_ClassAllStudent->name;?></td>
                                        <td><?php echo $_ClassAllStudent->email;?></td>
                                        <td><?php echo $_ClassAllStudent->phone;?></td>
                                        <td><?php echo date("d-m-Y", strtotime($_ClassAllStudent->created)); ?></td>
                                        <td><span class="badge <?php echo $btnClass; ?>"><?php echo $_ClassAllStudent->status; ?></span></td>
                                        <td class="no-sort center-text-table">
                                            <a href="#" onclick="RemoveClassStudent(<?php echo $_ClassAllStudent->id; ?>);">
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
                        <h5>Assign Student to <?php echo $class_title;?></h5>
                        <table id="DataTableAssign" class="table table-sm table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                   <th>Name</th>
                                   <th>Email</th>
                                   <th>Phone</th>
                                   <th>Registration Date</th>
                                   <th>Status</th>
                                   <th class="no-sort center-text-table" style="width: 10%;">Action</th>
                                   </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($AllStudent as $_AllStudent) { 
                                     if($_AllStudent->status == "Active"){
                                        $btnClass = "badge-success";
                                    }else{
                                        $btnClass = "badge-danger";
                                    }
                                ?>
                                    <tr>
                                        <td><?php echo $_AllStudent->name;?></td>
                                        <td><?php echo $_AllStudent->email;?></td>
                                        <td><?php echo $_AllStudent->phone;?></td>
                                        <td><?php echo date("d-m-Y", strtotime($_AllStudent->created)); ?></td>
                                        <td><span class="badge <?php echo $btnClass; ?>"><?php echo $_AllStudent->status; ?></span></td>
                                        <td class="no-sort center-text-table">
                                            <a href="#" onclick="AssignClassStudent(<?php echo $_AllStudent->id; ?>);">
                                                <button class="btn btn-warning btn-sm"><i class="fas fa-plus"></i></button>
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

<script>
    $(function () {  
       $('#DataTableAssign').dataTable( {
            "columnDefs": [ {
              "targets"  : 'no-sort',
              "orderable": false,
              "order": []
            }]
        });
    });
function SetLevelClass(level_id) {
    var class_id = '<?php echo $id;?>';
    $.ajax({  
       url:"<?php echo base_url() . "admin/Class_master/set_level_action"; ?>",  
       method:"POST",  
       "dataSrc": "tableData",
       data:{level_id:level_id, class_id:class_id},  
       success:function(data)  
       {  
           $('#ResponceMessage').html(data);  
       }  
  });
}

function AssignClassStudent(student_id) {
    var class_id = '<?php echo $id;?>';
    if (confirm('Are you sure add student in this class!')) {
        $.ajax({  
           url:"<?php echo base_url() . "admin/Class_master/assign_class_student"; ?>",  
           method:"POST",  
           "dataSrc": "tableData",
           data:{student_id:student_id, class_id:class_id},  
           success:function(data)  
           {  
               if(data !=0){
                   alert("Assign student successfully");
                   window.location.reload();  
               } else {
                   alert("No Assign student");
                   return false;
               }
           }  
      });
  }
}
function RemoveClassStudent(student_id) {
    var class_id = '<?php echo $id;?>';
    if (confirm('Are you sure remove student in this class!')) {
        $.ajax({  
           url:"<?php echo base_url() . "admin/Class_master/remove_class_student"; ?>",  
           method:"POST",  
           "dataSrc": "tableData",
           data:{student_id:student_id, class_id:class_id},  
           success:function(data)  
           {  
               if(data !=0){
                   alert("Remove student successfully");
                   window.location.reload();  
               } else {
                   alert("No Remove student");
                   return false;
               }
           }  
      });
  }
}
   
    
</script>