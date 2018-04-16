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

// updateBlog("", "神秘巨星", "", "", "");

function updateBlog($type, $objectName, $year, $mouth, $date)
{
	if (!$objectName)
	{
		die("No Object Name");
	}

    $fileName = "ReadList.txt";

    $blogItem = new BlogItem($type, $objectName, $year, $mouth, $date);
    // $blogItem->printInfo();

	// 读取
	$itemList = array();
	$readFile = fopen($fileName, "r");
	if ($readFile)
	{
		while(!feof($readFile)) 
		{
			array_push($itemList, fgets($readFile));
		}
		fclose($readFile);
	}
	
	// 添加
	$newItem = $blogItem->blogItemInfo()."\n";
	array_push($itemList, $newItem);
    $itemList = array_unique($itemList);
	// 排序
	sort($itemList);
    
    // 重新写入
    $writeFile = fopen($fileName, "w+") or die("Unable to open file!");
    foreach ($itemList as $key => $value) 
    {
    	// 去除空白行
    	$value = ltrim($value);
    	if (is_string($value) && $value!='')
    	{
			fwrite($writeFile, $value);
    	}
    }
	fclose($writeFile);

    updateGithub($fileName);
}

function updateGithub($fileName)
{
    // 复制数据库文件
    if (copy("./".$fileName, "/var/www/html/Norcy.github.io/".$fileName))
    {
        echo "Copy Success";
    }
    else
    {
        echo "Copy Fail";
    }

    // 产生 markdown 文件

    // 执行 git 更新操作
    
}
?>
