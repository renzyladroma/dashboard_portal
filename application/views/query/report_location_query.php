<?php
set_time_limit(0);
$location_name = $this->db->query("SELECT ads_id FROM advertiser_summary_report GROUP BY ads_id LIMIT 5"); 
//$year = $this->db->query("SELECT DISTINCT(LEFT(DATE, 4)) AS YEAR FROM `advertiser_summary_report` GROUP BY YEAR ORDER BY YEAR ASC");


?>