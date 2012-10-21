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
                <span class="title">Modify Book</span>
                <span class="subtitle">Evernote Ucab</span>
            </div>
            <!-- ENDS title -->

      
     
                         <div class="centrar"> 
                <?php
               $attributes = array('id' => 'sc-modify-form');
               echo form_open('/Libreta/ModifyBook/'.$username.'/'.$libreta,$attributes);
                ?>
                <fieldset>
                    <div>
                        <label>Titulo</label>
                        <?php 
                         $query = $this->db->query("select id_libreta,nombre,descripcion,fecha from libreta where id_libreta ='$libreta'");	
                         
                        ?>
                         <input name="titulo"  id="titulo" value ='<?php echo $query->row()->nombre ?>'
                               type="text" class="form-poshytip" title="Enter a tittle" />
                    </div>
                    <div>
                        <label>Descripcion</label>
                        <textarea name="descrip" id="descrip"  cols="30" rows="6" class="form-poshytip" title="Description"><?php echo $query->row()->descripcion ?></textarea>
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