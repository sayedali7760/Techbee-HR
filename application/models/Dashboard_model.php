<?php
class Dashboard_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_total_staff()
    {
        $staff_id = $this->session->userdata['id'];

        if ($this->session->userdata['id'] == ADMIN_MANAGER) {
            $this->db->select('COUNT(*) as total_staffs');
            $this->db->from('clients AS c');
        } else {
            $this->db->select('COUNT(*) as total_staffs');
            $this->db->from('clients AS c');
            $this->db->where('c.manager', $staff_id);
        }
        $query = $this->db->get();
        $total_count = $query->row()->total_staffs;
        return $total_count;
    }
    public function get_total_tasks()
    {
        $staff_id = $this->session->userdata['id'];

        if ($this->session->userdata['id'] == ADMIN_MANAGER) {
            $this->db->select('COUNT(*) as total_task');
            $this->db->from('task AS t');
            $this->db->join('clients AS c', 'c.id = t.staff_id', 'left');
        } else {
            $this->db->select('COUNT(*) as total_task');
            $this->db->from('task AS t');
            $this->db->join('clients AS c', 'c.id = t.staff_id', 'left');
            $this->db->where('c.manager', $staff_id);
        }
        $query = $this->db->get();
        $total_count = $query->row()->total_task;
        return $total_count;
    }
    public function get_total_leave()
    {
        $staff_id = $this->session->userdata['id'];

        if ($this->session->userdata['id'] == ADMIN_MANAGER) {
            $this->db->select('COUNT(*) as total_leave');
            $this->db->from('leave_management AS l');
            $this->db->join('clients AS c', 'c.id = l.staff_id', 'left');
            $this->db->where('l.status', 1);
        } else {
            $this->db->select('COUNT(*) as total_leave');
            $this->db->from('leave_management AS l');
            $this->db->join('clients AS c', 'c.id = l.staff_id', 'left');
            $this->db->where('l.status', 1);
            $this->db->where('c.manager', $staff_id);
        }
        $query = $this->db->get();
        $total_count = $query->row()->total_leave;
        return $total_count;
    }
    public function get_leave_applications()
    {
        $staff_id = $this->session->userdata['id'];

        if ($this->session->userdata['id'] == ADMIN_MANAGER) {
            $this->db->select('l.*, c.name as staff_name');
            $this->db->from('leave_management AS l');
            $this->db->join('clients AS c', 'c.id = l.staff_id', 'left');
            $this->db->where('l.status', 0);
        } else {
            $this->db->select('l.*, c.name as staff_name');
            $this->db->from('leave_management AS l');
            $this->db->join('clients AS c', 'c.id = l.staff_id', 'left');
            $this->db->where('l.status', 0);
            $this->db->where('c.manager', $staff_id);
        }
        $query = $this->db->get()->result();
        return $query;
    }
}
