
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/Dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Vendor List</li>
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
                                <h3 class="card-title">Vendor List</h3>
                            </div>                          
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2" style="padding-bottom: 10px;"> 
                                    <label for="category_id">Select Category</label>
                                    <select class="custom-select" id="category_id" name="category_id" multiple>
                                        <option value="all" >All</option>
                                        <?php foreach($AllCategory as $_AllCategory) { ?>
                                        <option value="<?php echo $_AllCategory->id; ?>" ><?php echo $_AllCategory->category_name; ?></option>
                                        <?php } ?>                                                
                                    </select> 
                                </div>
                                <div class="col-md-2">
                                    <label>&nbsp;</label><br>
                                    <button id="SearchBtn" class="btn btn-primary btn-sm" onclick="search_vendor();">Search</button>
                                </div>
                            </div>
                            <table id="vendorDataTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Company Name</th>
                                        <th>Category Name</th>
                                        <th>Mobile No</th>
                                        <th>E-mail</th>                                      
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($AllVendors as $_AllVendors) { ?>                                        
                                    <tr>
                                        <td><a href="<?php echo base_url();?>admin/Vendor_master/view/<?php echo $_AllVendors->id;?>"><?php echo $_AllVendors->first_name. ' ' .$_AllVendors->middle_name. ' ' .$_AllVendors->last_name; ?></a></td>
                                        <td><a href="<?php echo base_url();?>admin/Vendor_master/view/<?php echo $_AllVendors->id;?>"><?php echo $_AllVendors->company_name; ?></a> </td>                                      
                                        <td><?php echo $_AllVendors->category_name; ?></td>
                                        <td><?php echo $_AllVendors->mobile_no; ?></td>
                                        <td><?php echo $_AllVendors->email; ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
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
<script>
    
    $('#vendorDataTable').DataTable();
function search_vendor()
{
    var id = $("#category_id").val();
    if(id != ''){
        $.ajax({
                type: "POST",
                url: '<?php echo base_url();?>admin/Reports/get_vendor_list',
                data: {category_id:id}, 
                success: function(data){
                    $("#vendorDataTable").html(data);
                },
            });
    } else {
       
    }
   
}


</script>