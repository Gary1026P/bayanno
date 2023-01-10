<div class="row">
    <div class="col-md-12">
        <button onclick="showAjaxModal('<?php echo site_url('modal/popup/add_facility/'.$department_info->department_id); ?>');"
                class="btn btn-primary pull-right">
            <i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('add_department_facility'); ?>
        </button>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered table-striped datatable" id="table-2">
            <thead>
            <tr>
                <th width="35%"><?php echo get_phrase('title'); ?></th>
                <th width="45%"><?php echo get_phrase('description'); ?></th>
                <th><?php echo get_phrase('options'); ?></th>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($facilities as $row) { ?>
                <tr>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo substr($row['description'], 0, 100); ?> ...</td>
                    <td>
                        <a  onclick="showAjaxModal('<?php echo site_url('modal/popup/edit_facility/'.$row['facility_id']); ?>');"
                            class="btn btn-info btn-sm">
                            <i class="fa fa-pencil"></i>&nbsp;
                            <?php echo get_phrase('edit');?>
                        </a>
                        <a onclick="confirm_modal('<?php echo site_url('admin/department_facilities/delete/'.$row['facility_id'].'/'.$row['department_id']); ?>')"
                           class="btn btn-danger btn-sm">
                            <i class="fa fa-trash-o"></i>&nbsp;
                            <?php echo get_phrase('delete');?>
                        </a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    jQuery(window).load(function ()
    {
        var $ = jQuery;

        $("#table-2").dataTable({
            "sPaginationType": "bootstrap"
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
