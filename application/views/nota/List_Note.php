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
                <span class="title">Note</span>
                <span class="subtitle">Evernote Ucab</span>
            </div>
            <!-- ENDS title -->
            <?php
            $attributes = array('id' => 'sc-modify-form');
            echo form_open('/homeuser/index/' . $username, $attributes);
            ?>
            <fieldset>
                <?php
                echo $uploadNote;
                ?>

        </div>
        </fieldset>
        <?php echo form_close(); ?>
    </div>


    <!-- ENDS form -->
    <!-- END Login -->


    <!-- ENDS 2 cols -->
</div>
<!-- ENDS wrapper-main -->
</div>