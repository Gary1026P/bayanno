<?php
$single_notice_info = $this->db->get_where('notice', array('notice_id' => $param2))->result_array();
foreach ($single_notice_info as $row) {
?>

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-primary" data-collapsed="0">

                <div class="panel-heading">
                    <div class="panel-title">
                        <h3><?php echo get_phrase('edit_notice'); ?></h3>
                    </div>
                </div>

                <div class="panel-body">

                    <form class="form-horizontal form-groups" role="form" method="post"
                        action="<?php echo site_url('admin/notice/update/'.$row['notice_id']); ?>"
                        enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('title'); ?></label>

                            <div class="col-sm-7">
                                <input type="text" name="title" class="form-control" id="field-1" value="<?php echo $row['title']; ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>

                            <div class="col-sm-7">
                                <textarea rows="5" name="description" class="form-control" id="field-ta"><?php echo $row['description']; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('start_date'); ?></label>

                            <div class="col-sm-7">
                                <input type="text" name="start_timestamp" class="form-control datepicker" data-format="D, dd MM yyyy"
                                       placeholder="<?php echo get_phrase('event_start_date');?>" value="<?php echo date("D, d M Y", $row['start_timestamp']); ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('end_date'); ?></label>

                            <div class="col-sm-7">
                                <input type="text" name="end_timestamp" class="form-control datepicker" data-format="D, dd MM yyyy"
                                       placeholder="<?php echo get_phrase('event_end_date');?>" value="<?php echo date("D, d M Y", $row['end_timestamp']); ?>" required>
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
