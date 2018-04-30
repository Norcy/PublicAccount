<?php
$locale='en_US.UTF-8';
setlocale(LC_ALL,$locale);
putenv('LC_ALL='.$locale);

header('Content-type:text');
define("TOKEN", "weixin");
$wechatObj = new wechatCallbackapiTest();
if (isset($_GET['echostr'])) {
    $wechatObj->valid();
}else{
    $wechatObj->responseMsg();
}

class wechatCallbackapiTest
{
    public function valid()
    {
        $echoStr = $_GET["echostr"];
        if($this->checkSignature()){
            header('content-type:text');
            echo $echoStr;
            exit;
        }
    }

    private function checkSignature()
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }

    public function responseMsg()
    {
        // echo "HelloWorld";
        //$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

        $postStr = file_get_contents('php://input');
        if (!empty($postStr))
        {
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $fromUsername = $postObj->FromUserName;
            $toUsername = $postObj->ToUserName;
            $keyword = trim($postObj->Content);
	    $keywords = explode(" ", $keyword);
	    $objName = $keywords[0];
	    $objType = "m";
	    if (count($keywords) > 1)
	    {
		$objType = $keywords[1];
	    }
	    if ($fromUsername == "o_iMAj1gZOuQIR_yDK7Sz5nsFqnw")
	    {
		include_once "blogUpdater.php";
                updateBlog($objType, $objName, "", "", "");
	    }

            $time = time();
            $textTpl = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[%s]]></MsgType>
                        <Content><![CDATA[%s]]></Content>
                        <FuncFlag>0</FuncFlag>
                        </xml>";

            $msgType = "text";
            if($fromUsername != "o_iMAj1gZOuQIR_yDK7Sz5nsFqnw" || $keyword == "?" || $keyword == "？")
            {
                $contentStr = date("Y-m-d H:i:s",time());
            }
            else
            {
                $contentStr = "http://norcy.github.io/2013/03/01/%E9%82%A3%E4%BA%9B%E5%B9%B4%EF%BC%8C%E6%88%91%E7%9C%8B%E8%BF%87%E7%9A%84/";
            }
            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
            echo $resultStr;
        }
        else
        {
            echo "EmptyPost";
            exit;
        }
    }
}
?>
