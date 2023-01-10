<?php 
    $theme = $this->frontend_model->get_frontend_settings('theme');
    $hospital_name = $this->frontend_model->get_frontend_settings('hospital_name');
?>
<!DOCTYPE html>
<html>

    <head>
        <?php  include 'metas.php';?>
        <title><?php echo $page_title;?> | <?php echo $hospital_name;?></title>
        <?php  include 'stylesheets.php';?>
    </head>

    <body>
        <!-- MAIN WRAPPER -->
        <div class="body-wrap">
            <div id="st-container" class="st-container">
                <div id="doctor_details"></div>   
                <div class="st-pusher">
                    <div class="st-content">
                        <div class="st-content-inner">
                            <?php  include 'navigation.php';?>
                            <?php include $page_name.'.php';?>
                            <?php  include 'footer.php';?>

                        </div>
                    </div>
                </div><!-- END: st-pusher -->
            </div><!-- END: st-container -->
        </div><!-- END: body-wrap -->
        <?php  include 'javascripts.php';?>
    </body>

</html>