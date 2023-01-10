
<div class="panel panel-primary" data-collapsed="0">
    
    <div class="panel-body">

        <div class="row">
            <div class="col-md-12">
                <a href="<?php echo site_url('admin/frontend/blog_new');?>" 
                    class="btn btn-primary">
                        <i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('new_blog');?>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered datatable" id="table-2">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo get_phrase('title');?></th>
                            <th><?php echo get_phrase('posted_by');?></th>
                            <th><?php echo get_phrase('date');?></th>
                            <th><?php echo get_phrase('published');?></th>
                            <th><?php echo get_phrase('options');?></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                            $count = 1;
                            foreach ($blogs as $row) {
                        ?>
                            <tr>
                                <td><?php echo $count++;?></td>
                                <td><?php echo $row['title'];?></td>
                                <td>
                                    <?php 
                                        $user = $this->frontend_model->get_user_from_type_id($row['posted_by']);
                                        echo $user->name;
                                    ?>
                                </td>
                                <td><?php echo date('d M, Y', $row['timestamp']);?></td>                                
                                <td>
                                    <?php echo $row['published'] == 1 ? get_phrase('yes') : get_phrase('no');?>
                                </td>
                                <td>
                                    <a href="<?php echo site_url('admin/frontend/blog_edit/'.$row['frontend_blog_id']);?>" 
                                        class="btn btn-info btn-sm">
                                            <i class="fa fa-pencil"></i>&nbsp;
                                            <?php echo get_phrase('edit');?>
                                    </a>
                                    <a onclick="confirm_modal('<?php echo site_url('admin/frontend_settings/blog_delete/'.$row['frontend_blog_id']);?>')" 
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
    });
</script>