<div class="col-md-4">
    <div class="form-group">
        <label>Select Division</label><br>
            <select class="form-control" id="division_id" name="division_id">
                   <?php foreach ($AllClassDivision as $_AllClassDivision){?>
                <option value="<?php echo $_AllClassDivision->id; ?>" <?php if($_AllClassDivision->id == $division_id){echo "selected";}else{}?>><?php echo $_AllClassDivision->division_name; ?></option>
             <?php } ?>
            </select>
    </div>
</div>
