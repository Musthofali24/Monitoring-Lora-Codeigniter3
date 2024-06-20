<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insert($table, $data)
    {
        return $this->db->insert($table, $data);
    }

    public function count_all_users()
    {
        return $this->db->count_all('user');
    }

    public function count_users_by_criteria($criteria)
    {
        $this->db->where($criteria);
        $this->db->from('user');
        return $this->db->count_all_results();
    }
}
