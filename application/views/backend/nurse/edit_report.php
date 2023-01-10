<?php
$patient_info = $this->db->get('patient')->result_array();
$doctor_info = $this->db->get('doctor')->result_array();
$single_report_info = $this->db->get_where('report', array('report_id' => $param2))->result_array();
foreach ($single_report_info as $row) {
?>
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-primary" data-collapsed="0">

                <div class="panel-heading">
                    <div class="panel-title">
                        <h3><?php echo get_phrase('edit_report'); ?></h3>
                    </div>
                </div>

                <div class="panel-body">

                    <form role="form" class="form-horizontal form-groups" action="<?php echo site_url('nurse/report/update/'.$row['report_id']); ?>" 
                        method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('type'); ?></label>

                            <div class="col-sm-7">
                                <select name="type" class="form-control select2" required>
                                    <option value=""><?php echo get_phrase('select_type'); ?></option>
                                    <option value="operation" <?php if ($row['type'] == 'operation') echo 'selected';?>>
                                        <?php echo get_phrase('operation'); ?>
                                    </option>
                                    <option value="birth" <?php if ($row['type'] == 'birth') echo 'selected';?>>
                                        <?php echo get_phrase('birth'); ?>
                                    </option>
                                    <option value="death" <?php if ($row['type'] == 'death') echo 'selected';?>>
                                        <?php echo get_phrase('death'); ?>
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>

                            <div class="col-sm-7">
                                <textarea rows="5" name="description" class="form-control" id="field-ta"><?php echo $row['description']; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('date'); ?></label>

                            <div class="col-sm-7">
                                <input type="text" name="timestamp" class="form-control datepicker" id="field-1" value="<?php echo date("m/d/Y", $row['timestamp']); ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('patient'); ?></label>

                            <div class="col-sm-7">
                                <select name="patient_id" class="form-control select2" required>
                                    <option value=""><?php echo get_phrase('select_patient'); ?></option>
                                    <?php foreach ($patient_info as $row2) { ?>
                                        <option value="<?php echo $row2['patient_id']; ?>" <?php if ($row['patient_id'] == $row2['patient_id']) echo 'selected';?>>
                                            <?php echo $row2['name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('doctor'); ?></label>

                            <div class="col-sm-7">
                                <select name="doctor_id" class="form-control select2" required>
                                    <option value=""><?php echo get_phrase('select_doctor'); ?></option>
                                    <?php foreach ($doctor_info as $row2) { ?>
                                        <option value="<?php echo $row2['doctor_id']; ?>" <?php if ($row['doctor_id'] == $row2['doctor_id']) echo 'selected';?>>
                                            <?php echo $row2['name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
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
