<?php

//get $DBCONFIG from .gitignored /config to avoid 
//showing db user details to everyone on github
require_once('config/dbconfig.php');

$CONFIG = array(
    'dbconfig'  => $DBCONFIG,
    'site_url'  => "http://tsoha.elmnainen.fi/"
);