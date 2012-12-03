<?php
if ($messi)
    echo $messi;
?><!-- MAIN -->
<div id="main">

    <div class="wrapper">

        <!-- content -->


        <!-- title -->
        <div id="page-title">
            <span class="title">Modify a Book</span>
            <span class="subtitle">Evernote Ucab</span>
        </div>






        <div id="main">
            <div class="wrapper">		

                <!-- content -->
                <div id="content"> 
                    <div id="projects-list">

                        <!-- project -->
                        <?php
                        echo $upload;
   
        
                                     
        


if(isset($records)):

foreach($records as $c):

echo $c->nombre;

endforeach;

endif; //endif



echo $this->pagination->create_links();
                  //    echo $this->table->generate($records);
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
