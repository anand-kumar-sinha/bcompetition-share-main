<div id="section_<?php echo $sectionCount;?>">
   <hr>
    <input type="hidden" id="section_question_count_<?php echo $sectionCount;?>" value="0">
    <b style="font-size: 20px;" id="section_title_<?php echo $sectionCount;?>" value=""><?php echo $section_name; ?></b>
    <input type="hidden" class="section_id" name="section_id[]" id="section_id_<?php echo $sectionCount;?>" value="<?php echo $sectionCount; ?>">
    <input type="hidden" class="section_name" name="section_name[]" id="section_name_<?php echo $sectionCount;?>" value="<?php echo $section_name; ?>">
    <button class="btn btn-warning waves-effect waves-light btn-sm" type="button" onclick="editSectionBtn('<?php echo $sectionCount;?>')"><i class="fas fa-edit"></i> </button>
    <button onclick="deleteSectionBtn('<?php echo $sectionCount;?>')" class="btn btn-danger waves-effect waves-light btn-sm" style="margin-right: 5px;" type="button"><i class="fa fa-trash"></i> </button>
    <hr>
    <div class="row col-sm-12 float-left" id="section_<?php echo $sectionCount;?>_questions">
        
    </div>
</div>