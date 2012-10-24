
 <div class="wrapper">
<div id="content">
<div id="page-title">
                <span class="title">Modify User</span>
                
            </div>

           
                 <div class="centrar">
                
                <?php
                $attributes2 = array('id' => 'sc-modify-form');
                 echo form_open('/Usuario/modificar/'. $username, $attributes2);
                ?>
                <fieldset>
                    <div>
                        <label>Name</label>
                        <input name="name_modify"  id="name_modify" type="text" class="form-poshytip" title="Enter your name" />
                    </div>
                    <div>
                        <label>Lastname</label>
                        <input name="lastname_modify"  id="lastname_modify" type="text" class="form-poshytip" title="Enter your lastname" />
                    </div>
                    <div>
                        <label>Email</label>
                        <input name="email_modify"  id="email_modify" type="email" class="form-poshytip" title="Enter your email" />
                    </div>
                                            
                    <p><input type="submit" value="Modify" name="submit" id="submit" /></p>
                </fieldset>
                <?php echo form_close(); ?>
                <!-- ENDS form -->
            </div>

</div>

</div>


