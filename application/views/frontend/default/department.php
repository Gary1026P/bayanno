<section class="slice--offset parallax-section parallax-section-xl b-xs-bottom custom-page-head" 
    style="background-image: url('<?php echo base_url('assets/frontend/' . $theme . '/images/dep.jpg');?>');">
    <div class="container">
        <div class="row py-3">
            <div class="col-lg-12">
                <h1 class="heading text-uppercase c-white">
                    <?php echo $department->name;?>
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
                        <?php echo $department->name;?>
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
                <div class="sidebar sidebar--style-2 department-sidebar">
                    <div class="sidebar-object">
                        <ul class="categories categories--style-2">
                            <?php foreach ($departments as $row) { ?>
                            <li class="<?php echo ($row['department_id'] == $department->department_id) ? 'active' : '';?>">
                                <a href="<?php echo site_url('home/department/' . $row['department_id']);?>">
                                    <?php echo $row['name'];?>
                                </a>
                            </li>
                            <?php } ?>
                        </ul>
                        <div class="appointment-btn">
                            <a href="<?php echo site_url('home/appointment');?>" 
                                class="btn btn-styled btn-base-1 btn-outline btn-icon-left">
                                <i class="fa fa-calendar"></i>
                                <?php echo get_phrase('book_appointment');?>
                            </a>
                        </div>
                    </div>
                    <div class="sidebar-object text-center">
                        <p class="mb-1"><?php echo get_phrase('for_emergency_contact');?></p>
                        <h3>
                            <?php echo $this->frontend_model->get_frontend_settings('emergency_contact');?>
                        </h3>
                    </div>

                </div>
            </div>
            
            <div class="col-lg-9">
                <div class="block block-post">
                    <div class="block-body block-post-body b-xs-bottom mb-5 pb-5">
                        <p><?php echo $department->description;?></p>
                    </div>
                    <div class="department-price-list row mb-5">
                        <div class="col-md-12">
                            <h4 class="heading heading-4 strong-400 text-normal">
                                <?php echo $department->name.' '.get_phrase('department_facilities');?>
                            </h4>
                            <span class="short-delimiter--style-1 mb-4"></span>
                            <div class="accordion accordion--style-3" id="collapseFour">
                                <?php $count = 1; foreach ($facilities as $facility) { ?>
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title ">
                                            <a class="accordion-toggle" data-toggle="collapse"
                                               data-parent="#collapseFour" href="#collapseFour-<?php echo $facility['facility_id'];?>"
                                                aria-hidden="<?php echo $count == 1 ? 'false' : 'true';?>"
                                                    aria-expanded="<?php echo $count == 1 ? 'true' : 'false';?>">
                                                <?php echo $facility['title'];?>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseFour-<?php echo $facility['facility_id'];?>" class="panel-collapse collapse <?php echo $count == 1 ? 'show' : '';?>">
                                        <div class="card-body">
                                            <p>
                                                <?php echo $facility['description'];?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <?php $count++; } ?>
                            </div>
                        </div>
                    </div>
                    <div class="block department-doctor-list mb-5 ">
                        <h4 class="heading heading-4 strong-400 text-normal">
                            <?php echo get_phrase('awesome_doctors_of').' '.$department->name.' '.get_phrase('department');?>
                        </h4>
                        <span class="short-delimiter--style-1 mb-4"></span>
                        <div class="doctor-grid-view row">
                            <?php foreach ($doctors as $row) { ?>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                                    <div class="block block--style-1 list doctor-department-list">
                                        <div class="block-image">
                                            <div class="view view-fifth">
                                                <img src="<?php echo $this->crud_model->get_image_url('doctor', $row['doctor_id']);?>">
                                                <div class="mask">
                                                    <div class="view-buttons">
                                                        <span class="view-buttons-inner text-center">
                                                            <a href="#" class="c-white btn-st-trigger" data-effect="st-effect-1"
                                                                id="<?php echo site_url('home/get_doctor_details/' . $row['doctor_id']);?>">
                                                                <i class="fa fa-user-md fa-3x"></i>
                                                            </a>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="block-content w-100">
                                            <div class="block-body py-1">
                                                <h3 class="heading heading-5 strong-500">
                                                    <a href="#" class="btn-st-trigger" data-effect="st-effect-1"
                                                    id="<?php echo site_url('home/get_doctor_details/' . $row['doctor_id']);?>">
                                                        <?php echo $row['name'];?>
                                                    </a>
                                                </h3>

                                            </div>
                                            <?php $social = json_decode($row['social_links']);?>
                                            <div class="block-footer block-footer-fixed-bottom b-xs-top">
                                                <div class="row">
                                                    <div class="col-xs-12">
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
                            <a href="<?php echo site_url('home/appointment');?>" 
                                class="btn btn-styled btn-base-1 btn-outline btn-icon-left">
                                <i class="fa fa-calendar"></i><?php echo get_phrase('book_appointment');?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>