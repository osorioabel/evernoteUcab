
<?php   
$username=$this->session->unset_userdata('username');
$username=$this->session->userdata('username'); ?>

<body>
        <!-- HEADER -->
        <div id="header">
            <!-- wrapper-header -->
            <div class="wrapper">
                <a href="index.html"><img id="logo" src="<?php echo base_url(); ?>img/logo.png" alt="" /></a>
                <!-- search -->
                <div class="top-search">
                    <form  method="get" id="searchform" action="#">
                        <div>
                            <input type="text" value="Search..." name="s" id="s" onfocus="defaultInput(this)" onblur="clearInput(this)" />
                            <input type="submit" id="searchsubmit" value=" " />
                        </div>
                    </form>
                </div>
                <!-- ENDS search -->
            </div>
            <!-- ENDS wrapper-header -->					
        </div>
        <!-- ENDS HEADER -->


        <!-- Menu -->
        <div id="menu">



            <!-- ENDS menu-holder -->
            <div id="menu-holder">
                <!-- wrapper-menu -->
                <div class="wrapper">
                    <!-- Navigation -->
                    <ul id="nav" class="sf-menu">
                        
                        
                        
                        <li class="current-menu-item"><?php
                      
                        echo anchor ('homeuser/index/'. $username,$username, array ( 'title' => 'Home'));?><a><span class="subheader">Welcome</span></a>
                            <ul>

                                <li><?php echo anchor ('usuario/index/'. $username.'/modify','Modificar Datos', array ( 'title' => 'Modify'));?></li>
                                <li><?php echo anchor ('usuario/index/'. $username.'/changePassword','Cambiar Clave', array ( 'title' => 'Change Password'));?></li>
                                <li><?php echo anchor ('example/request_dropbox/','Configurar cuenta Dropbox', array ( 'title' => 'Configurate Dropbox Account'));?></li>
                                <li><?php echo anchor ('home','Logout', array ( 'title' => 'Home'));?></li>
                                
                            </ul>
                        </li>
                        <li ><?php echo anchor ('homeuser/index/'. $username,'Libretas', array ( 'title' => 'Home'));?><a><span class="subheader">Admin your Notebook</span></a>
                            <ul>

                                <li><?php echo anchor ('libreta/index/'. $username.'','Crear Libreta', array ( 'title' => 'Create'));?></li>
                                <li><?php echo anchor ('libreta/indexModify/'. $username.'','Modificar Libreta', array ( 'title' => 'Modify'));?></li>
                                <li><?php echo anchor ('libreta/indexDelete/'. $username.'','Eliminar Libreta', array ( 'title' => 'Delete'));?></li>
                                <li><?php echo anchor ('libreta/indexSelect/'. $username.'','Ver Libreta', array ( 'title' => 'Add'));?></li>
                                <li><?php echo anchor ('','Agregar Nota a Libreta', array ( 'title' => 'Add'));?></li>
                            </ul>
                        </li>
                        <li ><?php echo anchor ('homeuser/index/'. $username,'Notas', array ( 'title' => 'Home'));?><a><span class="subheader">Admin your Notes</span></a>
                            <ul>

                                <li><?php echo anchor ('','Crear Nota', array ( 'title' => 'Create'));?></li>
                                <li><?php echo anchor ('','Modificar Nota', array ( 'title' => 'Modify'));?></li>
                                <li><?php echo anchor ('','Eliminar Nota', array ( 'title' => 'Delete'));?></li>
                                
                            </ul>
                        </li>
                        <li><a href="">Contact Us<span class="subheader">Get in touch</span></a></li>
                    </ul>
                    <!-- Navigation -->
                </div>
                <!-- wrapper-menu -->
            </div>
            <!-- ENDS menu-holder -->
        </div>
        <!-- ENDS Menu -->