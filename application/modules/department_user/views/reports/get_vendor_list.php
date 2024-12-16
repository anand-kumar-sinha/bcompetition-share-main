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
<?php die();?>