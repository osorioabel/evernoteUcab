<!-- MAIN -->
<div id="main">
    <!-- wrapper-main -->
    <div class="wrapper">

        <!-- content -->
        <div id="content">

            <!-- title -->
            <div id="page-title">
                <span class="title">Log In / Sign Up</span>
                <span class="subtitle">Welcome to Evernote Ucab</span>
            </div>
            <!-- ENDS title -->

            <!-- 2 cols -->
            <div class="one-half">
                <h6 class="line-divider">Log In</h6>
                <!-- Login -->
                <?php
                $attributes = array('id' => 'contactForm');
                echo form_open('/Home/verifylogin', $attributes);
                ?>
                <fieldset>
                    <div>
                        <label>Username</label>
                        <input name="username_login"  id="username_login" 
                               type="text" class="form-poshytip" title="Enter a username" />
                    </div>
                    <div>
                        <label>Password</label>
                        <input name="password_login"  id="password_login" type="password" class="form-poshytip" title="Enter a password 6-12 characters" />
                    </div>
                    <p><input type="submit" value="Log In" name="submit" id="submit" /></p>
                </fieldset>
                <?php echo form_close(); ?>

                <!-- ENDS form -->
                <!-- END Login -->
            </div>
            <div class="one-half last">
                <h6 class="line-divider">Join Us</h6>
                <?php
                $attributes2 = array('id' => 'sc-contact-form');
                echo form_open('/Home/register', $attributes2);
                ?>
                <fieldset>
                    <div>
                        <label>Username</label>
                        <input name="username_signup"  id="username_signup" type="text" class="form-poshytip" title="Enter a username" />
                    </div>
                    <div>
                        <label>Email</label>
                        <input name="email_signup"  id="email_signup" type="email" class="form-poshytip" title="Enter your email" />
                    </div>
                    <div>
                        <label>Password</label>
                        <input name="pass_signup"  id="pass_signup" type="password" class="form-poshytip" title="Enter a password 6-12 characters" />
                    </div>
                    <div>
                        <label>Re-enter Password</label>
                        <input name="repass_signup"  id="repass_signup" type="password" class="form-poshytip" title="Re-Enter a password " />
                    </div>
                    <div>
                        <label>Dropbox Email</label>
                        <input name="dropboxmail_signup"  id="dropboxmail_signup" type="text" class="form-poshytip" title="Enter your Dropbox User" />
                    </div>
                    <div>
                        <label>Dropbox Password</label>
                        <input name="dropboxpass_signup"  id="dropboxmail_signup" type="password" class="form-poshytip" title="Enter your Dropbox password" />
                    </div>

                    <p><input type="submit" value="Sign Up" name="submit" id="submit" /></p>
                </fieldset>
                <?php echo form_close(); ?>
                <!-- ENDS form -->
            </div>
            <!-- ENDS 2 cols -->
        </div>
        <!-- ENDS wrapper-main -->
    </div>
    <!-- ENDS MAIN -->
    <!-- Twitter -->
    <div id="twitter">
        <div class="wrapper">
            <a href="#" id="prev-tweet"></a>
            <a href="#" id="next-tweet"></a>
            <img id="bird" src="<?php echo base_url(); ?>img/bird.png" alt="Tweets" />
            <div id="tweets">
                <ul class="tweet_list"></ul>
            </div>
        </div>
    </div>
    <!-- ENDS Twitter -->