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
                        <a class="page-scroll" href="#about">ABOUT</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#purchase">PURCHASE</a>
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

    <section class="bg-primary" id="news">
        <div class="container">
            <?php foreach ($news as $post): ?>
            <div class="newsPost">
                <div class="image">
                    <img src="<?php echo '/img/news/'.$post['News']['filename'] ?>">
                </div>
                <div class="news-copy">
                    <h1><?php echo $post['News']['title']; ?></h1>
                    <?php echo $textile->parse($post['News']['body']); ?>
                </div>
            </div>                 
            <?php endforeach; ?>

        </div>
    </section>


    <section class="bg-primary" id="about">
        <div class="container">
            <div class="left">
                <img src="/img/peter-about.jpg">
                <ul id="about-nav">
                    <li view="biography" class="link active">BIOGRAPHY</li>
                    <li view="statement" class="link" >STATEMENT</li>
                    <li><a href="PincusPeter_Resume_2015.pdf" target="_blank">CV</a></li>
                    <li><a href="mailto:pjpincus1@gmail.com">CONTACT</a></li>
                </ul>
            </div>
            <div class="right">
                <div class="active" id="biography">
                    <p>Born in Rochester, NY, Peter Pincus is a ceramic artist and instructor. He joined the School for American Crafts as Visiting Assistant Professor in Ceramics in Fall 2014. Peter received his BFA (2005) and MFA (2011) in ceramics from Alfred University, and in between was a resident artist at the Mendocino Art Center in Mendocino,California. Since graduate school, Peter worked as the Studio Manager and Resident Artist Coordinator of the Genesee Center for Arts and Education in Rochester, NY, Adjunct Professor of three dimensional studies at Roberts Wesleyan College and has established a studio in Penfield NY. </p>

                    <p>Peter works in colored porcelain to create three dimensional paintings out of pots. His work has been exhibited in venues such as the Museum of Contemporary Craft, John Michael Kohler Arts Center, San Angelo Museum of Fine Arts, Icheon World Ceramics Center, AKAR Gallery, TRAX Gallery, Plinth Gallery, the Art of the Pot studio tour, the American Pottery Festival, Greenwich House Pottery and National Council on Education for the Ceramic Art. A recipient of the NICHE award for slip cast ceramics, Peter's work can be found in numerous private and public collections. In 2012, Ceramics Monthly featured Peter's work on the cover and in the article "Painting Pots from the Inside."</p>
                </div>
                <div id="statement">
                    <!--<p>As an early career ceramic artist, I am part of a lively and rapidly changing conversation in which the worlds of art, craft, and design are increasingly defined not only by their distinctions, but also by their similarities and relationships to one another.  I’ve found meaning in the ceramic vessel as it relates to this conversation.  I aim to engage in my studio practice and subsequent output with equivalent rigor in workmanship, use, design, and metaphor.</p>

					<p>I produce three-dimensional paintings out of pots.  My objective is to study and make objects that have a distinct location in the home, using our familiarity toward them to instigate new discussions about the role of the vessel in our place and time.  I focus on containers that are status symbols saved for special occasions, generally deemed distinct because of the value of what they hold rather than for what they are.  But to me, in between such occasions, they become canvases that visually illustrate the defining spirit of the times.  They are useful as well as opulent.  But they can be so much more.</p>-->
					<p>What started as my curiosity for pottery and vessel has extended to include painting and sculpture, and my present work is evidence of that evolution. I believe that color interaction can elicit new ways of seeing so I have dedicated the last five years to its study. Frequently, I elect to stage conflict by introducing an assertive color field to an equally emphatic form. This friction augments and enriches perceptions of space.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-primary" id="purchase">
        <div class="container">
            <h1>For the time being, visit these galleries to inquire/purchase my current work:</h1>
            <ul id="galleries">
                <li>
                    <a href="http://www.wexlergallery.com/artists/ceramic-mixedmedia/Pincus_Peter/index.php" target="_blank">
                        <img src="img/wexler.png">
                    </a>
                </li>
                <li>
                    <a href="http://ferrincontemporary.com/portfolio-items/peter-pincus/" target="_blank">
                        <img src="img/ferrin.png">
                    </a>
                </li>
                <li>
                    <a href="http://www.artisangal.com/peter-pincus" target="_blank">
                        <img src="img/artisan.png">
                    </a>
                </li>
                <li>
                    <a href="http://www.studiokotokoto.com/" target="_blank">
                        <img src="img/koto.png">
                    </a>
                </li>
            </ul>



            <?php if (false): ?>
            <?php foreach ($buyableWork as $piece): ?>
                <div class="buyable">
                    <a class="work_thumb_<?php echo $piece['Piece']['id']; ?>"><img class="thumb" title="<?php echo $piece['Piece']['title']; ?>" alt="<?php echo $piece['Piece']['description']; ?>" big="<?php echo $piece['Piece']['filename']; ?>" src="/img/pieces/<?php 
                    $ext = strtolower(substr(basename($piece['Piece']['filename']), strrpos(basename($piece['Piece']['filename']), ".") + 1)); 
                    $extLen = strlen($ext)+1;
                    $filename = substr_replace($piece['Piece']['filename'],"_buy",strlen($piece['Piece']['filename'])-$extLen,0);
                    echo $filename; ?>"></a>
                    <p class="piecetitle"><?php echo $piece['Piece']['title'] ?></p>
                    <?php if ($piece['Piece']['purchaseStatus'] == 'sold'): ?>
                        <p class="sold-piece" que='<?php echo $piece['Piece']['id'] ?>'><img src="/img/sold_new.png">&nbsp;SOLD</p>
                    <? else: ?>
                        <p class="purchase-price" que='<?php echo $piece['Piece']['id'] ?>'>$<?php echo $piece['Piece']['price'] ?></p>
                    <? endif; ?>
                    <div style="display:none;" id="title_<?php echo $piece['Piece']['id']; ?>">
                        <?php echo $textile->parse($piece["Piece"]["description"]).'<br><br><a class="inboxbuy" que="'.$piece["Piece"]["id"].'">$'.$piece["Piece"]["price"]. '- PURCHASE</a>'; ?>
                    </div>
                </div>

            <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>

<footer id="footer">
    <div class="container">
        <a href="http://www.instagram.com/peterpincusporcelain"><img src="/img/instagram-small.png"></a>
        <span>&copy;&nbsp;Peter Pincus <?php echo date('Y'); ?></span>

    </div>
</footer>

    

    

    

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
    <script>
    $('P.purchase-price').on('click', function(){
        $.fancybox({
                minHeight   : 400,
                minWidth    : 350,
                maxWidth    : 400,              
                fitToView   : false,
                closeClick  : false,
                openEffect  : 'none',
                closeEffect : 'none',
                type: 'iframe', 
                href: '/pages/order/'+$(this).attr('que')
            });
    });
    $('A.inboxbuy').on('click', function(){
        $.fancybox.close();
        $.fancybox({
                minHeight   : 400,
                minWidth    : 350,
                maxWidth    : 400,              
                fitToView   : false,
                closeClick  : false,
                openEffect  : 'none',
                closeEffect : 'none',
                type: 'iframe', 
                href: 'http://peterpincus.com/pages/order/'+$(this).attr('que')
            });
    });
    
    <? foreach ($buyableWork as $piece): ?>

            $('.work_thumb_<?= $piece["Piece"]["id"]; ?>').click(function(){
                $.fancybox.open([
                    {href : '/img/pieces/<?= $piece["Piece"]["filename"]; ?>'},
                    <? foreach ($piece['Images'] as $k=>$img): ?>
                    {href : '/img/pieces/<?= $img["filename"]; ?>'}, 
                    <? endforeach; ?>
                    ],
                    {
                        'margin'        : 0,
                        'padding'       : 0,
                        'prevEffect'    : 'fade',
                        'nextEffect'    : 'fade',
                            fitToView   : false,
                            closeClick  : false,
                            openEffect  : 'none',
                            closeEffect : 'none',
                            maxHeight   : 600,
                            helpers : {
                                title : {
                                    type : 'inside'
                                }
                            },
                            beforeLoad: function() {
                                var el
                                el = $('#title_' + <?= $piece["Piece"]["id"]; ?>);
                                if (el.length) {
                                    this.title = el.html();
                                }
                            }
                    });
                    
                });
<?php endforeach; ?>



// ABOUT SECTION

$("#about .left UL#about-nav li.link").click(function(){
    var that = $(this);
    $("#about .left UL#about-nav li.link").removeClass('active');
    that.addClass('active');
    $("#about .right div").css('display','none');
    $("#about .right div#"+that.attr('view')).css('display','block');
})
</script>
