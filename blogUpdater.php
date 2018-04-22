<?php

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

updateBlog("s", "神秘巨星", "2019", "04", "");

function updateBlog($type, $objectName, $year, $mouth, $date)
{
	if (!$objectName)
	{
		die("No Object Name");
	}

    $debug = 0;

    $pythonPath = "python3";
    $pythonFilePath = "/var/www/html/Norcy.github.io/isee.py";

    if ($debug)
    {
        $pythonPath = "/Users/Norcy/anaconda/bin/python";
        $pythonFilePath = "/Users/Norcy/Documents/Github/Norcy.github.io/isee.py";
    }

    shell_exec("'$pythonPath' '$pythonFilePath' '$objectName' '$type' '$year' '$mouth' '$date'");
    
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
