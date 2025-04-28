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
class Task_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_staff_details($id)
    {
        $this->db->select('C.*');
        $this->db->from('clients as C');
        $this->db->where('C.manager', $id);
        $query = $this->db->get()->result();
        return $query;
    }
    public function schedule_task_save($data)
    {
        $this->db->insert('task', $data);
        return $this->db->insert_id();
    }
    public function get_tasks_details($id)
    {
        $this->db->select('T.*,C.name as staff_name');
        $this->db->from('task as T');
        $this->db->join('clients as C', 'C.id = T.staff_id', 'left');
        $this->db->where('C.manager', $id);
        $query = $this->db->get()->result();
        return $query;
    }
    public function get_tasks_details_unique($id)
    {
        $this->db->select('T.*,C.name as staff_name');
        $this->db->from('task as T');
        $this->db->join('clients as C', 'C.id = T.staff_id', 'left');
        $this->db->where('T.staff_id', $id);
        $query = $this->db->get()->result();
        return $query;
    }
    public function change_status($data, $id)
    {
        $this->db->update('task', $data, 'id=' . $id . '');
        return true;
    }
    public function task_details_single($id)
    {
        $this->db->select('T.*,C.name as staff_name');
        $this->db->from('task as T');
        $this->db->join('clients as C', 'C.id = T.staff_id', 'left');
        $this->db->where('T.id', $id);
        $query = $this->db->get()->row();
        return $query;
    }
}
