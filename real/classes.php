<?php

include_once("global_functions.php");


function __autoload($name) {
    echo "Want to load $name.\n";
    throw new Exception("Unable to load $name.");
}

//class user
class user
{

	private $uid=null;
	private $email=null;
	private $name=null;
	private $username=null;
	private $admin=null;
	private $time=null;
	private $messages=null;
	private $new_messages=null;
	private $ip=null;
	
	public function __construct($user)
	{
		connect_to_database();
		protect($user);
		
		if(is_numeric($user))
			//find user by id
			$sql="SELECT * FROM `users` WHERE `id` = ".$user;
		
		else
			$sql="SELECT * FROM `users` WHERE `username` = ".$user;	
			//else by username
		
		$res=mysql_query($sql) or die(mysql_error());
		
		if(mysql_numrows($res))
		{
			$this->uid= mysql_result($res,0,"id");
			$this->admin= mysql_result($res,0,"admin");
			$this->email= mysql_result($res,0,"email");
			$this->time= mysql_result($res,0,"time");
			$this->username= mysql_result($res,0,"username");
			$this->messages= mysql_result($res,0,"messages");
			$this->new_messages= mysql_result($res,0,"new_messages");
			$this->name= mysql_result($res,0,"name");
			$this->ip= $_SERVER['REMOTE_ADDR'];
		}
		
		
	}
	
	public function uid() { return $this->uid;}
	public function email() { return $this->email;}
	public function name() { return $this->name;}
	public function messages() { return $this->messages;}
	public function username() { return $this->username;}
	public function new_messages() { return $this->new_messages;}
	public function time_created() { return $this->time;}
	public function ip() { return $this->ip;}
	public function setIP($IP) { $this->ip=$IP;}
	public function setNM($nm) { $this->new_messages= $nm;}
	public function setM($m) { $this->messages= $m;}
}

//class sale
class sale
{
	private $uid=null;
	private $sender_id=null;
	private $sender_name=null;
	private $time=null;
	private $item_name=null;
	private $discription=null;
	private $other=null;
	private $condition=null;
	private $category=null;
	private $picture=null;
	
	
	public function __construct($id)
	{
		connect_to_databae();
		
		$sql="SELECT * FROM `sales` WHERE `sender_id` = ".$id;
		$res=mysql_result($sql) or die(mysql_error());
		
		if(mysql_numrows($res))
		{
			$this->uid= mysql_result($res,0,"id");
			$this->sender_name= mysql_result($res,0,"sender_name");
			$this->time= mysql_result($res,0,"time");
			$this->item_name= mysql_result($res,0,"item_name");
			$this->category= mysql_result($res,0,"category");
			$this->condition= mysql_result($res,0,"condition");
			$this->sender_id= mysql_result($res,0,"sender_id");
		}
	}
	
	public function get_details() 
	{
		connect_to_databae();
		
		$sql="SELECT * FROM `sales` WHERE `sender_id` = ".$uid;
		$res=mysql_result($sql) or die(mysql_error());
		
		if(mysql_numrows($res))
		{
			$this->discription= mysql_result($res,0,"discription");
			$this->other= mysql_result($res,0,"other");
			$this->picture= mysql_result($res,0,"picture");
		}
		
	}
	
	public function uid() { return $this->uid;}
	public function sender_id() { return $this->sender_id;}
	public function sender_name() { return $this->sender_name;}
	public function time() { return $this->time;}
	public function item_name() { return $this->item_name;}
	public function discription() { return $this->discription;}
	public function other() { return $this->other;}
	public function condition() { return $this->condition;}
	public function category() { return $this->category;}
	public function picture() { return $this->picture;}
}

//class bid
class bid extends sale
{
}


//class pm
class pm
{
	private $uid=null;
	private $sender_id=null;
	private $reciever_id=null;
	private $time=null;
	private $title=null;
	private $message=null;
	private $isnew=null;
	private $sender_name=null;
	
	
	public function __construct($rid)
	{
		connect_to_databae();
		
		$sql="SELECT * FROM `pms` WHERE `reciever_id` = ".$rid;
		$res=mysql_result($sql) or die(mysql_error());
		
		if(mysql_numrows($res))
		{
			$this->uid= mysql_result($res,0,"id");
			$this->sender_id= mysql_result($res,0,"sender_id");
			$this->reciever_id= mysql_result($res,0,"reciever_id");
			$this->sender_name= mysql_result($res,0,"sender_name");
			$this->time= mysql_result($res,0,"time");
			$this->isnew= mysql_result($res,0,"new");
		}
	}
	
	public function get_details() 
	{
		connect_to_databae();
		
		$sql="SELECT * FROM `pms` WHERE `id` = ".$uid;
		$res=mysql_result($sql) or die(mysql_error());
		
		if(mysql_numrows($res))
		{
			$message= mysql_result($res,0,"message");
		}
	}
	public function uid() { return $this->uid;}
	public function sender_id() { return $this->sender_id;}
	public function sender_name() { return $this->sender_name;}
	public function time() { return $this->time;}
	public function title() { return $this->title;}
	public function message() { return $this->message;}
	public function unchecked() { return $this->isnew;}
	public function old() { $this->isnew=false;}
	
}


?>