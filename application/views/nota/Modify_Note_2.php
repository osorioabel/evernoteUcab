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
                $attributes = array('id' => 'sc-contact-form');
                echo form_open('/nota/ModifyNote/' . $username . '/' . $nota, $attributes);
                ?>
                <fieldset>
                     <?php echo $upload;?>
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