<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->accesscontrol->isUser();
    }

    public function index()
    {
        $user_id = $this->session->userdata('id');
        $data['title'] = "Dashboard";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['user_devices'] = $this->DeviceModel->count_user_devices($user_id);
        $data['sensors'] = $this->DeviceModel->get_user_sensors($user_id);
        $data['devices'] = $this->DeviceModel->get_user_devices_with_sensors($user_id);
        $this->load->view("user/header", $data);
        $this->load->view("user/sidebar", $data);
        $this->load->view("user/dashboard", $data);
        $this->load->view("user/footer");
    }


    public function profile()
    {
        $data['title'] = "Profile";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view("user/header", $data);
        $this->load->view("user/sidebar", $data);
        $this->load->view("user/profile", $data);
        $this->load->view("user/footer");
    }

    public function edit()
    {
        $data['title'] = "Edit Profile";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'Name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view("user/header", $data);
            $this->load->view("user/sidebar", $data);
            $this->load->view("user/edit", $data);
            $this->load->view("user/footer");
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            // cek jika ada gambar yg akan diatur
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/img/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.png') {
                        unlink(FCPATH . 'assets/img/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Your profile has been updated
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');

            redirect('user/profile');
        }
    }
}
