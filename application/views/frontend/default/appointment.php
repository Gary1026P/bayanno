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


<section class="slice sct-color-2 b-xs-bottom">
    <div class="container">
        <div class="section-title section-title--style-1 text-center mb-3">
            <h3 class="heading heading-2 strong-400">
                <?php echo get_phrase('make_an_appointment');?>
            </h3>
            <span class="section-title-delimiter clearfix d-none"></span>
        </div>
    </div>
</section>
<section class="slice sct-color-2">
    <div class="container container-xs">
        <div class="row">
            <div class="col">
                <form class="form-default" role="form"
                    action="<?php echo site_url('home/make_an_appointment');?>"
                        method="post"
                            enctype="multipart/form-data">

                    <div class="form-group">
                        <div class="checkbox checkbox-inline">
                            <input type="radio" name="patient_type" id="radioExample_4a"
                                   checked="checked" value="new">
                            <label for="radioExample_4a">
                                <?php echo get_phrase('new_patient');?>
                            </label>
                        </div>
                        <div class="checkbox checkbox-inline">
                            <input type="radio" name="patient_type" id="radioExample_4b"
                                value="old">
                            <label for="radioExample_4b">
                                <?php echo get_phrase('old_patient');?>
                            </label>
                        </div>
                    </div>

                    <div id="old_patient">
                        <div class="form-group">
                            <label for="" class="text-uppercase  c-gray-light">
                                <?php echo get_phrase('patient_code');?>
                            </label>
                            <span id="code_error" style="font-size: 12px; color: #d50000;
                                margin-left: 15px;">
                                <?php echo get_phrase('invalid_patient_code');?>
                            </span>
                            <input type="text" class="form-control input-lg" name="code"
                                onblur="check_code(this.value)" value="">
                            <span style="font-size: 12px;">
                            <a href="<?php echo site_url('login');?>" target="_blank">
                                <?php echo get_phrase('log_in_to_patient_account_to_see_your_code');?>
                            </a>
                        </span>
                        </div>
                    </div>

                    <div id="new_patient">
                        <div class="form-group">
                            <label for="" class="text-uppercase  c-gray-light">
                                <?php echo get_phrase('name');?>
                            </label>
                            <input type="text" class="form-control input-lg" placeholder=""
                                   name="name">
                        </div>

                        <div class="form-group">
                            <label for="" class="text-uppercase c-gray-light">
                                <?php echo get_phrase('email');?>
                            </label>
                            <input type="email" class="form-control input-lg" placeholder=""
                                   name="email">
                        </div>

                        <div class="form-group">
                            <label for="" class="text-uppercase c-gray-light">
                                <?php echo get_phrase('phone');?>
                            </label>
                            <input type="text" class="form-control input-lg" placeholder=""
                                   name="phone">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="text-uppercase c-gray-light">
                            <?php echo get_phrase('date');?>
                        </label>
                        <input type="text" class="form-control input-lg datepicker" placeholder=""
                            name="timestamp">
                    </div>

                    <div class="form-group">
                        <label for="" class="text-uppercase c-gray-light">
                            <?php echo get_phrase('department');?>
                        </label>
                        <select class="form-control" name="department_id" id="dept_select"
                            onchange="get_doctors(this.value)">
                            <option value="0"><?php echo get_phrase('select_a_department');?></option>
                            <?php foreach ($departments as $row) { ?>
                                <option value="<?php echo $row['department_id'];?>"
                                    <?php
                                        if (isset($doctor)) {
                                            if ($row['department_id'] == $doctor->department_id) {
                                                echo 'selected';
                                            }
                                        }
                                    ?>
                                >
                                    <?php echo $row['name'];?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="" class="text-uppercase c-gray-light">
                            <?php echo get_phrase('doctor');?>
                        </label>
                        <div id="doctor_list">
                            <?php if (isset($doctor)) { ?>
                                <select class="form-control" name="doctor_id">
                                    <?php
                                        $doctors = $this->frontend_model->get_doctors($doctor->department_id);
                                        foreach ($doctors as $row) {
                                    ?>
                                        <option value="<?php echo $row['doctor_id'];?>"
                                            <?php if ($row['doctor_id'] == $doctor->doctor_id) echo 'selected';?>>
                                            <?php echo $row['name'];?>
                                        </option>
                                    <?php } ?>
                                </select>
                            <?php } else { ?>
                                <input type="text" class="form-control input-lg"
                                value="<?php echo get_phrase('select_a_department_first');?>" disabled>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="text-uppercase c-gray-light">
                            <?php echo get_phrase('message');?>
                        </label>
                        <textarea class="form-control no-resize" rows="5" name="message"
                                  placeholder="<?php echo get_phrase('your_message_to_the_doctor');?>"></textarea>
                    </div>

                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="<?php echo $recaptcha[0]->site_key;?>"></div>
                    </div>
                    <button type="submit" class="btn btn-styled btn-base-1"
                            style="cursor: pointer;">
                        <i class="fa fa-calendar mr-1"></i> <?php echo get_phrase('book_now');?>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<script>

    $(document).ready(function () {
       $('#old_patient').hide();
        $('#code_error').hide();

       $('input[type=radio][name=patient_type]').change(function () {
           if (this.value == 'new') {
               $('#old_patient').hide();
               $('#new_patient').fadeIn();
           } else if (this.value == 'old') {
               $('#new_patient').hide();
               $('#old_patient').fadeIn();
           }
       });

    });

    function get_doctors(department_id) {

        $.ajax({
            url: '<?php echo site_url('home/get_doctors_of_department/');?>' + department_id,
            success: function (response) {
                jQuery('#doctor_list').html(response);
            }
        });
    }

    function check_code(code) {
        $.ajax({
            url: '<?php echo site_url('home/check_patient_code/');?>' + code
        }).done(function (response) {
            if (response == 1) {
                $('#code_error').hide();
            } else if (response == 0) {
                $('#code_error').fadeIn();
            }
        });
    }

</script>
