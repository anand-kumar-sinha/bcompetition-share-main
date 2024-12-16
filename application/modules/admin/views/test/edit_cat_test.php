<?php
 
if(isset($TestDetail) && $TestDetail !=''){
    $id = $TestDetail->id;
    $free_paid = $TestDetail->free_paid;
    $publish_at = $TestDetail->publish_at;
    $publish_time = $TestDetail->publish_time;
    $auto_unpublish = $TestDetail->auto_unpublish;
    $unpublish_at = $TestDetail->unpublish_at;
    $unpublish_time = $TestDetail->unpublish_time;
} else {
    $id = '';
    $free_paid = '';
    $publish_at = '';
    $publish_time = '';
    $auto_unpublish = '';
    $unpublish_at = '';
    $unpublish_time = '';
}

?>

<div id="EditTestModel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Edit Test</h5>
                <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>-->
            </div>
            <!--<form class="offloadingImages"  id="offloadingImages" method="post" action="#" enctype="multipart/form-data">--> 
            <form id="Category_Form" method="post" action="<?php echo base_url(); ?>admin/Test/cat_test_action" enctype="multipart/form-data" novalidate="novalidate">
                <div class="modal-body">
                    <input type="hidden" name="cat_test_id" id="cat_test_id" value="<?php echo $id;?>">
                    <div class="form-group row col-sm-12" style="border: solid; border-width: thin; border-radius: 10px; padding:0; margin: 10px;">
                        
                        <div class="row" style="margin :10px;" id="">
                            
<!--                            <div class="col-sm-6 row" style="padding-bottom: 10px;">
                                <label class="col-sm-4" style="">Number of Attempts: </label>
                                <select class="form-control col-sm-7" required id="test_attempts_" name="edit_cat_number_of_attempts">
                                    <option value="0" <?php //if($TestDetail->number_of_attempts==0) { echo "selected";}?>>Unlimited</option>
                                    <option value="1" <?php //if($TestDetail->number_of_attempts==1) { echo "selected";}?>>1</option>
                                    <option value="2" <?php //if($TestDetail->number_of_attempts==2) { echo "selected";}?>>2</option>
                                    <option value="3" <?php //if($TestDetail->number_of_attempts==3) { echo "selected";}?>>3</option>
                                    <option value="4" <?php //if($TestDetail->number_of_attempts==4) { echo "selected";}?>>4</option>
                                    <option value="5" <?php //if($TestDetail->number_of_attempts==5) { echo "selected";}?>>5</option>
                                    <option value="6" <?php //if($TestDetail->number_of_attempts==6) { echo "selected";}?>>6</option>
                                    <option value="7" <?php //if($TestDetail->number_of_attempts==7) { echo "selected";}?>>7</option>
                                    <option value="8" <?php //if($TestDetail->number_of_attempts==8) { echo "selected";}?>>8</option>
                                    <option value="9" <?php //if($TestDetail->number_of_attempts==9) { echo "selected";}?>>9</option>
                                    <option value="10" <?php //if($TestDetail->number_of_attempts==10) { echo "selected";}?>>10</option>
                                </select>
                            </div>-->
                            <div class="col-sm-6 row" style="padding-bottom: 10px;">
                                <label class="col-sm-4" style="">Select Type: </label>
                                <select class="form-control col-sm-7" required id="test_pay_type_" name="edit_cat_free_paid" >
                                    <option value="free" <?php if($free_paid== 'free') { echo "selected";}?>>Free for everyone</option>
                                    <option value="locked" <?php if($free_paid== 'locked') { echo "selected";}?>>Only for paid/added students</option>
                                </select>
                            </div>
                            <div class="col-sm-6 row form-group" style="padding-bottom: 10px;">
                                <label class="col-sm-4" style="">Publish at: </label> 

                                <div class="input-group form-group col-sm-7 date" style="padding-left: 0; padding-right: 0;" id="publish_at_" data-target-input="nearest">
                                    <input type="text"  name="edit_cat_publish_at" class="form-control publish_at" data-target="#publish_at_" value="<?php echo date("d-m-Y", strtotime($publish_at)).' '.date("h:i", strtotime($publish_time));?>"/>
                                    <div class="input-group-append" data-target="#publish_at_" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
<!--                                <div class="input-group form-group col-sm-2" style="margin: auto; padding-left: 0; padding-right: 0;" id="publish_time_" data-target-input="nearest">
                                    <input id="" name="edit_cat_publish_time" type="time" class="col-sm-8 form-control" value="<?php echo $TestDetail->publish_time;?>">
                                </div>-->
                            </div>
                            <div class="col-sm-3 row form-group" style="padding-bottom: 10px;">
                                <label class=""  style="margin-left: 15px;margin-top: 10px;">Auto-Unpublish?</label>
                                <input type="checkbox" name="edit_cat_auto_unpublish" id="Unpublish" switch="none" class="" value="0" onchange="autoUnpublish();">
                                <label style="margin-top: 7px;margin-left: 10px;" for="Unpublish" data-on-label="Yes" data-off-label="No"></label>
                            </div>
                            <div class="col-sm-3 row form-group" style="padding-bottom: 10px;">
                            <label class=""  style="margin-left: 15px;margin-top: 10px;">Auto Publish Date</label>
                                <div class="input-group form-group date" style="margin: auto; padding-right: 0; margin-left: 20px;  <?php if($auto_unpublish == '0') { ?>display: none;<?php } else{ ?>display: block;<?php } ?>" id="unpublish_at" data-target-input="nearest">
                                    <input type="text" name="edit_cat_unpublish_at" class="form-control auto_unpublish" data-target="#unpublish_at_" value="<?php echo date("d-m-Y", strtotime($unpublish_at)).' '.date("h:i", strtotime($unpublish_time));?>" />
                                    <div class="input-group-append" data-target="#unpublish_at_" data-toggle="datetimepicker">
                                        <div class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <!--<button type="button" class="btn btn-primary waves-effect waves-light">Edit questions</button>-->
                    <!--<a class="btn btn-primary waves-effect waves-light" href="<?php echo base_url();?>admin/Test/edit_question/<?php echo $test_id;?>"    >Edit questions</a>-->
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                    <!--<button  type="submit" class="btn btn-primary waves-effect waves-light">Create</button>-->
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
 
   
$('.publish_at, .auto_unpublish').datetimepicker({
      format: "d-m-Y h:i",
//      todayHighlight: true,
//      autoclose: true,
//      orientation: "bottom", // <-- and add this
//      startDate: new Date(),
  });
//$('.publish_at, .auto_unpublish').datepicker({
//      format: "dd-mm-yyyy",
//      todayHighlight: true,
//      autoclose: true,
//      orientation: "bottom", // <-- and add this
//      startDate: new Date(),
//  });
    
    function autoUnpublish(){
        if($('#Unpublish').prop("checked") == true){
            $("#Unpublish").val('1');
            $("#unpublish_at").show();
        }else if($('#Unpublish').prop("checked") == false){
            $("#unpublish_at").hide();
            $("#Unpublish").val('0');
        }
    }
</script>