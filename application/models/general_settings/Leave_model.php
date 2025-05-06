<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of caste_model
 *
 * @author Seyad ali N
 */
class Leave_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function apply_leave_save($data)
    {
        $this->db->insert('leave_management', $data);
        return $this->db->insert_id();
    }
    public function get_applied_leave($id)
    {
        $this->db->select('lm.*');
        $this->db->from('leave_management lm');
        $this->db->where('lm.staff_id', $id);
        $query = $this->db->get()->result();
        return $query;
    }
    public function get_applied_leave_admin($id)
    {
        $this->db->select('lm.*,c.name as client_name');
        $this->db->from('leave_management lm');
        $this->db->join('clients c', 'c.id = lm.staff_id', 'left');
        $this->db->where('c.manager', $id);
        $query = $this->db->get()->result();
        return $query;
    }
    public function approve_leave($data, $id)
    {
        $this->db->update('leave_management', $data, 'id=' . $id . '');
        return true;
    }
}
