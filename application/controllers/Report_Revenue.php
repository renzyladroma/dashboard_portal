<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_Revenue extends CI_Controller {
	

	public function get_report_revenue_table(){
		$year = $this->input->post('year');
		$month = $this->input->post('month');
		$telco = $this->input->post('telco');
		$service = $this->input->post('service');
		
		$left = 0;
		$date = "";
		$telco_id = "";
		$service_id = "";
		
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
			$date = " AND LEFT(report_date, 4) = '$year' ";
		}elseif($year != "" && $month != "" ){
			$date = " AND LEFT(report_date, 7) = '$year-$month' ";
		}
		
		if($telco == ""){
			$telco_id = "";
		}else{
			$telco_id = "AND t1.telco_id = $telco ";
		}
		
		if($service == ""){
			$service_id = "";
		}else{
			$service_id = "AND t2.service_id = $service ";
		}
		
		$query = $this->db->query("SELECT LEFT(report_date, $left) AS report_date, 
									FORMAT(SUM(charge*success_dn), 2) AS revenue
									FROM tbl_sms_mt_report t1
									INNER JOIN tbl_sms_keyword t2 ON t1.keyword_id = t2.keyword_id AND t1.telco_id = t2.shortcode_id
									WHERE t1.id != ''
									$date
									$telco_id $service_id
									GROUP BY LEFT(report_date, $left)
									ORDER BY LEFT(report_date, $left);");
									
		$total = $this->db->query("SELECT LEFT(report_date, $left) AS report_date, 
									FORMAT(SUM(charge*success_dn), 2) AS revenue
									FROM tbl_sms_mt_report t1
									INNER JOIN tbl_sms_keyword t2 ON t1.keyword_id = t2.keyword_id AND t1.telco_id = t2.shortcode_id
									WHERE t1.id != ''
									$date
									$telco_id $service_id
									ORDER BY LEFT(report_date, $left);");
	
		
		
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
								<th>Date</th> 
								<th>Revenue</th>
							</tr>
						</thead> 
						<tbody id="service_name">';
						foreach($query->result() as $row){
						echo "<tr>
								<td>$row->report_date</td>
								<td>$row->revenue</td>
							</tr>";
						}
						echo "</tbody>";
			foreach($total->result() as $row_total){}
			echo "<tfoot>
							<tr>
								<th>Total</th>
								<th>$row_total->revenue</th>
							</tr>
						</tfoot>
					</table>";
		}else{
			echo "<center>No records found.</center>";
		}
    }
	
	public function get_report_revenue_table_all(){
		$year = date("Y");
		$query = $this->db->query("SELECT LEFT(report_date, 4) AS report_date, 
									FORMAT(SUM(charge*success_dn), 2) AS revenue
									FROM tbl_sms_mt_report t1
									INNER JOIN tbl_sms_keyword t2 ON t1.keyword_id = t2.keyword_id AND t1.telco_id = t2.shortcode_id
									WHERE LEFT(report_date, 4) = '$year'
									GROUP BY LEFT(report_date, 4)
									ORDER BY LEFT(report_date, 4);");
								
		$total = $this->db->query("SELECT LEFT(report_date, 4) AS report_date, 
									FORMAT(SUM(charge*success_dn), 2) AS revenue
									FROM tbl_sms_mt_report t1
									INNER JOIN tbl_sms_keyword t2 ON t1.keyword_id = t2.keyword_id AND t1.telco_id = t2.shortcode_id
									WHERE LEFT(report_date, 4) = '$year'
									ORDER BY LEFT(report_date, 4);");
	
		
		
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
			
			echo '<table id="report_rev_table_all" class="display" cellspacing="0" width="100%">
						<thead>
							<tr class="">
								<th>Date</th> 
								<th>Revenue</th>
							</tr>
						</thead> 
						<tbody >
							 
						';
			
			foreach($query->result() as $row){
		
			echo "<tr>
					<td>$row->report_date</td>
					<td>$row->revenue</td>
				</tr>"; 

			}
			foreach($total->result() as $row_total){}
			echo "</tbody>
					<tfoot>
							<tr>
								<th>Total</th>
								<th>$row_total->revenue</th>
							</tr>
						</tfoot>
					</table>";
		}else{
			echo "<center>No records found.</center>";
		}
    }
	
	public function get_report_revenue_graph() {
		$year = $this->input->post('year');
		$month = $this->input->post('month');
		$telco = $this->input->post('telco');
		$service = $this->input->post('service');
		
		$left = 0;
		$date = "";
		$telco_id = "";
		$service_id = "";
		
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
			$date = " AND LEFT(report_date, 4) = '$year' ";
		}elseif($year != "" && $month != "" ){
			$date = " AND LEFT(report_date, 7) = '$year-$month' ";
		}
		
		if($telco == ""){
			$telco_id = "";
		}else{
			$telco_id = "AND t1.telco_id = $telco ";
		}
		
		if($service == ""){
			$service_id = "";
		}else{
			$service_id = "AND t2.service_id = $service ";
		}
		
		$query = $this->db->query("SELECT LEFT(report_date, $left) AS report_date, 
									SUM(charge*success_dn) AS revenue
									FROM tbl_sms_mt_report t1
									INNER JOIN tbl_sms_keyword t2 ON t1.keyword_id = t2.keyword_id AND t1.telco_id = t2.shortcode_id
									WHERE t1.id != ''
									$date
									$telco_id $service_id
									GROUP BY LEFT(report_date, $left)
									ORDER BY LEFT(report_date, $left);");
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
					text: 'Report Revenue',
					x: -20 //center
				},
				subtitle: {
					text: '',
					x: -20
				},
				xAxis: {
					categories: [";
					
						foreach($query->result() as $dates){
							echo "'".$dates->report_date."',";
						}
		 echo "
					],
					
				},
				yAxis: {
					title: {
						text: 'Report Revenue'
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
						name: 'Revenue',
						data: [";
								 foreach ($query->result() as $value) {
									echo $value->revenue.",";
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
	
	public function get_report_revenue_graph_all() {
		$year = date("Y");
		$query = $this->db->query("SELECT LEFT(report_date, 4) AS report_date, 
									SUM(charge*success_dn) AS revenue
									FROM tbl_sms_mt_report t1
									INNER JOIN tbl_sms_keyword t2 ON t1.keyword_id = t2.keyword_id AND t1.telco_id = t2.shortcode_id
									WHERE LEFT(report_date, 4) = '$year'
									GROUP BY LEFT(report_date, 4)
									ORDER BY LEFT(report_date, 4);");

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
					text: 'Report Revenue',
					x: -20 //center
				},
				subtitle: {
					text: '',
					x: -20
				},
				xAxis: {
					categories: [";
					
						foreach($query->result() as $value){
							echo "'".$value->report_date."',";
						}
		 echo "
					],
					
				},
				yAxis: {
					title: {
						text: 'Report Revenue'
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
						name: 'Revenue',
						data: [";
								 foreach ($query->result() as $value) {
									echo $value->revenue.",";
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
