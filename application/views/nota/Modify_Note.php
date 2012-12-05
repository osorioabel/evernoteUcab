<?php
if ($messi)
    echo $messi;
?><!-- MAIN -->
<div id="main">

    <div class="wrapper">
        <!-- content -->
        <!-- title -->
        <div id="page-title">
            <span class="title">Select a Note</span>
            <span class="subtitle">Evernote Ucab</span>
        </div>
        <div id="main">
            <div class="wrapper">		
                <!-- content -->
                <div id="content"> 
                    <div id="projects-list">

                        <!-- project -->
                       <?php 
                 if (isset($records)):

                            foreach ($records as $c):
                                $attributes = array('id' => 'sc-contact-form');

                                $ref = base_url() . 'nota/indexModify2/' . $username . '/' . $c->id_nota . '>';
                                $ref2 = base_url() . 'nota/indexModify2/' . $username . '/' . $c->id_nota;
       
                       
                       
                       
               echo form_open('/nota/indexModify2/' . $username . '/' . $c->titulo, $attributes);
                    
                ?>
                 <div class='project'>
                          <h1><a href="<?php echo $ref ?>"> <?php echo $c->titulo ?> </a></h1>
                          
                           
                                <!-- shadow -->
                                <div class='project-shadow'>
                                    <!-- project-thumb -->
                                    <div class='project-thumbnail'>
            

                                        <!-- meta -->
                                        <ul class='meta'>
                                            
                                            
                                            
                                            <li><strong>Project date</strong> <? echo $c->fecha_creacion ?> </li>
                                            <li><strong>username</strong> <? echo $username ?> </li>
                                        </ul>
                                        <!-- ENDS meta -->

                                        <a href="<?php echo $ref2 ?>" class='cover'><img src='/evernoteUcab/images/nota.png' alt='Feature image' /></a>
                                    </div>
                                    <!-- ENDS project-thumb -->

                                    <div class='the-excerpt'>
                                               <?php echo $c->texto?> 
                                        
                                    </div>	
                                 
             </div>
                                <!-- ENDS shadow -->
                            </div>
                            <!-- ENDS project -->
              <?php echo form_close(); 
                                       endforeach;

                        endif;
                          ?>    
                    </div> 
                    <!-- ENDS pagination -->
<?php echo $this->pagination->create_links(); ?> 
                </div> 
            </div> 
        </div>                
        <!-- ENDS form -->
        <!-- END Login -->
        <!-- ENDS 2 cols -->

        <!-- ENDS wrapper-main -->
    </div>
