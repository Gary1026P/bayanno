<div class="panel panel-primary" data-collapsed="0">
    
    <div class="panel-body">

        <form action="<?php echo site_url('admin/frontend_settings/about_us');?>"
              method="post"
                class="form-horizontal form-groups">

            <div class="form-group">
                <div class="col-sm-12">
                    <textarea name="about_us" class="form-control html5editor" id="field-ta" rows="30"
                       data-stylesheet-url="<?php echo base_url();?>assets/css/wysihtml5-color.css"><?php echo $this->frontend_model->get_frontend_settings('about_us');?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <input type="submit" class="btn btn-success" value="<?php echo get_phrase('save_changes');?>">
                </div>
            </div>

        </form>
        
    </div>

</div>