<?php $patient_info = $this->db->get('patient')->result_array(); ?>

<div style="clear:both;"></div>
<br>
<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th><?php echo get_phrase('image');?></th>
            <th><?php echo get_phrase('name');?></th>
            <th><?php echo get_phrase('email');?></th>
            <th><?php echo get_phrase('phone');?></th>
            <th><?php echo get_phrase('uploaded_reports');?></th>
            <th><?php echo get_phrase('options');?></th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($patient_info as $row) { ?>
            <tr>
                <td><img src="<?php echo $this->crud_model->get_image_url('patient' , $row['patient_id']);?>" class="img-circle" width="40px" height="40px"></td>
                <td><?php echo $row['name']?></td>
                <td><?php echo $row['email']?></td>
                <td><?php echo $row['phone']?></td>
                <td>
                  <?php
                    $report_info = $this->db->get_where('pathology_report', array('patient_id' => $row['patient_id']))->result_array();
                    foreach ($report_info as $report):?>
                    <a href="<?php echo site_url('uploads/pathology_reports/'.$report['pathology_report']);?>" target="_blank" style="color: #fff;" class="badge badge-secondary"><i class="fa fa-download" aria-hidden="true"></i> <?php echo $report['test_name']; ?></a><br>
                  <?php endforeach; ?>
                </td>
                <td>
                    <a  onclick="showAjaxModal('<?php echo site_url('modal/popup/upload_pathology_report/'.$row['patient_id']);?>');"
                        class="btn btn-info btn-sm">
                            <i class="fa fa-pencil"></i>&nbsp;
                            <?php echo get_phrase('upload_pathology_report');?>
                    </a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<script type="text/javascript">
    jQuery(window).load(function ()
    {
        var $ = jQuery;

        $("#table-2").dataTable({
            "sPaginationType": "bootstrap",
            "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>"
        });

        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });

        // Highlighted rows
        $("#table-2 tbody input[type=checkbox]").each(function (i, el)
        {
            var $this = $(el),
                    $p = $this.closest('tr');

            $(el).on('change', function ()
            {
                var is_checked = $this.is(':checked');

                $p[is_checked ? 'addClass' : 'removeClass']('highlight');
            });
        });

        // Replace Checboxes
        $(".pagination a").click(function (ev)
        {
            replaceCheckboxes();
        });
    });
</script>
