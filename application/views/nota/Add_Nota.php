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
                <span class="title">Add note to a Book</span>
                <span class="subtitle">Evernote Ucab</span>
            </div>
            <!-- ENDS title -->

      
     
                         <div class="centrar"> 
                <?php
               $attributes = array('id' => 'sc-modify-form');
               echo form_open('/Nota/AddNote/'.$username,$attributes);
                ?>
                <fieldset>
                    <div>
                        <label>Tittle</label>
                        <input name="tittleNote"  id="tittleNote" 
                               type="text" class="form-poshytip" title="Enter a tittle" />
                    </div>
                    <div>
                        <label>Note</label>
                        <textarea name="Note"  id="note" cols="20" rows="3" class="form-poshytip" title="Note"></textarea>
                    </div>
                    
                    <div> 
                        <label>Which book?</label>
                        <select class="iclass" name="ListBook"  id="ListBook" >
                            <option value="NULL"></option>

                            <?php
                            $query = $this->db->query("select id_libreta,nombre from libreta");
                            if ($query->num_rows() > 0) {
                                $row = $query->num_rows();
                                $row2 = $query->row();
                                for ($i = 0; $i < $row; $i++) {
                                    ?>
                                    <option value=<?php echo $row2->id_libreta ?>><?php echo $row2->nombre ?> </option>;
                                    <?php
                                    $row2 = $query->next_row();
                                }
                            }
                            ?>
                        </select>
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