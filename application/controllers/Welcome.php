<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
		$this->load->library('redis');
		$redis=$this->redis->config();
		$redis->set('message', 'Hello world');
		$value = $redis->get('message');

// Hello world
		print($value);	
	}
	public function count(){
		$this->load->library('redis');
		$redis=$this->redis->config();
	$redis->set("counter", 0);

$redis->incrby("counter", 15); // 15
$redis->incrby("counter", 5);  // 20
//incrby oprator penambahan 

$redis->decrby("counter", 10);
//decrby oprator pengurangan
}
public function getRedis()
{
	$this->load->library('redis');
	$redis=$this->redis->config();
	$redis->hset('user:124', 'name', 'arslan1');
	$redis->hset('user:124', 'email', 'arslan@gmail.com1');
	$redis->hset('user:124', 'dob', '1990-09-091');
}

}
