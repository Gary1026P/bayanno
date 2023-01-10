<?php
$single_bed_info = $this->db->get_where('bed', array('bed_id' => $param2))->result_array();
foreach ($single_bed_info as $row) {
?>
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-primary" data-collapsed="0">

                <div class="panel-heading">
                    <div class="panel-title">
                        <h3><?php echo get_phrase('edit_bed'); ?></h3>
                    </div>
                </div>

                <div class="panel-body">

                    <form role="form" class="form-horizontal form-groups-bordered" action="<?php echo site_url('nurse/bed/update/'.$row['bed_id']); ?>" 
                        method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('bed_number'); ?></label>

                            <div class="col-sm-7">
                                <input type="number" name="bed_number" class="form-control" id="field-1" value="<?php echo $row['bed_number']; ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('type'); ?></label>

                            <div class="col-sm-7">
                                <select name="type" class="form-control select2" required>
                                    <option value=""><?php echo get_phrase('select_type'); ?></option>
                                    <option value="ward" <?php if ($row['type'] == 'ward')echo 'selected';?>>
                                        <?php echo get_phrase('ward'); ?>
                                    </option>
                                    <option value="cabin" <?php if ($row['type'] == 'cabin')echo 'selected';?>>
                                        <?php echo get_phrase('cabin'); ?>
                                    </option>
                                    <option value="icu" <?php if ($row['type'] == 'icu')echo 'selected';?>>
                                        <?php echo get_phrase('icu'); ?>
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>

                            <div class="col-sm-7">
                                <textarea rows="5" name="description" class="form-control"
                                          id="field-ta"><?php echo $row['description']; ?></textarea>
                            </div>
                        </div>

                        <div class="col-sm-3 control-label col-sm-offset-1">
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
