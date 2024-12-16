<footer class="footer">
    &copy; 2022 Testbook <span class="d-none d-sm-inline-block"> - Developed by <a href="#" target="_blank"> Digisys India Tech</a></span>.
</footer>

</div>
 <!-- jQuery  --> 
         <!-- jQuery  -->
        
        <script src="<?php echo base_url();?>assets/admin/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo base_url();?>assets/admin/js/metismenu.min.js"></script>
        <script src="<?php echo base_url();?>assets/admin/js/jquery.slimscroll.js"></script>
        <script src="<?php echo base_url();?>assets/admin/js/waves.min.js"></script>

           <!-- form wizard -->
        <script src="<?php echo base_url();?>assets/admin/plugins/jquery-steps/jquery.steps.min.js"></script>
   
        
          <!-- Required datatable js -->
        <script src="<?php echo base_url();?>assets/admin/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url();?>assets/admin/plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="<?php echo base_url();?>assets/admin/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="<?php echo base_url();?>assets/admin/plugins/datatables/buttons.bootstrap4.min.js"></script>
        <script src="<?php echo base_url();?>assets/admin/plugins/datatables/jszip.min.js"></script>
        <script src="<?php echo base_url();?>assets/admin/plugins/datatables/pdfmake.min.js"></script>
        <script src="<?php echo base_url();?>assets/admin/plugins/datatables/vfs_fonts.js"></script>
        <script src="<?php echo base_url();?>assets/admin/plugins/datatables/buttons.html5.min.js"></script>
        <script src="<?php echo base_url();?>assets/admin/plugins/datatables/buttons.print.min.js"></script>
        <script src="<?php echo base_url();?>assets/admin/plugins/datatables/buttons.colVis.min.js"></script>
        <script src="<?php echo base_url();?>assets/admin/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="<?php echo base_url();?>assets/admin/plugins/datatables/responsive.bootstrap4.min.js"></script>

        <!-- Datatable init js -->
        <script src="<?php echo base_url();?>assets/admin/pages/datatables.init.js"></script>   
        
        <!-- App js -->
        <script src="<?php echo base_url();?>assets/admin/js/app.js"></script>
        <script src="<?php echo base_url();?>assets/admin/js/jquery.validate.min.js"></script>
        
       
<style>
    .error{
        color: red;
    }
</style>
<script>
//    
    $(function () {   
        
        $('#DataTableComman').dataTable( {
            "columnDefs": [ {
              "targets"  : 'no-sort',
              "orderable": false,
              "order": []
            }]
        });
       
         $('#DataTableComman1').dataTable( {
            "columnDefs": [ {
              "targets"  : 'no-sort',
              "orderable": false,
              "order": [],
              "aaSorting": [[0, 'desc']] 
            }]
        });
        
        $('#DataTableButton').DataTable( {
            dom: 'lBfrtip',
            buttons: [
                'excel'
            ],
            "columnDefs": [ {
              "targets"  : 'no-sort',
              "orderable": false,
              "order": []
            }]
        } );
        
         $('#QuantityAdjustmentTable').dataTable( {
        "columnDefs": [ {
          "targets"  : 'no-sort',
          "orderable": false,
          "order": []
        }]
    });
    $('#PendingQuantityAdjustmentTable').dataTable( {
        "columnDefs": [ {
          "targets"  : 'no-sort',
          "orderable": false,
          "order": []
        }]
    });
    });  
</script>
    </body>

</html>