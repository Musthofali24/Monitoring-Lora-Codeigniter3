<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SensorModel extends CI_Model
{
    public function insert_data($data)
    {
        return $this->db->insert('sensor_data', $data);
    }

    public function get_all_data()
    {
        $query = $this->db->get('sensor_data');
        return $query->result();
    }

    public function get_sensor_data($device_id = null)
    {
        if ($device_id !== null) {
            $this->db->where('device_id', $device_id);
        }
        $query = $this->db->get('sensor_data');
        return $query->result_array();
    }
}
