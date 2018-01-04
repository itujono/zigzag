<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section class="section main-slider pb0" data-start-height="550" data-slide-overlay="yes" id="home">
    <div class="rev_slider_wrapper">
        <div id="rev_slider" class="rev_slider tp-overflow-hidden fullscreenbanner">
            <ul>
            <?php
            if(!empty($listslider)){
                foreach ($listslider as $key => $slider) {
            ?>
                <li data-transition="slotzoom-horizontal"  data-slotamount="6" data-masterspeed="1000" data-fsmasterspeed="1000">

                    <img src="<?php echo $slider->imageSLIDER; ?>" data-bgparallax="10"  alt="<?php echo $slider->titleSLIDER; ?>" data-bgposition="center 0" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg">

                    <!-- Layer 1 -->
                    <div class="tp-caption tp-shape tp-shapewrapper  tp-resizeme"
                    data-x="['left']" data-hoffset="['100']"
                    data-y="['middle','middle','middle','middle']" data-voffset="['-250']"
                    data-width="270"
                    data-height="5"
                    data-whitespace="nowrap"
                    data-type="shape"
                    data-responsive_offset="on"
                    data-frames='[{"from":"x:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;","speed":1000,"to":"o:1;","delay":0,"ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]'
                    data-textAlign="['left','left','left','left']"
                    data-paddingtop="[0,0,0,0]"
                    data-paddingright="[0,0,0,0]"
                    data-paddingbottom="[0,0,0,0]"
                    data-paddingleft="[0,0,0,0]"
                    style="background-color:#fdc236;"></div>

                    <!-- Layer 2 -->
                    <div class="tp-caption tp-shape tp-shapewrapper  tp-resizeme"
                    data-x="['left']" data-hoffset="['370']"
                    data-y="['middle','middle','middle','middle']" data-voffset="['19']"
                    data-width="5"
                    data-height="544"
                    data-whitespace="nowrap"
                    data-type="shape"
                    data-responsive_offset="on"
                    data-frames='[{"from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;","speed":1000,"to":"o:1;","delay":600,"ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]'
                    data-textAlign="['left','left','left','left']"
                    data-paddingtop="[0,0,0,0]"
                    data-paddingright="[0,0,0,0]"
                    data-paddingbottom="[0,0,0,0]"
                    data-paddingleft="[0,0,0,0]"
                    style="background-color:#fdc236;"></div>

                    <!-- Layer 3 -->
                    <div class="tp-caption tp-shape tp-shapewrapper  tp-resizeme"
                    data-x="['left']" data-hoffset="['100']"
                    data-y="['middle','middle','middle','middle']" data-voffset="['289']"
                    data-width="270"
                    data-height="5"
                    data-whitespace="nowrap"
                    data-type="shape"
                    data-responsive_offset="on"
                    data-frames='[{"from":"x:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;","speed":1000,"to":"o:1;","delay":1200,"ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]'
                    data-textAlign="['left','left','left','left']"
                    data-paddingtop="[0,0,0,0]"
                    data-paddingright="[0,0,0,0]"
                    data-paddingbottom="[0,0,0,0]"
                    data-paddingleft="[0,0,0,0]"
                    style="background-color:#fdc236;"></div>

                    <!-- Layer 4 -->
                    <div class="tp-caption tp-shape tp-shapewrapper  tp-resizeme"
                    data-x="['left']" data-hoffset="['100']"
                    data-y="['middle','middle','middle','middle']" data-voffset="['19']"
                    data-width="5"
                    data-height="544"
                    data-whitespace="nowrap"
                    data-type="shape"
                    data-responsive_offset="on"
                    data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;","speed":1000,"to":"o:1;","delay":1800,"ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]'
                    data-textAlign="['left','left','left','left']"
                    data-paddingtop="[0,0,0,0]"
                    data-paddingright="[0,0,0,0]"
                    data-paddingbottom="[0,0,0,0]"
                    data-paddingleft="[0,0,0,0]"
                    style="background-color:#fdc236;"></div>

                    <!-- Layer 5 -->
                    <div class="slider-title tp-caption tp-resizeme"
                    data-x="['left']" data-hoffset="['156']"
                    data-y="['middle','middle','middle','middle']" data-voffset="['-30']"
                    data-textAlign="['left']"
                    data-fontsize="['72', '63','57','50']"
                    data-lineheight="['72','68', '62','54']"
                    data-height="none"
                    data-whitespace="nowrap"
                    data-transform_idle="o:1;"
                    data-transform_in="x:[-155%];z:0;rX:0deg;rY:0deg;rZ:0deg;sX:1;sY:1;skX:0;skY:0;s:2000;e:Power2.easeInOut;"
                    data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                    data-mask_in="x:50px;y:0px;s:inherit;e:inherit;"
                    data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                    data-start="500"
                    data-splitin="chars"
                    data-splitout="none"
                    data-responsive_offset="on"
                    data-elementdelay="0.05" style="font-weight:600; letter-spacing:-0.05em;"><?php echo $slider->descSLIDER; ?>
                    </div>

                    <!-- Layer 6 -->
                    <div class="slider-title tp-caption"
                    data-x="['left']" data-hoffset="['156']"
                    data-y="['middle','middle','middle','middle']" data-voffset="['-170']"
                    data-textAlign="['left']"
                    data-fontsize="['18']"
                    data-lineheight="['20']"
                    data-height="none"
                    data-whitespace="nowrap"
                    data-transform_idle="o:1;"
                    data-transform_in="x:[155%];z:0;rX:0deg;rY:0deg;rZ:0deg;sX:1;sY:1;skX:0;skY:0;s:2000;e:Power2.easeInOut;"
                    data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                    data-mask_in="x:50px;y:0px;s:inherit;e:inherit;"
                    data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                    data-start="1000"
                    data-splitin="chars"
                    data-splitout="none"
                    data-responsive_offset="on"
                    data-elementdelay="0.05" style="font-weight:600; letter-spacing:0.1em; text-transform:uppercase;"><?php echo $slider->titleSLIDER; ?>
                    </div>

                    <!-- Layer 7 -->
                    <div class="slider-title tp-caption"
                    data-x="['left']" data-hoffset="['156']"
                    data-y="['middle','middle','middle','middle']" data-voffset="['230']"
                    data-textAlign="['left']"
                    data-fontsize="['18']"
                    data-lineheight="['20']"
                    data-height="none"
                    data-whitespace="nowrap"
                    data-transform_idle="o:1;"
                    data-transform_in="x:[-105%];z:0;rX:0deg;rY:0deg;rZ:0deg;sX:1;sY:1;skX:0;skY:0;s:2000;e:Power2.easeInOut;"
                    data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                    data-mask_in="x:50px;y:0px;s:inherit;e:inherit;"
                    data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                    data-start="1500"
                    data-splitin="none"
                    data-splitout="none"
                    data-responsive_offset="on"
                    data-elementdelay="0.05" style="font-weight:600;">
                        <a href="" class="link-arrow">Lihat
                            <i class="icon ion-ios-arrow-thin-right"></i>
                        </a>
                    </div>
                </li>
            <?php } ?>
        <?php } ?>
            </ul>
        </div> <!-- kelar ID Rev-Slider -->
    </div> <!-- kelar Rev-SLider Wrapper -->
</section>
<?php
    $about = select_row_about();
    $title_about = $about->titlehomeABOUT;
    $desc_about = $about->deschomeABOUT;
    $map = directory_map('assets/upload/about/home-about/pic-home-about-'.folenc($about->idABOUT), FALSE, TRUE);
    if(!empty($map)){
        $imageHOMEABOUT = base_url() . 'assets/upload/about/home-about/pic-home-about-'.folenc($about->idABOUT).'/'.$map[0];
    } else {
        $imageHOMEABOUT = '';
    }
?>
<section class="section ataglance">
    <div class="columns">
        <div class="column">
            <img src="<?php echo $imageHOMEABOUT; ?>" width="300" alt="<?php echo $title_about;?>">
        </div>
        <div class="column">
            <div class="columns">
                <div class="column p20 lead-title" class="wow fadeInUp" data-wow-delay="2s">
                    <h3><?php echo $title_about;?></h3>
                </div>
                <div class="column wow fadeInUp">
                    <p><?php echo $desc_about;?></p>
                    <div class="button-cta">
                        <a href="<?php echo base_url();?>about">
                            <div class="level">
                                <div class="level-left">
                                    <div class="level-item">
                                        <span>Kenali Nyat Kadir</span>
                                        <h3>Lebih dalam</h3>
                                    </div>
                                </div>
                                <div class="level-right">
                                    <div class="level-item">
                                        <a href="#"><span class="icon mdi mdi-chevron-right"></span></a>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div> <!-- kelar Button-CTA -->
                </div>
            </div> <!-- kelar Columns -->
        </div>
    </div> <!-- kelar Columns pas di bawah At A Glance -->
</section>

<section class="section article-section bb5px">
    <div class="container">
        <div class="section-title dark">
            <div class="iconic">
                <span class="icon mdi mdi-barley"></span>
            </div>
            <div>
                <h3>Infografis <span class="reddish">Nyat Kadir</span></h3>
                Visualisasi data berbagai macam hal dalam baluran infografis
            </div>
        </div>
        <div class="read-more">
            <a href="<?php echo base_url();?>article/infographic">Lihat semua <span class="icon mdi mdi-chevron-right"></span></a>
        </div>
        <div class="article-carousel four-item-carousel owl-carousel owl-theme">
        <?php
            if(!empty($listarticle)){
                foreach ($listarticle as $key => $article) {
                    if($article->idCAT == 1 OR $article->nameCAT == 'Infografis'){
        ?>
            <div class="card">
                <div class="card-image">
                    <div class="image is-square">
                        <img src="<?php echo $article->imageARTICLE;?>" alt="<?php echo $article->titleARTICLE;?>">
                        <span class="title"><?php echo $article->titleARTICLE;?></span>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="card-footer-item">
                        <span><?php echo date('d F Y', strtotime($article->createdateARTICLE));?></span>
                    </div>
                    <div class="card-footer-item">
                        <a href="<?php echo base_url();?>article/detail/<?php echo base64_encode($article->idARTICLE).'-'.seo_url($article->titleARTICLE);?>">Baca <span class="icon mdi mdi-chevron-right"></span></a>
                    </div>
                </div>
            </div>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
        </div> <!-- kelar Article-Carousel -->
    </div>
</section>

<section class="hero voting is-medium parallax-window" data-stellar-ratio="0.5">
    <div class="hero-body">
        <div class="container">
            <div class="columns">
                <div class="column is-one-third">
                    <div class="section-title dark">
                        <h3 class="mb10">Mau ikut <span class="yellowish">berpartisipasi</span> <br> dalam pemberian opini?</h3>
                        Hari di mana demokrasi merupakan hak-hak yang mutlak bagi seluruh rakyat. Semua suku bangsa yang ada di Indonesia, haruslah bersatu tanpa terkecuali.
                    </div>
                </div>
                <?php if(!empty($getpolling)){ ?>
                <div class="column">
                    <div class="content">
                    <?php if(!empty($message_choice)){ ?>
                        <div class="column">
                            <div class="successful box">
                                <article class="media">
                                    <div class="media-left">
                                        <figure class="image">
                                            <span class="icon is-large mdi mdi-trophy-award"></span>
                                        </figure>
                                    </div>
                                    <div class="media-content">
                                        <div class="content">
                                            <h3><?php echo $message_choice['title'];?></h3>
                                            <p><?php echo $message_choice['text'];?></p>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        </div>
                        <?php } ?>
                        <h3 class="title"><a href="<?php echo base_url();?>polling/detail/<?php echo base64_encode($getpolling->idPOLLING).'-'.seo_url($getpolling->questionPOLLING);?>"><?php echo $getpolling->questionPOLLING;?></a></h3>
                        <?php
                            if(!empty($check_choice_polling)){
                        ?>
                        <div class="field">
                            <div class="control">
                                <label class="radio">
                                    <h6 class="title">Anda telah memilih:</h6>
                                    <input type="radio" value="<?php echo $check_choice_polling->nameCHOICE;?>" required="required" checked>
                                    <?php echo $check_choice_polling->nameCHOICE;?>
                                </label>
                            </div>
                        </div>
                        <?php if(!empty($message_choice)){ ?>
                        <div class="column">
                            <div class="successful box">
                                <article class="media">
                                    <div class="media-left">
                                        <figure class="image">
                                            <span class="icon is-large mdi mdi-trophy-award"></span>
                                        </figure>
                                    </div>
                                    <div class="media-content">
                                        <div class="content">
                                            <h3><?php echo $message_choice['title'];?></h3>
                                            <p><?php echo $message_choice['text'];?></p>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="column"> <!--Hasil polling ya wak-->
                            <h6 class="title">Hasil Polling:</h6>
                            <div class="voting-result">
                                <?php
                                  if(!empty($number_voting)){
                                    foreach ($number_voting as $choice) {
                                      if($choice->idPOLLING == $check_choice_polling->idPOLLING){
                                        $total_vote = round(100*($choice->vote_value / $choice->total),2);
                                ?>
                                <h4 class="wow fadeInUp"><?php echo $choice->nameCHOICE;?> - <?php echo $total_vote;?>%</h4>
                                <progress class="progress is-primary wow fadeInUp" value="<?php echo $total_vote;?>" max="100"><?php echo $total_vote;?>%</progress>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                            <div class="share">
                                <h3>Share Polling ini:</h3>
                                <ul>
                                    <li class="wow fadeInUp">
                                        <a href="javascript:void(0)" onclick="javascript:genericSocialShare('http://twitter.com/share?text=Ikuti polling di nyatkadir.org dengan tema <?php echo $getpolling->questionPOLLING;?>&url=<?php echo base_url();?>polling/<?php echo base64_encode($getpolling->idPOLLING).'-'.seo_url($getpolling->questionPOLLING);?>')" title="Share to Twitter" data-wow-delay=".9s"><span class="icon mdi mdi-twitter"></span></a>
                                    </li>
                                    <li class="wow fadeInUp" data-wow-delay="1.1s">
                                        <a href="#" title="Share to Facebook" class="ShareFB"><span class="icon mdi mdi-facebook"></span></a>
                                    </li>
                                    <?php
                                        $content_wa = str_replace(' ','%20',$getpolling->questionPOLLING);
                                        $url_wa = "https://api.whatsapp.com/send?text=Ikuti%20polling%20di%20nyatkadir.org%20dengan%20tema%20".$content_wa." di ".base_url(uri_string());
                                    ?>
                                    <li class="wow fadeInUp" data-wow-delay="1.3s">
                                        <a href="javascript:void(0)" onclick="javascript:genericSocialShare('<?php echo $url_wa;?>')" title="Share to Whatsapp"><span class="icon mdi mdi-whatsapp"></span></a>
                                    </li>
                                    <li class="wow fadeInUp" data-wow-delay="1.5s">
                                        <a href="javascript:void(0)" onclick="javascript:genericSocialShare('https://plus.google.com/share?url=<?php echo base_url();?>polling/<?php echo base64_encode($getpolling->idPOLLING).'-'.seo_url($getpolling->questionPOLLING);?>')" title="Share to Google+"><span class="icon mdi mdi-google-plus"></span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <?php } else { ?>
                        <form class="" action="<?php echo base_url();?>polling/submit_polling" method="POST">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                            <input type="hidden" name="idUSER" value="<?php echo $this->session->userdata('idUSER');?>">
                            <input type="hidden" name="idPOLLING" value="<?php echo $getpolling->idPOLLING;?>" required="required">
                            <div class="field">
                                <div class="control">
                                    <?php
                                    $data_polling = json_decode($getpolling->answerPOLLING,TRUE);
                                    foreach ($data_polling as $value) {
                                        ?>
                                        <label class="radio">
                                            <input type="radio" name="answer" value="<?php echo $value[0];?>" required="required">
                                            <?php echo $value[0];?>
                                        </label>
                                        <?php } ?>
                                </div>
                            </div>
                                <div class="field">
                                    <div class="control">
                                        <input type="submit" value="Submit" class="button is-link">
                                    </div>
                                </div>
                        </form>
                        <?php } ?>
                    </div>
                </div>
            <?php } else { ?>
                <div class="column pl4em">
                    <div class="successful box">
                        <article class="media">
                            <div class="media-left">
                                <figure class="image">
                                    <span class="icon is-large mdi mdi-trophy-award"></span>
                                </figure>
                            </div>
                            <div class="media-content">
                                <div class="content">
                                    <h3>Mohon Maaf!</h3>
                                    <p>Tidak ada polling untuk saat ini.</p>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            <?php } ?>
            </div> <!-- kelar div Columns -->
        </div>
    </div> <!-- kelar Hero-Body -->
</section>

<section class="section news-section">
    <?php
        $is_home_video = select_video_gallery_at_home();
        if(!empty($is_home_video)){
            $thumbnail = get_thumbnail_from_youtube($is_home_video->linkvideoGALLERY);
            $image = '<img class="img_thumb" src="'.$thumbnail.'" alt="'.$is_home_video->titleGALLERY.'"/>';
    ?>
    <section class="hero">
        <div class="container">
            <div class="video-pop">
                <figure class="image">
                    <img src="<?php echo $thumbnail;?>" alt="<?php echo $is_home_video->titleGALLERY;?>">
                </figure>
                <div class="caption">
                    <a data-fancybox href="<?php echo $is_home_video->linkvideoGALLERY;?>&amp;autoplay=1&amp;rel=0&amp;controls=0&amp;showinfo=0" class="icon play-button"><i class="mdi mdi-play"></i></a>
                    <span class="title"><?php echo $is_home_video->titleGALLERY;?></span>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>
    <div class="container">
        <div class="section-title">
            <h3>Berita dan Event <span class="reddish">Nyat Kadir</span></h3>
            Segala hal yang Nyat Kadir lakukan baru-baru ini
        </div>
        <div class="columns">
            <div class="column is-half news-started">
                <div class="box wow fadeInUp">
                    <?php
                        if(!empty($updated_at_home)){
                            foreach ($updated_at_home as $key => $updated) {
                    ?>
                    <div class="media wow fadeInUp">
                        <div class="media-content">
                            <div class="content">
                                <h3><?php echo $updated->titleNEWS;?></h3>
                                <?php echo word_limiter($updated->descNEWS,35);?>
                                <span class="wow fadeInUp" data-wow-delay=".5s">0<?php echo $key+1;?></span>
                                <a href="<?php echo base_url();?>news/detail/<?php echo base64_encode($updated->idNEWS).'-'.seo_url($updated->titleNEWS);?>">Selengkapnya <i class="icon mdi mdi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
            <div class="column parallax-window" data-stellar-background-ratio="0.5">
                <figure class="image">
                    <img src="<?php echo base_url().$this->data['asfront'];?>img/looking.jpg" alt="">
                </figure>
                <div class="read-more">
                    <h4>Lihat semua <br> <span class="yellowish">Berita dan Event</span></h4>
                    <a href="<?php echo base_url();?>news"><span class="icon mdi mdi-chevron-right"></span></a>
                </div>
            </div>
        </div> <!-- kelar div Columns -->
    </div>
</section>

<section class="section partner">
    <div class="container">
        <div class="section-title">
            <h3>Mitra Kerja <span class="reddish">Nyat Kadir</span></h3>
            Instansi-instansi yang menjadi kolega sekaligus mitra dalam bidang profesional Nyat Kadir
        </div>
        <div class="five-item-carousel owl-carousel owl-theme">
        <?php
            if(!empty($listmitra)){
                foreach ($listmitra as $key => $mitra) {
        ?>
            <figure class="image">
                <img src="<?php echo $mitra->imageMITRA;?>" alt="<?php echo $mitra->nameMITRA;?>">
                <figcaption><a href="#" target="_blank"><?php echo $mitra->nameMITRA;?></a></figcaption>
            </figure>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</section>
