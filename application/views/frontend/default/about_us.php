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


<section class="slice sct-color-1 pb-0" id="scrollToSection">
    <div class="container no-padding">
        <div class="row row-no-padding">
            <div class="col-md-12">
                <div class="section-title section-title--style-1 text-center mb-4">
                    <h3 class="section-title-inner text-uppercase">
                        <?php echo get_phrase('about').' '.$hospital_name;?>
                    </h3>
                    <span class="section-title-delimiter clearfix d-none"></span>
                </div>

                <span class="clearfix"></span>

                <div class="text-center">
                    <div class="fluid-paragraph fluid-paragraph-md c-gray-light about-text">
                        <?php echo $this->frontend_model->get_frontend_settings('about_us');?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<?php $service_section_data = json_decode($service_section);?>
<section class="slice slice--arrow bg-base-1">
    <div class="sct-inner container">
        <div class="section-title section-title-inverse section-title--style-1 text-center">
            <h3 class="section-title-inner">
                <span><?php echo $service_section_data[0]->title;?></span>
            </h3>
            <span class="section-title-delimiter clearfix d-none"></span>
        </div>

        <div class="fluid-paragraph fluid-paragraph-sm strong-300 text-center">
            <?php echo $service_section_data[0]->description;?>
        </div>
    </div>
</section>

<section class="slice-xl sct-color-1">
    <div class="container">
        <div class="row-wrapper">
            <div class="row">
                <?php foreach ($services as $row) { ?>
                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="icon-block icon-block--style-1-v2 block-icon-right block-icon-sm">
                        <div class="block-icon">
                            <img src="<?php echo base_url('uploads/frontend/service_images/' . $row['service_id'] . '.png');?>"
                                 width="50">
                        </div>
                        <div class="block-content">
                            <h3 class="heading heading-5 strong-500">
                                <?php echo $row['title'];?>
                            </h3>
                            <p>
                                <?php echo $row['description'];?>
                            </p>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<section class="slice sct-color-2 b-xs-top b-xs-bottom">
    <div class="container">
        <div class="text-center">
            <div class="section-title section-title--style-1 text-center mb-4">
            <div class="mt-5">
                <a href="<?php echo site_url('home/appointment');?>"
                   class="btn btn-styled btn-lg btn-base-1">
                    <?php echo get_phrase('make_an_appointment');?>
                </a>
            </div>
        </div>
    </div>
</section>