<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_Location extends CI_Controller {
	

	public function get_report_location_table(){
		$year = $this->input->post('year');
		$month = $this->input->post('month');
		$telco_id = $this->input->post('telco_id');
		$telco_subscription = $this->input->post('telco_subscription');
		$gender = $this->input->post('gender');  
		$location = $this->input->post('location'); 
		
		$left = 0;
		$date = "";
		$telco_name = "";
		$gender_id = "";
		$subs = "";
		$location_id = "";
		
		if($year == "" && $month == ""){
			$left = 4;
		}elseif($year != "" && $month == ""){
			$left = 7;
		}elseif($year != "" && $month != ""){
			$left = 10;
		}else{
			$left = 4;
		}
	
		if($year == "" && $month == "" ){
			$date = "";
		}elseif($year != "" && $month == "" ){
			$date = " AND LEFT(date_created, 4) = '$year' ";
		}elseif($year != "" && $month != "" ){
			$date = " AND LEFT(date_created, 7) = '$year-$month' ";
		}
		
		if($telco_id == ""){
		$telco_name = "";
		}else{
			$telco_name = "AND telco_id = '$telco_id' ";
		}
		
		if($telco_subscription == ""){
			$subs = "";
		}else{
			$subs = "AND telco_subscription = '$telco_subscription' ";
		}
		
		if($gender == ""){
			$gender_id = "";
		}else{
			$gender_id = "AND gender = '$gender' ";
		}
		
		if($location == ""){
			$location_id = "";
		}else{
			$location_id = "AND location = '$location' ";
		}
		
		$query = $this->db->query("SELECT location AS location, 
									COUNT(DISTINCT imei) AS total_count
									FROM tbl_registration
									WHERE location != ''
									$date
									$telco_name
									$telco_subscription
									$gender_id $location_id
									GROUP BY location
									ORDER BY location;");
									
		$total = $this->db->query("SELECT location AS location, 
									COUNT(DISTINCT imei) AS total_count
									FROM tbl_registration
									WHERE location != ''
									$date
									$telco_name
									$telco_subscription
									$gender_id $location_id
									GROUP BY location
									ORDER BY location;");
	
		
		
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
			
			echo '<table id="report_rev_table" class="display" cellspacing="0" width="100%">
						<thead>
							<tr class="">
								<th>Location</th> 
								<th>Total Count</th>
							</tr>
						</thead> 
						<tbody id="location_name">';
						foreach($query->result() as $row){
						echo "<tr>
								<td>$row->location</td>
								<td>$row->total_count</td>
							</tr>";
						}
						echo "</tbody>";
			foreach($total->result() as $row_total){}
			echo "<tfoot>
							<tr>
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
		$query = $this->db->query("SELECT location AS location, 
									COUNT(DISTINCT imei) as total_count
									FROM tbl_registration 
									GROUP BY location
									ORDER BY location;");
								
		$total = $this->db->query("SELECT location AS location, 
									COUNT(DISTINCT imei) as total_count
									FROM tbl_registration 
									GROUP BY location
									ORDER BY location;");
	
		
		
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
								<th>Location</th> 
								<th>Total Count</th>
							</tr>
						</thead> 
						<tbody >
							 
						';
			
			foreach($query->result() as $row){
		
			echo "<tr>
					<td>$row->location</td>
					<td>$row->total_count</td>
				</tr>"; 

			}
			foreach($total->result() as $row_total){}
			echo "</tbody>
					<tfoot>
							<tr>
								<th>Total</th>
								<th>$row_total->total_count</th>
							</tr>
						</tfoot>
					</table>";
		}else{
			echo "<center>No records found.</center>";
		}
    }
	
	public function get_report_location_graph() {
		$year = $this->input->post('year');
		$month = $this->input->post('month');
		$telco_id = $this->input->post('telco_id');
		$telco_subscription = $this->input->post('telco_subscription');
		$gender = $this->input->post('gender');
		$location = $this->input->post('location');
		
		$left = 0;
		$date = "";
		$telco_name = "";
		$gender_id = "";
		$subs = "";
		$location_id = "";
		
		if($year == "" && $month == ""){
			$left = 4;
		}elseif($year != "" && $month == ""){
			$left = 7;
		}elseif($year != "" && $month != ""){
			$left = 10;
		}else{
			$left = 4;
		}
	
		if($year == "" && $month == "" ){
			$date = "";
		}elseif($year != "" && $month == "" ){
			$date = " AND LEFT(date_created, 4) = '$year' ";
		}elseif($year != "" && $month != "" ){
			$date = " AND LEFT(date_created, 7) = '$year-$month' ";
		}
		
		if($telco_id == ""){
		$telco_name = "";
		}else{
			$telco_name = "AND telco_id = '$telco_id' ";
		}
		
		if($telco_subscription == ""){
			$subs = "";
		}else{
			$subs = "AND telco_subscription = '$telco_subscription' ";
		}
		
		if($gender == ""){
			$gender_id = "";
		}else{
			$gender_id = "AND gender = $gender ";
		}
		
		if($location == ""){
			$location_id = "";
		}else{
			$location_id = "AND location = '$location' ";
		}
		
		$query = $this->db->query("SELECT location as location, 
									COUNT(DISTINCT imei) AS total_count
									FROM tbl_registration
									WHERE location != ''
									$date
									$telco_id
									$telco_subscription
									$gender_id $location_id
									GROUP BY location
									ORDER BY location");
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
							echo "'".$dates->location."',";
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
						name: 'total_count',
						data: [";
								 foreach ($query->result() as $value) {
									echo $value->total_count.",";
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
		$query = $this->db->query("SELECT location AS location, 
									COUNT(DISTINCT imei) as total_count
									FROM tbl_registration 
									GROUP BY location
									ORDER BY location;");

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
							echo "'".$value->location."',";
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
						name: 'total_count',
						data: [";
								 foreach ($query->result() as $value) {
									echo $value->total_count.",";
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
