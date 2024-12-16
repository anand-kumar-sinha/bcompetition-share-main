<div class="footer">
  <div class="container">
    <p class="pull-left">© 2016  VPAG. ALL RIGHTS RESERVED</p>
    <p class="pull-right">DESIGN BY <a href="http://www.webplusinfotech.net/" rel="nofollow" target="_blank">WEBPLUS</a></p>
  </div> 
</div>

<!-- jQuery --> 
<script src="<?php echo base_url()?>assets/front/js/jquery.min.js"></script> 
<script src="<?php echo base_url()?>assets/front/js/bootstrap.min.js"></script> 
<script src="<?php echo base_url()?>assets/front/js/include.js"></script> 
<script src="<?php echo base_url()?>assets/front/js/script.js"></script>
<script src="<?php echo base_url()?>assets/front/js/easyResponsiveTabs.js"></script>



<script type="text/javascript">
    $(document).ready(function () {
        $('#horizontalTab').easyResponsiveTabs({
            type: 'default',            
            width: 'auto', 
            fit: true   
        });
    });
    
    
    $(document).ready(function() {

        // Get current page URL
        var url = window.location.href;

        // remove # from URL
        url = url.substring(0, (url.indexOf("#") == -1) ? url.length : url.indexOf("#"));

        // remove parameters from URL
        url = url.substring(0, (url.indexOf("?") == -1) ? url.length : url.indexOf("?"));

        // select file name
        url = url.substr(url.lastIndexOf("/") + 1);

        // If file name not avilable
        if(url == ''){
        url = 'home';
        }

        // Loop all menu items
        $('.navbar-nav li').each(function(){
         // select href
         var href = $(this).find('a').attr('href');
         // Check filename
         if(url == href){
          // Add active class
          $(this).addClass('active');
         }
        });
    });


</script>

<script type="text/javascript" src="<?php echo base_url()?>assets/front/js/jquery.fancybox.js"></script>
	<script type="text/javascript">
        $(document).ready(function() {
    
        $('.fancybox').fancybox();
    
        });
    </script>


<script>
$(document).ready(function() {
    $('.collapse').on('show.bs.collapse', function() {
        var id = $(this).attr('id');
        $('a[href="#' + id + '"]').closest('.panel-heading').addClass('active-faq');
        $('a[href="#' + id + '"] .panel-title span').html('<i class="glyphicon glyphicon-minus"></i>');
    });
    $('.collapse').on('hide.bs.collapse', function() {
        var id = $(this).attr('id');
        $('a[href="#' + id + '"]').closest('.panel-heading').removeClass('active-faq');
        $('a[href="#' + id + '"] .panel-title span').html('<i class="glyphicon glyphicon-plus"></i>');
    });
});
</script>

</body>
</html>