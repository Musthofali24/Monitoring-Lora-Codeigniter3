<?php
class Device extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    // Menampilkan semua devices (Untuk Admin)
    public function index()
    {
        $data['title'] = "Devices";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        if ($this->session->userdata('role_id') == 1) {
            $data['devices'] = $this->DeviceModel->get_all_devices();
            $this->load->view('admin/header', $data);
            $this->load->view('admin/sidebar', $data);
            $this->load->view('admin/device', $data);
            $this->load->view('admin/footer', $data);
        } else {
            $user_id = $this->session->userdata('id');
            $data['devices'] = $this->DeviceModel->get_user_devices($user_id);
            $this->load->view('user/header', $data);
            $this->load->view('user/sidebar', $data);
            $this->load->view('user/device', $data);
            $this->load->view('user/footer', $data);
        }
    }

    // Menyimpan data device baru
    public function store()
    {
        $this->form_validation->set_rules('device_name', 'Device Name', 'required');
        $this->form_validation->set_rules('application_name', 'Application Name', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('device/create');
        } else {
            $sensors = $this->input->post('sensors');
            $sensors_string = is_array($sensors) ? implode(',', $sensors) : '';

            $data = array(
                'device_name' => $this->input->post('device_name'),
                'user_id' => $this->input->post('user_id'),
                'application_name' => $this->input->post('application_name'),
                'sensors' => $sensors_string
            );
            var_dump($data);
            $this->DeviceModel->insert_device($data);
            redirect('device');
        }
    }


    // Menyimpan perubahan data device
    public function update()
    {
        $id = $this->input->post('id');
        $this->form_validation->set_rules('device_name', 'Device Name', 'required');
        $this->form_validation->set_rules('application_name', 'Application Name', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->index();
        } else {
            $sensors = $this->input->post('sensors');
            $sensors_string = is_array($sensors) ? implode(',', $sensors) : '';

            $data = array(
                'device_name' => $this->input->post('device_name'),
                'application_name' => $this->input->post('application_name'),
                'sensors' => $sensors_string
            );
            $this->DeviceModel->update_device($id, $data);
            redirect('device');
        }
    }


    // Menghapus device
    public function delete($id)
    {
        $this->DeviceModel->delete_device($id);
        redirect('device');
    }
}
