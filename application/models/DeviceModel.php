<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DeviceModel extends CI_Model
{
    public function get_all_devices()
    {
        $query = $this->db->get('devices');
        return $query->result();
    }

    public function get_user_devices($user_id)
    {
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('devices');
        return $query->result();
    }

    public function insert_device($data)
    {
        return $this->db->insert('devices', $data);
    }

    public function update_device($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('devices', $data);
    }

    public function delete_device($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('devices');
    }

    public function count_all_devices()
    {
        return $this->db->count_all('devices');
    }

    public function count_user_devices($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->from('devices');
        return $this->db->count_all_results();
    }

    public function get_user_sensors($user_id)
    {
        $this->db->select('sensors');
        $this->db->from('devices');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        $result = $query->result();

        $sensors = [];
        foreach ($result as $row) {
            $device_sensors = explode(',', $row->sensors);
            foreach ($device_sensors as $sensor) {
                if (!in_array($sensor, $sensors)) {
                    $sensors[] = trim($sensor);
                }
            }
        }

        return $sensors;
    }

    public function get_user_devices_with_sensors($user_id)
    {
        $this->db->select('id, device_name, sensors');
        $this->db->from('devices');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        return $query->result();
    }
}
