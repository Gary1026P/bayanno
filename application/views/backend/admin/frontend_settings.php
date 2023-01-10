
<div class="panel panel-primary" data-collapsed="0">
    
    <div class="panel-body">

        <form action="<?php echo site_url('admin/frontend_settings/settings');?>" 
            method="post" class="form-groups form-horizontal"
                enctype="multipart/form-data">

            <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">
                    <?php echo get_phrase('hospital_name');?>
                </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="hospital_name"
                        value="<?php echo $this->frontend_model->get_frontend_settings('hospital_name') ;?>"
                            required>
                </div>
            </div>

            <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">
                    <?php echo get_phrase('emergency_contact');?>
                </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="emergency_contact"
                        value="<?php echo $this->frontend_model->get_frontend_settings('emergency_contact') ;?>">
                </div>
            </div>

            <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">
                    <?php echo get_phrase('email');?>
                </label>
                <div class="col-sm-6">
                    <input type="email" class="form-control" name="email"
                        value="<?php echo $this->frontend_model->get_frontend_settings('email') ;?>">
                </div>
            </div>

            <?php 
                $opening_hours = $this->frontend_model->get_frontend_settings('opening_hours');
                $open = json_decode($opening_hours);
            ?>
            <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">
                    <?php echo get_phrase('opening_hours');?>
                </label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" name="monday_friday"
                        value="<?php echo $open[0]->monday_friday;?>">
                    <span class="description"><?php echo get_phrase('monday').' - '.get_phrase('friday');?></span>
                </div>
                <div class="col-sm-2">
                    <input type="text" class="form-control" name="saturday"
                        value="<?php echo $open[0]->saturday;?>">
                    <span class="description"><?php echo get_phrase('saturday');?></span>
                </div>
                <div class="col-sm-2">
                    <input type="text" class="form-control" name="sunday"
                        value="<?php echo $open[0]->sunday;?>">
                    <span class="description"><?php echo get_phrase('sunday');?></span>
                </div>
            </div>

            <?php 
                $social_links = $this->frontend_model->get_frontend_settings('social_links');
                $social = json_decode($social_links);
            ?>
            <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">
                    <?php echo get_phrase('social_links');?>
                </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="facebook"
                        value="<?php echo $social[0]->facebook;?>">
                    <span class="description"><?php echo get_phrase('facebook_page_link');?></span>
                    <br>
                    <input type="text" class="form-control" name="twitter"
                        value="<?php echo $social[0]->twitter;?>">
                    <span class="description"><?php echo get_phrase('twitter_profile_link');?></span>
                    <br>
                    <input type="text" class="form-control" name="google_plus"
                        value="<?php echo $social[0]->google_plus;?>">
                    <span class="description"><?php echo get_phrase('google_plus_link');?></span>
                    <br>
                    <input type="text" class="form-control" name="youtube"
                        value="<?php echo $social[0]->youtube;?>">
                    <span class="description"><?php echo get_phrase('youtube_channel_link');?></span>
                </div>
            </div>

            <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">
                    <?php echo get_phrase('copyright_text');?>
                </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="copyright_text"
                        value="<?php echo $this->frontend_model->get_frontend_settings('copyright_text') ;?>">
                </div>
            </div>

            <?php $recaptcha = json_decode($this->frontend_model->get_frontend_settings('recaptcha')); ?>
            <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">
                   Recaptcha <?php echo get_phrase('settings');?>
                </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="site_key"
                           value="<?php echo $recaptcha[0]->site_key;?>">
                    <span class="description">Recaptcha Site Key</span>
                    <br>
                    <input type="text" class="form-control" name="secret_key"
                           value="<?php echo $recaptcha[0]->secret_key;?>">
                    <span class="description">Recaptcha Secret Key</span>
                </div>
            </div>

            <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"></label>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-check"></i><?php echo get_phrase('save');?>
                    </button>
                </div>
            </div>

        </form>
        
    </div>

</div>