
<div class="wrapper">
    <div id="content">
        <div id="page-title">
            <span class="title">Configurate Dropbox Account</span>

        </div>


        <div class="centrar">

            <?php
            $attributes2 = array('id' => 'sc-contact-form');
            echo form_open('/usuario/guardarDatosDropbox/' . $username, $attributes2);
            ?>
            <fieldset>
                <div>
                    <label>Email</label>
                    <input name="email_signup"  id="email_signup" type="email" class="form-poshytip" title="Enter your email" />
                </div>
                <div>
                    <label>Password</label>
                    <input name="pass_signup"  id="pass_signup" type="password" class="form-poshytip" title="Enter a password 6-12 characters" />
                </div>


                <p><input type="submit" value="Save" name="submit" id="submit" /></p>
            </fieldset>
            <?php echo form_close(); ?>
            <!-- ENDS form -->
        </div>

    </div>

</div>

