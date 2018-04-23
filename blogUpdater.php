<?php

$locale='en_US.UTF-8';  
setlocale(LC_ALL,$locale);  
putenv('LC_ALL='.$locale);

class BlogItem
{
    private $year, $mouth, $date, $type, $name;

    function __construct($type, $name, $year, $mouth, $date) 
    { 
    	if ($year)
    	{
    		$this->year = $year;
    	}
    	else
    	{
    		$this->year = date("Y",time());
    	}

    	if ($mouth)
    	{
    		$this->mouth = $mouth;
    	}
    	else
    	{
    		$this->mouth = date("m",time());
    	}

    	if ($date)
    	{
    		$this->date = $date;
    	}
    	else
    	{
    		$this->date = date("d",time());
    	}
        
        if ($type)
        {
        	$this->type = $type;	
        }
        else
        {
        	$this->type = "1";	//默认是电影
        }
       	
       	$this->name = $name;
    }

    function printInfo()
    {
    	echo "Type: ".$this->type."<br>";
    	echo "ObjectName: ".$this->name."<br>";
    	echo "Time is: ".$this->year.$this->mouth.$this->date."<br>";
    }

    function blogItemInfo()
    {
    	return $this->timeInfo()." ".$this->type." ".$this->name." "." ";
    }

    function timeInfo()
    {
    	return $this->year.$this->mouth.$this->date;
    }
}

//updateBlog("b", "神秘巨星99", "2029", "05", "");

function updateBlog($type, $objectName, $year, $mouth, $date)
{
	if (!$objectName)
	{
		die("No Object Name");
	}

	echo "Hello!";
    	$pythonPath = "python3";
    	$pythonFilePath = "/var/www/html/Norcy.github.io/isee.py";
	$cmd = "python3 /var/www/html/Norcy.github.io/isee.py ".$objectName." ".$type." ".$year." ".$mouth." ".$date." 2>&1";
	echo $cmd;	
	var_dump(shell_exec($cmd));
    //echo shell_exec("$pythonPath $pythonFilePath $objectName $type $year $mouth $date");
    
    // $fileName = "ReadList.txt";

 //    if (!file_exists($fileName))
 //    {
 //        $createFile = fopen($fileName, "w");
 //        fclose($createFile);
 //    }

 //    $blogItem = new BlogItem($type, $objectName, $year, $mouth, $date);
 //    // $blogItem->printInfo();

	// // 读取
	// $itemList = array();
	// $readFile = fopen($fileName, "r");
	// if ($readFile)
	// {
	// 	while(!feof($readFile)) 
	// 	{
	// 		array_push($itemList, fgets($readFile));
	// 	}
	// 	fclose($readFile);
	// }
	
	// // 添加
	// $newItem = $blogItem->blogItemInfo()."\n";
	// array_push($itemList, $newItem);
 //    $itemList = array_unique($itemList);
	// // 排序
	// sort($itemList);
    
 //    // 重新写入
 //    $writeFile = fopen($fileName, "w+") or die("Unable to open file!");
 //    foreach ($itemList as $key => $value) 
 //    {
 //    	// 去除空白行
 //    	$value = ltrim($value);
 //    	if (is_string($value) && $value!='')
 //    	{
	// 		fwrite($writeFile, $value);
 //    	}
 //    }
	// fclose($writeFile);
}
?>
