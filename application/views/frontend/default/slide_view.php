<nav class="st-menu st-effect-1" id="menu-1">
    <div class="doctor-profile">
        <div class="doctor-image">
            <img src="<?php echo $this->crud_model->get_image_url('doctor', $doctor->doctor_id) ?>" 
                class="img-fluid">
        </div>
        <div class="doctor-info">
            <p class="doctor-designation"><?php echo $doctor->name;?></p>
        </div>
    </div>

    <div class="doctor-details">
        <ul>
            <li class="clearfix">
                <strong class="float-left"><?php echo get_phrase('phone');?> : </strong> <span class="float-left"><?php echo $doctor->phone;?></span>
            </li>
            <li class="clearfix">
                <strong class="float-left"><?php echo get_phrase('email');?> : </strong> <span class="float-left"><?php echo $doctor->email;?></span>
            </li>
            <li class="clearfix">
                <strong class="float-left"><?php echo get_phrase('address');?> : </strong> <span class="float-left"><?php echo $doctor->address;?></span>
            </li>
            <li class="clearfix">
                <strong class="float-left"><?php echo get_phrase('degrees');?> : </strong> <span class="float-left">M.D. of Medicine</span>
            </li>
        </ul>
        <div class="doctor-description">
            <h5><?php echo get_phrase('profile');?></h5>
            <p>
            <?php echo $doctor->profile;?>
            </p>
        </div>
    </div>

    <?php $social = json_decode($doctor->social_links);?>
    <div class="doctor-social">
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
    <div class="appointment-btn doctor-book">
        <a href="<?php echo site_url('home/appointment/' . $doctor->doctor_id);?>" class="btn btn-styled btn-base-1 btn-outline btn-icon-left">
            <i class="fa fa-calendar"></i><?php echo get_phrase('book_appointment');?>
        </a>
    </div>

</nav>