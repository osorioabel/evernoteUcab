
<?php
     if($messi)   
     echo $messi;
?>
<!-- Slider -->
<div id="slider-block">
    <div id="slider-holder">
        <div id="slider">
            <a href="http://www.luiszuno.com"><img src="<?php echo base_url(); ?>images/Servicios1.jpg" title="Visit my web site regularly and get freebies each week!" alt="" /></a>
            <a href="http://themeforest.net/user/Ansimuz/portfolio?ref=ansimuz"><img src="<?php echo base_url(); ?>images/Cloud1.jpg" title="Support the freebies buying high quality premium themes from my portfolio at themeforest" alt="" /></a>
        </div>
    </div>
</div>
<!-- ENDS Slider -->

<!-- MAIN -->
<div id="main">
    <!-- wrapper-main -->
    <div class="wrapper">

        <!-- headline -->
        



        <!-- content -->
        <div id="content">

            <!-- TABS -->
            <!-- the tabs -->
            <ul class="tabs">
                <li><a href="#"><span>Last Books</span></a></li>
               
            </ul>

            <!-- tab "panes" -->
            <div class="panes">

                <!-- Posts -->
                 <div>
                    <ul class="blocks-thumbs thumbs-rollover">
                        <?php echo $upload; ?>        
                    </ul>
                </div>
                <!-- ENDS posts -->


            </div>
            <!-- ENDS TABS -->



        </div>
        <!-- ENDS content -->
    </div>
    <!-- ENDS wrapper-main -->
</div>
<!-- ENDS MAIN -->

