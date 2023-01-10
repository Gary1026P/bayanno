<?php echo form_open(site_url('admin/sms_settings/do_update'), array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top'));
?>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" >

            <div class="panel-body">

                <div class="form-group">
                    <label  class="col-sm-3 control-label"><?php echo get_phrase('clickatell_user'); ?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="clickatell_user"
                            value="<?php echo $this->db->get_where('settings', array('type' => 'clickatell_user'))->row()->description; ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label  class="col-sm-3 control-label"><?php echo get_phrase('clickatell_password'); ?></label>
                    <div class="col-sm-5">
                        <input type="password" class="form-control" name="clickatell_password"
                            value="<?php echo $this->db->get_where('settings', array('type' => 'clickatell_password'))->row()->description; ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label  class="col-sm-3 control-label"><?php echo get_phrase('clickatell_api_id'); ?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="clickatell_api_id"
                            value="<?php echo $this->db->get_where('settings', array('type' => 'clickatell_api_id'))->row()->description; ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-check"></i> <?php echo get_phrase('save'); ?>
                        </button>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>


</form>
