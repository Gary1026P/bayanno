<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered table-striped datatable" id="table-2">
            <thead>
            <tr>
                <th><?php echo get_phrase('date');?></th>
                <th><?php echo get_phrase('name');?></th>
                <th><?php echo get_phrase('email');?></th>
                <th><?php echo get_phrase('phone');?></th>
                <th><?php echo get_phrase('address');?></th>
                <th width="40%"><?php echo get_phrase('message');?></th>
                <th><?php echo get_phrase('options');?></th>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($contact_emails as $row) { ?>
                <tr>
                    <td>
                        <?php echo date('d M, Y', $row['timestamp']);?>
                    </td>
                    <td><?php echo $row['name']?></td>
                    <td><?php echo $row['email']?></td>
                    <td><?php echo $row['phone']?></td>
                    <td><?php echo $row['address']?></td>
                    <td><?php echo $row['message']?></td>
                    <td>
                        <a onclick="confirm_modal('<?php echo site_url('admin/contact_email/delete/'.$row['contact_email_id']);?>')"
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

        // Replace Checboxes
        $(".pagination a").click(function (ev)
        {
            replaceCheckboxes();
        });
    });
</script>