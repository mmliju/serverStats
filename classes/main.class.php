<?php
error_reporting(0);
class main {

	private $server_list_url;
	private $server_statistics_url;
	private $server_list_key;
	private $server_dat_label;
	private $server_dat_value;
	
	public function __construct()
	{ 
		//------Configuring values for external api calls------------------------------------------
		$this->server_list_url 	     = "https://services.mysublime.net/st4ts/data/get/type/servers/";
		$this->server_statistics_url = "https://services.mysublime.net/st4ts/data/get/type/iq/server/";
		$this->server_list_key		 = "s_system";
		$this->server_dat_label		 = "data_label";
		$this->server_dat_value		 = "data_value";
	}
	//------------------------------------
	public function get_server_list()
	{
		$server_arr = $this->decode_data($this->server_list_url);
		return $this->generate_server_drop($server_arr['data']);
		
	}
	//-----------Create server dropdown list------------------
	private function generate_server_drop($servers)
	{
		$select = "<select id='server_list' name='server_list'>";
		$select.= "<option value='0'>Select a server</option>";
		if(count($servers) > 0)
		{
			foreach($servers as $list)
			{
				 $select.="<option value='".$list->s_system."'>".$list->s_system."</option>"; 
			}
		}
		else
		  $select.="<option value='0'>Error in loading</option>";
		$select.="</select>";
		return $select;
	}
	//-----Ajax function for server statisticss-----------------
	public function get_server_details($server)
	{
		$stats_arr = $this->decode_data($this->server_statistics_url.$server.'/');
		$stats_result = array();
		if($stats_arr['status'] == 1)
		{
			foreach($stats_arr['data'] as $stats)
			{
				$stats_result[$stats->data_label] = $stats->data_value;
			}
			ksort($stats_result);
			$statistics = json_encode($stats_result);
			echo $statistics;
		}
		else
		{
			$error_arr['result'] = "Error";
			$statistics = json_encode($error_arr);
			echo $statistics;
		}
	}
	//-----------decode api data---------------------
	private function decode_data($url)
	{
		$api = file_get_contents($url);
		$result_arr = json_decode($api);
		if(count($result_arr) > 0)
		{
		 $return_arr['status'] = 1;
		 $return_arr['data']   = $result_arr;
		}
		else
		{
		 $return_arr['status'] = 0;
		 $return_arr['data']   = array();
		}
		return $return_arr;
	}
	//-------------------------------------------------------------
}