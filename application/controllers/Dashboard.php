<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	public function ew_total() {
		
	$query_total = $this->db->query("SELECT t1.date AS DATE, FORMAT(t1.total,0) AS total_device, FORMAT(t2.total_impression,0) AS total_impression, FORMAT(t2.inactive_count,0) AS inactive
FROM total_unique_monthly_device t1
INNER JOIN unique_monthly_device_impression t2
ON t1.id = t2.id
WHERE t1.id != '1' ORDER BY t1.date DESC LIMIT 1");

	$unique_device = $this->db->query("SELECT LEFT(DATE, 7) AS DATE, FORMAT(total,0) AS total_unique_device FROM total_unique_device GROUP BY LEFT(DATE, 7) ORDER BY DATE DESC LIMIT 1");
	
		
		
			foreach($query_total->result() as $total){}
			foreach($unique_device->result() as $unique_total_device){}
			
			
			
			echo "
					<div class='col-sm-3 col-md-3 col-lg-3'>
					<div class='card card-block'>
					  <h5 class='m-b-0 v-align-middle text-overflow'>
						<i class='material-icons text-primary md-48'>system_update</i>
						<span>$unique_total_device->total_unique_device</span>
						
					  </h5>
					  <div class='small text-overflow text-muted'>
						<h6>Total Unique Devices</h6>
					  </div>
					</div>
				  </div>
			
			
				  <div class='col-sm-3 col-md-3 col-lg-3'>
					<div class='card card-block'>
					  <h5 class='m-b-0 v-align-middle text-overflow'>
						<i class='material-icons text-primary md-48'>phonelink_ring</i>
						<span>$total->total_device</span>
						
					  </h5>
					  <div class='small text-overflow text-muted'>
						<h6>Unique ACTIVE Devices</h6>
					  </div>
					</div>
				  </div>
				  
				  <div class='col-sm-3 col-md-3 col-lg-3'>
					<div class='card card-block'>
					  <h5 class='m-b-0 v-align-middle text-overflow'>
						<i class='material-icons text-primary md-48'>forward</i>
						<span>$total->total_impression</span>
					  </h5>
					  <div class='small text-overflow text-muted'>
						<h6>PushAds Sent for this Month(Unique)</h6>	
					  </div>
					</div>
				  </div>
				  
				  <div class='col-sm-3 col-md-3 col-lg-3'>
					<div class='card card-block'>
					  <h5 class='m-b-0 v-align-middle text-overflow'>
						<i class='material-icons text-primary'>signal_cellular_no_sim</i>
						<span>$total->inactive</span>
					  </h5>
					  <div class='small text-overflow text-muted'>
					<h6>Inactive Devices of the Month</h6>
					  </div>
					</div>
				  </div>
				  
				  
				  
				  ";
	}
/* 	
	public function gender_rate() {
		header('Content-Type: application/json');
		$query = $this->db->query("SELECT gender AS label, ROUND((COUNT(gender) * 100 / (SELECT COUNT(*) FROM tbl_registration)),2) AS value FROM tbl_registration WHERE gender IN ('FEMALE','MALE') GROUP BY gender");
		
		$encode = array();
		foreach ($query->result() as $row)
		{
			$encode[] = $row;
		}
		echo json_encode($encode); 
	} */
	
	
		/* public function top_model() {
		header('Content-Type: application/json');
		$query = $this->db->query("SELECT model, COUNT(DISTINCT imei) AS modeltop FROM tbl_registration GROUP BY model ORDER BY modeltop DESC LIMIT 5");
		$encode = array();
		foreach ($query->result() as $row)
		{
			$encode[] = $row;
		}
		echo json_encode($encode); 
	} */
	
		public function monthly_device_impression() {
		header('Content-Type: application/json');
		$query = $this->db->query("SELECT t1.date AS ads_month, t1.total AS total_device, t2.total_impression AS total_impression
				FROM total_unique_monthly_device t1
				INNER JOIN unique_monthly_device_impression t2
				ON t1.id = t2.id
				WHERE t1.id != '1' ORDER BY t1.date ASC");
		$encode = array();
		foreach ($query->result() as $row)
		{
			$encode[] = $row;
		}
		echo json_encode($encode); 
	}
	
		public function agebracket_female() {
		header('Content-Type: application/json');
		$date_yesterday = date('Y-m-d',strtotime("-1 days"));
		$date = date('Y-m-d',strtotime("-3 days"));
		$query = $this->db->query("SELECT t2.name AS ads_name, t1.date AS ads_date, SUM(t1.total_impression) AS total_impression, SUM(t1.total_click) AS total_click
								FROM advertiser_summary_report t1
								INNER JOIN campaign_creative_info t2 ON t2.id = t1.ads_id
								WHERE LEFT(t2.start_date, 10) = '$date_yesterday'
								GROUP BY t1.ads_id");
		$encode = array();
		foreach ($query->result() as $row)
		{			
			$encode[] = $row;
		}
		echo json_encode($encode); 
	}
	
	
	public function get_total_per_location() {
		header('Content-Type: application/json');
		$query = $this->db->query("SELECT advertiser_report_per_hour.date AS ads_date, SUM(total_impression) AS total_impression, SUM(total_click) AS total_click
FROM advertiser_report_per_hour
WHERE advertiser_report_per_hour.date >= DATE(NOW()) - INTERVAL 7 DAY
GROUP BY advertiser_report_per_hour.date ORDER BY advertiser_report_per_hour.date ASC");
		$encode = array();
		foreach ($query->result() as $row)
		{
			$encode[] = $row;
		}
		echo json_encode($encode); 
		
		
	}
	
	public function get_model_total() {
		header('Content-Type: application/json');
		$query = $this->db->query("SELECT advertiser_report_per_hour.date AS ads_date, SUM(total_click) AS total_click
FROM advertiser_report_per_hour
WHERE advertiser_report_per_hour.date >= DATE(NOW()) - INTERVAL 7 DAY
GROUP BY advertiser_report_per_hour.date ORDER BY advertiser_report_per_hour.date ASC");
		$encode = array();
		foreach ($query->result() as $row)
		{
			$encode[] = $row;
		}
		echo json_encode($encode); 
		
	} 
	
	public function revenue_report_per_country() {
			
$query = $this->db->query("SELECT t2.name AS ads_name, t1.date AS ads_date, SUM(t1.total_impression) AS total_impression, SUM(t1.total_click) AS total_click
FROM advertiser_summary_report t1
INNER JOIN campaign_creative_info t2 ON t2.id = t1.ads_id
WHERE t1.date = CURDATE()-1 AND t2.status_id = '1'
GROUP BY t1.ads_id;");
				
			
			
			if($query->num_rows() > 0){
				
				echo '<table id="revenue_report_per_country" class="table-striped table-hover table" cellspacing="0" width="100%">
						<thead>
							<tr align="center">
								
							</tr>
							<tr align="center">
							    <th>Date</th>
								<th>PushAd</th>
								<th>Impression</th>
								<th>Click</th>
							</tr>
						</thead> 
						<tbody id="">';
						foreach($query->result() as $row){
							$revenue_country = number_format($row->total_impression,2);
						echo "<tr align=''>
								<td>$row->ads_date</td>
								<td>$row->ads_name</td>
								<td>$row->total_impression</td>
								<td>$row->total_click</td>
							</tr>";
							
						
						}
				echo "</tbody>";
				echo "</table>";
			}
			
			
		}
	
	/* public function donut() {
		header('Content-Type: application/json');
		$query = $this->db->query("SELECT LEFT(t1.date_created, 10) AS label, IFNULL(COUNT(*), 0) AS value
									FROM tbl_entries t1
									INNER JOIN tbl_user t2 ON t1.msisdn = t2.msisdn
									GROUP BY LEFT(t1.date_created, 10) 
									ORDER BY LEFT(t1.date_created, 10) DESC LIMIT 20");
		$encode = array();
		foreach ($query->result() as $row)
		{
			$encode[] = $row;
		}
		echo json_encode($encode); 
		
	} */
}
