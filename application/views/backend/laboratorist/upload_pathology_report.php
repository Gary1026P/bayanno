<?php $patient_info = $this->db->get_where('patient', array('patient_id' => $param2))->row_array(); ?>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <h3><?php echo get_phrase('upload_pathology_report'); ?></h3>
                </div>
            </div>

            <div class="panel-body">

                <form role="form" class="form-horizontal form-groups validate" action="<?php echo site_url('laboratorist/upload_pathology_report/'.$param2); ?>" 
                    method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('pathology_test_name'); ?></label>

                        <div class="col-sm-7">
                            <input type="text" name="pathology_test_name" class="form-control" id="field-1" value="" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('patient_name'); ?></label>

                        <div class="col-sm-7">
                            <input type="patient_name" name="patient_name" class="form-control" id="field-1" value="<?php echo $patient_info['name']; ?>" readonly required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('upload'); ?></label>

                        <div class="col-sm-7">
                            <input type="file" name="pathology_report" class="form-control" id="field-1" value="" required>
                        </div>
                    </div>

                    <div class="col-sm-3 control-label col-sm-offset-2">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-check"></i> <?php echo get_phrase('upload');?>
                        </button>
                    </div>
                </form>

            </div>

        </div>

    </div>
</div>
