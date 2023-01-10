<?php $department = $this->frontend_model->get_department_info($param2);?>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <h4>
                        <?php echo get_phrase('add_facility');?> | <?php echo $department->name;?> <?php echo get_phrase('department');?>
                    </h4>
                </div>
            </div>

            <div class="panel-body">

                <form role="form" class="form-horizontal form-groups"
                      action="<?php echo site_url('admin/department_facilities/add/'.$department->department_id); ?>"
                      method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('title'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="title" class="form-control" id="field-1" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>

                        <div class="col-sm-8">
                            <textarea name="description" rows="5" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('department'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" disabled
                                value="<?php echo $department->name;?>">
                        </div>
                    </div>

                    <div class="col-sm-3 control-label col-sm-offset-2">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-check"></i><?php echo get_phrase('save');?>
                        </button>
                    </div>


                </form>

            </div>

        </div>

    </div>
</div>
