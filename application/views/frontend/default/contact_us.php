<section class="slice--offset parallax-section parallax-section-xl b-xs-bottom custom-page-head" 
    style="background-image: url('<?php echo base_url('assets/frontend/' . $theme . '/images/img-15.jpg');?>');">
    <div class="container">
        <div class="row py-3">
            <div class="col-lg-12">
                <h1 class="heading text-uppercase c-white">
                    <?php echo $page_title;?>
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


<section class="slice b-xs-bottom">
    <div class="container">
        <div class="text-center">
            <h2 class="heading heading-2 strong-400">
                <?php echo get_phrase('contact_us_for_help');?>
            </h2>
            <p>
                <?php echo get_phrase('please_call_us_or_complete_the_form_below_and_we_will_get_to_you_shortly');?>
            </p>
            <button class="btn btn-styled btn-xl btn-base-1 btn-icon-left mt-4">
                <i class="fa fa-mobile"></i><?php echo $this->frontend_model->get_frontend_settings('emergency_contact');?>
            </button>
        </div>
    </div>
</section>

<section class="slice sct-color-1">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Contact form -->
                <form id="form_contact" class="form-default" role="form"
                    action="<?php echo site_url('home/contact_us/contact');?>"
                        method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label for="" class="text-uppercase c-gray-light">
                                    <?php echo get_phrase('your_name');?>
                                </label>
                                <input type="text" name="name" class="form-control form-control-lg" required="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label for="" class="text-uppercase c-gray-light">
                                    <?php echo get_phrase('your_email');?>
                                </label>
                                <input type="email" name="email" class="form-control form-control-lg" required="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label for="" class="text-uppercase c-gray-light">
                                <?php echo get_phrase('phone');?>
                                </label>
                                <input type="text" name="phone" class="form-control form-control-lg" required="">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group has-feedback">
                                <label for="" class="text-uppercase c-gray-light">
                                <?php echo get_phrase('address');?>
                                </label>
                                <input type="text" name="address" class="form-control form-control-lg" required="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group has-feedback">
                                <label for="" class="text-uppercase c-gray-light">
                                <?php echo get_phrase('message');?>
                                </label>
                                <textarea name="message" class="form-control no-resize" rows="5" required=""></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="g-recaptcha" data-sitekey="<?php echo $recaptcha[0]->site_key;?>"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <button type="submit" class="btn btn-styled btn-base-1 mt-4"
                            style="cursor: pointer;">
                        <?php echo get_phrase('send_message');?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>