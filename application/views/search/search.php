<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div id="main">
    <div class="wrapper">
        <!-- content -->
        <div id="content">
            <!-- title -->
            <div id="page-title">
                <span class="title">Search</span>
                <span class="subtitle">Evernote Ucab</span>
            </div>
            
              <?php
                $attributes = array('id' => 'sc-contact-form');
                echo form_open('/search/indexsearchresult/'. $username, $attributes);
                ?>
            <fieldset>
             <div>
                        <label>WTF</label>
                        <input name="goal"  id="tittleNote" 
                               type="text" class="form-poshytip"  title="Enter a tittle" />
            </div>
                 <p><input type="submit" value="Search" name="submit" id="submit" /></p>
                       </fieldset>
                  <?php echo form_close(); ?>
         </div>
        
    </div>
    
 </div>    