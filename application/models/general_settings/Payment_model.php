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
class Payment_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function refund_save($data)
    {
        if ($this->db->insert('refund', $data)) {
            return true;
        }
    }
    public function get_refund_data()
    {
        $this->db->select('r.*, c.name as staff_name');
        $this->db->from('refund AS r');
        $this->db->join('clients AS c', 'c.id = r.staff_id', 'left');
        $this->db->order_by('r.id', "desc");
        $query = $this->db->get()->result();
        return $query;
    }
    public function approve_refund($data, $id)
    {
        $this->db->update('refund', $data, 'id=' . $id . '');
        return true;
    }
    public function refund_details_single($id)
    {
        $this->db->select('r.*, c.name as staff_name');
        $this->db->from('refund AS r');
        $this->db->join('clients AS c', 'c.id = r.staff_id', 'left');
        $this->db->where('r.id', $id);
        $query = $this->db->get()->row();
        return $query;
    }
}
