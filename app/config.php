<?php

//set up config 
$CONFIG = array(
    'homedir'       =>  __DIR__ . "/",
    'controllerdir' =>  __DIR__ . "/controllers/",
    'viewsdir'      =>  __DIR__ . "/views/",
    'modelsdir'     =>  __DIR__ . "/models/",
    'homeurl'       =>  ""
);


//dbconfig holds db dsn, username, password
//get $dbconfig from .gitignored /config to avoid 
//showing db user details to everyone on github
require_once( $CONFIG["homedir"] . 'config/dbconfig.php');
$CONFIG["dbconfig"] = $dbconfig;



