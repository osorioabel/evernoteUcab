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
                <span class="title">Modify Note</span>
                <span class="subtitle">Evernote Ucab</span>
            </div>
            <!-- ENDS title -->

      
     
                         <div class="centrar"> 
                <?php
               $attributes = array('id' => 'sc-modify-form');
               echo form_open('/Nota/ModifyNote/'.$username.'/'.$nota,$attributes);
                ?>
                <fieldset>
                    <div>
                        <label>Titulo</label>
                        <?php 
                         $query = $this->db->query("select id_nota,titulo,texto from nota where id_nota ='$nota'");	
                         
                        ?>
                         <input name="tituloNota"  id="titulo" value ='<?php echo $query->row()->titulo ?>'
                               type="text" class="form-poshytip" title="Enter a tittle" />
                    </div>
                    <div>
                        <label>Note</label>
                        <textarea name="texto" id="texto"  cols="30" rows="6" class="form-poshytip" title="Note"><?php echo $query->row()->texto ?></textarea>
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