<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends CI_Controller {

	 function __construct() {
        parent::__construct();
        $this->load->model('users_model');
    }

	public function index() {
            $this->load->view('home');
    }
	
	public function get_start_end_date(){
		$date = $this->input->post('filter');
		$filter_date = "";
		$left = 0;
		if($date == "day"){
			$filter_date = "";
			$left = 10;
		}elseif($date == "month"){
			$filter_date = "";
			$left = 7;
		}elseif($date == "year"){
			$filter_date = "";
			$left = 4;
		}
		$query = $this->db->query("SELECT LEFT(report_date, $left) AS report_date FROM tbl_sms_mt_report
								   GROUP BY LEFT(report_date, $left)
								   ORDER BY report_date DESC");
		
		foreach ($query->result() as $row)
		{
			echo "<option value='$row->report_date'>$row->report_date</option>";
		}
	}
	
	public function get_service(){
		
		$telco = $this->input->post("telco");
		$where = "";
		if($telco == ""){
			$where = "";
		}else{
			$where = "WHERE t1.shortcode_id = $telco";
		}
		$query = $this->db->query("SELECT t1.service_id AS service_id, t3.name AS service, t2.name AS telco_name 
		FROM tbl_sms_keyword t1
		INNER JOIN tbl_sms_telco t2 ON t1.shortcode_id = t2.telco_id
		INNER JOIN tbl_sms_service t3 ON t1.service_id = t3.service_id
		$where
		GROUP BY t3.service_id
		ORDER BY t3.name");
		
		foreach ($query->result() as $row)
		{
			echo "<option value='$row->service_id'>$row->service</option>";
		}
	}
	
	public function get_data(){
		header('Content-Type: application/json');
		$query = $this->db->query("SELECT keyword, SUM(charge*success_dn) AS revenue
									FROM tbl_sms_mt_report t1
									INNER JOIN tbl_sms_keyword t2 ON t1.keyword_id = t2.keyword_id
									WHERE (report_date BETWEEN '2016-09-01' AND '2016-10-02')
										  AND  t1.keyword_id IN (630, 629, 628)
										  AND telco_id = 4
									GROUP BY report_date, t1.keyword_id");
		
		
		$encode = array();
		$shit = "";
		foreach ($query->result() as $row)
		{
			$encode[] = $row;
			
		}
		
		echo json_encode($encode);
		 
	}
	
	public function get_data2(){
		header('Content-Type: application/json');
		$start_date = "";
		$end_date = "";
		$telco = "";
		$keyword = "";
		$report = "";
		
		$query = $this->db->query("SELECT t1.keyword_id AS keyword_id, keyword, SUM(charge*success_dn) AS revenue
									FROM tbl_sms_mt_report t1
									INNER JOIN tbl_sms_keyword t2 ON t1.keyword_id = t2.keyword_id
									WHERE (report_date BETWEEN '2016-09-01' AND '2016-10-02')
										  AND  t1.keyword_id IN (630, 629, 628, 627)
										  AND telco_id = 4
									GROUP BY report_date, t1.keyword_id");
	
	$encode = array();
		$shit = "";
		foreach ($query->result() as $row)
		{
			$encode[] = $row;
			
		}
		
		echo json_encode($encode);
		 
	}
	
	
	
}
