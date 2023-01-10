<div class="sidebar-menu">
    <header class="logo-env" >

        <!-- logo -->
        <div class="logo" style="">
            <a href="<?php echo site_url('login'); ?>">
                <img src="<?php echo base_url('uploads/logo.png');?>"  style="max-height:120px;"/>
            </a>
        </div>

        <!-- logo collapse icon -->
        <div class="sidebar-collapse" style="">
            <a href="#" class="sidebar-collapse-icon with-animation">

                <i class="entypo-menu"></i>
            </a>
        </div>

        <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
        <div class="sidebar-mobile-menu visible-xs">
            <a href="#" class="with-animation">
                <i class="entypo-menu"></i>
            </a>
        </div>
    </header>
    <div class="sidebar-user-info">

        <div class="sui-normal">
            <a href="#" class="user-link">
                <img src="<?php echo $this->crud_model->get_image_url($this->session->userdata('login_type'), $this->session->userdata('login_user_id'));?>" alt="" class="img-circle" style="height:120px;">

                <span>welcome،</span>
                <strong><?php
                    echo $this->db->get_where($this->session->userdata('login_type'), array($this->session->userdata('login_type') . '_id' =>
                        $this->session->userdata('login_user_id')))->row()->name;
                    ?>
                </strong>
            </a>
        </div>

        <div class="sui-hover inline-links animate-in"><!-- You can remove "inline-links" class to make links appear vertically, class "animate-in" will make A elements animateable when click on user profile -->
            <a href="<?php echo site_url('admin/manage_profile');?>">
                <i class="entypo-pencil"></i>
                <?php echo get_phrase('edit_profile'); ?>
            </a>

            <a href="<?php echo site_url('admin/manage_profile');?>">
                <i class="entypo-lock"></i>
                <?php echo get_phrase('change_password'); ?>
            </a>

            <span class="close-sui-popup">×</span><!-- this is mandatory -->
        </div>
    </div>

    <ul id="main-menu" class="">
        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->


        <!-- DASHBOARD -->
        <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?> ">
            <a href="<?php echo site_url('admin/dashboard');?>">
                <i class="fa fa-desktop"></i>
                <span>Dashboard</span>
            </a>
        </li>

       

     

        <li class="<?php if ($page_name == 'manage_patient') echo 'active'; ?> ">
            <a href="<?php echo site_url('admin/patient');?>">
                <i class="fa fa-user"></i>
                <span>cases</span>
            </a>
        </li>

      

 

        <!-- SETTINGS 
        <li class="<?php if ($page_name == 'system_settings' || $page_name == 'manage_language' ||
                            $page_name == 'sms_settings') echo 'opened active';?> ">
            <a href="#">
                <i class="fa fa-wrench"></i>
                <span><?php echo get_phrase('settings'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'system_settings') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/system_settings');?>">
                        <span><i class="fa fa-h-square"></i> <?php echo get_phrase('system_settings'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'manage_language') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/manage_language');?>">
                        <span><i class="fa fa-globe"></i> <?php echo get_phrase('language_settings'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'sms_settings') echo 'active'; ?> ">
                    <a href="<?php echo site_url('admin/sms_settings');?>">
                        <span><i class="entypo-paper-plane"></i><?php echo get_phrase('sms_settings'); ?></span>
                    </a>
                </li>
            </ul>
        </li>

-->

        <!-- ACCOUNT -->
        <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> ">
            <a href="<?php echo site_url('admin/manage_profile');?>">
                <i class="fa fa-user"></i>
                <span>my account</span>
            </a>
        </li>



    </ul>

</div>
