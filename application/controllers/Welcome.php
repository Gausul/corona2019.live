<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
   function __construct() 
     {
        parent::__construct();
		$this->load->database();
		$this->load->library('session');
 		$this->load->helper('url');
 		$this->load->helper('form');
		$this->load->model('admin_model');
	}
	
	public function index(){
		$data['country_id']=46;
$data['total_count']=$this->admin_model->total_count();
$data['country_data']=$this->admin_model->moneselect('country_list','country_id',$data['country_id']);
$data['allcountry_data']=$this->admin_model->resselect('country_list','status',1,'total_case','DESC');

$data['title']='<meta name="description" content="">
  <meta name="author" content="Corona2019 Team">
  <meta name="keyword" content="COVID19 Live Update,Corona 2019,Corona virus Live update,Corona virus Live,Coronalive2019,corona2019.live,corona2019">
  <title>COVID19 Live Update :Total '.$data['total_count']->total.' Cases</title>';
		
		$this->load->view('header',$data);
		$this->load->view('welcome_message',$data);
		$this->load->view('footer');
	}

public function livedata($country_id,$name){
$data['country_id']=$country_id;
$data['total_count']=$this->admin_model->total_count();
$data['country_data']=$this->admin_model->moneselect('country_list','country_id',$data['country_id']);
$data['title']='<meta name="description" content="">
<meta name="author" content="Corona2019 Team">
<meta name="keyword" content="'.strtoupper($data['country_data']->country_name).' COVID19 Live Update,Corona 2019,Corona virus Live update,Corona virus Live,Coronalive2019,corona2019.live,corona2019">
<title>'.strtoupper($data['country_data']->country_name).' COVID19 Live Update :Total '.strtoupper($data['country_data']->total_case).' Cases</title>';
		$this->load->view('header',$data);
		$this->load->view('index',$data);
		$this->load->view('footer');
}


public function updatecountry(){

if($this->input->post()){
	$country_id=$this->input->post('country_id');	
	$count=count($this->input->post('recovered_cases'));
	$total_case=$this->input->post('total_cases');
	$fatal_cases=$this->input->post('fatal_cases');
	$recovered_cases=$this->input->post('recovered_cases');
	for ($i=0; $i <$count ; $i++) { 
		$array=array();
		$array=array('total_case'=>$total_case[$i],
                     'recovered_cases'=>$recovered_cases[$i],
                     'fatal_cases'=>$fatal_cases[$i]
	     );
$this->admin_model->update('country_list',$array,'country_id',$country_id[$i]);
	}
}

$data['country_data']=$this->admin_model->resselect('country_list','status',1,'total_case','DESC');
	$this->load->view('updatecountry',$data);
}



public function jsondata(){
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://coronavirus-19-api.herokuapp.com/countries",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
));
$response = curl_exec($curl);
curl_close($curl);

$this->admin_model->insert('json_data',
	array('json_data'=>$response,
		'time_stamp'=>date('d-m-Y H:i:s')));
$country_data=json_decode($response);
foreach ($country_data as $cd) {
     $country_data=$this->admin_model->moneselect('country_list','country_name',$cd->country);
	if(empty($country_data)){
			$country_array=array('country_name'=>$cd->country,
			'total_case'=>$cd->cases,
			'recovered_cases'=>$cd->recovered,
			'fatal_cases'=>$cd->deaths,
			'last_updated'=>date('d-m-Y H:i:s')
			);
			$this->admin_model->insert('country_list',$country_array);
	}else{
		   $country_array=array('country_name'=>$cd->country,
			'total_case'=>$cd->cases,
			'recovered_cases'=>$cd->recovered,
			'fatal_cases'=>$cd->deaths,
			'last_updated'=>date('d-m-Y H:i:s')
			);
	$this->admin_model->update('country_list',$country_array,'country_id',$country_data->country_id);     
	}
}
echo "done";
}

}
