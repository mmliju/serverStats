<?php
class main {

private $server_list_url;
private $server_statistics_url;
private $server_list_key;

public function __construct()
{ 
 	$this->server_list_url 	     = "https://services.mysublime.net/st4ts/data/get/type/servers/";
	$this->server_statistics_url = "https://services.mysublime.net/st4ts/data/get/type/iq/server/";
	$this->server_list_key		 = "s_system";
}
//------------------------------------
public function get_server_list()
{
	$server_arr = $this->decode_data($this->server_list_url);
	if(count($server_arr) > 0)
	{
		return $this->generate_server_drop($server_arr);
	}
}
//----------------------------------------
private function generate_server_drop($servers)
{
	$select = "<select id='server_list' name='server_list'>";
	$select.= "<option value='0'>Select a server</option>";
	foreach($servers as $list)
	{
		 $select.="<option value='".$list->s_system."'>".$list->s_system."</option>"; 
		//$list->$this->server_list_key;
	}
	$select.="</select>";
	return $select;
}
//---------------------------------------------------
public function get_server_details($server)
{
	$stats_arr = $this->decode_data($this->server_statistics_url.$server.'/');
	$stats_result = array();
	 //print_r($stats_arr);
	foreach($stats_arr as $stats)
	{
		$stats_result[$stats->data_value] = $stats->data_label;
	}
	ksort($stats_result);
    $statistics = json_encode($stats_result);
	echo $statistics;
	//print_r($stats_result);
	//echo $this->server_statistics_url.$server.'/';
}
//-------------------------------------------------------------
private function decode_data($url)
{
	$api = file_get_contents($url);
	$result_arr = json_decode($api);
	return $result_arr;
}
//-------------------------------------------------------------
}