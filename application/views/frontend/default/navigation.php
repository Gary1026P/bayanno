
<!-- Navbar -->
<nav class="navbar navbar-expand-lg  navbar-light bg-default navbar--link-arrow navbar--uppercase bayanno-nav">
    <div class="container navbar-container">
        <!-- Brand/Logo -->
        <a class="navbar-brand" href="<?php echo site_url('home');?>">
            <img src="<?php echo base_url('uploads/logo.png');?>" width="40"
                alt="">
                &nbsp; <?php echo $hospital_name;?>
        </a>

        <div class="d-inline-block">
            <!-- Navbar toggler  -->
            <button class="navbar-toggler hamburger hamburger-js hamburger--spring" 
                type="button" data-toggle="collapse" data-target="#navbar_main" 
                    aria-controls="navbarsExampleDefault" aria-expanded="false" 
                        aria-label="Toggle navigation">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>

        <div class="collapse navbar-collapse align-items-center justify-content-end" id="navbar_main">

            <!-- Navbar links -->
            <ul class="navbar-nav" data-hover="dropdown">
                <li class="nav-item
                    <?php echo $page_name == 'home' ? 'active' : ''; ?>">
                    <a class="nav-link" aria-haspopup="true" aria-expanded="false"
                        href="<?php echo site_url('home');?>">
                        <?php echo get_phrase('home');?>
                    </a>
                </li>

                <li class="nav-item dropdown
                <?php echo $page_name == 'department' ? 'active' : ''; ?>">
                    <a href="#" class="nav-link" 
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo get_phrase('departments');?>
                    </a>

                    <ul class="dropdown-menu">
                        <?php
                            $departments = $this->frontend_model->get_departments(); 
                            foreach ($departments as $row) { 
                        ?>
                        <li>
                            <a class="dropdown-item" 
                                href="<?php echo site_url('home/department/' . $row['department_id']);?>">
                                <?php echo $row['name'];?>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </li>
                <li class="nav-item
                <?php echo $page_name == 'doctors' ? 'active' : ''; ?>">
                    <a class="nav-link" aria-haspopup="true" aria-expanded="false"
                        href="<?php echo site_url('home/doctors');?>">
                    <?php echo get_phrase('doctors');?>
                    </a>
                </li>
                <li class="nav-item
                <?php echo $page_name == 'about_us' ? 'active' : ''; ?>">
                    <a class="nav-link" aria-haspopup="true" aria-expanded="false"
                        href="<?php echo site_url('home/about_us');?>">
                    <?php echo get_phrase('about');?>
                    </a>
                </li>
                <li class="nav-item
                <?php echo $page_name == 'appointment' ? 'active' : ''; ?>">
                    <a class="nav-link" aria-haspopup="true" aria-expanded="false"
                        href="<?php echo site_url('home/appointment');?>">
                    <?php echo get_phrase('appointment');?>
                    </a>
                </li>
                <li class="nav-item
                <?php echo ($page_name == 'blog' || $page_name == 'blog_details') ? 'active' : ''; ?>">
                    <a class="nav-link" aria-haspopup="true" aria-expanded="false"
                        href="<?php echo site_url('home/blog');?>">
                    <?php echo get_phrase('blog');?>
                    </a>
                </li>
                <li class="nav-item
                <?php echo $page_name == 'contact_us' ? 'active' : ''; ?>">
                    <a class="nav-link" aria-haspopup="true" aria-expanded="false"
                        href="<?php echo site_url('home/contact_us');?>">
                    <?php echo get_phrase('contact');?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-haspopup="true" aria-expanded="false"
                        href="<?php echo site_url('login');?>" target="_blank">
                    <?php echo get_phrase('login');?>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
