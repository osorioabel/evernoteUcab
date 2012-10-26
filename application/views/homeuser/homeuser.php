
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
                                 <?php		
                  $query = $this->db->query("select l.id_libreta,l.nombre,l.descripcion,l.fecha from libreta l, usuario u where u.username = '$username' and u.id_usuario = l.fk_usuario");		
                   if ($query->num_rows() > 0){ 
                      $row = $query->num_rows();
                      $row2 = $query->row();   
		    for ($i = 0; $i < $row ; $i++){	  
                        
                        if ($i < 3)
                        {
                            ?>  
                        <li>
                            <a title="An image"><img src="<?php echo base_url(); ?>images/home.png" /></a>
                            <div class="excerpt">
                   
             
                                <a class="header"><?php echo $row2->nombre ?></a>
                                <?php echo $row2->descripcion ?>
                            </div>
                           
                        </li>
                                       <?php
                        }            
       $row2 = $query->next_row();     

}
}
?> 
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

