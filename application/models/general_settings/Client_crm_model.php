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
class Client_crm_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }


    public function get_details($staff_id)
    {
        if ($this->session->userdata['id'] == ADMIN_MANAGER) {
            $this->db->select('c.*, d.account_verify,u.fname as manager,u.company_name as manager_company');
            $this->db->from('clients AS c');
            $this->db->join('documents AS d', 'd.client_id = c.id', 'left');
            $this->db->join('user_details AS u', 'c.manager = u.id', 'left');
            $this->db->order_by('c.id', "desc");
        } else {
            $this->db->select('c.*, d.account_verify,u.fname as manager,u.company_name as manager_company');
            $this->db->from('clients AS c');
            $this->db->join('documents AS d', 'd.client_id = c.id', 'left');
            $this->db->join('user_details AS u', 'c.manager = u.id', 'left');
            $this->db->where('c.manager', $staff_id);
            $this->db->order_by('c.id', "desc");
        }


        $query = $this->db->get()->result();
        return $query;
    }
    public function staff_refund_details($staff_id, $start_date, $end_date)
    {
        $this->db->select('R.*');
        $this->db->from('refund AS R');
        $this->db->where('R.staff_id', $staff_id);
        $this->db->where('R.date >=', $start_date);
        $this->db->where('R.date <=', $end_date);
        $this->db->order_by('R.id', "desc");
        $query = $this->db->get()->result();
        return $query;
    }
    public function get_staff_details($staff_id)
    {
        if ($this->session->userdata['id'] == ADMIN_MANAGER) {
            $this->db->select('C.*');
            $this->db->from('clients as C');
        } else {
            $this->db->select('C.*');
            $this->db->from('clients as C');
            $this->db->where('C.manager', $staff_id);
        }
        $query = $this->db->get()->result();
        return $query;
    }
    public function get_countries()
    {
        $this->db->from('country');
        $this->db->order_by('country_name', "asc");
        $query = $this->db->get()->result();
        return $query;
    }
    public function get_client_staff_details()
    {
        $query = $this->db->select('U.*')
            ->from('user_details as U')
            ->get()
            ->result();
        return $query;
    }

    public function update_password($id, $data)
    {
        $this->db->update('clients', $data, 'id=' . $id . '');
        return true;
    }


    public function add_client($data)
    {
        if ($this->db->insert('clients', $data)) {
            return true;
        }
    }
    public function thumbnail_update($data, $id)
    {
        $this->db->update('clients', $data, 'id=' . $id . '');
        return true;
    }
    public function doc_upload($data)
    {
        if ($this->db->insert('documents', $data)) {
            return true;
        }
    }

    public function upload_document_update($data, $id)
    {
        $this->db->update('documents', $data, 'client_id=' . $id . '');
        return true;
    }
    public function update_document_status($client_id, $data)
    {
        $this->db->update('documents', $data, 'client_id=' . $client_id . '');
        return true;
    }
    public function activate_client($client_id, $data)
    {
        $this->db->update('documents', $data, 'client_id=' . $client_id . '');
        return true;
    }

    public function get_documents_details($id)
    {
        $this->db->from('documents');
        $this->db->where('client_id', $id);
        $query = $this->db->get()->row_array();
        return $query;
    }
    public function get_notverified_clients()
    {
        $this->db->from('clients');
        $this->db->order_by('id', "desc");
        $query = $this->db->get()->result();
        return $query;
    }

    public function add_bank_data($data)
    {
        if ($this->db->insert('bank_data', $data)) {
            return true;
        }
    }
    public function get_client_details($client_id)
    {
        $query = $this->db->select('C.*')
            ->from('clients as C')
            ->where('C.id', $client_id)
            ->get()
            ->row_array();
        return $query;
    }
    public function get_client_document_details($client_id)
    {
        $this->db->from('documents');
        $this->db->where('client_id', $client_id);
        $query = $this->db->get()->row_array();
        return $query;
    }

    public function add_wallet($data)
    {
        if ($this->db->insert('wallet_address', $data)) {
            return true;
        }
    }
    public function change_status($data, $client_id)
    {
        $this->db->update('clients', $data, 'id=' . $client_id . '');
        return true;
    }



    public function get_bank_data($id)
    {
        $this->db->from('bank_data');
        $this->db->where('client_id', $id);
        $query = $this->db->get()->result_array();
        return $query;
    }
    public function get_bank_details($id)
    {
        $this->db->from('bank_data');
        $this->db->where('client_id', $id);
        $this->db->where('status', 1);
        $this->db->order_by('id', "desc");
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function reject_bank_data($client_id, $id)
    {
        $this->db->update('bank_data', ['status' => '2'], ['client_id' => $client_id, 'id' => $id]);
        return true;
    }

    public function approve_bank_data($client_id, $id)
    {
        $this->db->update('bank_data', ['status' => '1'], ['client_id' => $client_id, 'id' => $id]);
        return true;
    }
}
