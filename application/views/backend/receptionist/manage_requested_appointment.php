<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th>#</th>
            <th><?php echo get_phrase('date');?></th>
            <th><?php echo get_phrase('doctor');?></th>
            <th><?php echo get_phrase('patient');?></th>
            <th><?php echo get_phrase('options');?></th>
        </tr>
    </thead>

    <tbody>
        <?php
        $count = 1;
        foreach ($requested_appointment_info as $row) { ?>   
            <tr>
                <td><?php echo $count++; ?></td>
                <td><?php echo date("d M, Y -  H:i", $row['timestamp']); ?></td>
                <td>
                    <?php $name = $this->db->get_where('doctor' , array('doctor_id' => $row['doctor_id'] ))->row()->name;
                        echo $name;?>
                </td>
                <td>
                    <?php $name = $this->db->get_where('patient' , array('patient_id' => $row['patient_id'] ))->row()->name;
                        echo $name;?>
                </td>
                <td>
                    <a onclick="showAjaxModal('<?php echo site_url('modal/popup/approve_appointment/' . $row['appointment_id']);?>');"
                        class="btn btn-primary btn-sm">
                            <i class="fa fa-check"></i> &nbsp;
                            <?php echo get_phrase('approve');?>
                    </a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>