
 <div class="wrapper">
<div id="content">
<div id="page-title">
                <span class="title">Change Password</span>
                
            </div>

           
                 <div class="centrar">
                
                <?php
                $attributes2 = array('id' => 'sc-contact-form');
                 echo form_open('/Usuario/cambiarPassword/'. $username, $attributes2);
                ?>
                <fieldset>
                     <div>
                        <label>Password</label>
                        <input name="pass_signup"  id="pass_signup" type="password" class="form-poshytip" title="Enter a password 6-12 characters" />
                    </div>
                    <div>
                        <label>Re-enter Password</label>
                        <input name="repass_signup"  id="repass_signup" type="password" class="form-poshytip" title="Re-Enter a password " />
                    </div>
                    
                    <p><input type="submit" value="Change" name="submit" id="submit" /></p>
               </fieldset>
                <?php echo form_close(); ?>
                <!-- ENDS form -->
            </div>

</div>

</div>

