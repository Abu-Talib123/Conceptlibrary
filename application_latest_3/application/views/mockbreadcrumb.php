<div class="custom-breadcrumns border-bottom">
    <div class="container">
        <a href="<?=base_url('home')?>">Home</a>
        <span class="mx-3 icon-keyboard_arrow_right"></span>
        <a href="<?=base_url('mockpaper')?>"><span><?=$title?></span></a>
        <span class="mx-3 icon-keyboard_arrow_right"></span>
        <span <?php if($sub_title =='Courses' || $this->uri->segment(2) == 'course'){echo 'class="current"';}?>><?=$sub_title?></span>
       
    </div>
</div>
