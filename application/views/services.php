<?php include('template/header.php'); ?>
<?php include('query/services_query.php'); ?>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/js/bootstrap-select.min.js"></script>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/datatables/buttons.dataTables.min.css">
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/vendor/datatables/dataTables.buttons.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/vendor/datatables/buttons.flash.min.js"></script>


<!-- /page level scripts -->

<script>
$(document).ready(function(){
	
	$( "#start_date" ).prop( "disabled", true );
	$( "#end_date" ).prop( "disabled", true );
	$( "#telco" ).prop( "disabled", true );
	$( "#service" ).prop( "disabled", true );
	$( "#report" ).prop( "disabled", true );
	
	//get_start_end_date
    $("#filter").change(function(){ 
	$( "#start_date" ).prop( "disabled", false );
	$( "#end_date" ).prop( "disabled", false );
	var filter = $("#filter").val();
	var value = {
        filter: filter
    };
	
		$.ajax({
			type: "POST",
			data: value,
			url: "<?php echo base_url(); ?>index.php/services/get_start_end_date",             
			dataType: "html",            
			success: function(response){
				$("#start_date").html(response);
				$("#end_date").html(response);
				$('#start_date').selectpicker('refresh');
				$('#end_date').selectpicker('refresh');
				
			},
			error: function (jqXHR, textStatus, errorThrown){
				alert('Error get data from ajax');
			}

		});
		
	});
	
	//Start and End Date
	$("#end_date").change(function(){
		var telco = $("#telco").val();
		
		$("#telco" ).prop( "disabled", false );
		$("#telco").selectpicker('refresh');
			
	});
	
	//telco
	$("#telco").change(function(){
		var telco = $("#telco").val();
		console.log(telco);
		var value = {
			telco: telco
		};
		
		$("#service").prop( "disabled", false );
		$("#report").prop( "disabled", false );
		
		$('#report').selectpicker('refresh');
		$.ajax({
			type: "POST",
			data: value,
			url: "<?php echo base_url(); ?>index.php/services/get_service",             
			dataType: "html",            
			success: function(response){
				$("#service").html(response);
				$('#service').selectpicker('refresh');
			},
			error: function (jqXHR, textStatus, errorThrown){
				alert('Error get data from ajax');
			}

		});		
	});

	$('#service_table').DataTable( {
        dom: 'Blfrtip',
        buttons: [
            'csv', 'excel'
        ],
		"scrollX": true,
		"ordering": false,
		"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
    } );
  
});
</script>
<script>
	$(function () {
		Highcharts.setOptions({
		lang: {
			numericSymbols: null //otherwise by default ['k', 'M', 'G', 'T', 'P', 'E']
		}
    });
    $('#container').highcharts({
        title: {
            text: 'Report per Service <?php echo $report_label; ?>',
            x: -20 //center
        },
        subtitle: {
            text: '',
            x: -20
        },
        xAxis: {
            categories: [<?php foreach ($days->result() as $value) { ?>'<?php echo date("M j, Y", strtotime($value->report_date )); ?>',<?php } ?>],
			
        },
        yAxis: {
            title: {
                text: '<?php echo $report_label; ?>'
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
		<?php for($x=0 ; $x < $len ; $x++){?>
			{
				<?php
					$service_key = $this->db->query("SELECT t3.name AS service, t2.name AS telco_name FROM tbl_sms_keyword t1
													INNER JOIN tbl_sms_telco t2 ON t1.shortcode_id = t2.telco_id
													INNER JOIN tbl_sms_service t3 ON t1.service_id = t3.service_id
													WHERE t3.service_id = $service_filter[$x] $telco_list LIMIT 1");
				?>
				name: '<?php foreach($service_key->result() as $sel_key){ ?> <?php echo $sel_key->service.' ('.$sel_key->telco_name.')'; ?><?php } ?>',
				data: [
						<?php foreach ($days->result() as $value) { ?>
							<?php
								$sample = $this->db->query("SELECT t3.name AS service, IFNULL(SUM($column_name), 0) AS revenue
												FROM  $table t1
												INNER JOIN tbl_sms_keyword t2 ON t1.keyword_id = t2.keyword_id
												AND t1.telco_id = t2.shortcode_id
												$charge_report
												INNER JOIN tbl_sms_service t3 ON t2.service_id = t3.service_id
												WHERE (report_date LIKE '%$value->report_date%')
												AND  (t3.service_id = $service_filter[$x]) $telco_list_service
												");
												
							?>
							<?php foreach($sample->result() as $sel_rev2){ ?>
									
											<?php echo $sel_rev2->revenue;?>,
										
							<?php } ?>
						<?php } ?>
						
				],
				lineWidth: 3
			},
		<?php } ?>
			
		]
    });
});
</script>

<!-- main area -->
	<div class="main-content">
		<form class="form-horizontal" method="post" action="">
		  <fieldset>
			<div class="form-group">
			<label class="col-sm-1 control-label">Filter</label>
			<div class="col-sm-11">
			  <div class="row">
			  
				<div class="col-xs-2">	
					<select class="selectpicker form-control" name="filter" id="filter" title="Select Day/Month/Year">
					  <option value="year">Per Year </option>
					  <option value="month">Per Month</option>
					  <option value="day">Per Day</option>
					</select>
				</div>
				
				<div class="col-xs-2">	
					<select class="selectpicker form-control" data-size="10" id="start_date" name="start_date" title="Start Date">
					  
					</select>
					<br>
					<select class="selectpicker form-control" data-size="10" id="end_date" name="end_date" title="End Date">
					  
					</select>
				</div>
				
				<div class="col-xs-2">	
						<select class="selectpicker form-control" id="telco" name="telco" title="Telco">
						  <option value="">All</option>
						  <option value="1">Smart</option>
						  <option value="2">Sun</option>
						  <option value="3">Yondu</option>
						  <option value="4">Globe</option>
						  <option value="5">Cherry Prepaid</option>
						</select>
				</div>
				
				<div class="col-xs-2">
					<select class="selectpicker form-control" data-size="10" data-live-search="true" data-actions-box="true" name="service[]" id="service" title="Service" multiple>
					  
					</select>
					
				</div>
				
				<div class="col-xs-2">	
					<select class="selectpicker form-control" title="Report" id="report" name="report">
					  <option value="active_subscribers">Active Subscriber</option>
					  <option value="total_optin">Opt-In</option>
					  <option value="total_optout">Opt-Out</option>
					  <option value="charge*success_dn">Revenue</option>
					  <option value="total_mt">Total MT</option>
					  <option value="total_dn">Total DN</option>
					  <option value="success_dn">Success DN</option>

					</select>
				</div>
				
				<div class="col-xs-2">
					<button type="submit" class="btn btn-primary">Submit</button>
				  </div>
				
			  </div>
			</div>
		  </div>
		
			
		  </fieldset>
		</form>
		
		<div class="row mb25">
		  <div class="col-md-12">
			<div class="panel">
			  <div class="panel-heading border" >
				Services Report
			  </div>
			  <div class="panel-body">
				<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
			  </div>
			</div>
		  </div>
		</div>
		
		<div class="panel">
          <div class="panel-heading border">
            
          </div>
          <div class="panel-body">
            <table id="service_table" class="display" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Services</th>
						<?php foreach ($days->result() as $value) { ?><th><?php echo date("M j, Y", strtotime($value->report_date )); ?></th><?php } ?>
					</tr>
				</thead>
				<tbody>
				<?php for($x=0 ; $x < $len ; $x++){?>
				<?php
					$service_key = $this->db->query("SELECT t1.service_id AS id, t3.name AS service, t2.name AS telco_name FROM tbl_sms_keyword t1
													INNER JOIN tbl_sms_telco t2 ON t1.shortcode_id = t2.telco_id
													INNER JOIN tbl_sms_service t3 ON t1.service_id = t3.service_id
													WHERE t3.service_id = $service_filter[$x] $telco_list LIMIT 1");
				?>
			
					<tr>
						<td><?php foreach($service_key->result() as $sel_key){ ?> <?php echo $sel_key->service.' ('.$sel_key->telco_name.')'; ?><?php } ?></td>
						
						<?php foreach ($days->result() as $value) { ?>
							<?php
								$sample = $this->db->query("SELECT t2.service_id AS service, IFNULL(SUM($column_name), 0) AS revenue
												FROM  $table t1
												INNER JOIN tbl_sms_keyword t2 ON t1.keyword_id = t2.keyword_id
												AND t1.telco_id = t2.shortcode_id 
												WHERE (report_date LIKE '%$value->report_date%')
												AND (t2.service_id = $service_filter[$x])
												$charge_report
												$telco_list_service");
							
							?>
							<?php foreach($sample->result() as $sel_rev2){ ?>
									<td>
										<?php echo number_format($sel_rev2->revenue);?>
									</td>
							<?php } ?>
						<?php } ?>
		
					</tr>
				<?php } ?>
				</tbody>
				
				<tfoot>
					
					<tr>
						<th>Services</th>
						<?php foreach ($days->result() as $value) { ?>
						<?php
						$report_sum = $this->db->query("SELECT t2.service_id AS service, IFNULL(SUM($column_name), 0) AS revenue
										FROM $table t1
										INNER JOIN tbl_sms_keyword t2 ON t1.keyword_id = t2.keyword_id
										AND t1.telco_id = t2.shortcode_id 
										WHERE (report_date LIKE '%$value->report_date%')
										$charge_report
										AND (t2.service_id IN ($service_list)) $telco_list_service");
												
						?>
							<th>
								<?php 
									foreach($report_sum->result() as $report_rev){ echo number_format($report_rev->revenue); }
								?>
							</th>
						<?php } ?>
					</tr>
				</tfoot>
			</table>
          </div>
        </div>

				
	</div>
<!-- /main area -->
</div>
<!-- /content panel -->

<?php include('template/footer.php'); ?>