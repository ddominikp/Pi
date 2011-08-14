<?php
require_once "Pi.class.php";
$k = 1000;
$scale = 100;

try{
	$pi = new Pi();
	$pi->setK($k);
	$pi->setScale($scale);

	echo 'Newton: '.$pi->newton();
	echo "<br />\r\n";
	echo 'Viete: '.$pi->viete();
	echo "<br />\r\n";
	echo 'Leibniz: '.$pi->leibniz();
	echo "<br />\r\n";
	echo 'Wallis: '.$pi->wallis();
	echo "<br />\r\n";
	echo 'pi(): '.pi();
	echo "<br />\r\n";
} catch(Exception $e){
	echo 'Error: '.$e->getMessage()."\r\n";
}
?>