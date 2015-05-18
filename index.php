<?php

//load db connection 
require_once('config/mysql.php');

//load header
require_once('php/elements/header.php');

//load twits
require_once('php/twitts.php');

//load footer
require_once('php/elements/footer.php');

//close db connection 
$conn->close();

?>