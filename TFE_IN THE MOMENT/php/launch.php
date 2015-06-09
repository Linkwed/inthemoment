<?php
require_once 'Mobile_Detect.php';
$detect = new Mobile_Detect;
 
// Any mobile device (phones or tablets).
if ( $detect->isMobile() ) {
	
	echo "<a data-sr href=\"http://www.charlespattyn.be/project/tfe/app\" class=\"launch\">Launch</a>";
}