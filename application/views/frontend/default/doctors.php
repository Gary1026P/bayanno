<section class="slice--offset parallax-section parallax-section-xl b-xs-bottom custom-page-head"
    style="background-image: url('<?php echo base_url('assets/frontend/' . $theme . '/images/img-15.jpg');?>');">
    <div class="container">
        <div class="row py-3">
            <div class="col-lg-12">
                <h1 class="heading text-uppercase c-white">
                    <?php echo (isset($department)) ? get_phrase('doctors_of').' '.$department->name.' '. get_phrase('department') :
                        get_phrase('doctors_of_all_departments');?>
                </h1>

                <span class="clearfix"></span>

                <div class="">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?php echo site_url('home');?>">
                            <?php echo get_phrase('home');?>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                        <?php echo $page_title;?>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="slice--offset sct-color-1 pt-4 pb-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="sidebar sidebar--style-2 doctor-sidebar">
                    <div class="sidebar-object">
                        <div class="section-title section-title--style-1">
                            <h3 class="section-title-inner heading-sm strong-500">
                                <?php echo get_phrase('doctors_of');?>
                            </h3>
                        </div>

                        <ul class="categories categories--style-2">
                            <li class="<?php if(!(isset($department))) echo 'active';?>">
                                <a href="<?php echo site_url('home/doctors');?>">
                                    <?php echo get_phrase('all_departments');?>
                                </a>
                            </li>
                            <?php foreach ($departments as $row) { ?>
                            <li class="<?php
                                    if (isset($department)) {
                                        if ($row['department_id'] == $department->department_id)
                                            echo 'active';
                                    }
                                ?>">
                                <a href="<?php echo site_url('home/doctors/' . $row['department_id']);?>">
                                    <?php echo $row['name'];?>
                                </a>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>

                </div>
            </div>
            
            <div class="col-lg-9">
                <div class="block block-post">
                    <div class="block department-doctor-list">
                        <div class="doctor-grid-view row">
                            <?php foreach ($doctors as $row) { ?>
                            <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                <div class="block block--style-4 list doctor-list">
                                    <div class="block-image">
                                        <div class="view view-fifth">
                                            <img src="<?php echo $this->crud_model->get_image_url('doctor', $row['doctor_id']);?>">
                                            <div class="mask">
                                                <div class="view-buttons">
                                                    <span class="view-buttons-inner text-center appointment-btn">
                                                        <a href="" id="<?php echo site_url('home/get_doctor_details/' . $row['doctor_id']);?>"
                                                            class="btn btn-styled btn-base-1 btn-outline btn-icon-left btn-st-trigger" 
                                                                data-effect="st-effect-1">
                                                            <i class="fa fa-user-md"></i> &nbsp;<?php echo get_phrase('profile');?>
                                                        </a>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block-content w-100">
                                        <div class="block-body py-2 px-0">
                                            <h3 class="heading heading-5 strong-500">
                                                <a href="" class="btn-st-trigger" data-effect="st-effect-1"
                                                id="<?php echo site_url('home/get_doctor_details/' . $row['doctor_id']);?>">
                                                    <?php echo $row['name'];?>
                                                </a>
                                            </h3>

                                        </div>

                                        <?php $social = json_decode($row['social_links']);?>
                                        <div class="block-footer block-footer-fixed-bottom b-xs-top">
                                            <div class="row">
                                                <div class="col-12">
                                                    <ul class="social-media social-media--style-1-v4">
                                                        <?php if ($social[0]->facebook != '') { ?>
                                                            <li>
                                                                <a href="<?php echo $social[0]->facebook;?>"
                                                                   target="_blank">
                                                                    <i class="ion ion-social-facebook"></i>
                                                                </a>
                                                            </li>
                                                        <?php } ?>
                                                        <?php if ($social[0]->twitter != '') { ?>
                                                            <li>
                                                                <a href="<?php echo $social[0]->twitter;?>"
                                                                   target="_blank">
                                                                    <i class="ion ion-social-twitter"></i>
                                                                </a>
                                                            </li>
                                                        <?php } ?>
                                                        <?php if ($social[0]->google_plus != '') { ?>
                                                            <li>
                                                                <a href="<?php echo $social[0]->google_plus;?>"
                                                                   target="_blank">
                                                                    <i class="ion ion-social-googleplus"></i>
                                                                </a>
                                                            </li>
                                                        <?php } ?>
                                                        <?php if ($social[0]->linkedin != '') { ?>
                                                            <li>
                                                                <a href="<?php echo $social[0]->linkedin;?>"
                                                                   target="_blank">
                                                                    <i class="ion ion-social-linkedin"></i>
                                                                </a>
                                                            </li>
                                                        <?php } ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    
                    
                    <div class="doctor-pagination d-flex justify-content-center mb-4 pt-4">
                        <?php //echo $this->pagination->create_links();?>
                    </div>
                    
                </div>
            </div>

        </div>
    </div>
</section>
<section class="slice-sm sct-color-2 b-xs-top b-xs-bottom appointment-cta">
    <div class="container">
        <div class="px-4">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-9">
                        <div class="text-center text-lg-left">
                            <h1 class="heading heading-4 text-normal strong-500 c-white">
                            <?php echo get_phrase('get_in_touch_with_our_specialists');?>
                            </h1>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="py-4 text-center text-lg-right">
                            <a href="<?php echo site_url('home/appointment');?>" class="btn btn-styled btn-base-1 btn-outline btn-icon-left">
                                <i class="fa fa-calendar"></i><?php echo get_phrase('book_appointment');?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>