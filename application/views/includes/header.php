<!DOCTYPE  html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo $title; ?></title>

        <!-- CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/social-icons.css" type="text/css" media="screen" />
       
        <!-- JS -->
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.5.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui-1.8.13.custom.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/easing.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.scrollTo-1.4.2-min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.cycle.all.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/custom.js"></script>

        <!-- Isotope -->
        <script src="<?php echo base_url(); ?>js/jquery.isotope.min.js"></script>

      


        <!-- Nivo slider -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/nivo-slider.css" type="text/css" media="screen" />
        <script src="<?php echo base_url(); ?>js/nivo-slider/jquery.nivo.slider.js" type="text/javascript"></script>
        <!-- ENDS Nivo slider -->

        <!-- tabs -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/tabs.css" type="text/css" media="screen" />
        <script type="text/javascript" src="<?php echo base_url(); ?>js/tabs.js"></script>
        <!-- ENDS tabs -->

        <!-- prettyPhoto -->
        <script type="text/javascript" src="<?php echo base_url(); ?>js/prettyPhoto/js/jquery.prettyPhoto.js"></script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>js/prettyPhoto/css/prettyPhoto.css" type="text/css" media="screen" />
        <!-- ENDS prettyPhoto -->

        <!-- superfish -->
        <link rel="stylesheet" media="screen" href="<?php echo base_url(); ?>css/superfish.css" /> 
        <link rel="stylesheet" media="screen" href="<?php echo base_url(); ?>css/superfish-left.css" /> 
        <script type="text/javascript" src="<?php echo base_url(); ?>js/superfish-1.4.8/js/hoverIntent.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/superfish-1.4.8/js/superfish.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/superfish-1.4.8/js/supersubs.js"></script>
        <!-- ENDS superfish -->

        <!-- poshytip -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>js/poshytip-1.0/src/tip-twitter/tip-twitter.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>js/poshytip-1.0/src/tip-yellowsimple/tip-yellowsimple.css" type="text/css" />
        <script type="text/javascript" src="<?php echo base_url(); ?>js/poshytip-1.0/src/jquery.poshytip.min.js"></script>
        <!-- ENDS poshytip -->

        <!-- Tweet -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery.tweet.css" media="all"  type="text/css"/> 
        <script src="<?php echo base_url(); ?>js/tweet/jquery.tweet.js" type="text/javascript"></script> 
        <!-- ENDS Tweet -->

        <!-- Fancybox -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>js/jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
        <!-- ENDS Fancybox -->



    </head>

    <body>

        <!-- HEADER -->
        <div id="header">
            <!-- wrapper-header -->
            <div class="wrapper">
                <a href="index.html"><img id="logo" src="<?php echo base_url(); ?>img/logo.png" alt="Nova" /></a>
                <!-- search -->
                <div class="top-search">
                    <form  method="get" id="searchform" action="#">
                        <div>
                            <input type="text" value="Search..." name="s" id="s" onfocus="defaultInput(this)" onblur="clearInput(this)" />
                            <input type="submit" id="searchsubmit" value=" " />
                        </div>
                    </form>
                </div>
                <!-- ENDS search -->
            </div>
            <!-- ENDS wrapper-header -->					
        </div>
        <!-- ENDS HEADER -->


        <!-- Menu -->
        <div id="menu">



            <!-- ENDS menu-holder -->
            <div id="menu-holder">
                <!-- wrapper-menu -->
                <div class="wrapper">
                    <!-- Navigation -->
                    <ul id="nav" class="sf-menu">
                        <li><a href="index.html">Home<span class="subheader">Welcome</span></a></li>
                        <li><a href="features.html">Features<span class="subheader">Awesome options</span></a>
                            <ul>

                                <li><a href="features-columns.html"><span> Columns layout</span></a></li>
                                <li><a href="features-accordion.html"><span> Accordion</span></a></li>
                                <li><a href="features-toggle.html"><span> Toggle box</span></a></li>
                                <li><a href="features-tabs.html"><span> Tabs</span></a></li>
                                <li><a href="features-infobox.html"><span> Text box</span></a></li>
                                <li><a href="features-monobox.html"><span> Icons</span></a></li>
                            </ul>
                        </li>
                        <li class="current-menu-item"><a href="blog.html">Blog<span class="subheader">Read our posts</span></a></li>
                        <li><a href="portfolio.html">Portfolio <span class="subheader">Showcase work</span></a></li>
                        <li><a href="gallery.html">Gallery<span class="subheader">Featured work</span></a>
                            <ul>
                                <li><a href="gallery.html"><span> Four columns</span></a></li>
                                <li><a href="gallery-3.html"><span> Three columns </span></a></li>
                                <li><a href="gallery-2.html"><span> Two columns </span></a></li>
                                <li><a href="video-gallery.html"><span> Video gallery </span></a></li>
                            </ul>
                        </li>
                        <li><a href="contact.html">Contact<span class="subheader">Get in touch</span></a></li>
                    </ul>
                    <!-- Navigation -->
                </div>
                <!-- wrapper-menu -->
            </div>
            <!-- ENDS menu-holder -->
        </div>
        <!-- ENDS Menu -->