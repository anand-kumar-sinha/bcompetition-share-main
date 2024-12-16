<div id="PublishTestModel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Select batch(es) to publish this test to</h5>
                <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>-->
            </div>
            <!--<form class="offloadingImages"  id="offloadingImages" method="post" action="#" enctype="multipart/form-data">--> 
            <form id="Category_Form" method="post" action="<?php echo base_url(); ?>admin/Test/publist_test_action" enctype="multipart/form-data" novalidate="novalidate">
                <div class="modal-body">
                    <input type="hidden" name="test_id" id="test_id" value="<?php echo $test_id;?>">
                    <?php foreach ($AllCategory as $_AllCategory) { ?>
                    <div class="form-group row col-sm-12" style="border: solid; border-width: thin; border-radius: 10px; padding:0; margin: 10px;">
                        <div class="card-header col-sm-12">
                            <?php echo $_AllCategory->category_name; ?>
                            <input type="checkbox" id="procedure_hold_<?php echo $_AllCategory->id;?>" switch="none" class="" name="category_id[]" value="<?php echo $_AllCategory->id;?>" onchange="ShowControl(`<?php echo $_AllCategory->id;?>`);">
                            <label style="float: right;" for="procedure_hold_<?php echo $_AllCategory->id;?>" data-on-label="Yes" data-off-label="No"></label>
                        </div>
                        <div class="row" style="display: none; margin :10px;" id="controls_<?php echo $_AllCategory->id?>">
<!--                            <div class="col-sm-6 row" style="padding-bottom: 10px;">
                                <label class="col-sm-4" style="margin: auto;">Enter test name: </label>
                                <input id="" name="publish_time[<?php echo $_AllCategory->id; ?>]" type="text" class="col-sm-8 form-control">
                            </div>-->
<!--                            <div class="col-sm-6 row" style="padding-bottom: 10px;">
                                <label class="col-sm-4" style="">Number of Attempts: </label>
                                <select class="form-control col-sm-7" required id="test_attempts_" name="cat_number_of_attempts[<?php echo $_AllCategory->id; ?>]">
                                    <option value="0" selected="true">Unlimited</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </div>-->
                            <div class="col-sm-6 row" style="padding-bottom: 10px;">
                                <label class="col-sm-4" style="margin: auto;">Select Type: </label>
                                <select class="form-control col-sm-8" required id="test_pay_type_" name="cat_free_paid[<?php echo $_AllCategory->id; ?>]" onchange="togglePayType()">
                                    <option value="free" selected="true">Free for everyone</option>
                                    <option value="locked">Only for paid/added students</option>
                                </select> 
                            </div>
                            <!--<div class="col-sm-6 row" style="visibility: hidden; padding-bottom: 10px;" id="test_price_">-->
<!--                                <label class="col-sm-6" style="text-align: center; margin: auto;">Enter Price: </label>
                                <input type="number" name="cat_price[<?php //echo $_AllCategory->id; ?>]" class="col-sm-6 form-control">-->
                            <!--</div>-->
                            <div class="col-sm-6 row form-group" style="padding-bottom: 10px;">
                                <label class="col-sm-4" style="">Publish at: </label> 

                                <div class="input-group form-group col-sm-7 date" style="padding-left: 0; padding-right: 0;" id="publish_at_" data-target-input="nearest">
                                    <input type="text"  name="cat_publish_at[<?php echo $_AllCategory->id; ?>]" class="form-control publish_at" data-target="#publish_at_"/>
                                    <div class="input-group-append" data-target="#publish_at_" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                <!--<input id="" name="publish_time[<?php //echo $_AllCategory->id; ?>]" type="time" class="col-sm-2 form-control">-->
                            </div>
                            <div class="col-sm-3 row form-group" style="padding-bottom: 10px;">
                                <label class="" style="margin-left: 15px;margin-top: 10px;">Auto-Unpublish?</label>
                                <input type="checkbox" name="cat_auto_unpublish[<?php echo $_AllCategory->id; ?>]" id="Unpublish_<?php echo $_AllCategory->id;?>" switch="none" class="" name="" value="0" onchange="autoUnpublish(`<?php echo $_AllCategory->id;?>`);">
                                <label style="margin-top: 7px;margin-left: 10px;" for="Unpublish_<?php echo $_AllCategory->id;?>" data-on-label="Yes" data-off-label="No"></label>
                            </div>
                            <div class="col-sm-3 row form-group" style="padding-bottom: 10px;">
                                <div class="input-group form-group date" style="margin: auto; padding-right: 0; margin-left: 20px; display: none;" id="unpublish_at_<?php echo $_AllCategory->id;?>" data-target-input="nearest">
                                    <input type="text" name="cat_unpublish_at[<?php echo $_AllCategory->id; ?>]" class="form-control auto_unpublish" data-target="#unpublish_at_" />
                                    <div class="input-group-append" data-target="#unpublish_at_" data-toggle="datetimepicker">
                                        <div class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 row form-group" style="padding-bottom: 10px;">
                                <label class="" style="margin-left: 15px;margin-top: 10px;">Result-Auto-Publish?</label>
                                <input type="checkbox" name="cat_result_auto_publish[<?php echo $_AllCategory->id; ?>]" id="result_auto_publish_<?php echo $_AllCategory->id;?>" switch="none" class="" name="" value="0" onchange="ResultAutoPublish(`<?php echo $_AllCategory->id;?>`);">
                                <label style="margin-top: 7px;margin-left: 10px;" for="result_auto_publish_<?php echo $_AllCategory->id;?>" data-on-label="Yes" data-off-label="No"></label>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Create</button>
                    <!--<button  type="submit" class="btn btn-primary waves-effect waves-light">Create</button>-->
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
  
$('.publish_at, .auto_unpublish').datetimepicker({
      format: "d-m-Y H:i",
//      todayHighlight: true,
//      autoclose: true,
//      orientation: "bottom", // <-- and add this
//      startDate: new Date(),
  });
    
    function ShowControl(category_id){
        if($('#procedure_hold_'+category_id).prop("checked") == true){
//            $("#procedure_hold_"+category_id).val('1');
            $("#controls_"+category_id).show();
        }else if($('#procedure_hold_'+category_id).prop("checked") == false){
            $("#controls_"+category_id).hide();
//            $("#procedure_hold_"+category_id).val('0');
        }
    }
    function autoUnpublish(category_id){
        if($('#Unpublish_'+category_id).prop("checked") == true){
            $("#Unpublish_"+category_id).val('1');
            $("#unpublish_at_"+category_id).show();
        }else if($('#Unpublish_'+category_id).prop("checked") == false){
            $("#unpublish_at_"+category_id).hide();
            $("#Unpublish_"+category_id).val('0');
        }
    }
    function ResultAutoPublish(category_id){
        if($('#result_auto_publish_'+category_id).prop("checked") == true){
            $("#result_auto_publish_"+category_id).val('1'); 
        }else if($('#result_auto_publish_'+category_id).prop("checked") == false){ 
            $("#result_auto_publish_"+category_id).val('0');
        }
    }
</script>