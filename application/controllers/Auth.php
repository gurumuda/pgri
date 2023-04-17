<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function register()
    {
        $this->load->view('template/meta');
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('menu/register');
        $this->load->view('template/script');
    }

    function process_register()
    {
        $email = $this->input->post('email', true);
        $password = $this->input->post('password', true);
        $name = $this->input->post('name', true);
        $gelar = $this->input->post('gelar', true);
        $address = $this->input->post('address', true);
        $noHP = $this->input->post('noHP', true);
        $instansi = $this->input->post('instansi', true);

        $insert = $this->insert->member($email, $password, $name, $gelar, $noHP, $address, $instansi);

        if ($insert == 1) {

            $array = array(
                'level' => 1,
                'email' => $email
            );

            $this->session->set_userdata($array);

            echo '1';
        } elseif ($insert == 2) {
            echo '2';
        } else {
            echo '0';
        }
    }

    public function login()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');


        if ($this->form_validation->run() == FALSE) {
            # code...
            $this->load->view('template/meta');
            $this->load->view('template/header');
            $this->load->view('template/sidebar');
            $this->load->view('menu/login');
            $this->load->view('template/script');
        } else {
            # code...
            $this->login_();
        }
    }

    private function login_()
    {
        $email = $this->input->post('email', true);
        $password = $this->input->post('password', true);

        $data = $this->db->get_where('members', ['email' => $email]);

        if ($data->num_rows() > 0) {
            # code...
            if (password_verify($password, $data->row()->password)) {
                # code...
                $array = array(
                    'level' => 1,
                    'email' => $email
                );

                $this->session->set_userdata($array);


                redirect('dashboard/profile', 'refresh');
            } else {
                # code...
                $this->session->set_flashdata('tipe', 'error');
                $this->session->set_flashdata('pesan', 'Email atau password tidak cocok');

                redirect('auth/login', 'refresh');
            }
        } else {
            # code...
            $this->session->set_flashdata('tipe', 'error');
            $this->session->set_flashdata('pesan', 'Email tidak terdaftar');

            redirect('auth/login', 'refresh');
        }
    }

    function login_admin()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('welcome_message');
        } else {
            $this->login_admin_();
        }
    }

    private function login_admin_()
    {
        $username = $this->input->post('username', true);
        $password = $this->input->post('password', true);

        $data = $this->db->get_where('admin', ['username' => $username]);

        if ($data->num_rows() > 0) {
            # code...
            if (password_verify($password, $data->row()->password)) {
                # code...
                $array = array(
                    'level' => 2,
                    'username' => $username
                );

                $this->session->set_userdata($array);


                redirect('admin', 'refresh');
            } else {
                # code...
                $this->session->set_flashdata('tipe', 'error');
                $this->session->set_flashdata('pesan', 'Email atau password tidak cocok');

                redirect('auth/login_admin', 'refresh');
            }
        } else {
            # code...
            $this->session->set_flashdata('tipe', 'error');
            $this->session->set_flashdata('pesan', 'Email tidak terdaftar');

            redirect('auth/login_admin', 'refresh');
        }
    }

    function logout()
    {

        $this->session->sess_destroy();

        redirect('dashboard', 'refresh');
    }
}

/* End of file Auth.php */
