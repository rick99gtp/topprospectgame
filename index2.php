<?php
    // Include config file
    require_once "config.php";

    $msg = '';
    $msg_err = '';
    $msg_class = '';
    $email = '';
    
    // Processing form data when form is submitted
    if(filter_has_var(INPUT_POST, 'submit')) {
        $email = htmlspecialchars($_POST['email']);
        if(!empty($email)) {
        // passed
            if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                // failed validation
                $msg = 'Please enter a valid email.';
            }
            else {
                // passed validation

                // setup automatic email
                $toEmail = $email;
                $subject = 'Thank you for subscribing!';
                $body = "<html><body>";
                $body .= "<h2>THANK YOU FOR SUBSCRIBING!</h2>";
                $body .= "<p>We're just as excited to bring you a fun and new way to enjoy tabletop baseball gaming on your computer!</p>";
                $body .= "<p>We hope you've been enjoying the Scoresheets.  We will be adding the 2019 season shortly so you can get started on your 2019 Season proejcts.</p>";
                $body .= "Thanks again and if you have any questions please send an email to digidugout@gmail.com";
                $body .= "<br />";
                $body .= "<p>Rick @ Digital Dugout</p>";
                $body .= "</body></html>";

                // email headers
                $headers = "Reply-To: Digital Dugout <digidugout@digidugout.com>\r\n";
                $headers .= "Return-Path: Digital Dugout <digidugout@digidugout.com>\r\n";
                $headers .= "From: Digital Dugout <digidugout@digidugout.com>\r\n";
                $headers .= "Organization: Sender Organization\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
                $headers .= "X-Priority: 3\r\n";
                $headers .= "X-Mailer: PHP/". phpversion() . "\r\n";

                // send email
                if(mail($toEmail, $subject, $body, $headers)) {
                    // email sent
                    $msg = 'Thank you for your subscription!';

                    // add to database
                    $sql = "SELECT id FROM subscribers WHERE email = ?";

                    if($stmt = mysqli_prepare($link, $sql)) {
                        mysqli_stmt_bind_param($stmt, "s", $param_email);

                        $param_email = $email;

                        if(mysqli_stmt_execute($stmt)) {
                            mysqli_stmt_store_result($stmt);

                            if(mysqli_stmt_num_rows($stmt) == 1) {
                                $msg_err = 'You have already subscribed!';
                            }
                        }
                    }

                    mysqli_stmt_close($stmt);

                    if(empty($msg_err)) {
                        $sql = "INSERT INTO subscribers (email) VALUES (?)";

                        if($stmt = mysqli_prepare($link, $sql)) {
                            mysqli_stmt_bind_param($stmt, "s", $param_email);

                            if(mysqli_stmt_execute($stmt)) {
                            // success
                                $msg_class = 'hidden-msg-shown';
                                $msg = 'Thank you for subscribing!';
                            }
                            else {
                                $msg_class = '';
                            }
                        }
                    }
                    else {
                        $msg = $msg_err;
                        $msg_class = 'hidden-msg-shown';
                    }

                    mysqli_stmt_close($stmt);

                    mysqli_close($link);
                }
                else {
                    // email not sent
                }
            }
        
        }
        else {
            // failed
            $msg = "Please enter a valid email";
        }
    }
?>
 
 <!DOCTYPE html>
    <html class="no-js">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>Digital Dugout</title>
            <meta name="description" content="">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
            <link href="https://fonts.googleapis.com/css?family=Dancing+Script&display=swap" rel="stylesheet">
            <link rel="stylesheet" href="./css/index2.css">
        </head>
    <body>
        <div class="hidden-msg <?php echo $msg_class; ?>">
            <?php echo $msg; ?>
        </div>
        <header>
            <div class="link-wrapper">
                <nav>
                    <ul>
                        <li><a href="tabletophelper.html">Scoresheets</a></li>
                        <li>Online Game <span>(coming soon)</span></li>
                        <!-- <li><a href="login.php" class="login">Login</a></li>
                        <li><a href="register.php" class="signup">Sign up</a></li> -->
                    </ul>
                </nav>
            </div>
        </header>

        <!-- Hero -->
        <section class="hero">
            <div class="headline">
                <div class="logo-name">
                    <img src="./images/dd-logo.png" width="75" />
                    <div class="digitaldugout">
                        digital<span>dugout</span>
                    </div>
                </div>
                <div class="tag-line">
                    <h1>TABLETOP BASEBALL GAMING</h1>
                </div>
                <div class="text">
                    Providing valuable resources for your gaming needs
                </div>
            </div>

            <div class="mouse-scroll-container">
                <div class="mouse-wheel"></div>
            </div>
        </section>

        <!-- Quotes -->
        <section class="quote-section">
            <div class="quote-bg">
                <div class="quote-top">
                    <i class="fas fa-quote-left fa-2x"></i>
                    <p class="random-quote">Baseball is 90% mental. The other half is physical.</p>
                    <i class="fas fa-quote-right fa-2x"></i>
                </div>
                <div class="quote-bottom">
                    <p class="random-quote-author">Yogi Berra</p>
                </div>
            </div>
        </section>

        <!-- Scoresheets -->
        <section class="scoresheets">
            <div class="scoresheet-bg"></div>
            <div class="scoresheet-left">
                <div class="left-details">
                    <h2>Score<span>sheets</span></h2>
                    <p class="scoresheet-desc">Find 'As-Played' lineups for your tabletop baseball games easily with the Scoresheet Finder Tool.  The names and positions of each player are pre-filled in so you don't have to.  Click the button below to get started!</p>
                    <div class="bullet-points">
                        <div class="bullet-row">
                            <i class="fas fa-check-circle"></i>
                            <p>Search. Print. Play.</p>
                        </div>
                        <div class="bullet-row middle-row">
                            <i class="fas fa-check-circle"></i>
                            <p>Every scoresheet since 1906.</p>
                        </div>
                        <div class="bullet-row">
                            <i class="fas fa-check-circle"></i>
                            <p>100% FREE!</p>
                        </div>
                    </div>
                    <a href="tabletophelper.html">Show me the scoresheets</a>
                </div>
            </div>
        </section>

        <!-- Donation -->
        <section class="donation">
            <div class="donation-inner">
                <h2>Support our efforts!</h2>
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                    <input type="hidden" name="cmd" value="_donations" />
                    <input type="hidden" name="business" value="HHHS2A5VYFUDJ" />
                    <input type="hidden" name="currency_code" value="USD" />
                    <!-- <a href="#">DONATE</a> -->
                    <input type="submit" name="submit" value="DONATE" id="donate-button" /> 
                    <!-- <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" /> -->
                    <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1" />
                </form>
                
                <p>Thank you so much!</p>
            </div>
        </section>

        <!-- Coming Soon -->
        <section class="coming-soon">
            <div class="coming-soon-inner">
                <div class="coming-soon-center">
                    <h2>COMING SOON!</h2>
                    <p>We are very excited to announce that we are developing an online baseball game! We don't have a release date yet, however we are working hard to make it something that we can all enjoy.</p>
                    <p>There will be more information released in the coming weeks.  So, if you're interested in receiving updates on this exciting project, fill in your email address below and click the 'Notify Me' button.  We promise NOT to spam your inbox.</p>
                    <p>Get notified when we go live with the game!</p>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <input type="email" placeholder="Enter email address" name="email" value="<?php echo isset($_POST['email']) ? $email : ''; ?>" >
                        <input type="submit" value="Notify Me" class="notify-me" name="submit" />
                    </form>
                </div>
            </div>
        </section>

        <section class="footer">
            <h2>Follow Us On</h2>
            <div class="social">
            <a href="https://www.facebook.com/digidugout/"><div class="facebook icon">
                    <i class="fab fa-facebook-f fa-2x"></i>
                </div></a>
                <a href="https://twitter.com/DigiDugout"><div class="twitter icon">
                    <i class="fab fa-twitter fa-2x"></i>
                </div></a>
                <!-- <div class="youtube icon">
                    <i class="fab fa-youtube fa-2x"></i>
                </div> -->
            </div>
            <p class="cpy"></p>
        </section>

        <script src="../js/index.js" async defer></script>
    </body>
</html>