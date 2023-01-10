
<div class="mail-header" style="padding-bottom: 27px ;">
    <!-- title -->
    <h4 class="mail-title">
        <?php echo get_phrase('write_new_message'); ?>
    </h4>
</div>

<div class="mail-compose">

    <?php echo form_open(site_url('doctor/message/send_new'), array(
            'class' => 'form-groups form-horizontal', 'enctype' => 'multipart/form-data')); ?>


    <div class="form-group">
        <label for="subject"><?php echo get_phrase('recipient'); ?>:</label>
        <br><br>
        <select class="form-control select2" name="reciever" required>

            <option value=""><?php echo get_phrase('select_a_user'); ?></option>
            <optgroup label="<?php echo get_phrase('patient'); ?>">
                <?php
                $appointments = $this->crud_model->select_patient_info_by_doctor_id();
                foreach($appointments as $appointment) {
                    $patient_info = $this->db->get_where('patient', array('patient_id' => $appointment['patient_id']))->result_array();

                    foreach ($patient_info as $row) { ?>

                        <option value="patient-<?php echo $row['patient_id']; ?>">
                            - <?php echo $row['name']; ?></option>

                <?php } } ?>
            </optgroup>
        </select>
    </div>


    <div class="compose-message-editor">
        <textarea rows="5" class="form-control wysihtml5" data-stylesheet-url="<?php echo base_url('assets/css/wysihtml5-color.css');?>"
            name="message" placeholder="<?php echo get_phrase('write_your_message'); ?>"
            id="sample_wysiwyg" required></textarea>
    </div>

    <hr>

    <button type="submit" class="btn btn-success pull-right">
        <i class="fa fa-share"></i> &nbsp;<?php echo get_phrase('send_message'); ?>
    </button>
</form>

</div>
