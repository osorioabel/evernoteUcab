
<?php
if ($messi)
    echo $messi;
?>
<!-- Slider -->
<div id="slider-block">
    <div id="slider-holder">
        <div id="slider">
            <a href="#"><img src="<?php echo base_url(); ?>images/Servicios1.jpg" title="Evernote Ucab is a proyect based on Cloud Computering, Cloud Storage " alt="" /></a>
            <a href="#"><img src="<?php echo base_url(); ?>images/Cloud1.jpg" title="Evernote Ucab let you have Remainders,Notes, Notebooks and More in one single web" alt="" /></a>
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

