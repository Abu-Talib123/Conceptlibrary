<div class="site-section">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-4">
                <h4 class="section-title-underline mb-5">
              <span>SELECT YOUR COURSE</span>
            </h4>
            </div>
        </div>
        <div class="row">
          
         <?php
          $i=0;
          if($categories){
          foreach($categories as $category)
          {?>
            <div class="col-lg-3" onclick="window.location='<?php echo base_url();?>video/course/<?= $category['category_id']; ?>'" style="cursor:pointer;">
                <div class="feature-1 category1 text-center">
                    <div class="icon-wrapper bg-primary">
                    <a href="javascript:void(0)">    <h5  align="text-center" class="text-white"><?=$category['category_name'];?></h5></a>
                    </div>
                </div>
            </div>
            <?php 
            $i++;
            }} else{?>
                <div class="col-lg-12">
                  <h5 align="center">   No  Data Found</h5>
                </div>
        <?php }?>
            
        </div>
    </div>
</div>

<div class="section-bg style-1" style="background-image: url('<?=base_url('assets/cl/images/about_1.jpg')?>')">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                
            </div>
            <div class="col-lg-8">
                <h2 class="section-title-underline style-2">
              <span>Director's desk</span>
            </h2>
            <br/>
                <p class="lead">This is <strong style="font-weight: bold;">Vikash Kumar Shrivastav</strong>. Founder and CEO of Concept library. I have been teaching IIT-JEE & NEET for 10 years. Also, I have been conducting aerospace subjects for GATE AE and other GATE disciplines as well.</p>
                <p>I am a graduate in Aerospace Engineering from The Aeronautical Society of India.</p>
                <p>Teaching is my passion & learning is my habit.</p>
                <p>I hope, all students will appreciate our course videos and mock papers available on this website.</p>
            </div>
        </div>
    </div>
</div>

<!-- // 05 - Block -->
<div class="site-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-4">
                <h2 class="section-title-underline">
              <span>Testimonials</span>
            </h2>
            </div>
        </div>

        <div class="owl-slide owl-carousel">

            <div class="ftco-testimonial-1">
                <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
                    <img src="<?=base_url('assets/cl/images/male.png')?>" alt="Image" class="img-fluid mr-3">
                    <div>
                        <h3>Ramesh babu</h3>
                        <span>Anna University</span>
                    </div>
                </div>
                <div>
                    <p>&ldquo;I am proud to see your website, you have been an excellent teacher. I would say, your explanations are so easy to understand, I still remember most of your tips and tricks. Thank you so much, continue to do the great job. &rdquo;</p>
                </div>
            </div>

            <div class="ftco-testimonial-1">
                <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
                    <img src="<?=base_url('assets/cl/images/female.png')?>" alt="Image" class="img-fluid mr-3">
                    <div>
                        <h3>Samyuktha</h3>
                        <span>Prince Matriculation</span>
                    </div>
                </div>
                <div>
                    <p>The way you teach physics is amazing, you make difficult concepts very easy to understand. I am previledged to be your student. I always mention you as the best faculty.</p>
                </div>
            </div>

            <div class="ftco-testimonial-1">
                <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
                    <img src="<?=base_url('assets/cl/images/male.png')?>" alt="Image" class="img-fluid mr-3">
                    <div>
                        <h3>Vishal</h3>
                        <span>PSBB Millenium</span>
                    </div>
                </div>
                <div>
                    <p>&ldquo;You have been a great teacher, all of us appreciate your teaching style. We have learnt all the tough concepts in very easy way. I want to be a teacher like you some day.&rdquo;</p>
                </div>
            </div>

            <div class="ftco-testimonial-1">
                <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
                    <img src="<?=base_url('assets/cl/images/female.png')?>" alt="Image" class="img-fluid mr-3">
                    <div>
                        <h3>Rajeshwari</h3>
                        <span>KCG College</span>
                    </div>
                </div>
                <div>
                    <p>We are fortunate to found you for my GATE preparation for Aerospace, without you I wouldn't have joined IIT KGP</p>
                </div>
            </div>

            <div class="ftco-testimonial-1">
                <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
                    <img src="<?=base_url('assets/cl/images/female.png')?>" alt="Image" class="img-fluid mr-3">
                    <div>
                        <h3>Shreya</h3>
                        <span>St. Johns School</span>
                    </div>
                </div>
                <div>
                    <p>&ldquo;You are the best coach for IIT JEE preparation I have ever found. With this website you can reach more people like me who are desparately need support for IIT and Medical exams.&rdquo;</p>
                </div>
            </div>

            <div class="ftco-testimonial-1">
                <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
                    <img src="<?=base_url('assets/cl/images/male.png')?>" alt="Image" class="img-fluid mr-3">
                    <div>
                        <h3>Rahul</h3>
                        <span>Guru nanak School</span>
                    </div>
                </div>
                <div>
                    <p>After wasting a bulk amount in so called reputed centre for IIT, me and my parents were very nervous and fortunate I got you. And, now I am sitting in IIT campus, this is all because of you. That's all I want to say.</p>
                </div>
            </div>

        </div>

    </div>
</div>

<div class="section-bg style-1" style="background-image: url('<?=base_url('assets/cl/images/hero_1.jpg')?>')">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
                <span class="icon flaticon-mortarboard"></span>
                <h3>Our Philosphy</h3>
                <p>Start preparing with right content at right time. Toughest part is not studies but the routine.</p>
            </div>
            <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
                <span class="icon flaticon-school-material"></span>
                <h3>Our believes</h3>
                <p>We belive in teaching style followed by students focus to succeed in their exams.</p>
            </div>
            <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
                <span class="icon flaticon-library"></span>
                <h3>Do you need motivation?</h3>
                <p>If you are behind external factors such as motivational videos or motivational guru, it means this dream is not yours.</p>
            </div>
        </div>
    </div>
</div>

<div class="site-section ftco-subscribe-1" style="background-image: url('<?=base_url('assets/cl/images/bg_1.jpg')?>')">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <h2>Subscribe to us!</h2>
                <p>Don't hesitate to get in touch with us</p>
            </div>
            <div class="col-lg-5">
                <form action="" class="d-flex">
                    <input type="text" class="rounded form-control mr-2 py-3" placeholder="Enter your email">
                    <button class="btn btn-primary rounded py-3 px-4" type="submit">Send</button>
                </form>
            </div>
        </div>
    </div>
</div>