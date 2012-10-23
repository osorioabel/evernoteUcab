<?php
       if ($messi)
        echo $messi;

?><!-- MAIN -->
<div id="main">

<div class="wrapper">

        <!-- content -->
        <div id="content">

            <!-- title -->
            <div id="page-title">
                <span class="title">Note</span>
                <span class="subtitle">Evernote Ucab</span>
            </div>
            <!-- ENDS title -->

      
     
                         <div class="centrar"> 
                <?php
               $attributes = array('id' => 'sc-modify-form');
               echo form_open('/homeuser/index/'.$username,$attributes);
                ?>
                <fieldset>
                 
                   
                   <div>
                      
                        
                           
                            <?php
                            $query = $this->db->query("select titulo,texto from nota where id_libreta = '$id'");
                            if ($query->num_rows() > 0) {
                                $row = $query->num_rows();
                                $row2 = $query->row();
                                for ($i = 0; $i < $row; $i++) {
                                    ?>
                                    
                                    
                                        
                                        
                                             <div id="page-content">
                       <div>
                    <h6 class="toggle-trigger"><a href="#"><?php echo $row2->titulo ?> </a></h6>
							<div class="toggle-container">
							    <div class="block">
								<p><?php echo $row2->texto?></p>
							    </div>
							</div>

                    </div>
                    
                    </div>
                                        
                                        
                                        
                                        <?php
                                    $row2 = $query->next_row();
                                }
                            }
                            ?>
                      
                    </div>
               
                    <p><input type="submit" value="Accept" name="submit" id="submit" /></p>
                </fieldset>
                   <?php echo form_close(); ?>
              </div>
               

                <!-- ENDS form -->
                <!-- END Login -->
          
        
            <!-- ENDS 2 cols -->
        </div>
        <!-- ENDS wrapper-main -->
    </div>