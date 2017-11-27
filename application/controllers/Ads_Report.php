<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ads_Report extends CI_Controller {
	

	public function get_report_location_table(){
		$start_date = $_POST['start_date'];
		$end_date = $_POST['end_date'];
		
		$query = $this->db->query("SELECT MIN(t1.date) AS ads_date, t2.name AS ads_name, FORMAT(SUM(t1.total_impression),0) AS total_impression, FORMAT(SUM(t1.total_click),0) AS total_click 
FROM advertiser_report_per_hour t1
INNER JOIN campaign_creative_info t2 ON t1.ads_id = t2.id
WHERE t1.date BETWEEN '$start_date' AND '$end_date'
AND t2.start_date >= DATE(NOW()) - INTERVAL 7 DAY GROUP BY t1.ads_id");
		
		
									
		$total = $this->db->query("SELECT advertiser_report_per_hour.date AS ads_date, SUM(total_impression) AS total_impression, SUM(total_click) AS total_click
FROM advertiser_report_per_hour
WHERE advertiser_report_per_hour.date BETWEEN '$start_date' AND '$end_date'");
	
		
		
		if($query->num_rows() > 0){
			echo '
			<script>
			$("#report_rev_table").DataTable({
							"paging": true,
							"ordering": true,
							"info": true,
							"lengthMenu": [[25, 50, 75, 100, -1], [25, 50, 75, 100, "All"]],
							"order": [[ 0, "asc" ]],
							dom: "Blfrtip",
							buttons: [
								"csv",
								"excel"
							],
						});
			</script>';
			
			echo '<table id="report_rev_table" class="table-striped table-hover table table-bordered datatable" style="font-size:12px" cellspacing="0" width="100%">
						<thead>
							<tr class="">
								<th>Date</th> 			
								<th>PushAd Title</th>
								<th>Impression</th>
								<th>Click</th>
							</tr>
						</thead> 
						<tbody id="location_name">';
						foreach($query->result() as $row){
						echo "<tr>
								<td>$row->ads_date</td>
								<td>$row->ads_name</td>
								<td>$row->total_impression</td>
								<td>$row->total_click</td>
							</tr>";
						}
						echo "</tbody>";
			foreach($total->result() as $row_total){}
			echo "<tfoot>
							<tr>
								<th></th>
								<th></th>
								<th></th>
							</tr>
						</tfoot>
					</table>";
		}else{
			echo "<center>No records found.</center>";
		}
    }
	
	public function get_report_location_table_all(){

		$year = date("Y");
		$query = $this->db->query("SELECT MIN(t1.date) AS ads_date, t2.name AS ads_name, FORMAT(SUM(t1.total_impression),0) AS total_impression, FORMAT(SUM(t1.total_click),0) AS total_click 
FROM advertiser_report_per_hour t1
INNER JOIN campaign_creative_info t2 ON t1.ads_id = t2.id
WHERE t1.date >= DATE(NOW()) - INTERVAL 7 DAY 
AND t2.start_date >= DATE(NOW()) - INTERVAL 7 DAY GROUP BY t1.ads_id");
								
		$total = $this->db->query("SELECT advertiser_report_per_hour.date AS ads_date, SUM(total_impression) AS total_impression, SUM(total_click) AS total_click
FROM advertiser_report_per_hour
WHERE advertiser_report_per_hour.date >= DATE(NOW()) - INTERVAL 7 DAY");
	
		
		
		if($query->num_rows() > 0){
			echo '
			<script>
			$("#report_rev_table_all").DataTable({
							"paging": true,
							"ordering": true,
							"info": true,
							"lengthMenu": [[25, 50, 75, 100, -1], [25, 50, 75, 100, "All"]],
							"order": [[ 0, "asc" ]],
							dom: "Blfrtip",
							buttons: [
								"csv",
								"excel",
							],
						});
			</script>';
			
			echo '<table id="report_rev_table_all" class="table-striped table-hover table table-bordered datatable" style="font-size:12px" cellspacing="0" width="100%">
						<thead>
							<tr class="">
								<th>Date</th> 
								<th>PushAd</th>
								<th>Impression</th>
								<th>Click</th>
							</tr>
						</thead> 
						<tbody >';
			
			foreach($query->result() as $row){
		
			echo "<tr>
					<td>$row->ads_date</td>
					<td>$row->ads_name</td>
					<td>$row->total_impression</td>
					<td>$row->total_click</td>
				</tr>"; 

			}
			foreach($total->result() as $row_total){}
			echo "</tbody>
					<tfoot>
							<tr>
								<th></th>
								<th</th>
								<th></th>
							</tr>
						</tfoot>
					</table>";
		}else{
			echo "<center>No records found.</center>";
		}
    }
	
	public function get_report_location_graph() {
		$start_date = $_POST['start_date'];
		$end_date = $_POST['end_date'];
		
	
		
		$query = $this->db->query("SELECT advertiser_report_per_hour.date AS ads_date, SUM(total_impression) AS total_impression, SUM(total_click) AS total_click
FROM advertiser_report_per_hour
WHERE advertiser_report_per_hour.date BETWEEN '$start_date' AND '$end_date'
GROUP BY advertiser_report_per_hour.date ORDER BY advertiser_report_per_hour.date ASC");
		if($query->num_rows() > 0){
		echo "<script>
			$(function () {
			Highcharts.setOptions({
				lang: {
					numericSymbols: null //otherwise by default ['k', 'M', 'G', 'T', 'P', 'E']
				}
			});
			$('#container2').highcharts({
				title: {
					text: 'Report Total Count',
					x: -20 //center
				},
				subtitle: {
					text: '',
					x: -20
				},
				xAxis: {
					categories: [";
					
						foreach($query->result() as $dates){
							echo "'".$dates->ads_date."',";
						}
		 echo "
					],
					
				},
				yAxis: {
					title: {
						text: 'Report Total Count'
					},
					plotLines: [{
						value: 0,
						width: 1,
						color: '#808080'
					}]
				},
				tooltip: {
					valuePrefix: 'Php '
				},
				legend: {
					layout: 'vertical',
					align: 'right',
					verticalAlign: 'middle',
					borderWidth: 2
				},
				series: [
					{
						name: 'total_impression',
						data: [";
								 foreach ($query->result() as $value) {
									echo $value->total_impression.",";
								}	
						echo "],
						lineWidth: 3
					},
					{
						name: 'total_click',
						data: [";
								 foreach ($query->result() as $value) {
									echo $value->total_click.",";
								}	
						echo "],
						lineWidth: 3
					}
					
				]
			});
		});
		</script>
		
		<div id='container2' style='min-width: 310px; height: 400px; margin: 0 auto'></div>";
		}
		else{
			echo "<center>No Records Found</center>";
		}
    }
	
	public function get_report_location_graph_all() {
		$year = date("Y");
		$query = $this->db->query("SELECT advertiser_report_per_hour.date AS ads_date, SUM(total_impression) AS total_impression, SUM(total_click) AS total_click
FROM advertiser_report_per_hour
WHERE advertiser_report_per_hour.date >= DATE(NOW()) - INTERVAL 7 DAY
GROUP BY advertiser_report_per_hour.date ORDER BY advertiser_report_per_hour.date ASC");

		if($query->num_rows() > 0){
		echo "<script>
			$(function () {
			Highcharts.setOptions({
				lang: {
					numericSymbols: null //otherwise by default ['k', 'M', 'G', 'T', 'P', 'E']
				}
			});
			$('#container').highcharts({
				title: {
					text: 'Report Total Count',
					x: -20 //center
				},
				subtitle: {
					text: '',
					x: -20
				},
				xAxis: {
					categories: [";
					
						foreach($query->result() as $value){
							echo "'".$value->ads_date."',";
						}
		 echo "
					],
					
				},
				yAxis: {
					title: {
						text: 'Report Total Count'
					},
					plotLines: [{
						value: 0,
						width: 1,
						color: '#808080'
					}]
				},
				tooltip: {
					valuePrefix: ''
				},
				legend: {
					layout: 'vertical',
					align: 'right',
					verticalAlign: 'middle',
					borderWidth: 2
				},
				series: [
					{
						name: 'total_impression',
						data: [";
								 foreach ($query->result() as $value) {
									echo $value->total_impression.",";
								}	
						echo "],
						lineWidth: 3
					},
					{
						name: 'total_click',
						data: [";
								 foreach ($query->result() as $value) {
									echo $value->total_click.",";
								}	
						echo "],
						lineWidth: 3
					}
					
					
					
				]
				
			});
		});
		</script>
		
		<div id='container' style='min-width: 310px; height: 400px; margin: 0 auto'></div>";
		}
		else{
			echo "<center>No Records Found</center>";
		}
    }
	
}
