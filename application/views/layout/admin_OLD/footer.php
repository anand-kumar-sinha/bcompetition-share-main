  <!-- /.content-wrapper -->
  <footer class="main-footer">
      <strong>Copyright &copy; <a href="#" target="_blank">Shiv Auto Tech</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        Developed by 
        <!--<a href="https://kookycoder.com/" target="_blank">Kooky Coder</a>-->
      <!--<b>Version</b> 3.0.1-->
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<script>
    $(function () {   
        $("#datatable1").DataTable();  
        $("#datatable2").DataTable();   
        $("#datatable3").DataTable();    
        $("#example1").DataTable({
            "targets"  : 'no-sort',
//            "orderable": false,
//            "order": [],
            aaSorting: [[0, 'desc']]   
//            aaSorting: [[0, 'desc']]   
        });        
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });
        $("#example3").DataTable();  
    }); 
    
    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();   
    });
    
    
    $(document).ready(function () {
      bsCustomFileInput.init();
    });

</script>  


</body>

</html>