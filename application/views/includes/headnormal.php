<body>
        <!-- HEADER -->
        <div id="header">
            <!-- wrapper-header -->
            <div class="wrapper">
                <a href="index.html"><img id="logo" src="<?php echo base_url(); ?>img/logo.png" alt="" /></a>
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