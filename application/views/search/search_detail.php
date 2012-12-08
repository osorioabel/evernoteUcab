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
                <span class="title">Detail Note</span>
                <span class="subtitle">Evernote Ucab</span>
            </div>
            <!-- ENDS title -->



            <div class="centrar"> 
                <?php
                if (isset($records)):

                     foreach ($records as $c):
                $attributes = array('id' => 'sc-contact-form');
                
                echo form_open('/homeuser/index/', $attributes);
                ?>
                <fieldset>
                    
         <div>
        <label>Titulo</label>
         <input name='tittleNote'  id='tittleNote' value ='<?php echo $c->titulo ?>'
               type='text'readonly ="true" class='form-poshytip' title='tittle' />
         <label>Tags</label>
        </div>
                    <label>
          <?php
          
                    if (isset($records2)):

                     foreach ($records2 as $s):   ?>          
          
        <?php echo '#'.$s->texto. ' ' ?>
         
                   
                    
             <?php 
                             endforeach;

                        endif;?> 
                </label>        
                    
        <div>
        <label>Note</label>
        <textarea name='Note' id='Note'  cols='30' rows='6' class='form-poshytip' readonly ="true" title='Note'><?php echo $c->texto ?></textarea>
            </div>
                    
                    
                    <p><input type="submit" value="Accept" name="submit" id="submit" /></p>
                </fieldset>
                <?php echo form_close(); 
                             endforeach;

                        endif;?>
            </div>


            <!-- ENDS form -->
            <!-- END Login -->


            <!-- ENDS 2 cols -->
        </div>
        <!-- ENDS wrapper-main -->
    </div>