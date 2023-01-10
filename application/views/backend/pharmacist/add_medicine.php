<?php $medicine_category_info = $this->db->get('medicine_category')->result_array(); ?>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <h3><?php echo get_phrase('add_medicine'); ?></h3>
                </div>
            </div>

            <div class="panel-body">

                <form role="form" class="form-horizontal form-groups" action="<?php echo site_url('pharmacist/medicine/create'); ?>" 
                    method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>

                        <div class="col-sm-7">
                            <input type="text" name="name" class="form-control" id="field-1" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('medicine_category'); ?></label>

                        <div class="col-sm-7">
                            <select name="medicine_category_id" class="form-control select2" required>
                                <option value=""><?php echo get_phrase('select_medicine_category'); ?></option>
                                <?php foreach ($medicine_category_info as $row) { ?>
                                    <option value="<?php echo $row['medicine_category_id']; ?>"><?php echo $row['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>

                        <div class="col-sm-7">
                            <textarea rows="5" name="description" class="form-control" id="field-ta"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('price'); ?></label>

                        <div class="col-sm-7">
                            <input type="number" name="price" class="form-control" id="field-1" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('total_quantity'); ?></label>

                        <div class="col-sm-7">
                            <input type="number" name="total_quantity" class="form-control" value="" required/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('manufacturing_company'); ?></label>

                        <div class="col-sm-7">
                            <input type="text" name="manufacturing_company" class="form-control" id="field-1" >
                        </div>
                    </div>

                    <div class="col-sm-3 control-label col-sm-offset-2">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-check"></i> &nbsp;
                            <?php echo get_phrase('save');?>
                        </button>
                    </div>
                </form>

            </div>

        </div>

    </div>
</div>
