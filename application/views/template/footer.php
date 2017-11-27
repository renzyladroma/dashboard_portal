
    <script type="text/javascript">
      window.paceOptions = {
        document: true,
        eventLag: true,
        restartOnPushState: true,
        restartOnRequestAfter: true,
        ajax: {
          trackMethods: [ 'POST','GET']
        }
      };
    </script>
	
	

    <!-- build:js({.tmp,app}) scripts/app.min.js -->
    
    <script src="<?php echo base_url(); ?>asset/vendor/pace/pace.js"></script>
    <script src="<?php echo base_url(); ?>asset/vendor/tether/dist/js/tether.js"></script>
    <script src="<?php echo base_url(); ?>asset/vendor/bootstrap/dist/js/bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>asset/vendor/fastclick/lib/fastclick.js"></script>
    <script src="<?php echo base_url(); ?>asset/scripts/constants.js"></script>
	<script src="<?php echo base_url(); ?>asset/scripts/menu.js"></script>
    <!-- endbuild -->

    

    <!-- initialize page scripts -->
    <script src="<?php echo base_url(); ?>asset/vendor/datatables/media/js/jquery.dataTables.js"></script>
    <script src="<?php echo base_url(); ?>asset/vendor/datatables/media/js/dataTables.bootstrap4.js"></script>
	<link rel="stylesheet" href="http://115.85.17.57:8001/ChumsDashboard/assets/js/datatables/buttons.dataTables.min.css">
	<script type="text/javascript" language="javascript" src="http://115.85.17.57:8001/ChumsDashboard/assets/js/datatables/dataTables.buttons.min.js"></script>
	<script type="text/javascript" language="javascript" src="http://115.85.17.57:8001/ChumsDashboard/assets/js/datatables/buttons.flash.min.js"></script>
	
	<script src="<?php echo base_url(); ?>asset/vendor/moment/min/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/vendor/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="<?php echo base_url(); ?>asset/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url(); ?>asset/vendor/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
    <script src="<?php echo base_url(); ?>asset/vendor/clockpicker/dist/jquery-clockpicker.min.js"></script>
    <!-- end initialize page scripts -->
    
  </body>
</html>