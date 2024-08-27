<style>

</style>
<?php if ($student_result) {?>
<div class="site-section topper-section py-2"
    style="background-image: url('<?= base_url('assets/cl/images/result_bg.jpg') ?>');">
    <div class="container">
        <div class="row justify-content-center text-center mb-3">
            <div class="col-lg-4">
                <h4 class="section-title-underline  text-white">
                    <span>Toppers <?php echo $result_year ?></span>
                </h4>
            </div>
        </div>
        <div class="w-100 d-flex justify-content-evenly rslt-container my-3 ">
            <?php
                $i = 1;
                ?>
                <?php
                foreach ($student_result as $std) { ?>
                    <div class=" m-2 ">
                        <a href="#" class="read_more" data-toggle="modal" data-target="#resultModal<?php echo $i; ?>">
                            <div class="result_continer position-relative p-4 text-white">
                                <div class="std_image d-flex justify-content-center align-items-center my-2">
                                    <?php if ($std['student_image']): ?>
                                        <div class=''>
                                            <img width="150" height="150" align="absmiddle" id="uploadImage"
                                                class="profile-img res-img shadow border-primary"
                                                src="<?= $std['student_image'] ?>" />
                                        </div>
                                    <?php else: ?>
                                        <div class="">
                                            <img width="150" height="150" align="absmiddle" id="uploadImage"
                                                class="profile-img shadow res-img border-primary"
                                                src="<?= base_url('assets/cl/images/user_pic.png') ?>" />
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="ribbon position-absolute d-flex justify-content-center align-items-center" style="top:5px; right:15px;">
                                    <p class="m-0"> <i class="fad fa-ribbon"></i><?php echo $std['rank'] ?></p>
                                </div>
                                <div class="std_details my-3">
                                    <p class='h5 text-center font-weight-bold text-uppercase'
                                        style="text-shadow: -2px 2px 8px rgba(0,0,0,0.6);"> <?php echo $std['name'] ?></p>
                                </div>
                            </div>
                        </a>
                        <div class="modal fade" id="resultModal<?php echo $i; ?>" tabindex="-1" role="dialog"
                            aria-labelledby="resultModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl mx-auto" role="document">
                                <div class="modal-content result_continer text-white">
                                    <div class="modal-header">
                                        <h5>Toppers - <?php echo $std['passed_year']; ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body p-3">
                                        <div class="std_image d-flex justify-content-center align-items-center my-3">
                                            <?php if ($std['student_image']): ?>
                                                <div class=''>
                                                    <img width="150" height="150" align="absmiddle" id="uploadImage"
                                                        class="profile-img res-img shadow border-primary"
                                                        src="<?= $std['student_image'] ?>" />
                                                </div>
                                            <?php else: ?>
                                                <div class="">
                                                    <img width="150" height="150" align="absmiddle" id="uploadImage"
                                                        class="profile-img shadow res-img border-primary"
                                                        src="<?= base_url('assets/cl/images/user_pic.png') ?>" />
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="ribbon position-absolute d-flex justify-content-center align-items-center" style="top:0; right:30%;">
                                            <p class="m-0"> <i class="fad fa-ribbon"></i><?php echo $std['rank'] ?></p>
                                        </div>
                                        <div class="std_details my-3">
                                            <div class="table-responsive my-3">
                                                <table class="table w-100">
                                                    <tbody>
                                                        <tr class='border border-0'>
                                                            <th>Name</th>
                                                            <td><?php echo $std['name'] ?></td>
                                                        </tr>
                                                        <tr class='border border-0'>
                                                            <th>Course</th>
                                                            <td><?php echo $std['course'] ?></td>
                                                        </tr>
                                                        <tr class='border border-0'>
                                                            <th>Passed Year</th>
                                                            <td><?php echo $std['passed_year'] ?></td>
                                                        </tr>
                                                        <tr class='border border-0'>
                                                            <th>Description </th>
                                                            <td><?php echo $std['description'] ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $i++;
                } ?>

        </div>
    </div>
</div>
<?php } ?>
<?php
$i = 0;
if ($blogs) {
    $blogs = array_reverse($blogs);
    ?>
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="section-title-underline my-3 text-center">
                        <span>Our Blogs</span>
                    </h4>
                    <div class="row justify-content-between overflow-scroll ">
                        <?php
                        foreach ($blogs as $blog) { ?>
                            <div class="col-md-4 my-3">
                                <div class="item h-100 shadow position-relative p-0">
                                    <a href="#" class="read_more" data-toggle="modal"
                                        data-target="#blogModal<?php echo $blog['blog_id']; ?>">
                                        <div class="blog_ig">
                                            <?php if ($blog['blog_image']): ?>
                                                <div class='w-100'>
                                                    <img width="100%" height="200" align="absmiddle" id="uploadImage"
                                                        class="profile-img" src="<?= $blog['blog_image'] ?>" />
                                                </div>
                                            <?php else: ?>
                                                <div class="w-100">
                                                    <img width="auto" height="150" align="absmiddle" id="uploadImage"
                                                        class="profile-img"
                                                        src="<?= base_url('assets/cl/images/video_preview') ?>" />
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="item-in p-3 ">
                                            <h4 class="text-dark h5 font-weight-bold"><?php echo $blog['title']; ?></h4>
                                            <div class="seperator mb-2"></div>
                                            <?php
                                            $custome_date = date("F", strtotime($blog['created_at'])) . ' ' . date("d", strtotime($blog['created_at'])) . ', ' . date("Y", strtotime($blog['created_at']));
                                            ?>
                                            <p class="my-2 text-dark font-weight-bold" style="font-size:12px">
                                                <?php echo $blog['author_name']; ?><span
                                                    class="mx-1">|</span><?= isset($category_map[$blog['category_id']]) ? $category_map[$blog['category_id']] : 'Uncategorized' ?><span
                                                    class="mx-1">|</span><?php echo $custome_date; ?>
                                            </p>
                                            <p class="text-dark">
                                                <?php
                                                $description_words = explode(' ', $blog['discription']);
                                                $short_description = implode(' ', array_slice($description_words, 0, 20));
                                                echo $short_description;
                                                if (count($description_words) > 20) {
                                                    echo '...';
                                                }
                                                ?>
                                            </p>

                                        </div>
                                    </a>
                                    <!-- Modal Structure -->
                                    <div class="modal fade w-100" id="blogModal<?php echo $blog['blog_id']; ?>" tabindex="-1"
                                        role="dialog" aria-labelledby="blogModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl  mx-auto" role="document"
                                            style="max-width:70%!important;">
                                            <div class="modal-content">
                                                <div class="modal-body ">
                                                    <button type="button" class="close position-absolute bg-danger px-3 py-2"
                                                        style="right:0; top:0;" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <div class="blog_ig mb-3">
                                                        <?php if ($blog['blog_image']): ?>
                                                            <div class=''>
                                                                <img width="100%" height="315" align="absmiddle" id="uploadImage"
                                                                    class="profile-img" src="<?= $blog['blog_image'] ?>" />
                                                            </div>
                                                        <?php else: ?>
                                                            <div class="">
                                                                <img width="100%" height="100%" align="absmiddle" id="uploadImage"
                                                                    class="profile-img"
                                                                    src="<?= base_url('assets/cl/images/video_preview') ?>" />
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="p-3">
                                                        <h4 class="text-dark"><?php echo $blog['title']; ?></h4>
                                                        <div class="seperator mb-2"></div>
                                                        <?php
                                                        $custome_date = date("F", strtotime($blog['created_at'])) . ' ' . date("d", strtotime($blog['created_at'])) . ', ' . date("Y", strtotime($blog['created_at']));
                                                        ?>
                                                        <p class="my-2 " style="font-size:13px">
                                                            <?php echo $blog['author_name']; ?><span
                                                                class="mx-1">|</span><?= isset($category_map[$blog['category_id']]) ? $category_map[$blog['category_id']] : 'Uncategorized' ?><span
                                                                class="mx-1">|</span><?php echo $custome_date; ?>
                                                        </p>
                                                        <p>
                                                            <?php echo nl2br(htmlspecialchars($blog['discription'])) ?>
                                                        </p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $i++;
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<div class="section my-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="section-title-underline mb-4 text-center">
                    <span>Our Videos</span>
                </h4>
                <div class="row">
                    <div class="col-md-4  mb-4">
                        <div class="videos   p-0">
                            <iframe width="100%" height="215"
                                src="https://www.youtube.com/embed/rTf9m5RICug?si=21pDKp64qWZycxyF"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen
                                class="shadow"></iframe>
                        </div>
                    </div>
                    <div class="col-md-4  mb-4">
                        <div class="videos   p-0">
                            <iframe width="100%" height="215"
                                src="https://www.youtube.com/embed/QOZT5T027K8?si=1IxXFDNURK1ul_87"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen
                                class="shadow"></iframe>
                        </div>
                    </div>
                    <div class="col-md-4  mb-4">
                        <div class="videos   p-0">
                            <iframe width="100%" height="215"
                                src="https://www.youtube.com/embed/NJRNMQlAPN0?si=uitDQCPn7KaFKlm4"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen
                                class="shadow"></iframe>
                        </div>
                    </div>
                    <div class="col-md-4  mb-4">
                        <div class="videos   p-0">
                            <iframe width="100%" height="215"
                                src="https://www.youtube.com/embed/WXbudP1E7Pc?si=XRru1cQBjm6dDcfD"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen
                                class="shadow"></iframe>
                        </div>
                    </div>
                    <div class="col-md-4  mb-4">
                        <div class="videos   p-0">
                            <iframe width="100%" height="215"
                                src="https://www.youtube.com/embed/8XWpC0tTF5U?si=sYGax2yCg1uwOESF"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen
                                class="shadow"></iframe>
                        </div>
                    </div>
                    <div class="col-md-4  mb-4">
                        <div class="videos   p-0">
                            <iframe width="100%" height="215"
                                src="https://www.youtube.com/embed/3kvBqxyxoL4?si=mQcRXJIejMuVupuJ"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen
                                class="shadow"></iframe>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="view_more_btn">
                            <a href="https://www.youtube.com/@conceptlibrary/featured" target="_blank"
                                class='btn btn-primary'>View More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section-bg style-1" style="background-image: url('<?= base_url('assets/cl/images/about_1.jpg') ?>')">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">

            </div>
            <div class="col-lg-8">
                <h2 class="section-title-underline style-2">
                    <span>Director's desk</span>
                </h2>
                <br />
                <p class="lead">This is <strong style="font-weight: bold;">Vikash Kumar Shrivastav</strong>. Founder and
                    CEO of Concept library. I have been teaching IIT-JEE & NEET for 10 years. Also, I have been
                    conducting aerospace subjects for GATE AE and other GATE disciplines as well.</p>
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
                    <img src="<?= base_url('assets/cl/images/male.png') ?>" alt="Image" class="img-fluid mr-3">
                    <div>
                        <h3>Ramesh babu</h3>
                        <span>Anna University</span>
                    </div>
                </div>
                <div>
                    <p>&ldquo;I am proud to see your website, you have been an excellent teacher. I would say, your
                        explanations are so easy to understand, I still remember most of your tips and tricks. Thank you
                        so much, continue to do the great job. &rdquo;</p>
                </div>
            </div>

            <div class="ftco-testimonial-1">
                <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
                    <img src="<?= base_url('assets/cl/images/female.png') ?>" alt="Image" class="img-fluid mr-3">
                    <div>
                        <h3>Samyuktha</h3>
                        <span>Prince Matriculation</span>
                    </div>
                </div>
                <div>
                    <p>The way you teach physics is amazing, you make difficult concepts very easy to understand. I am
                        previledged to be your student. I always mention you as the best faculty.</p>
                </div>
            </div>

            <div class="ftco-testimonial-1">
                <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
                    <img src="<?= base_url('assets/cl/images/male.png') ?>" alt="Image" class="img-fluid mr-3">
                    <div>
                        <h3>Vishal</h3>
                        <span>PSBB Millenium</span>
                    </div>
                </div>
                <div>
                    <p>&ldquo;You have been a great teacher, all of us appreciate your teaching style. We have learnt
                        all the tough concepts in very easy way. I want to be a teacher like you some day.&rdquo;</p>
                </div>
            </div>

            <div class="ftco-testimonial-1">
                <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
                    <img src="<?= base_url('assets/cl/images/female.png') ?>" alt="Image" class="img-fluid mr-3">
                    <div>
                        <h3>Rajeshwari</h3>
                        <span>KCG College</span>
                    </div>
                </div>
                <div>
                    <p>We are fortunate to found you for my GATE preparation for Aerospace, without you I wouldn't have
                        joined IIT KGP</p>
                </div>
            </div>

            <div class="ftco-testimonial-1">
                <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
                    <img src="<?= base_url('assets/cl/images/female.png') ?>" alt="Image" class="img-fluid mr-3">
                    <div>
                        <h3>Shreya</h3>
                        <span>St. Johns School</span>
                    </div>
                </div>
                <div>
                    <p>&ldquo;You are the best coach for IIT JEE preparation I have ever found. With this website you
                        can reach more people like me who are desparately need support for IIT and Medical exams.&rdquo;
                    </p>
                </div>
            </div>

            <div class="ftco-testimonial-1">
                <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
                    <img src="<?= base_url('assets/cl/images/male.png') ?>" alt="Image" class="img-fluid mr-3">
                    <div>
                        <h3>Rahul</h3>
                        <span>Guru nanak School</span>
                    </div>
                </div>
                <div>
                    <p>After wasting a bulk amount in so called reputed centre for IIT, me and my parents were very
                        nervous and fortunate I got you. And, now I am sitting in IIT campus, this is all because of
                        you. That's all I want to say.</p>
                </div>
            </div>

        </div>

    </div>
</div>

<div class="section-bg style-1" style="background-image: url('<?= base_url('assets/cl/images/hero_1.jpg') ?>')">
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
                <p>If you are behind external factors such as motivational videos or motivational guru, it means this
                    dream is not yours.</p>
            </div>
        </div>
    </div>
</div>

<div class="section-freetest">
    <div class="free-test bg-white">
        <a data-toggle="tooltip" data-placement="top" title="Take Free Mock Test" href = "<?= base_url('mockpaper/free_test') ?>">
            <img src="<?= base_url('assets/cl/images/free-test.svg') ?>" alt="" >
                    </a>
        
    </div>
</div>
<div class="site-section ftco-subscribe-1"
    style="background-image: url('<?= base_url('assets/cl/images/bg_1.jpg') ?>')">
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
