<div class="panel panel-primary" data-collapsed="0">
    
    <div class="panel-body">

        <?php $service_data = json_decode($service); ?>

        <form action="<?php echo site_url('admin/frontend_settings/service_section');?>" 
            method="post" class="form-groups form-horizontal"
                enctype="multipart/form-data">

            <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">
                    <?php echo get_phrase('service_section_title');?>
                </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="title"
                        value="<?php echo $service_data[0]->title;?>"
                            required>
                </div>
            </div>

            <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">
                    <?php echo get_phrase('service_section_note');?>
                </label>
                <div class="col-sm-6">
                    <textarea rows="3" class="form-control" name="description"
                        required><?php echo $service_data[0]->description;?></textarea>
                </div>
            </div>


            <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"></label>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-check"></i> <?php echo get_phrase('save');?>
                    </button>
                </div>
            </div>

        </form>        
        
    </div>

</div>

<div class="panel panel-primary" data-collapsed="0">
    
    <div class="panel-body">

    <div class="row">
            <div class="col-md-12">
                <a onclick="showAjaxModal('<?php echo site_url('modal/popup/add_service'); ?>');"
                    class="btn btn-primary">
                        <i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('add_service');?>
                </a>
            </div>
        </div>

        <div class="row" style="margin-top: 10px;">
            <div class="col-md-12">
                <table class="table table-bordered datatable" id="table-2">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo get_phrase('icon');?></th>
                            <th><?php echo get_phrase('title');?></th>
                            <th width="40%"><?php echo get_phrase('description');?></th>
                            <th><?php echo get_phrase('options');?></th>
                        </tr>
                    </thead>

                    <tbody>
                            <?php
                                $count = 1;
                                foreach ($services as $row) {
                            ?>
                            <tr>
                                <td><?php echo $count++;?></td>
                                <td>
                                    <img src="<?php echo base_url();?>uploads/frontend/service_images/<?php echo $row['service_id'];?>.png"
                                        width="60">
                                </td>
                                <td><?php echo $row['title'];?></td>
                                <td><?php echo $row['description'];?></td>
                                <td>
                                    <a onclick="showAjaxModal('<?php echo site_url('modal/popup/edit_service/'.$row['service_id']); ?>');"
                                        class="btn btn-info btn-sm">
                                            <i class="fa fa-pencil"></i>&nbsp;
                                            <?php echo get_phrase('edit');?>
                                    </a>
                                    <a onclick="confirm_modal('<?php echo site_url('admin/frontend_settings/service_delete/'.$row['service_id']); ?>')"
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