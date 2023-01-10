<hr>
<div class="row">

    <div class="col-md-2">
        <a href="<?php echo site_url('admin/frontend/home_page');?>"
            class="btn btn-<?php echo $inner_page == 'frontend_home_page' ? 'primary' : 'default';?> btn-block">
            <?php echo get_phrase('home_page'); ?>
        </a>
        <a href="<?php echo site_url('admin/frontend/about_us');?>"
            class="btn btn-<?php echo $inner_page == 'frontend_about_us' ? 'primary' : 'default';?> btn-block">
            <?php echo get_phrase('about_us'); ?>
        </a>
        <a href="<?php echo site_url('admin/frontend/blog');?>"
            class="btn btn-<?php echo ($inner_page == 'frontend_blog' || $inner_page == 'frontend_blog_new' || $inner_page == 'frontend_blog_edit') ? 'primary' : 'default';?> btn-block">
            <?php echo get_phrase('blog'); ?>
        </a>
        <a href="<?php echo site_url('admin/frontend/service');?>"
            class="btn btn-<?php echo $inner_page == 'frontend_service' ? 'primary' : 'default';?> btn-block">
            <?php echo get_phrase('services'); ?>
        </a>
        <a href="<?php echo site_url('admin/frontend/settings');?>"
            class="btn btn-<?php echo $inner_page == 'frontend_settings' ? 'primary' : 'default';?> btn-block">
            <?php echo get_phrase('settings'); ?>
        </a>
    </div>

    <div class="col-md-10 ">
        <?php include $inner_page.'.php'; ?>
    </div>

</div>
