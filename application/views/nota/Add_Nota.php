<?php
if ($messi)
    echo $messi;
?><!-- MAIN -->

<link href="<?php echo base_url(); ?>css/ui-lightness/jquery-ui-1.8.14.custom.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>css/fileUploader.css" rel="stylesheet" type="text/css" />

<script src="<?php echo base_url(); ?>js/jquery-ui-1.8.14.custom.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/jquery.fileUploader.js" type="text/javascript"></script>
<script   > 

   $(document).ready(function() {
      
       $('#Tag2').hide();
       $('#Tag3').hide();
       $('#Tag4').hide();
        $('#Tag5').hide();
       $('#Tag6').hide();
       $('#Tag7').hide();
       $('#Tag8').hide();
       $('#Tag9').hide();
       $('#Tag10').hide();
       $('#TagN').hide();
       var cont = 1;
       var miArray = new Array();
       $('#addme').click(function(){
           
           miArray[cont] = $('#Tag').val();
           
           $('#Tag'+cont).val($('#Tag'+cont).val());
           $('#TagN').val(cont);
           cont++;
          $('#Tag'+cont).show();
           
       
           
         
         
        
       }) // put all your jQuery goodness in here.
});




</script>

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


            <div class="one-half"> 
                <h6 class="line-divider">Note's Fields </h6>
                <p>Here you can write any note,reminders,text,and more..  
                    if you want Attach files 
                    .</p>
                <?php
                $attributes = array('id' => 'sc-contact-form');
                echo form_open('/nota/AddNote/' . $username, $attributes);
                ?>
                <fieldset>
                    <div>
                        <label>Tittle</label>
                        <input name="tittleNote"  id="tittleNote" 
                               type="text" class="form-poshytip" title="Enter a tittle" />
                    </div>
                    <div>
                        <label>Note</label>
                        <textarea name="Note"  id="Note" cols="20" rows="3" class="form-poshytip" title="Note" ></textarea>
                    </div>
                    <div>
                        <label>New Tag</label>
                        <input name="TagN" type="number"  id="TagN" cols="10" rows="2" class="form-poshytip" title="New Tag" ></input>
                        
                        <input name="Tag1"  id="Tag1" cols="10" rows="2" class="form-poshytip" title="New Tag" ></input>
                        <input name="Tag2"  id="Tag2" cols="10" rows="2" class="form-poshytip" title="New Tag" ></input>
                        <input name="Tag3"  id="Tag3" cols="10" rows="2" class="form-poshytip" title="New Tag" ></input>
                        <input name="Tag4"  id="Tag4" cols="10" rows="2" class="form-poshytip" title="New Tag" ></input>
                        <input name="Tag5"  id="Tag5" cols="10" rows="2" class="form-poshytip" title="New Tag" ></input>
                        <input name="Tag6"  id="Tag6" cols="10" rows="2" class="form-poshytip" title="New Tag" ></input>
                        <input name="Tag7"  id="Tag7" cols="10" rows="2" class="form-poshytip" title="New Tag" ></input>
                        <input name="Tag8"  id="Tag8" cols="10" rows="2" class="form-poshytip" title="New Tag" ></input>
                        <input name="Tag9"  id="Tag9"  cols="10" rows="2" class="form-poshytip" title="New Tag" ></input>
                        <input name="Tag10" id="Tag10"  cols="10" rows="2" class="form-poshytip" title="New Tag" ></input>
                        
                        
                            <a name="addme" id="addme" class="link-button" >
                                <span>Add Tag</span>
                                </a>
                          
                    </div>

                      
                    <div> 
                        <label>Which book?</label>
                        <select class="iclass" name="ListBook"  id="ListBook" >
                            

                            <?php echo $upload; ?>

                        </select>
                    </div>
                    
                   
                       
                    

                    <p><input type="submit" value="Accept" name="submit" id="submit" /></p>
                </fieldset>
                <?php echo form_close(); ?>
            </div>

            <div class="one-half last">

                <h6 class="line-divider">Attach </h6>
                <p>Here you can upload type of file to the Note*.. From here this files 
                    are going to sync with your Dropox Account. 
                    * Type of File allowed (jpg, jpeg, gif, png, zip, avi)</p>
                <?php
                $attributes2 = array('enctype' => 'multipart/form-data');
                echo form_open('/upload/do_upload', $attributes);
                ?>

                <input type="file" name="userfile" class="fileUpload" multiple>

                <button id="px-submit" type="submit">Upload</button>
                <button id="px-clear" type="reset">Clear</button>

                </form>

                <script type="text/javascript">
                    jQuery(function($){
                       
                        $('.fileUpload').fileUploader({
                            allowedExtension: 'jpg|jpeg|gif|png|zip|avi|mpeg|plain|png|xls',
                            afterEachUpload: function(data, status, formContainer){
                                $jsonData = $.parseJSON( $(data).find('#upload_data').text() );
                            }
                        });
                    });
                </script>
            </div>
            <div class="clear "></div>

        </div>


    </div>



</div>
<!-- ENDS wrapper-main -->
</div>