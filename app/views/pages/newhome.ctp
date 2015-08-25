<nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="show-on-small navbar-brand page-scroll" href="#page-top"><span class="peter-name">Peter Pincus</span><span class='peter-title'>CERAMIC ARTIST</span></a>
            </div>

            <div class="collapse navbar-collapse show-on-big" style="position:relative;" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar">
                    <li>
                        <a class="page-scroll" href="#work">WORK</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#news">NEWS</a>
                    </li>
                    
                    <li>
                        <a class="page-scroll" href="#purchase">PURCHASE</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#about">ABOUT</a>
                    </li>
                </ul>
                <div class="show-on-big full-page-header-logo">
                        <span class="peter-name">Peter Pincus</span><span class='peter-title'>CERAMIC ARTIST</span>
                </div>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <header>
        <div class="header-content">
            <div class="header-content-inner">
            </div>
        </div>
    </header>

    <section class="bg-primary" id="work">
        <div class="container current-work-slider">
            <?php foreach ($newWorkCategories as $cat): 
            $imglist = '';
            foreach ($cat['Pieces'] as $p){ $imglist .= '/img/pieces/'.$p['filename'].',';}
                $imglist = substr($imglist, 0,-1);
?>
                <a class="fancybox" imglist="<?php echo $imglist ?>" title="<?php echo $cat['Category']['copy']; ?>">
                    <img src="<?php echo '/img/categories/'.$cat['Category']['filename']; ?>" alt="">
                    <div class="current-title"><?php echo $cat['Category']['title']; ?></div>
                </a>                
            <?php endforeach; ?>

        </div>
    </section>

    <section class="bg-primary" id="about">
        <div class="container">
            <div class="left">
            </div>
            <div class="right">
            </div>
        </div>
    </section>

    <section class="bg-primary" id="purchase">
        <div class="container">
            <?php debug($buyableWork); ?>
            <?php foreach ($buyableWork as $piece): 
            debug($work);?>
                <img class="thumb" title="<?php echo $piece['title']; ?>" alt="<?php echo $piece['description']; ?>" que="<?php echo $piece['id']; ?>" sale="<?php echo $piece['purchaseStatus']; ?>"  big="<?php echo $piece['filename']; ?>" pr="<?php echo $piece['price']; ?>" src="/img/pieces/<?php 
                        $ext = strtolower(substr(basename($piece['filename']), strrpos(basename($piece['filename']), ".") + 1)); 
                        $extLen = strlen($ext)+1;
                        $filename = substr_replace($piece['filename'],"_tn",strlen($piece['filename'])-$extLen,0);
                        echo $filename; ?>">            
            <?php endforeach; ?>
        </div>
    </section>

    <section class="bg-primary" id="news">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">We've got what you need!</h2>
                    <hr class="light">
                    <p class="text-faded">Start Bootstrap has everything you need to get your new website up and running in no time! All of the templates and themes on Start Bootstrap are open source, free to download, and easy to use. No strings attached!</p>
                    <a href="#" class="btn btn-default btn-xl">Get Started!</a>
                </div>
            </div>
        </div>
    </section>

    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">At Your Service</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-diamond wow bounceIn text-primary"></i>
                        <h3>Sturdy Templates</h3>
                        <p class="text-muted">Our templates are updated regularly so they don't break.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-paper-plane wow bounceIn text-primary" data-wow-delay=".1s"></i>
                        <h3>Ready to Ship</h3>
                        <p class="text-muted">You can use this theme as is, or you can make changes!</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-newspaper-o wow bounceIn text-primary" data-wow-delay=".2s"></i>
                        <h3>Up to Date</h3>
                        <p class="text-muted">We update dependencies to keep things fresh.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-heart wow bounceIn text-primary" data-wow-delay=".3s"></i>
                        <h3>Made with Love</h3>
                        <p class="text-muted">You have to make your websites with love these days!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="no-padding" id="portfolio">
        <div class="container-fluid">
            <div class="row no-gutter">
                <div class="col-lg-4 col-sm-6">
                    <a href="#" class="portfolio-box">
                        <img src="img/portfolio/1.jpg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Category
                                </div>
                                <div class="project-name">
                                    Project Name
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="#" class="portfolio-box">
                        <img src="img/portfolio/2.jpg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Category
                                </div>
                                <div class="project-name">
                                    Project Name
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="#" class="portfolio-box">
                        <img src="img/portfolio/3.jpg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Category
                                </div>
                                <div class="project-name">
                                    Project Name
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="#" class="portfolio-box">
                        <img src="img/portfolio/4.jpg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Category
                                </div>
                                <div class="project-name">
                                    Project Name
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="#" class="portfolio-box">
                        <img src="img/portfolio/5.jpg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Category
                                </div>
                                <div class="project-name">
                                    Project Name
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="#" class="portfolio-box">
                        <img src="img/portfolio/6.jpg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Category
                                </div>
                                <div class="project-name">
                                    Project Name
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <aside class="bg-dark">
        <div class="container text-center">
            <div class="call-to-action">
                <h2>Free Download at Start Bootstrap!</h2>
                <a href="#" class="btn btn-default btn-xl wow tada">Download Now!</a>
            </div>
        </div>
    </aside>

    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Let's Get In Touch!</h2>
                    <hr class="primary">
                    <p>Ready to start your next project with us? That's great! Give us a call or send us an email and we will get back to you as soon as possible!</p>
                </div>
                <div class="col-lg-4 col-lg-offset-2 text-center">
                    <i class="fa fa-phone fa-3x wow bounceIn"></i>
                    <p>123-456-6789</p>
                </div>
                <div class="col-lg-4 text-center">
                    <i class="fa fa-envelope-o fa-3x wow bounceIn" data-wow-delay=".1s"></i>
                    <p><a href="mailto:your-email@your-domain.com">feedback@startbootstrap.com</a></p>
                </div>
            </div>
        </div>
    </section>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <script src="js/underscore.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/jquery.fittext.js"></script>
    <script src="js/wow.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/creative.js"></script>

    <script src="js/fancybox/new.jquery.fancybox.js"></script>
    <script src="js/jquery.bxslider.js"></script>
    
    <script type="text/javascript">
        
        $(".current-work-slider a").click(function() {
            var that = $(this);
            var images =  that.attr('imglist').split(',');
            var title =  that.attr('title');
            var toOpen = _.map(images, function(img){ return {href: img, title: title} });
            $.fancybox.open(toOpen, {
                helpers : {
                    title: {
                        type: 'outside',
                        position: 'right'
                    }
                },
                nextEffect: 'none',
                prevEffect: 'none',
            });
        });

        $(document).ready(function(){
          $('.current-work-slider').bxSlider({
            slideWidth: 280,
            minSlides: 2,
            maxSlides: 3,
            moveSlides: 1,
            slideMargin: 30,
            infiniteLoop: false,
            pager: false,
          });
        });
    </script>
