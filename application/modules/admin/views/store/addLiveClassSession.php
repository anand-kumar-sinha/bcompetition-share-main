
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css" />
<!-- Start content -->
<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">View Live Class for recorded video</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/Dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/Store">Store</a></li>
                        <li class="breadcrumb-item active">View Live Class for recorded video</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                        <div class="col-md-6" style="border: 1px solid white;background: white;float: left; max-width: 55%;">
                            <h5>Chat</h5>
                            <hr>
                            <?php 
                            foreach ($get_join_meeting_details_chat as $key => $value) { 
                                $getstifent = getStudent($value['auth_id']);
                                 $profile_img= "https://digisysindiatech.com/testbook/assets/admin/images/users/user-4.jpg";
                                    if(!empty($getstifent->profile_pic)){
                                        $profile_img = $getstifent->profile_pic;
                                    }
                                ?>
                                <div class="container">
                                    <span style="position: absolute;margin-top: -9px;margin-left: 7px;"><?= $getstifent->name?></span>
                                      <img src="<?= $profile_img?>" alt="Avatar" style="width:100%;    margin-top: 14px;">
                                      <p style="    margin-top: 14px;"><?=  $value['message']?></p>
                                      <span class="time-right"><?=  $value['updated']?></span>
                                </div>
                            <?php }
                            ?>
                            

                           

                        


                        </div>
                        <div class="col-md-5" style="border: 1px solid white;background: white;float: left;    padding: 20px;margin-left: 30px;">
                            <div class="col-md-12">
                                <!-- <button class="btn btn-primary" style="    background: #ff80008c;
    border: 1px solid #ff80008c;
    color: #000;">Hide Stream</button> -->
    <?php 
    
    if(empty($livaclassdata->end_live_class)){ ?>
        <button class="btn btn-primary end_strem" data-id="<?= $livaclassdata->id?>" style="margin-left: 20px;    background: #e71313;border: 1px solid #e71313;">End Stream</button>
    <?php }
    ?>
                                
                            </div>
                         <!--    <div class="col-md-12">
                                <iframe width="420" height="345" src="<?= $livaclassdata->liveClassUrl ?>" frameborder='0'></iframe>
                            </div> -->
                            <hr>
                            <div class="col-md-12" style="margin-top: 10px;">
                            <div class="col-md-12" style="display: block;
    width: 100%;
    float: left;    border-bottom: 1px solid rgba(0,0,0,.1);
    margin-bottom: 30px;">
                                <div class="col-md-6" style="float: left;">
                                    <span style="color: #626ed4;
    font-size: 18px;">Student</span>
                                </div>
                                <div class="col-md-6" style="float: left;">
                                    <span style="color: #626ed4;float: right;
    font-size: 18px;">Total: <?= count($uniquePids)?></span>
                                </div>

                            </div>
                         
                         <table id="DataTableComman" class="table table-sm table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th style="width: 10%;">No.</th>
                                    <th style="width: 5%;">Photo</th>
                                    <th style="width: 5%;">Student Name</th>
                                    <th style="width: 10%;">Student Contact Number</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php 

                                foreach ($uniquePids as $key => $value) { 
                                    $getstifent = getStudent($value);
                                    $profile_img= "https://digisysindiatech.com/testbook/assets/admin/images/users/user-4.jpg";
                                    if(!empty($getstifent->profile_pic)){
                                        $profile_img = $getstifent->profile_pic;
                                    }

                                    ?>
                                    <tr>
                                        <td><?= $getstifent->id?></td>
                                        <td> <img src="<?= $profile_img?>" alt="Avatar" class="right" style="width:100%;"></td>
                                        <td><?= $getstifent->name?></td>
                                        <td><?= $getstifent->mobile_number?></td>
                                    </tr>
                               <?php }
                                ?>
                                
                                
                            </tbody>
                        </table>
                    </div>

                        </div>

                    </div>
                   
                </div>
            </div>

                </div>
        </div>
        </div>
    </div>
</div>
<style type="text/css">
.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}</style>

<script type="text/javascript">
    $(document).on("click",".end_strem", function(){
        var data_id = $(this).attr('data-id');
     
          $.ajax({
          url: 'https://digisysindiatech.com/testbook/admin/store/endstrem',
              type: 'post',
             data: {data_id:data_id},
              success:function(response) {
                 location.reload();
                    // if(userid == '' || userid == null){
                    //     window.location = "https://digisysindiatech.com/rxreliance/front/home_page/login";
                    // }else{
                    //     window.location = "https://digisysindiatech.com/rxreliance/front/home_page/cart";
                    // }
                }
            });
    });
</script>