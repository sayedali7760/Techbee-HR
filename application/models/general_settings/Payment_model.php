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
    public function get_refund_data_client()
    {
        $client_id = $this->session->userdata['id'];
        $this->db->select('r.*, c.name as staff_name');
        $this->db->from('refund AS r');
        $this->db->join('clients AS c', 'c.id = r.staff_id', 'left');
        $this->db->where('c.id', $client_id);
        $this->db->order_by('r.id', "desc");
        $query = $this->db->get()->result();
        return $query;
    }
    public function get_refund_data()
    {
        $admin_id = $this->session->userdata['id'];
        if ($this->session->userdata['id'] == ADMIN_MANAGER) {
            $this->db->select('r.*, c.name as staff_name');
            $this->db->from('refund AS r');
            $this->db->join('clients AS c', 'c.id = r.staff_id', 'left');
            $this->db->order_by('r.id', "desc");
        } else {
            $this->db->select('r.*, c.name as staff_name');
            $this->db->from('refund AS r');
            $this->db->join('clients AS c', 'c.id = r.staff_id', 'left');
            $this->db->where('c.manager', $admin_id);
            $this->db->order_by('r.id', "desc");
        }
        $query = $this->db->get()->result();
        return $query;
    }
    public function payroll_payment_save($data)
    {
        if ($this->db->insert('payroll_payment', $data)) {
            return true;
        }
    }
    public function get_out_standing_balance($staff_id)
    {
        $this->db->select('p.balance');
        $this->db->from('payroll_payment AS p');
        $this->db->where('staff_id', $staff_id);
        $this->db->order_by('p.id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get()->row();
        return $query;
    }
    public function get_payroll_details_added($staff_id)
    {
        if ($this->session->userdata['id'] == ADMIN_MANAGER) {
            $this->db->select('p.*, c.name as staff_name,c.id as staff_id,c.salary as staff_salary');
            $this->db->from('payroll_payment AS p');
            $this->db->join('clients AS c', 'c.id = p.staff_id', 'left');
            $this->db->order_by('p.id', "desc");
        } else {
            $this->db->select('p.*, c.name as staff_name,c.id as staff_id,c.salary as staff_salary');
            $this->db->from('payroll_payment AS p');
            $this->db->join('clients AS c', 'c.id = p.staff_id', 'left');
            $this->db->where('c.manager', $staff_id);
            $this->db->order_by('p.id', "desc");
        }

        $query = $this->db->get()->result();
        return $query;
    }
    public function get_payroll_details_added_client($staff_id)
    {
        $this->db->select('p.*, c.name as staff_name,c.id as staff_id,c.salary as staff_salary');
        $this->db->from('payroll_payment AS p');
        $this->db->join('clients AS c', 'c.id = p.staff_id', 'left');
        $this->db->where('p.staff_id', $staff_id);
        $this->db->order_by('p.id', "desc");
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
