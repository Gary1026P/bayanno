<?php
$single_department_info = $this->db->get_where('department', array('department_id' => $param2))->result_array();
foreach ($single_department_info as $row) {
?>
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-primary" data-collapsed="0">

                <div class="panel-heading">
                    <div class="panel-title">
                        <h3><?php echo get_phrase('edit_department'); ?></h3>
                    </div>
                </div>

                <div class="panel-body">

                    <form role="form" class="form-horizontal form-groups validate"
                        action="<?php echo site_url('admin/department/update/'.$row['department_id']); ?>" 
                            method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>

                            <div class="col-sm-7">
                                <input type="text" name="name" class="form-control" id="field-1" value="<?php echo $row['name']; ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>

                            <div class="col-sm-7">
                                <textarea name="description" class="form-control" rows="5"
                                    id="field-ta"><?php echo $row['description']; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-sm-3 control-label">
                            <?php echo get_phrase('icon'); ?>
                        </label>
                        <div class="col-sm-9">

                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 200px; height: 200px;" 
                                    data-trigger="fileinput">
                                    <img src="<?php echo base_url();?>uploads/frontend/department_images/<?php echo $row['department_id'];?>.png" alt="...">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" 
                                    style="max-width: 200px; max-height: 200px"></div>
                                <div>
                                    <span class="btn btn-white btn-file">
                                        <span class="fileinput-new"><?php echo get_phrase('select_image');?></span>
                                        <span class="fileinput-exists"><?php echo get_phrase('change');?></span>
                                        <input type="file" name="dept_icon" accept="image/*">
                                    </span>
                                    <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">
                                    <?php echo get_phrase('remove');?>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>

                        <div class="col-sm-3 control-label col-sm-offset-2">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-check"></i> <?php echo get_phrase('update');?>
                            </button>
                        </div>
                    </form>

                </div>

            </div>

        </div>
    </div>
<?php } ?>
