<div class="site-mobile-menu site-navbar-target">
    <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
        </div>
    </div>
    <div class="site-mobile-menu-body"></div>
</div>

<div class="py-2 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 d-none d-lg-block">
                <span class="small mr-3" style="color: #000"><span class="icon-question-circle-o mr-2"></span> Have a
                    question?</span>
                <a href="tel:6380135260" class="small mr-3" style="font-weight: 600;"><span
                        class="icon-phone2 mr-2"></span> +91 6380135260</a>
                <a href="mailto:info@conceptlibrary.in" class="small mr-3" style="font-weight: 600;"><span
                        class="icon-envelope-o mr-2"></span> info@conceptlibrary.in</a>
            </div>
            <?php if ($this->session->userdata('CL_STUDENT_ID')) { ?>
                <div class="col-lg-6 text-right">
                    <a href="" class="small mr-3"><span> Welcome ,
                            <?php if (is_null($this->session->userdata('CL_STUDENT_PHOTO'))): ?>
                                <img width="25" height="25" align="absmiddle" class="profile_pic mx-1 rounded-circle"
                                    src="<?= base_url('assets/cl') ?>/images/profile.jpg" />
                            <?php else: ?>
                                <img width="25" height="25" align="absmiddle" class="profile_pic mx-1 rounded-circle"
                                    src="<?php echo $this->session->userdata('CL_STUDENT_PHOTO'); ?>" />
                            <?php endif ?>
                            <?php echo ucfirst($this->session->userdata('CL_STUDENT_USERNAME')); ?></span> </a>
                    <a href="<?php echo base_url(); ?>profile" class="small mr-3"><span> Update Profile</a>
                    <a href="<?php echo base_url(); ?>profile/update_password" class="small mr-3"><span> Change
                            Password<span></a>

                    <a href="<?= base_url('login/logout') ?>"
                        class="small btn btn-primary px-4 py-2 rounded-0"><span></span>
                        Logout</a>
                </div>
            <?php } else { ?>

                <div class="col-lg-6 text-right">
                    <a style="font-weight: 600;" href="<?= base_url('login') ?>" <?php if ($sub_title == 'Login') {
                          echo 'class="small btn btn-primary px-4 py-2 rounded-0"';
                      } ?>"><span class="icon-unlock-alt"></span>
                        Login</a>&nbsp;&nbsp;
                    <a style="font-weight: 600;" href="<?= base_url('login/register') ?>" <?php if ($sub_title == 'Register') {
                          echo 'class="small btn btn-primary px-4 py-2 rounded-0"';
                      } ?>><span class="icon-users"></span>
                        Register</a>
                </div>
            <?php } ?>

        </div>
    </div>
</div>
<header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner" id="navbar">

    <div class="container">
        <div class="d-flex align-items-center">
            <div class="site-logo">
                <a href="<?= base_url('home') ?>" class="d-block">
                    <img src="<?= base_url('assets/cl/images/logo.png') ?>" alt="Image" class="img-fluid">
                </a>
            </div>
            <div class="mr-auto">
                <nav class="site-navigation position-relative text-right" role="navigation">
                    <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                        <li class="<?php if ($sub_title == 'Home') {
                            echo 'active';
                        } ?>">
                            <a href="<?= base_url('home') ?>" class="nav-link text-left">Home</a>
                        </li>
                        <!-- <li class="<?php if ($sub_title == 'About Us' || $this->uri->segment(1) == 'about') {
                            echo 'active';
                        } ?>">
                        <a href="<?= base_url('about') ?>" class="nav-link text-left">About</a>
                    </li> -->
                        <li class="<?php if ($sub_title == 'Videos' || $this->uri->segment(1) == 'video') {
                            echo 'active';
                        } ?>">
                            <a href="<?= base_url('video') ?>" class="nav-link text-left">Videos</a>
                        </li>

                        <li class="<?php if ($this->uri->segment(1) == 'mockpaper') {
                            echo 'active';
                        } ?>">
                            <a href="<?= base_url('mockpaper') ?>" class="nav-link text-left">Mock Papers</a>
                        </li>
                        <li class="<?php if ($sub_title == 'Contact Us') {
                            echo 'active';
                        } ?>">
                            <a href="<?= base_url('contact') ?>" class="nav-link text-left">Contact</a>
                        </li>
                    </ul>
                </nav>

            </div>
            <?php
            $cartcount = $this->Common_model->fetch_cartdata_count($this->session->userdata('CL_STUDENT_ID'));
            $totalcart = '';
            if ($cartcount > 0) {
                $totalcart = $cartcount;
            }
            ?>
            <div class="ml-auto">
                <?php if ($cartcount > 0) { ?>
                    <span
                        style="display: table-caption;width: 20px;height: 20px;background: #01bf1d;border-radius: 20px;text-align: center;line-height: 20px;color: #fff;"><?= $totalcart ?></span>
                <?php } ?>
                <div class="social-wrap">

                    <a href="<?= base_url('cart') ?>"><span class="icon-cart">
                            <image src="<?= base_url('assets/cl/images/cart.png') ?>" style="height:25px;width:25px;" />

                        </span> </a>
                    <a href="#"><span class="icon-facebook"></span></a>
                    <a target="_blank" href="https://www.youtube.com/channel/UC-Xm2AjuiY9Izk4hVBUBbtQ"><span
                            class="icon-youtube"></span></a>
                    <a href="#"><span class="icon-linkedin"></span></a>
                    <a href="https://wa.me/6380135260" target="_blank"><span class="icon-whatsapp"></span></a>
                    <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black"><span
                            class="icon-menu h3"></span></a>
                </div>
            </div>
        </div>
    </div>

</header>