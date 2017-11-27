<?php
class Users_model extends CI_Model {

    public function can_log_in() {
		
        $this->db->where('username', $this->input->post('username'));
        $this->db->where('password', $this->input->post('password'));
        $query = $this->db->get('tbl_auth');
        $r = $query->result();
        
        if ($query->num_rows() == 1 ) {
            return $r;
        } else {
            return false;
        }
    }
    

}

?>