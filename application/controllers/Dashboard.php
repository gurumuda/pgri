<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function index()
    {
        $this->load->view('template/meta');
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('menu/dashboard');
        $this->load->view('template/script');
    }

    public function profile()
    {
        if ((!$this->session->userdata('level') == 1) && (!$this->session->userdata('email'))) {
            redirect('dashboard', 'refresh');
        }

        $email = $this->session->userdata('email');
        $data['member'] = $this->db->get_where('members', ['email' => $email])->row();

        $this->load->view('template/meta', $data);
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('menu/profile');
        $this->load->view('template/script');
    }

    function edit_profile()
    {
        $update = $this->insert->profile();
        if ($update == 1) {
            # code...
            $this->session->set_flashdata('tipe', 'success');
            $this->session->set_flashdata('pesan', 'Data berhasil disimpan');

            redirect('dashboard/profile', 'refresh');
        } else {
            $this->session->set_flashdata('tipe', 'error');
            $this->session->set_flashdata('pesan', 'Data gagal disimpan');

            redirect('dashboard/profile', 'refresh');
        }
    }

    function up_photo()
    {
        $upload = $this->insert->photo();
        if ($upload == 1) {
            # code...
            $this->session->set_flashdata('tipe', 'success');
            $this->session->set_flashdata('pesan', 'Foto berhasil disimpan');
            redirect('dashboard/profile', 'refresh');
        } else {
            $this->session->set_flashdata('tipe', 'error');
            $this->session->set_flashdata('pesan', ($upload['error']));

            redirect('dashboard/profile', 'refresh');
        }
    }

    function tandatangan()
    {

        $s_img = $this->input->post('image');
        $img = str_replace('data:image/png;base64,', '', $s_img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $file = uniqid() . '.png';
        $path = './assets/sign/';
        $success = file_put_contents($path . $file, $data);
        $image = str_replace('./', '', $file);

        $object = ['ttd' => $file, 'ttd_json' => $s_img];

        $this->db->where('email', $this->session->userdata('email'));
        $this->db->update('members', $object);


        redirect('dashboard/profile', 'refresh');

        // $this->welcome_model->insert_single_signature($image);
        // echo '<img src="' . base_url() . $image . '">';
    }

    public function print()
    {
        $this->load->helper('formater_helper');

        $this->db->where('email', $this->session->userdata('email'));
        $member = $this->db->get('members')->row();

        require(APPPATH . '/libraries/fpdf/fpdf.php');

        $pdf = new FPDF('P', 'mm', 'A4');

        $pdf->AddPage();
        $pdf->SetMargins(20, 5, 10);
        $pdf->Image('./assets/images/logo/pgri.png', 20, 10, 30);
        $pdf->SetY(15);
        $pdf->Cell(20, 0, '', 0);
        $pdf->SetFont('Times', 'B', 14);
        $pdf->Cell(160, 8, 'PERSATUAN GURU RAPUBLIK INDONESIA (PGRI)', 0, 0, 'C');
        $pdf->Ln(8);
        $pdf->Cell(20, 0, '', 0);
        $pdf->Cell(160, 8, 'PENGURUS BESAR', 0, 0, 'C');
        $pdf->Ln(5);
        $pdf->Line(20, 40, 190, 40);
        $pdf->Line(20, 40.5, 190, 40.5);
        $pdf->Ln(20);
        $pdf->SetFont('Times', 'BU', 12);
        $pdf->Cell(180, 8, ($member->npa != '') ? 'DATA ANGGOTA PGRI' : 'FORMULIR REGISTRASI ANGGOTA PGRI', 0, 0, 'C');
        $pdf->Ln(5);
        $pdf->SetFont('Times', 'I', 9);
        $pdf->Cell(180, 8, 'Isilah dengan jelas dan benar biodata di bawah ini sesuai dengan keadaan yang sebenarnya', 0, 0, 'C');

        $pdf->Ln(15);
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(170, 8, 'KETERANGAN PRIBADI', 0, 0, 'L');
        $pdf->Ln(8);
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(10, 8, '', 0, 0);
        $pdf->Cell(50, 8, 'NPA PGRI', 0, 0, 'L');
        $pdf->Cell(3, 8, ':', 0, 0, 'L');
        $pdf->Cell(107, 8, $member->npa, 0, 0, 'L');

        $pdf->Ln(6);
        $pdf->Cell(10, 8, '1.', 0, 0, 'R');
        $pdf->Cell(50, 8, 'Nama Lengkap', 0, 0, 'L');
        $pdf->Cell(3, 8, ':', 0, 0, 'L');
        $pdf->Cell(107, 8, $member->name, 0, 0, 'L');

        $pdf->Ln(6);
        $pdf->Cell(10, 8, '2.', 0, 0, 'R');
        $pdf->Cell(50, 8, 'Jenis Kelamin', 0, 0, 'L');
        $pdf->Cell(3, 8, ':', 0, 0, 'L');
        $pdf->Cell(107, 8, ($member->jk == '01') ? 'Laki-laki' : 'Perempuan', 0, 0, 'L');

        $pdf->Ln(6);
        $pdf->Cell(10, 8, '3.', 0, 0, 'R');
        $pdf->Cell(50, 8, 'Tempat / Tanggal Lahir', 0, 0, 'L');
        $pdf->Cell(3, 8, ':', 0, 0, 'L');
        $pdf->Cell(107, 8, $member->tmp_lahir . ' / ' . $member->tgl . ' ' . bulan($member->bln) . ' ' . $member->thn, 0, 0, 'L');

        $pdf->Ln(6);
        $pdf->Cell(10, 8, '4.', 0, 0, 'R');
        $pdf->Cell(50, 8, 'Agama', 0, 0, 'L');
        $pdf->Cell(3, 8, ':', 0, 0, 'L');
        $pdf->Cell(107, 8, agama($member->agama), 0, 0, 'L');

        $pdf->Ln(6);
        $pdf->Cell(10, 8, '5.', 0, 0, 'R');
        $pdf->Cell(50, 8, 'Nomor KTP', 0, 0, 'L');
        $pdf->Cell(3, 8, ':', 0, 0, 'L');
        $pdf->Cell(107, 8, $member->noKtp, 0, 0, 'L');

        $pdf->Ln(8);
        $pdf->Cell(10, 5, '6.', 0, 0, 'R');
        $pdf->Cell(50, 5, 'Alamat', 0, 0, 'L');
        $pdf->Cell(3, 5, ':', 0, 0, 'L');
        $pdf->MultiCell(107, 5, $member->address, 0, 'L');

        $pdf->SetY(130);
        $pdf->Cell(10, 8, '7.', 0, 0, 'R');
        $pdf->Cell(50, 8, 'Kode Pos', 0, 0, 'L');
        $pdf->Cell(3, 8, ':', 0, 0, 'L');
        $pdf->Cell(107, 8, $member->kodePos, 0, 0, 'L');

        $pdf->Ln(6);
        $pdf->Cell(10, 8, '8.', 0, 0, 'R');
        $pdf->Cell(50, 8, 'Nomor TLP', 0, 0, 'L');
        $pdf->Cell(3, 8, ':', 0, 0, 'L');
        $pdf->Cell(107, 8, '(________) _______________', 0, 0, 'L');

        $pdf->Ln(6);
        $pdf->Cell(10, 8, '9.', 0, 0, 'R');
        $pdf->Cell(50, 8, 'Nomor HP', 0, 0, 'L');
        $pdf->Cell(3, 8, ':', 0, 0, 'L');
        $pdf->Cell(107, 8, $member->noHP, 0, 0, 'L');

        $pdf->Ln(6);
        $pdf->Cell(10, 8, '10.', 0, 0, 'R');
        $pdf->Cell(50, 8, 'Alamat Email', 0, 0, 'L');
        $pdf->Cell(3, 8, ':', 0, 0, 'L');
        $pdf->Cell(107, 8, $member->email, 0, 0, 'L');


        $pdf->Ln(6);
        $pdf->Cell(10, 8, '11.', 0, 0, 'R');
        $pdf->Cell(50, 8, 'Ijazah Terakhir', 0, 0, 'L');
        $pdf->Cell(3, 8, ':', 0, 0, 'L');
        $pdf->Cell(107, 8, ijazah($member->ijazah), 0, 0, 'L');

        $pdf->Ln(10);
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(170, 8, 'KETERANGAN KERJA', 0, 0, 'L');

        $pdf->Ln(8);
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(10, 8, '12.', 0, 0, 'R');
        $pdf->Cell(50, 8, 'Tempat Kerja', 0, 0, 'L');
        $pdf->Cell(3, 8, ':', 0, 0, 'L');
        $pdf->Cell(107, 8, $member->instansi, 0, 0, 'L');

        $pdf->Ln(6);
        $pdf->Cell(10, 8, '13.', 0, 0, 'R');
        $pdf->Cell(50, 8, 'Tugas/Jabatan', 0, 0, 'L');
        $pdf->Cell(3, 8, ':', 0, 0, 'L');
        $pdf->Cell(107, 8, jabatan($member->jabatan), 0, 0, 'L');

        $pdf->Ln(6);
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(10, 8, '14.', 0, 0, 'R');
        $pdf->Cell(50, 8, 'Tanggal Mulai Tugas', 0, 0, 'L');
        $pdf->Cell(3, 8, ':', 0, 0, 'L');
        $pdf->Cell(107, 8, $member->tgl_mulai . ' ' . bulan($member->bln_mulai) . ' ' . $member->thn_mulai, 0, 0, 'L');

        $pdf->Ln(6);
        $pdf->Cell(10, 8, '15.', 0, 0, 'R');
        $pdf->Cell(50, 8, 'Status Kepegawaian', 0, 0, 'L');
        $pdf->Cell(3, 8, ':', 0, 0, 'L');
        $pdf->Cell(107, 8, status($member->status), 0, 0, 'L');

        $pdf->Ln(6);
        $pdf->Cell(10, 8, '16.', 0, 0, 'R');
        $pdf->Cell(50, 8, 'Golongan', 0, 0, 'L');
        $pdf->Cell(3, 8, ':', 0, 0, 'L');
        $pdf->Cell(107, 8, golongan($member->golongan), 0, 0, 'L');

        $pdf->Ln(6);
        $pdf->Cell(10, 8, '17.', 0, 0, 'R');
        $pdf->Cell(50, 8, 'Tingkat Instansi Bekerja', 0, 0, 'L');
        $pdf->Cell(3, 8, ':', 0, 0, 'L');
        $pdf->Cell(107, 8, tingkat($member->tingkat_instansi), 0, 0, 'L');

        $pdf->Ln(6);
        $pdf->Cell(10, 8, '18.', 0, 0, 'R');
        $pdf->Cell(50, 8, 'Status Sekolah', 0, 0, 'L');
        $pdf->Cell(3, 8, ':', 0, 0, 'L');
        $pdf->Cell(107, 8, ($member->jk == '01') ? 'Negeri' : 'Swasta', 0, 0, 'L');

        $pdf->Ln(6);
        $pdf->Cell(10, 8, '19.', 0, 0, 'R');
        $pdf->Cell(50, 8, 'Mengajar / Bidang Studi', 0, 0, 'L');
        $pdf->Cell(3, 8, ':', 0, 0, 'L');
        $pdf->Cell(107, 8, $member->bidang, 0, 0, 'L');

        if ($member->photo) {

            $pdf->Image('./assets/images/photo/thumb/' . $member->photo, 30, 230, 30, 40);
        }

        if ($member->ttd) {

            $pdf->Image('./assets/sign/' . $member->ttd, 110, 245, 40, 20);
        }


        $pdf->SetY(230);
        $pdf->Cell(90, 8, '', 0, 0, 'L');
        $pdf->Cell(80, 8, 'Jorong, ' . date('d') . ' ' . bulan(date('m')) . ' ' . date('Y'), 0, 0, 'L');
        $pdf->Ln(6);
        $pdf->Cell(90, 8, '', 0, 0, 'L');
        $pdf->Cell(80, 8, 'Yang bersangkutan,', 0, 0, 'L');
        $pdf->Ln(25);
        $pdf->Cell(90, 8, '', 0, 0, 'L');
        $pdf->Cell(80, 8, $member->name, 0, 0, 'L');


        $pdf->Output();
    }

    public function print_all()
    {
        $this->load->helper('formater_helper');

        // $this->db->where('email', $this->session->userdata('email'));
        $member = $this->db->get('members')->result();

        require(APPPATH . '/libraries/fpdf/fpdf.php');

        $pdf = new FPDF('P', 'mm', 'A4');

        foreach ($member as $member) :

            $pdf->AddPage();
            $pdf->SetMargins(20, 5, 10);
            $pdf->Image('./assets/images/logo/pgri.png', 20, 10, 30);
            $pdf->SetY(15);
            $pdf->Cell(20, 0, '', 0);
            $pdf->SetFont('Times', 'B', 14);
            $pdf->Cell(160, 8, 'PERSATUAN GURU RAPUBLIK INDONESIA (PGRI)', 0, 0, 'C');
            $pdf->Ln(8);
            $pdf->Cell(20, 0, '', 0);
            $pdf->Cell(160, 8, 'PENGURUS BESAR', 0, 0, 'C');
            $pdf->Ln(5);
            $pdf->Line(20, 40, 190, 40);
            $pdf->Line(20, 40.5, 190, 40.5);
            $pdf->Ln(20);
            $pdf->SetFont('Times', 'BU', 12);
            $pdf->Cell(180, 8, 'FORMULIR REGISTRASI ANGGOTA PGRI', 0, 0, 'C');
            $pdf->Ln(5);
            $pdf->SetFont('Times', 'I', 9);
            $pdf->Cell(180, 8, 'Isilah dengan jelas dan benar biodata di bawah ini sesuai dengan keadaan yang sebenarnya', 0, 0, 'C');

            $pdf->Ln(15);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(170, 8, 'KETERANGAN PRIBADI', 0, 0, 'L');
            $pdf->Ln(8);
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(10, 8, '', 0, 0);
            $pdf->Cell(50, 8, 'NPA PGRI', 0, 0, 'L');
            $pdf->Cell(3, 8, ':', 0, 0, 'L');
            $pdf->Cell(107, 8, '_____________________', 0, 0, 'L');

            $pdf->Ln(6);
            $pdf->Cell(10, 8, '1.', 0, 0, 'R');
            $pdf->Cell(50, 8, 'Nama Lengkap', 0, 0, 'L');
            $pdf->Cell(3, 8, ':', 0, 0, 'L');
            $pdf->Cell(107, 8, $member->name, 0, 0, 'L');

            $pdf->Ln(6);
            $pdf->Cell(10, 8, '2.', 0, 0, 'R');
            $pdf->Cell(50, 8, 'Jenis Kelamin', 0, 0, 'L');
            $pdf->Cell(3, 8, ':', 0, 0, 'L');
            $pdf->Cell(107, 8, ($member->jk == '01') ? 'Laki-laki' : 'Perempuan', 0, 0, 'L');

            $pdf->Ln(6);
            $pdf->Cell(10, 8, '3.', 0, 0, 'R');
            $pdf->Cell(50, 8, 'Tempat / Tanggal Lahir', 0, 0, 'L');
            $pdf->Cell(3, 8, ':', 0, 0, 'L');
            $pdf->Cell(107, 8, $member->tmp_lahir . ' / ' . $member->tgl . ' ' . bulan($member->bln) . ' ' . $member->thn, 0, 0, 'L');

            $pdf->Ln(6);
            $pdf->Cell(10, 8, '4.', 0, 0, 'R');
            $pdf->Cell(50, 8, 'Agama', 0, 0, 'L');
            $pdf->Cell(3, 8, ':', 0, 0, 'L');
            $pdf->Cell(107, 8, agama($member->agama), 0, 0, 'L');

            $pdf->Ln(6);
            $pdf->Cell(10, 8, '5.', 0, 0, 'R');
            $pdf->Cell(50, 8, 'Nomor KTP', 0, 0, 'L');
            $pdf->Cell(3, 8, ':', 0, 0, 'L');
            $pdf->Cell(107, 8, $member->noKtp, 0, 0, 'L');

            $pdf->Ln(8);
            $pdf->Cell(10, 5, '6.', 0, 0, 'R');
            $pdf->Cell(50, 5, 'Alamat', 0, 0, 'L');
            $pdf->Cell(3, 5, ':', 0, 0, 'L');
            $pdf->MultiCell(107, 5, $member->address, 0, 'L');

            $pdf->SetY(130);
            $pdf->Cell(10, 8, '7.', 0, 0, 'R');
            $pdf->Cell(50, 8, 'Kode Pos', 0, 0, 'L');
            $pdf->Cell(3, 8, ':', 0, 0, 'L');
            $pdf->Cell(107, 8, $member->kodePos, 0, 0, 'L');

            $pdf->Ln(6);
            $pdf->Cell(10, 8, '8.', 0, 0, 'R');
            $pdf->Cell(50, 8, 'Nomor TLP', 0, 0, 'L');
            $pdf->Cell(3, 8, ':', 0, 0, 'L');
            $pdf->Cell(107, 8, '(________) _______________', 0, 0, 'L');

            $pdf->Ln(6);
            $pdf->Cell(10, 8, '9.', 0, 0, 'R');
            $pdf->Cell(50, 8, 'Nomor HP', 0, 0, 'L');
            $pdf->Cell(3, 8, ':', 0, 0, 'L');
            $pdf->Cell(107, 8, $member->noHP, 0, 0, 'L');

            $pdf->Ln(6);
            $pdf->Cell(10, 8, '10.', 0, 0, 'R');
            $pdf->Cell(50, 8, 'Alamat Email', 0, 0, 'L');
            $pdf->Cell(3, 8, ':', 0, 0, 'L');
            $pdf->Cell(107, 8, $member->email, 0, 0, 'L');


            $pdf->Ln(6);
            $pdf->Cell(10, 8, '11.', 0, 0, 'R');
            $pdf->Cell(50, 8, 'Ijazah Terakhir', 0, 0, 'L');
            $pdf->Cell(3, 8, ':', 0, 0, 'L');
            $pdf->Cell(107, 8, ijazah($member->ijazah), 0, 0, 'L');

            $pdf->Ln(10);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(170, 8, 'KETERANGAN KERJA', 0, 0, 'L');

            $pdf->Ln(8);
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(10, 8, '12.', 0, 0, 'R');
            $pdf->Cell(50, 8, 'Tempat Kerja', 0, 0, 'L');
            $pdf->Cell(3, 8, ':', 0, 0, 'L');
            $pdf->Cell(107, 8, $member->instansi, 0, 0, 'L');

            $pdf->Ln(6);
            $pdf->Cell(10, 8, '13.', 0, 0, 'R');
            $pdf->Cell(50, 8, 'Tugas/Jabatan', 0, 0, 'L');
            $pdf->Cell(3, 8, ':', 0, 0, 'L');
            $pdf->Cell(107, 8, jabatan($member->jabatan), 0, 0, 'L');

            $pdf->Ln(6);
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(10, 8, '14.', 0, 0, 'R');
            $pdf->Cell(50, 8, 'Tanggal Mulai Tugas', 0, 0, 'L');
            $pdf->Cell(3, 8, ':', 0, 0, 'L');
            $pdf->Cell(107, 8, $member->tgl_mulai . ' ' . bulan($member->bln_mulai) . ' ' . $member->thn_mulai, 0, 0, 'L');

            $pdf->Ln(6);
            $pdf->Cell(10, 8, '15.', 0, 0, 'R');
            $pdf->Cell(50, 8, 'Status Kepegawaian', 0, 0, 'L');
            $pdf->Cell(3, 8, ':', 0, 0, 'L');
            $pdf->Cell(107, 8, status($member->status), 0, 0, 'L');

            $pdf->Ln(6);
            $pdf->Cell(10, 8, '16.', 0, 0, 'R');
            $pdf->Cell(50, 8, 'Golongan', 0, 0, 'L');
            $pdf->Cell(3, 8, ':', 0, 0, 'L');
            $pdf->Cell(107, 8, golongan($member->golongan), 0, 0, 'L');

            $pdf->Ln(6);
            $pdf->Cell(10, 8, '17.', 0, 0, 'R');
            $pdf->Cell(50, 8, 'Tingkat Instansi Bekerja', 0, 0, 'L');
            $pdf->Cell(3, 8, ':', 0, 0, 'L');
            $pdf->Cell(107, 8, tingkat($member->tingkat_instansi), 0, 0, 'L');

            $pdf->Ln(6);
            $pdf->Cell(10, 8, '18.', 0, 0, 'R');
            $pdf->Cell(50, 8, 'Status Sekolah', 0, 0, 'L');
            $pdf->Cell(3, 8, ':', 0, 0, 'L');
            $pdf->Cell(107, 8, ($member->jk == '01') ? 'Negeri' : 'Swasta', 0, 0, 'L');

            $pdf->Ln(6);
            $pdf->Cell(10, 8, '19.', 0, 0, 'R');
            $pdf->Cell(50, 8, 'Mengajar / Bidang Studi', 0, 0, 'L');
            $pdf->Cell(3, 8, ':', 0, 0, 'L');
            $pdf->Cell(107, 8, $member->bidang, 0, 0, 'L');

            if ($member->photo) {

                $pdf->Image('./assets/images/photo/thumb/' . $member->photo, 30, 230, 30, 40);
            }

            if ($member->ttd) {

                $pdf->Image('./assets/sign/' . $member->ttd, 110, 245, 40, 20);
            }


            $pdf->SetY(230);
            $pdf->Cell(90, 8, '', 0, 0, 'L');
            $pdf->Cell(80, 8, 'Jorong, ' . date('d') . ' ' . bulan(date('m')) . ' ' . date('Y'), 0, 0, 'L');
            $pdf->Ln(6);
            $pdf->Cell(90, 8, '', 0, 0, 'L');
            $pdf->Cell(80, 8, 'Yang bersangkutan,', 0, 0, 'L');
            $pdf->Ln(25);
            $pdf->Cell(90, 8, '', 0, 0, 'L');
            $pdf->Cell(80, 8, $member->name, 0, 0, 'L');


        endforeach;
        $pdf->Output();
    }

    function resize_all()
    {
        $this->db->order_by('id', 'desc');
        $member = $this->db->get('members')->result();
        foreach ($member as $key) {
            if ($key->photo) {
                $this->resize_photo($key->photo);
            }
        }
    }

    function resize_photo($photo)
    {

        $config['image_library'] = 'gd2';
        $config['source_image'] = 'assets/images/photo/' . $photo;
        // $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width']         = 300;
        $config['height']       = 400;
        $config['new_image'] = 'assets/images/photo/thumb/' . $photo;

        $this->load->library('image_lib', $config);
        $this->image_lib->initialize($config);
        if (!$this->image_lib->resize()) {
            echo $this->image_lib->display_errors();
        }
    }
}

/* End of file Dashboard.php */
