<button onclick="showAjaxModal('<?php echo site_url('modal/popup/add_bed');?>');" 
    class="btn btn-primary pull-right">
        <i class="fa fa-plus"></i> &nbsp;<?php echo get_phrase('add_bed'); ?>
</button>
<div style="clear:both;"></div>
<br>
<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th><?php echo get_phrase('bed_number');?></th>
            <th><?php echo get_phrase('bed_type');?></th>
            <th><?php echo get_phrase('description');?></th>
            <th><?php echo get_phrase('options');?></th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($bed_info as $row) { ?>   
            <tr>
                <td><?php echo $row['bed_number'] ?></td>
                <td><?php echo $row['type'] ?></td>
                <td><?php echo $row['description'] ?></td>
                <td>
                    <a  onclick="showAjaxModal('<?php echo site_url('modal/popup/edit_bed/'.$row['bed_id']);?>');" 
                        class="btn btn-info btn-sm">
                            <i class="fa fa-pencil"></i> &nbsp; <?php echo get_phrase('edit');?>
                    </a>
                    <a onclick="confirm_modal('<?php echo site_url('nurse/bed/delete/'.$row['bed_id']); ?>')"
                        class="btn btn-danger btn-sm">
                            <i class="fa fa-trash-o"></i> &nbsp; <?php echo get_phrase('delete');?>
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