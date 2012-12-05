<?php
if ($messi)
    echo $messi;
?><!-- MAIN -->
<div id="main">

    <div class="wrapper">

        <!-- content -->


        <!-- title -->
        <div id="page-title">
            <span class="title">Select a Book</span>
            <span class="subtitle">Evernote Ucab</span>
        </div>






        <div id="main">
            <div class="wrapper">		

                <!-- content -->
                <div id="content"> 
                    <div id="projects-list">

                        <!-- project -->
                        <?php
                        if (isset($records)):

                            foreach ($records as $c):
                                $attributes = array('id' => 'sc-contact-form');

                                $ref = base_url() . 'nota/indexDelete/' . $username . '/' . $c->id_libreta . '>';
                                $ref2 = base_url() . 'libreta/indexSelect/' . $username . '/' . $c->nombre;

                                echo form_open('/libreta/indexSelect/' . $username . '/' . $c->nombre, $attributes);
                                ?>
                                <div class='project'>

                                    <h1><a href="<?php echo $ref ?>"> <?php echo $c->nombre ?></a></h1>



                                    <!-- shadow -->
                                    <div class='project-shadow'>
                                        <!-- project-thumb -->
                                        <div class='project-thumbnail'>
                                            <!-- meta -->
                                            <ul class='meta'>
                                                <li><strong>Project date</strong> <?php echo $c->fecha ?> </li>
                                                <li><strong>username</strong> <a href='#'> <?php echo $username ?> </a></li>
                                            </ul>
                                            <!-- ENDS meta -->

                                            <a href="<?php echo $ref2 ?>" class='cover'><img src='/evernoteUcab/images/book.png'  alt='Feature image' /></a>
                                        </div>
                                        <!-- ENDS project-thumb -->

                                        <div class='the-excerpt'>
                                            <?php $c->descripcion ?> 
                                        </div>	

                                    </div>
                                    <!-- ENDS shadow -->
                                </div>



                                <!-- ENDS project -->
                                <?php
                                echo form_close();

                            endforeach;

                        endif;
                        ?>               
                    </div> 


                    <!-- ENDS pagination -->
<?php echo $this->pagination->create_links(); ?> 
                </div> 
            </div> 
        </div>                





        <!-- ENDS form -->
        <!-- END Login -->


        <!-- ENDS 2 cols -->

        <!-- ENDS wrapper-main -->
    </div>
