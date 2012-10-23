
<?php   
//$username=$this->session->unset_userdata('username');
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

                                <li><?php echo anchor ('usuario/index/'. $username.'/modify','Modify User Data', array ( 'title' => 'Modify'));?></li>
                                <li><?php echo anchor ('usuario/index/'. $username.'/changePassword','Change Password', array ( 'title' => 'Change Password'));?></li>
                                <li><?php echo anchor ('example/request_dropbox/','Configure Dropbox Account', array ( 'title' => 'Configurate Dropbox Account'));?></li>
                                <li><?php echo anchor ('home','Logout', array ( 'title' => 'Home'));?></li>
                                
                            </ul>
                        </li>
                        <li ><?php echo anchor ('homeuser/index/'. $username,'Notebooks', array ( 'title' => 'Home'));?><a><span class="subheader">Admin your Notebook</span></a>
                            <ul>

                                <li><?php echo anchor ('libreta/index/'. $username.'','Create a Notebook', array ( 'title' => 'Create'));?></li>
                                <li><?php echo anchor ('libreta/indexModify/'. $username.'','Modify your Notebook', array ( 'title' => 'Modify'));?></li>
                                <li><?php echo anchor ('libreta/indexDelete/'. $username.'','Delete a Notebooks', array ( 'title' => 'Delete'));?></li>
                                <li><?php echo anchor ('libreta/indexSelectConsulta/'. $username.'','See your Notebooks', array ( 'title' => 'Add'));?></li>
                                <li><?php echo anchor ('','Add Note to Notebook', array ( 'title' => 'Add'));?></li>
                            </ul>
                        </li>
                        <li ><?php echo anchor ('homeuser/index/'. $username,'Notes', array ( 'title' => 'Home'));?><a><span class="subheader">Admin your Notes</span></a>
                            <ul>

                                <li><?php echo anchor ('nota/index/'. $username.'','Create a Note', array ( 'title' => 'Create'));?></li>
                                <li><?php echo anchor ('libreta/indexSelect/'.$username.'','Modify your Notes', array ( 'title' => 'Modify'));?></li>
                                <li><?php echo anchor ('','Delete a Note', array ( 'title' => 'Delete'));?></li>
                                
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