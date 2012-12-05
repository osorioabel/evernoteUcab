
<div class="wrapper">
    <div id="content">
        <div id="page-title">
            <span class="title">Modify User</span>

        </div>


        <div class="centrar">

            <?php
            $attributes2 = array('id' => 'sc-contact-form');
            echo form_open('/usuario/modificar/' . $username, $attributes2);
            ?>
            <fieldset>
                <?php echo $upload; ?>

                <p><input type="submit" value="Modify" name="submit" id="submit" /></p>
            </fieldset>
            <?php echo form_close(); ?>
            <!-- ENDS form -->
        </div>

    </div>

</div>


