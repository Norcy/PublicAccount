<?php

$locale='en_US.UTF-8';  
setlocale(LC_ALL,$locale);  
putenv('LC_ALL='.$locale);

function updateBlog($cmdType, $type, $objectName, $year, $mouth, $date)
{
	if (!$objectName)
	{
		die("No Object Name");
	}

	$cmd = "python3 /var/www/html/Norcy.github.io/isee.py ".$cmdType." ".$objectName." ".$type." ".$year." ".$mouth." ".$date." >/dev/null  &";
	//$cmd = "python3 /var/www/html/Norcy.github.io/isee.py ".$objectName." ".$type." ".$year." ".$mouth." ".$date." 2>&1";
	//var_dump(shell_exec($cmd));
    shell_exec($cmd);
}
?>
