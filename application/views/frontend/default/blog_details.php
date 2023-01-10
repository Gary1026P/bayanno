<section class="parallax-section parallax-section-xl sct-color-3 has-bg-cover bg-size-cover" 
    style="background-image: url(<?php echo base_url('uploads/frontend/blog_images/' . $blog->frontend_blog_id . '.jpg');?>); background-position: center center;">

    <span class="mask mask-dark--style-2"></span>

    <div class="container sct-inner">
        <div class="">
            <div class="row">
                <div class="col-lg-6">
                    <h3 class="heading heading-1 strong-400 c-white">
                        <?php echo $blog->title;?>
                    </h3>
                    <h4 class="heading heading-5 text-normal strong-300 c-white mt-4">
                    <?php echo $blog->short_description;?>
                    </h4>

                    <ul class="inline-links inline-links--style-1 mt-4">
                        <li>
                            <i class="fa fa-calendar"></i> <?php echo date('d M, Y', $blog->timestamp);?>
                        </li>
                        <li>
                            <?php 
                                $user = $this->frontend_model->get_user_from_type_id($blog->posted_by);
                            ?>
                            <i class="fa fa-user"></i> <?php echo $user->name;?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="slice-sm sct-color-1 mb-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="block block-post">
                    <div class="block-body block-post-body">
                        <?php echo $blog->blog_post;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>