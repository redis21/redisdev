<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library('redis');
		$this->redis   = $this->redis->config();
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		
		$this->redis->set('message', 'Hello world');

// gets the value of message
		$value = $this->redis->get('message');

// Hello world
		print($value); 

		echo ($this->redis->exists('message')) ? "Oui" : "please populate the message key";	
	}

	public function count(){

		$this->redis->set("counter", 0);

$this->redis->incrby("counter", 15); // 15
$this->redis->incrby("counter", 5);  // 20
//incrby oprator penambahan 

$this->redis->decrby("counter", 10);
//decrby oprator pengurangan
}

public function view(){
	$value = $this->redis->get('user','user:124');

	print($value);	

}
public function getRedis()
{

	$this->redis->hset('user124', 'name', 'data');
	$this->redis->hset('user124', 'email', 'arslan@gmail.com1');
	$this->redis->hset('user124', 'dob', '1990-09-091');

}

public function redisUp(){
	$this->redis->hset("data", "name","Putra"); 
	$this->redis->hset("data", "address","Jl.Manggis"); 
	$this->redis->hset("data", "number","9");  

}

public function append(){
	$this->redis->set('user_details', json_encode(
		array(		'first_name' => 'Dalkin', 
                    'last_name' => 'Richards',
                    'address' => 'Distict 9', 
                    'handphone' => '0217868727',

                                          )
                                       )
           );
$List = $this->redis->get("user_details");
$List = json_decode($List);
foreach ($List as $key => $value) {
	print_r($value);
}
}

public function redisUpx(){
	$this->redis->lpush("data", "name","Putra"); 
	$this->redis->lpush("data", "address","Jl.Manggis"); 
	$this->redis->lpush("data", "number","9");  

}
public function lushp(){
	$this->redis->lpush("tutorial-list", "Redis"); 
	$this->redis->lpush("tutorial-list", "Mongodb"); 
	$this->redis->lpush("tutorial-list", "Mysql");  

   // Get the stored data and print it 
	$arList = $this->redis->lrange("tutorial-list", 0 ,1); 
	echo "Stored string in redis:: "; 
	print_r($arList);
}
public function zzz(){
	
	$arList = $this->redis->hget("user124",'name'); 
	if (empty($arList)){
		echo "aaa";
	}else{
		echo "bbb";
	}
	print_r($arList);


}
//union
public function sinter(){
	$arList = $this->redis->SINTER('myset' ,'myex'); 
	print_r($arList);

}
//unionall
//
//
//
public function SADD(){
	$arList = $this->redis->SISMEMBER('myset' ,'data1'); 
	print_r($arList);
	if ($arList==1){
		echo "a";
	}else{
		echo "b";
	}

}
public function sunion(){
	$arList = $this->redis->SUNION('myset' ,'myex'); 
	print_r($arList);

}
public function viewAll(){
	$arList = $this->redis->keys("*"); 
	echo "Stored keys in redis "; 
	print_r($arList); 
}
public function getUser(){
	$x = $this->redis->keys('user:124');
	print_r ($this->redis->get($x,'key'));

	
	print_r($x);

}
public function arrayData(){
	$key = 'user:124';
	$this->redis->hset($key, 'age', 44);
	$this->redis->hset($key, 'country', 'finland');
	$this->redis->hset($key, 'occupation', 'software engineer');
	$this->redis->hset($key, 'reknown', 'linux kernel');
	$this->redis->hset($key, 'to delete', 'i will be deleted');

$this->redis->get($key, 'age'); // 44
$this->redis->get($key, 'country'); // Finland

$this->redis->del($key, 'to delete');

$this->redis->hincrby($key, 'age', 20); // 64

$this->redis->hmset($key, [
	'age' => 44,
	'country' => 'finland',
	'occupation' => 'software engineer',
	'reknown' => 'linux kernel',
]);
// finally
$data = $this->redis->hgetall($key);
print_r($data); 
}

public function lush(){
$this->redis->rpush("languages", "french"); // [french]
$this->redis->rpush("languages", "arabic"); // [french, arabic]

$this->redis->lpush("languages", "english"); // [english, french, arabic]
$this->redis->lpush("languages", "swedish"); // [swedish, english, french, arabic]

$this->redis->lpop("languages"); // [english, french, arabic]
$this->redis->rpop("languages"); // [english, french]

$this->redis->llen("languages"); // 2

$this->redis->lrange("languages", 0, -1); // returns all elements
$this->redis->lrange("languages", 0, 1);
}

}
