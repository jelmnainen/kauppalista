<!DOCTYPE html>

<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="style/css/bootstrap.css">

        <script src="style/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        
    </head>
    <body> 
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        
        <!-- start page -->
        
        <div class="container">
            
            <?php include_once("message.php"); ?>
            
            <section id="masthead" class="row">
                
                <div class="col-sm-12">

                    <h1 id="site-title">Tietokantasovelluksen esittelysivu: Kauppalista</h1>
                    
                </div>
                
            </section>
            
            <section id="navigation" class="row">
                
                <div class="col-sm-12">
                
                    <?php require_once('nav.php'); ?>
                    
                </div>

            </section><!-- navigation -->

            <section class="row" id="main-content">

                <div class="col-sm-12">

                    <?php include($view); ?>

                </id> <!-- main -->

            </section> <!-- container -->

                <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
                <script>window.jQuery || document.write('<script src="style/js/vendor/jquery-1.11.0.min.js"><\/script>')</script>

                <script src="style/js/main.js"></script>
                


            <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
            <script>
                (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
                function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
                e=o.createElement(i);r=o.getElementsByTagName(i)[0];
                e.src='//www.google-analytics.com/analytics.js';
                r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
                ga('create','UA-XXXXX-X');ga('send','pageview');
            </script>
        </div>
    </body>
</html>