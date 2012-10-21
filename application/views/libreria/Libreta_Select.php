<?php
       if ($messi)
        echo $messi;

?><!-- MAIN -->
<div id="main">

<div class="wrapper">

        <!-- content -->
       

            <!-- title -->
            <div id="page-title">
                <span class="title">Select a Book</span>
                <span class="subtitle">Evernote Ucab</span>
            </div>
        
     
           
             
                  
               
         <div id="main">
			<div class="wrapper">		
					
					<!-- content -->
					<div id="content"> 
                        <div id="projects-list">
        
                    	<!-- project -->
    <?php		
         $query = $this->db->query("select l.id_libreta,l.nombre,l.descripcion,l.fecha from libreta l, usuario u where u.username = '$username' and u.id_usuario = l.fk_usuario");		
           if ($query->num_rows() > 0){ 
              $row = $query->num_rows();
              $row2 = $query->row();   
		 for ($i = 0; $i < $row ; $i++){?>
               <?php
               $attributes = array('id' => 'sc-modify-form');
               echo form_open('/Libreta/DeleteBook/'.$username.'/'.$row2->nombre,$attributes);
                ?>
                          <div class="project">
                          <h1><a href="<?php echo base_url();?><?php echo '/Libreta/indexDelete/'.$username.'/'.$row2->nombre?>"> <?php echo $row2->nombre ?></a></h1>

                                <!-- shadow -->
                                <div class="project-shadow">
                                    <!-- project-thumb -->
                                    <div class="project-thumbnail">

                                        <!-- meta -->
                                        <ul class="meta">
                                            <li><strong>Project date</strong> <?php echo $row2->fecha ?> </li>
                                            <li><strong>username</strong> <a href="#"><?php echo $username ?></a></li>
                                        </ul>
                                        <!-- ENDS meta -->

                                        <a href="project.html" class="cover"><img src="<?php echo base_url(); ?>images/book.png"  alt="Feature image" /></a>
                                    </div>
                                    <!-- ENDS project-thumb -->

                                    <div class="the-excerpt">
                                        <?php echo $row2->descripcion ?>
                                    </div>	
                                   
                                    <a href="<?php echo base_url();?><?php echo '/Libreta/DeleteBook/'.$username.'/'.$row2->nombre?>" class="read-more link-button" name="<?php echo $row2->nombre ?>" id="<?php echo $row2->nombre ?>"><span>Delete it</span></a>
                                </div>
                                <!-- ENDS shadow -->
                            </div>
                            <!-- ENDS project -->
              <?php echo form_close(); ?>
                                 
                       
               <?php
       $row2 = $query->next_row();     

}
}
?>               
                </div> 
                       
                	
						<!-- ENDS pagination -->
		
					</div> 
                                    </div> 
                       </div>                
                
                 
            
               

                <!-- ENDS form -->
                <!-- END Login -->
          
        
            <!-- ENDS 2 cols -->
      
        <!-- ENDS wrapper-main -->
    </div>
