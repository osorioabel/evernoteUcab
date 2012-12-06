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
                <span class="title">Create Book</span>
                <span class="subtitle">Evernote Ucab</span>
            </div>
            <!-- ENDS title -->



            <div class="centrar"> 
                <?php
                $attributes = array('id' => 'contactForm');
                echo form_open('/libreta/AddBook/' . $username, $attributes);
                ?>
                <fieldset>
                    <div>
                        <label>Title</label>
                        <input name="tituloBook"  id="tituloBook" 
                               type="text" class="form-poshytip" title="Enter a tittle" />
                    </div>
                    <div>
                        <label>Description</label>
                        <textarea name="descrip"  id="descrip" cols="20" rows="3" class="form-poshytip" title="Description"></textarea>
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