<?php
class Tool extends CI_Model{
	
	//=========================基本变量设定=========================
	
	var $api_key="04cc4490522041c58d06679a63b6e29c";
	var $secret_key="6e039ee448a24efa9bdd5f0d8a96a260";
	var $redirect_url="http://localhost/index.php/portal";
	var $token;
	var $user_id;
	var $session_key;
	
	function __construct()
	{
		parent::__construct();
	}
	
	//=========================以下为基础函数=========================
	
	//把数组转化成get的参数
	function getpara($para)
	{
		$s=array();
		foreach ($para as $k=>$v)
		{
			if (is_array($v))
			{
				$v=implode(",",$v);
			}
			$s[]=$k."=".$v;
		}
		$s=implode("&",$s);
		return $s;
	}
	//得到带参数的url
	function geturl($url,$para)
	{
		$url=$url."?".$para;
		return $url;
	}
	//跳转
	function redirect($url)
	{
		header("Location:$url");
	}
	//带参数POST，其中参数须经getpara转化
	function post($url,$para)
	{
		$p=curl_init();
		//结果字符串化
		curl_setopt($p,CURLOPT_RETURNTRANSFER,TRUE);
		//安全验证
		curl_setopt($p,CURLOPT_SSL_VERIFYPEER,FALSE);
		curl_setopt($p,CURLOPT_URL,$url);
		curl_setopt($p,CURLOPT_POST,TRUE);
		curl_setopt($p,CURLOPT_POSTFIELDS,$para);
		return curl_exec($p);
		curl_close($p);	
	}
	//计算sig，参数须经getpara转化
	function getsig($para)
	{
		ksort($para);
		reset($para);
		$sig="";
		foreach ($para as $k=>$v)
		{
			$sig=$sig.$k."=".$v;
		}
		$sig=$sig.$this->secret_key;
		return (md5($sig));
	}
	//GET，暂时用不到，放着
	function get($url)
	{
		$p=curl_init();
		//结果字符串化
		curl_setopt($p,CURLOPT_HEADER,FALSE);
		curl_setopt($p,CURLOPT_RETURNTRANSFER,TRUE);
		//安全验证
		curl_setopt($p,CURLOPT_URL,$url);
		curl_setopt($p,CURLOPT_TIMEOUT,6000);
		return curl_exec($p);
		curl_close($p);	
	}
	
	//=========================以下为实现授权，按步骤放置=========================
	
	//第一步跳转到授权页面，放在首页
	//参数说明，scope为请求的权限，在http://wiki.dev.renren.com/wiki/%E6%9D%83%E9%99%90%E5%88%97%E8%A1%A8可查询
	function step1()
	{
		$para=array(
		"client_id"=>$this->api_key,
		"response_type"=>"code",
		"redirect_uri"=>$this->redirect_url,
		"scope"=>"status_update"
		);
		$para=$this->tool->getpara($para);
		$url=$this->tool->geturl("https://graph.renren.com/oauth/authorize",$para);
		$this->tool->redirect($url);
	}
	//第二步获取access token，放在redirect_url，默认为localhost/portal.php
	function step2()
	{
		$para=array(
		"grant_type"=>"authorization_code",
		"code"=>$_GET,
		"client_id"=>$this->api_key,
		"client_secret"=>$this->secret_key,
		"redirect_uri"=>$this->redirect_url
		);
		$para=$this->tool->getpara($para);
		$jsoncode=$this->tool->post("https://graph.renren.com/oauth/token",$para);
		$jsoncode=json_decode($jsoncode,TRUE);
		//var_dump($jsoncode);
		$this->token=$jsoncode["access_token"];
	}
	//第三步token换取session key，紧跟上一步放置
	function step3()
	{
		$para=$this->tool->getpara(array("oauth_token"=>$this->token));
		$jsoncode=$this->tool->post("https://graph.renren.com/renren_api/session_key",$para);
		$jsoncode=json_decode($jsoncode,TRUE);
		//var_dump($jsoncode);
		$this->session_key=$jsoncode["renren_token"]["session_key"];
		$this->user_id=$jsoncode["user"]["id"];
	}
	
	//=========================使用API=========================
	//每个api要求参数不同，参照http://wiki.dev.renren.com/wiki/API
	//默认返回获得的信息
	//extrapara要求对象数组，如木有就给个空数组
	function useapi($method,$extrapara=array())
	{
		$para=array(
		"api_key"=>$this->api_key,
		"method"=>$method,
		"format"=>"JSON",
		"v"=>"1.0",
		"session_key"=>$this->session_key
		);
		$para=array_merge($para,$extrapara);
		//计算加密sig
		$para["sig"]=$this->tool->getsig($para);
		//GET调用api的url,获取信息
		$para=$this->tool->getpara($para);
		$jsoncode=$this->tool->post("http://api.renren.com/restserver.do",$para);
		return $jsoncode=json_decode($jsoncode,TRUE);
	}
}
?>