<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function index()
	{
		//general variables...
		$headerInfo['siteKeywords'] = "" ;
		$headerInfo['siteTitle'] = "جشن نفس";
		$headerInfo['jsHandler'] = "home";

		//view...
		$this->load->view('template/header' , $headerInfo);
		$this->load->view('home/abba' , compact(''));
		$this->load->view('template/footer');
	}

	function find($code)
	{
		$this->load->model('Names_model');
		$code += 0 ;
		$Query = $this->Names_model->find($code);
		if(!$Query->num_rows()) {
			echo "نام زنده یاد ثبت نشده است";
			return;
		}

		$a = $Query->result_array();
		if ($a[0]['name'] == 'نام زنده یاد ثبت نشده است')
		{
			echo $a[0]['name'];
		}
		else
		{
			echo 'خانواده زنده یاد '.$a[0]['name'];
		}
	}

	function save($code)
	{
		$this->load->model('Names_model');
		$code += 0 ;
		$Query = $this->Names_model->save($code);
	}

	public function newn()
	{
		$number = '123
		124
		126';

		$name = 'علی
		محمد
		زیبا';

		$number = explode("\n", $number);
		$name = explode("\n", $name);

		for ($i = 0; $i < count($number); $i++)
		{
			$this->Names_model->insert($number[$i],$name[$i]);;

		}
	}
}
?>