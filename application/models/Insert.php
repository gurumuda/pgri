<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Insert extends CI_Model
{
    function member($email, $password, $name, $gelar, $noHP, $address, $instansi)
    {
        $cek_email = $this->db->get_where('members', ['email' => $email])->num_rows();
        if ($cek_email > 0) {
            return 2;
        }

        $data = [
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'name' => $name,
            'title' => $gelar,
            'noHP' => $noHP,
            'address' => $address,
            'instansi' => $instansi,
        ];

        $insert = $this->db->insert('members', $data);

        if ($insert) {
            return 1;
        }

        return 0;
    }

    function profile()
    {
        $data = [
            'name' => $this->input->post('name', true),
            'jk' => $this->input->post('jk', true),
            'tmp_lahir' => $this->input->post('tmp_lahir', true),
            'tgl' => $this->input->post('tgl', true),
            'bln' => $this->input->post('bln', true),
            'thn' => $this->input->post('thn', true),
            'noKtp' => $this->input->post('noKtp', true),
            'agama' => $this->input->post('agama', true),
            'address' => $this->input->post('address', true),
            'kodePos' => $this->input->post('kodePos', true),
            'noHP' => $this->input->post('noHP', true),
            'ijazah' => $this->input->post('ijazah', true),
            'instansi' => $this->input->post('instansi', true),
            'jabatan' => $this->input->post('jabatan', true),
            'tgl_mulai' => $this->input->post('tgl_mulai', true),
            'bln_mulai' => $this->input->post('bln_mulai', true),
            'thn_mulai' => $this->input->post('thn_mulai', true),
            'status' => $this->input->post('status', true),
            'golongan' => $this->input->post('golongan', true),
            'tingkat_instansi' => $this->input->post('tingkat_instansi', true),
            'status_instansi' => $this->input->post('status_instansi', true),
            'bidang' => $this->input->post('bidang', true),
            'npa' => $this->input->post('npa', true),
            'kartu' => $this->input->post('kartu', true),
        ];

        $this->db->where('email', $this->session->userdata('email'));
        $update = $this->db->update('members', $data);

        if ($update) {
            # code...
            return 1;
        }
        return 0;
    }

    function photo()
    {

        $config['upload_path'] = './assets/images/photo/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']  = '1000';
        $config['encrypt_name']  = true;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('photo')) {
            $error = array('error' => $this->upload->display_errors());
            return $error;
        } else {
            $data = array('upload_data' => $this->upload->data());

            $config['image_library'] = 'gd2';
            $config['source_image'] = 'assets/images/photo/' . $this->upload->data('file_name');
            // $config['create_thumb'] = TRUE;
            $config['maintain_ratio'] = TRUE;
            $config['width']         = 300;
            $config['height']       = 400;
            $config['new_image'] = 'assets/images/photo/thumb/' . $this->upload->data('file_name');

            $this->load->library('image_lib', $config);
            $this->image_lib->initialize($config);
            $this->image_lib->resize();

            $object = ['photo' => $this->upload->data('file_name')];

            $this->db->where('email', $this->session->userdata('email'));
            $this->db->update('members', $object);
            return 1;
        }
    }

    function ubahMember()
    {
        $data = [
            'name' => $this->input->post('name', true),
            'jk' => $this->input->post('jk', true),
            'tmp_lahir' => $this->input->post('tmp_lahir', true),
            'tgl' => $this->input->post('tgl', true),
            'bln' => $this->input->post('bln', true),
            'thn' => $this->input->post('thn', true),
            'noKtp' => $this->input->post('noKtp', true),
            'agama' => $this->input->post('agama', true),
            'address' => $this->input->post('address', true),
            'kodePos' => $this->input->post('kodePos', true),
            'noHP' => $this->input->post('noHP', true),
            'ijazah' => $this->input->post('ijazah', true),
            'instansi' => $this->input->post('instansi', true),
            'jabatan' => $this->input->post('jabatan', true),
            'tgl_mulai' => $this->input->post('tgl_mulai', true),
            'bln_mulai' => $this->input->post('bln_mulai', true),
            'thn_mulai' => $this->input->post('thn_mulai', true),
            'status' => $this->input->post('status', true),
            'golongan' => $this->input->post('golongan', true),
            'tingkat_instansi' => $this->input->post('tingkat_instansi', true),
            'status_instansi' => $this->input->post('status_instansi', true),
            'bidang' => $this->input->post('bidang', true),
            'npa' => $this->input->post('npa', true),
            'kartu' => $this->input->post('kartu', true),

        ];

        $this->db->where('id', $this->input->post('id'));
        $update = $this->db->update('members', $data);

        if ($update) {
            # code...
            return 1;
        }
        return 0;
    }

    function ubahPhoto()
    {

        $config['upload_path'] = './assets/images/photo/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']  = '1000';
        $config['encrypt_name']  = true;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('photo')) {
            $error = array('error' => $this->upload->display_errors());
            return $error;
        } else {
            $data = array('upload_data' => $this->upload->data());

            $config['image_library'] = 'gd2';
            $config['source_image'] = 'assets/images/photo/' . $this->upload->data('file_name');
            // $config['create_thumb'] = TRUE;
            $config['maintain_ratio'] = TRUE;
            $config['width']         = 300;
            $config['height']       = 400;
            $config['new_image'] = 'assets/images/photo/thumb/' . $this->upload->data('file_name');

            $this->load->library('image_lib', $config);
            $this->image_lib->initialize($config);
            $this->image_lib->resize();

            $object = ['photo' => $this->upload->data('file_name')];

            $this->db->where('id', $this->input->post('id'));
            $this->db->update('members', $object);
            return 1;
        }
    }

    function message()
    {
        $data = [
            'name' => $this->input->post('name', true),
            'noHP' => $this->input->post('noHP', true),
            'email' => $this->input->post('email', true),
            'subject' => $this->input->post('subject', true),
            'message' => $this->input->post('message', true),
        ];

        $save = $this->db->insert('messages', $data);

        if ($save) {
            return 1;
        }

        return 0;
    }
}

/* End of file Insert.php */
