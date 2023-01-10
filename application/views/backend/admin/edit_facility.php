<?php $facility = $this->db->get_where('facility',array('facility_id'=> $param2))->result_array();
foreach ($facility as $row) { ?>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <h4>
                        <?php echo get_phrase('edit_facility');?>
                    </h4>
                </div>
            </div>

            <div class="panel-body">

                <form role="form" class="form-horizontal form-groups"
                      action="<?php echo site_url('admin/department_facilities/edit/'.$row['facility_id'].'/'.$row['department_id']); ?>"
                      method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('title'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="title" class="form-control" id="field-1" required
                                value="<?php echo $row['title'];?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>

                        <div class="col-sm-8">
                            <textarea name="description" rows="5" class="form-control"><?php echo $row['description'];?></textarea>
                        </div>
                    </div>

                    <div class="col-sm-3 col-sm-offset-3">
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