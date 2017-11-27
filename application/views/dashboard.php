<?php include('template/header.php'); ?>
<script type="text/javascript">
$( document ).ready(function() {
    //$('#winners').DataTable({});
	
	////datatables
	$('#loader').show();
	$.ajax({    //create an ajax request to load_page.php
        type: "GET",
        url: "<?php echo base_url(); ?>index.php/dashboard/ew_total",             
        dataType: "html",   //expect html to be returned                
        success: function(outEvoVal) {    
		  console.log(outEvoVal.length);
				$('#tbl_users').html(outEvoVal);
				$('#loader').hide();
		},
		error: function(outEvoVal) {   
		  alert('error');
		  
		}

    });
	
	
	//report for revenue
	$.ajax({    
		url: '<?php echo base_url(); ?>index.php/dashboard/revenue_report_per_country',
		type: "GET",
		dataType: "html",
		success: function(outEvoVal) {
				$('#report_revenue_country_container').html(outEvoVal);
				
		},
		error: function(outEvoVal) {   
		  alert('error'); 
		}	
	});

});
  
</script>
<!-- main area -->
<div class="main-content">
  <div class="content-view">
	<div class="row" id="tbl_users" style="text-align: center;">
		<img src="<?php echo base_url(); ?>asset/images/loader.gif" id="loader" style="display:none; max-height: 100px;" />
	</div>
	
	<div class="row">
	  <div class='col-sm-12 col-md-12 col-lg-12'>
		<div class='card card-block'>
		  <p><h6>Daily Total Impression</h6></p>
		  <center><img src="<?php echo base_url(); ?>asset/images/loader.gif" id="loader6" style="display:none; max-height: 100px;" /></center>
		  <div id="total_per_location"></div>
		</div>
	  </div>
	</div>
	
		
	
	<div class="row">
	  <div class='col-sm-12 col-md-12 col-lg-12'>
		<div class='card card-block'>
		  <p><h6>Daily Total Click</h6></p>
		  <center><img src="<?php echo base_url(); ?>asset/images/loader.gif" id="loader3" style="display:none; max-height: 100px;" /></center>
		  <div id="model_total"></div>
		</div>
	  </div>
	</div> 
	
	
	
		<div class="row">
	  <div class='col-sm-6 col-md-6 col-lg-6'>
		<div class='card card-block'>
		  <p><h6>Monthly Total Unique Device vs. Unique Impression</h6></p>
		  <center><img src="<?php echo base_url(); ?>asset/images/loader.gif" id="loader6" style="display:none; max-height: 100px;" /></center>
		  <div id="total_monthly_device_impression"></div>
		</div>
	  </div>	  
		<div class='col-sm-6 col-md-6 col-lg-6'>
			<div class='card card-block'>
				<p><h6>Impression and Clicks (Yesterday's Ads)</h6></p>
			  <div id="report_revenue_country_container"></div>
			</div>
		</div>
	</div>	
	
	
	<!--	<div class="row">
		  <div class='col-sm-6 col-md-6 col-lg-6'>
			<div class='card card-block'>
			 
			
			  <p><h6>Gender Percentage</h6></p>
			  <center><img src="<?php echo base_url(); ?>asset/images/loader.gif" id="loader4" style="display:none; max-height: 100px;" /></center>
			  <div id="rate_gender"></div>
			
			</div>
			</ul>
		  </div>
		   <div class='col-sm-6 col-md-6 col-lg-6'>
			<div class='card card-block'>
			  <p><h6>Top 5 Model</h6></p>
			  <center><img src="<?php echo base_url(); ?>asset/images/loader.gif" id="loader5" style="display:none; max-height: 100px;" /></center>
			  <div id="top5_model"></div>
			</div>
		  </div>
		</div>-->
	
	

	



	
	
		
	<script>
	$(document).ready(function(){
		
		$('#loader2').show();
		$('#loader3').show();
		$('#loader4').show();
		$('#loader5').show();
		$('#loader6').show();
		$('#loader7').show();
		
/* 			$.ajax({    
			url: '<?php echo base_url(); ?>index.php/dashboard/gender_rate',
			type: "GET",
			dataType: "json",
			colors: ["#D95459"],
			success: function(outEvoVal) {    
			  console.log(outEvoVal);
		
				  Morris.Donut({  
				element: 'rate_gender',
				formatter: function (y, data) { return  y + '%' },
				parseTime: false,
				smooth: false,
				data: outEvoVal,
				colors: ["#D95459", "#407fd1"],
			  });
			  $('#loader4').hide();
			  
			},
			error: function() {
				 alert('error');
			  }
			
		}); */
		
		
	/* 		$.ajax({    
			url: '<?php echo base_url(); ?>index.php/dashboard/top_model',
			type: "GET",
			dataType: "json",
			colors: ["#D95459"],
			success: function(outEvoVal) {    
			  console.log(outEvoVal);
			  //alert(outEvoVal);
			  Morris.Bar({  
				element: 'top5_model',
				parseTime: false,
				smooth: false,
				  data: outEvoVal,
				  xkey: 'model',
				  xLabelAngle: 50,
				  barColors: ["#D95459"],
				  ykeys: ['modeltop'],
				  labels: ['Total']
			  });
			  $('#loader5').hide();
			  
			},
			error: function() {
				 alert('error');
			  }
			
		}); */
		
		
		
		
			$.ajax({    
			url: '<?php echo base_url(); ?>index.php/dashboard/agebracket_female',
			type: "GET",
			dataType: "json",
			colors: ["#D95459"],
			success: function(outEvoVal) {    
			  console.log(outEvoVal);
			  //alert(outEvoVal);
			  Morris.Bar({  
				element: 'total_female',
				parseTime: false,
				smooth: false,
				data: outEvoVal,
				  xkey: 'ads_name',
				  xLabelAngle: 8,
				  barColors: ["#D95459", "#407fd1"], 
				  ykeys: ['total_impression', 'total_click'],
				  labels: ['Impression', 'Click']
			  });
			  $('#loader7').hide();
			  
			},
			error: function() {
				 alert('error');
			  }
			
		});
		
		
		
		$.ajax({    
			url: '<?php echo base_url(); ?>index.php/dashboard/get_total_per_location',
			type: "GET",
			dataType: "json",
			colors: ["#D95459"],
			success: function(outEvoVal) {    
			  console.log(outEvoVal);
			  //alert(outEvoVal);
			  Morris.Line({  
				element: 'total_per_location',
				parseTime: false,
				smooth: false,
				  data: outEvoVal,
				  xkey: 'ads_date',
				  xLabelAngle: 50,
				  lineColors: ["#4CAF50","#D95459","#FFEB3B"],
				  ykeys: ['total_impression'],
				  labels: ['Impression']
			  });
			  $('#loader2').hide();
			  
			},
			error: function() {
				 alert('error');
			  }
			
		});
		
		
				$.ajax({    
			url: '<?php echo base_url(); ?>index.php/dashboard/monthly_device_impression',
			type: "GET",
			dataType: "json",
			colors: ["#D95459"],
			success: function(outEvoVal) {    
			  console.log(outEvoVal);
			  //alert(outEvoVal);
			  Morris.Line({  
				element: 'total_monthly_device_impression',
				parseTime: false,
				smooth: false,
				  data: outEvoVal,
				  xkey: 'ads_month',
				  xLabelAngle: 50,
				  lineColors: ["#D95459", "#4CAF50"],
				  ykeys: ['total_device', 'total_impression'],
				  labels: ['Total Unique Device', 'Total PushAds']
			  });
			  $('#loader6').hide();
			  
			},
			error: function() {
				 alert('error');
			  }
			
		});
		
		
		
		
		
 		$.ajax({    
			url: '<?php echo base_url(); ?>index.php/dashboard/get_model_total',
			type: "GET",
			dataType: "json",
			colors: ["#D95459"],
			success: function(outEvoVal) {    
			  console.log(outEvoVal);
			  //alert(outEvoVal);
			  Morris.Line({  
				element: 'model_total',
				parseTime: false,
				  smooth: false,
				  data: outEvoVal,
				  xkey: 'ads_date',
				  xLabelAngle: 50,
				  lineColors: ["#D95459", "#4CAF50", "#FFEB3B"],
				  ykeys: ['total_click'],
				  labels: ['Click']
			  });
			  $('#loader3').hide();
			  
			},
			error: function() {
				 alert('error');
			  }
			
		}); 
		
		
			  
		
		
		
		
	});
	</script>
	
  </div>
  <!-- bottom footer -->
  <div class="content-footer">
	<nav class="footer-left">
	  <ul class="nav">
		<li>
		  <a href="http://cdu.com.ph">
			<span>Copyright</span>
			&copy; 2016 Cosmic Digital Universe
		  </a>
		</li>
		
	  </ul>
	</nav>
  </div>
  <!-- /bottom footer -->
</div>
<!-- /main area -->
</div>
<!-- /content panel -->

<?php include('template/footer.php'); ?>