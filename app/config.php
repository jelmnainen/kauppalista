<?php

//set up config 
$CONFIG = array(
    'homedir'       =>  __DIR__ . "/",
    'controllerdir' =>  __DIR__ . "/controllers/",
    'homeurl'       => "http://tsoha.elmnainen.fi"
);

//dbconfig holds db dsn, username, password
//get $dbconfig from .gitignored /config to avoid 
//showing db user details to everyone on github
require_once( $CONFIG["homedir"] . 'config/dbconfig.php');
$CONFIG["dbconfig"] = $dbconfig;

//mysql:host=mysql5.sigmatic.fi;dbname=juhlisfi_db



