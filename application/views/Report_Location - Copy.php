<?php include('template/header.php'); ?>
<?php include('query/report_location_query.php'); ?>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/js/bootstrap-select.min.js"></script>


<!-- /page level scripts -->

<script type="text/javascript">
var table;
$(document).ready(function(){
	
	//graph
	$('#loader').show();
	$('#loader2').show();
	$.ajax({    //create an ajax request to load_page.php
        type: "GET",
        url: "<?php echo base_url(); ?>index.php/Report_Location/get_report_location_graph_all",             
        dataType: "html",   //expect html to be returned                
        success: function(outEvoVal) {    
		  console.log(outEvoVal);
				$('#tbl_opt_container_all').html(outEvoVal);
				$('#loader').hide();
		},
		error: function(outEvoVal) {   
		  alert('error');
		  
		}

    });
	
	//table
	$.ajax({  //create an ajax request to load_page.php
        type: "GET",
        url: "<?php echo base_url(); ?>index.php/Report_Location/get_report_location_table_all",             
        dataType: "html",   //expect html to be returned                
        success: function(outEvoVal) {    
		  console.log(outEvoVal);
				$('#tbl_opt_container_table_all').html(outEvoVal);
				$('#loader2').hide();
		},
		error: function(outEvoVal) {   
		  alert('error');
		  
		}

    });
	
	$("#submit").click(function(){
		$('#tbl_opt_container_table_all').remove();
		$('#tbl_opt_container_all').remove();
		
		var datastring = $("#form").serialize();
		$('#loader').show();
		$('#loader2').show();
	
		//table
		$('#tbl_opt_container').hide();
		$('#tbl_opt_container_table').hide();
		$.ajax({    
				url: '<?php echo base_url(); ?>index.php/Report_Location/get_report_location_graph',
				type: "POST",
				dataType: "html",
				data: datastring,
				success: function(outEvoVal) {
				  console.log(outEvoVal.length);
						$('#loader').hide();
						$('#tbl_opt_container').show();
						$('#tbl_opt_container').html(outEvoVal);
						
				},
				error: function(outEvoVal) {   
				  alert('error');
				  
				}	
		});
		
		$.ajax({    
				url: '<?php echo base_url(); ?>index.php/Report_Location/get_report_location_table',
				type: "POST",
				dataType: "html",
				data: datastring,
				success: function(outEvoVal) {
				  console.log(outEvoVal.length);
						$('#loader2').hide();
						$('#tbl_opt_container_table').show();
						$('#tbl_opt_container_table').html(outEvoVal);
						
						
				},
				error: function(outEvoVal) {   
				  alert('error');
				  
				}	
		});
		
	});
	
});
</script>

<?php 
		
?>

<!-- main area -->
	<div class="main-content">
		<div class="content-view">
		<form class="form-horizontal" method="post" id="form">
		  <fieldset>
			<div class="form-group">
			<label class="col-sm-1 control-label">Filter</label>
			<div class="col-sm-11">
			  <div class="row">
			  
				<div class="col-xs-1">	
					<select class="form-control" name="year" id="year" title="Select Year">
					  <option value="">All</option>
					  <?php foreach($year->result() as $row): ?>
						<option value="<?php echo $row->year; ?>"><?php echo $row->year; ?></option>
					  <?php endforeach; ?>
					</select>
				</div>
				<div class="col-xs-2">	
					<select class="form-control" id="month" name="month" title="Month">
						<option value="">All</option>
						<option value="01">January</option>
						<option value="02">February</option>
						<option value="03">March</option>
						<option value="04">April</option>
						<option value="05">May</option>
						<option value="06">June</option>
						<option value="07">July</option>
						<option value="08">August</option>
						<option value="09">September</option>
						<option value="10">October</option>
						<option value="11">November</option>
						<option value="12">December</option>
					</select>
				</div>
				
				<div class="col-xs-1">	
						<select class=" form-control" id="telco_id" name="telco_id" title="Telco">
						  <option value="">All</option>
						  <option value="1">Smart</option>
						  <option value="2">Globe</option>
						</select>
				</div>
				
					<div class="col-xs-1">	
						<select class=" form-control" id="telco_subscription" name="telco_subscription" title="Telco Subscription">
						  <option value="">All</option>
						  <option value="1">Postpaid</option>
						  <option value="2">Prepaid</option>
						</select>
				</div>
		
				
				<div class="col-xs-1">	
						<select class=" form-control" id="gender" name="gender" title="Gender">
						  <option value="">All</option>
						  <option value="1">Male</option>
						  <option value="2">Female</option>
						</select>
				</div>
				
				<div class="col-xs-2">
					<select class="form-control" id="location" name="location">
					  <option value="">All</option>
					  <?php foreach($location_name->result() as $row): ?>
						<option value="<?php echo $row->location; ?>"><?php echo $row->location; ?></option>
					  <?php endforeach; ?>
					</select> 
					
				</div>
				
				<div class="col-xs-2">
					<input id="submit" type="button" class="btn btn-primary" value="Submit">
				  </div>
				
			  </div>
			  	
			</div>
		
		  </div>
		
		  </fieldset>
		</form>
		<br>
		<div class="row">
		  <div class='col-sm-12 col-md-12 col-lg-12'>
			<div class='card card-block'>
				<h3>Report Location</h3>
				<center><img src="<?php echo base_url(); ?>asset/images/loader.gif" id="loader" style="display:none; max-height: 100px;" /></center>
				<div id="tbl_opt_container_all" class="display" cellspacing="0" width="100%"></div>
				<div id="tbl_opt_container" class="display" cellspacing="0" width="100%"></div>
			</div>
		  </div>
		</div>	
		
		<div class="row">
		  <div class='col-sm-12 col-md-12 col-lg-12'>
			<div class='card card-block'>
				<h3>Report Location</h3>
				<center><img src="<?php echo base_url(); ?>asset/images/loader.gif" id="loader2" style="display:none; max-height: 100px;" /></center>
            <table id="tbl_opt_container_table_all" class="display" cellspacing="0" width="100%"></table>
			<table id="tbl_opt_container_table" class="display" cellspacing="0" width="100%"></table>
			</div>
		  </div>
		</div>	
	
		
	</div>
<!-- /main area -->
</div>
<!-- /content panel -->

<?php include('template/footer.php'); ?>