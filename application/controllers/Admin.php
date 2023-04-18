<?php

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Pdf;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function index()
    {
        if (!($this->session->userdata('username') && $this->session->userdata('level') == '2')) {
            redirect('dashboard', 'refresh');
        }

        $this->db->select('instansi, count(*) as jumlah');
        $this->db->group_by('instansi');
        $this->db->order_by('instansi', 'asc');
        // $this->db->join('members', 'schools.nama_sekolah = members.instansi', 'right');
        $data['members'] = $this->db->get('members')->result();

        $data['total'] = $this->db->get('members')->num_rows();


        $this->load->view('admin/template/meta', $data);
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $this->load->view('admin/menu/dashboard');
        $this->load->view('admin/template/script');
    }

    public function members()
    {
        if (!($this->session->userdata('username') && $this->session->userdata('level') == '2')) {
            redirect('dashboard', 'refresh');
        }

        $data['members'] = $this->db->get('members')->result();

        $this->load->view('admin/template/meta', $data);
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $this->load->view('admin/menu/members');
        $this->load->view('admin/template/script');
    }

    function hapus_member()
    {
        if (!($this->session->userdata('username') && $this->session->userdata('level') == '2')) {
            redirect('dashboard', 'refresh');
        }

        $id = $this->input->post('id-hapus-member', true);
        $key = $this->input->post('key', true);

        if ($key === 'HAPUSMEMBER') {
            $this->db->where('id', $id);
            $hapus = $this->db->delete('members');

            if ($hapus) {
                $this->session->set_flashdata('tipe', 'success');
                $this->session->set_flashdata('pesan', 'Data berhasil dihapus');
                redirect('admin/members', 'refresh');
            } else {
                $this->session->set_flashdata('tipe', 'error');
                $this->session->set_flashdata('pesan', 'Data gagal dihapus');
                redirect('admin/members', 'refresh');
            }
        } else {
            $this->session->set_flashdata('tipe', 'error');
            $this->session->set_flashdata('pesan', 'Kunci salah, Data gagal dihapus');
            redirect('admin/members', 'refresh');
        }
    }

    function get_detail_member()
    {
        $this->load->helper('formater_helper');

        $id = $this->input->post('id');

        $this->db->where('id', $id);
        $data1 = $this->db->get('members')->row();
        $data = [
            'email' => $data1->email,
            'nama' => $data1->name,
            'address' => $data1->address,
            'jk' => jenis_kelamin($data1->jk),
            'instansi' => $data1->instansi,
            'title' => $data1->title,
            'tmp_lahir' => $data1->tmp_lahir,
            'tgl' => $data1->tgl,
            'bln' => $data1->bln,
            'thn' => $data1->thn,
            'noKtp' => $data1->noKtp,
            'agama' => agama($data1->agama),
            'kodePos' => $data1->kodePos,
            'noHP' => $data1->noHP,
            'ijazah' => ijazah($data1->ijazah),
            'jabatan' => jabatan($data1->jabatan),
            'tgl_mulai' => $data1->tgl_mulai,
            'bln_mulai' => $data1->bln_mulai,
            'thn_mulai' => $data1->thn_mulai,
            'status' => status($data1->status),
            'golongan' => golongan($data1->golongan),
            'tingkat_instansi' => tingkat($data1->tingkat_instansi),
            'status_instansi' => status_instansi($data1->status_instansi),
            'bidang' => $data1->bidang,
            'ttd' => $data1->ttd,
            'photo' => $data1->photo,
            'npa' => $data1->npa,
        ];

        echo json_encode($data);
    }


    function edit_member($id)
    {
        if (!($this->session->userdata('username') && $this->session->userdata('level') == '2')) {
            redirect('dashboard', 'refresh');
        }

        $id = $this->encrypt->decode((urldecode($id)));
        // echo $id;
        $this->db->where('id', $id);
        $data['member'] = $this->db->get('members')->row();

        $this->load->view('admin/template/meta', $data);
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $this->load->view('admin/menu/edit_member');
        $this->load->view('admin/template/script');
    }

    function ubahMember()
    {
        if (!($this->session->userdata('username') && $this->session->userdata('level') == '2')) {
            redirect('dashboard', 'refresh');
        }

        $update = $this->insert->ubahMember();
        if ($update == 1) {
            # code...
            $this->session->set_flashdata('tipe', 'success');
            $this->session->set_flashdata('pesan', 'Data berhasil disimpan');

            redirect(
                'admin/edit_member/' . urlencode($this->encrypt->encode($this->input->post('id'))),
                'refresh'
            );
        } else {
            $this->session->set_flashdata('tipe', 'error');
            $this->session->set_flashdata('pesan', 'Data gagal disimpan');

            redirect(
                'admin/edit_member/' . urlencode($this->encrypt->encode($this->input->post('id'))),
                'refresh'
            );
        }
    }


    function up_photo()
    {
        if (!($this->session->userdata('username') && $this->session->userdata('level') == '2')) {
            redirect('dashboard', 'refresh');
        }

        $upload = $this->insert->ubahPhoto();
        if ($upload == 1) {
            # code...
            $this->session->set_flashdata('tipe', 'success');
            $this->session->set_flashdata('pesan', 'Foto berhasil disimpan');
            redirect(
                'admin/edit_member/' . urlencode($this->encrypt->encode($this->input->post('id'))),
                'refresh'
            );
        } else {
            $this->session->set_flashdata('tipe', 'error');
            $this->session->set_flashdata('pesan', ($upload['error']));

            redirect(
                'admin/edit_member/' . urlencode($this->encrypt->encode($this->input->post('id'))),
                'refresh'
            );
        }
    }

    function export_excel()
    {
        $this->load->helper('formater_helper');
        $this->load->helper('file');

        $data = $this->db->get('members');

        $spreadsheet = new Spreadsheet();
        $spreadsheet->getDefaultStyle()->getFont()->setName('Times')->setSize(11);

        $sheet = $spreadsheet->getActiveSheet();

        // Set column width
        $sheet->getColumnDimension('A')->setWidth(7);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->getColumnDimension('I')->setAutoSize(true);
        $sheet->getColumnDimension('J')->setAutoSize(true);
        $sheet->getColumnDimension('K')->setAutoSize(true);
        $sheet->getColumnDimension('L')->setAutoSize(true);
        $sheet->getColumnDimension('M')->setAutoSize(true);
        $sheet->getColumnDimension('N')->setAutoSize(true);
        $sheet->getColumnDimension('O')->setAutoSize(true);
        $sheet->getColumnDimension('P')->setAutoSize(true);
        $sheet->getColumnDimension('Q')->setAutoSize(true);
        $sheet->getColumnDimension('R')->setAutoSize(true);
        $sheet->getColumnDimension('S')->setAutoSize(true);
        $sheet->getColumnDimension('T')->setAutoSize(true);
        $sheet->getColumnDimension('U')->setAutoSize(true);
        $sheet->getColumnDimension('V')->setWidth(15);
        $sheet->getColumnDimension('W')->setAutoSize(true);


        // Set title
        $sheet->setCellValue('A1', 'Data Anggota PGRI Cabang Kecamatan Jorong');

        // Set value of row number 4
        $sheet->setCellValue('A4', 'No');
        $sheet->setCellValue('B4', 'Nama');
        $sheet->setCellValue('C4', 'Email');
        $sheet->setCellValue('D4', 'Nomor HP');
        $sheet->setCellValue('E4', 'Jenis Kelamin');
        $sheet->setCellValue('F4', 'Tempat Lahir');
        $sheet->setCellValue('G4', 'Tanggal Lahir');
        $sheet->setCellValue('H4', 'Nomor KTP');
        $sheet->setCellValue('I4', 'Agama');
        $sheet->setCellValue('J4', 'Ijazah');
        $sheet->setCellValue('K4', 'Instansi');
        $sheet->setCellValue('L4', 'Jabatan di Instansi');
        $sheet->setCellValue('M4', 'Tanggal Mulai Tugas');
        $sheet->setCellValue('N4', 'Status Kepegawaian');
        $sheet->setCellValue('O4', 'Golongan');
        $sheet->setCellValue('P4', 'Tingkat Instansi');
        $sheet->setCellValue('Q4', 'Status Instansi');
        $sheet->setCellValue('R4', 'Mata Pelajaran');
        $sheet->setCellValue('S4', 'Alamat');
        $sheet->setCellValue('T4', 'Kode Pos');
        $sheet->setCellValue('U4', 'Kartu Anggota');
        $sheet->setCellValue('V4', 'Foto Anggota');
        $sheet->setCellValue('W4', 'NPA');


        $spreadsheet->getActiveSheet()->getStyle('A1:W' . ($data->num_rows() + 5))
            ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);

        $i = 5;
        $no = 1;
        foreach ($data->result() as $dt) {
            $sheet->getRowDimension($i)->setRowHeight(70);
            $sheet->setCellValue('A' . $i, $no++);
            $sheet->setCellValue('B' . $i, $dt->name);
            $sheet->setCellValue('C' . $i, $dt->email);
            $sheet->setCellValue('D' . $i, $dt->noHP);
            $sheet->setCellValue('E' . $i, jenis_kelamin($dt->jk));
            $sheet->setCellValue('F' . $i, $dt->tmp_lahir);
            $sheet->setCellValue('G' . $i, $dt->tgl . ' ' . bulan($dt->bln) . ' ' . $dt->thn);
            $sheet->setCellValue('H' . $i, ' ' . $dt->noKtp);
            $sheet->setCellValue('I' . $i, agama($dt->agama));
            $sheet->setCellValue('J' . $i, ijazah($dt->ijazah));
            $sheet->setCellValue('K' . $i, $dt->instansi);
            $sheet->setCellValue('L' . $i, jabatan($dt->jabatan));
            $sheet->setCellValue('M' . $i, $dt->tgl_mulai . ' ' . bulan($dt->bln_mulai) . ' ' . $dt->thn_mulai);
            $sheet->setCellValue('N' . $i, status($dt->status));
            $sheet->setCellValue('O' . $i, golongan($dt->golongan));
            $sheet->setCellValue('P' . $i, tingkat($dt->tingkat_instansi));
            $sheet->setCellValue('Q' . $i, status_instansi($dt->status_instansi));
            $sheet->setCellValue('R' . $i, $dt->bidang);
            $sheet->setCellValue('S' . $i, $dt->address);
            $sheet->setCellValue('T' . $i, $dt->kodePos);
            $sheet->setCellValue('U' . $i, kartu($dt->kartu));
            $sheet->setCellValue('W' . $i, $dt->npa);


            if ($dt->photo) {
                $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                $drawing->setName('PhpSpreadsheet logo');
                $drawing->setDescription('PhpSpreadsheet logo');
                $drawing->setPath('./assets/images/photo/thumb/' . $dt->photo);
                $drawing->setCoordinates('V' . $i);
                $drawing->setHeight(80);
                $drawing->setOffsetX(5);
                $drawing->setOffsetY(5);
                $drawing->setWorksheet($spreadsheet->getActiveSheet());
            }

            $i++;
        }

        // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        // header('Content-Disposition: attachment; filename="Data Anggota.xlsx"');
        // $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        // $writer->save('php://output');

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save("./assets/DataAnggota.xlsx");

        $this->load->helper('download');
        force_download('./assets/DataAnggota.xlsx', NULL);
    }

    function reset_password($id)
    {
        if (!($this->session->userdata('username') && $this->session->userdata('level') == '2')) {
            redirect('dashboard', 'refresh');
        }

        $id = $this->encrypt->decode((urldecode($id)));

        $object = [
            'password' => password_hash('123456', PASSWORD_DEFAULT)
        ];

        $this->db->where('id', $id);
        $reset = $this->db->update('members', $object);

        if ($reset) {
            $this->session->set_flashdata('pesan', 'Password berhasil di reset menjadi 123456');
            $this->session->set_flashdata('tipe', 'success');
            redirect('admin/members');
        } else {
            $this->session->set_flashdata('pesan', 'Maaf password gagal di reset');
            $this->session->set_flashdata('tipe', 'error');
            redirect('admin/members');
        }
    }

    function cetakKartu()
    {
        if (!($this->session->userdata('username') && $this->session->userdata('level') == '2')) {
            redirect('dashboard', 'refresh');
        }
        $this->buatbarcode();
        $data['members'] = $this->db->get('members')->result();

        $this->load->view('admin/template/meta', $data);
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $this->load->view('admin/menu/cetakKartu');
        $this->load->view('admin/template/script');
    }

    function cetakKartuTerpilih()
    {
        $select = [];

        foreach ($_POST as $post) {
            array_push($select, $post);
        }

        if ($this->input->post('mastercheck')) {
            $cetak = [];
            for ($i = 2; $i < count($select); $i++) {
                $id = $select[$i];
                $this->db->where('id', $id);
                $data = $this->db->get('members')->row();
                array_push($cetak, $data);
            }
            $this->printKartu($cetak);
        } else {
            $cetak = [];
            for ($i = 1; $i < count($select); $i++) {
                $id = $select[$i];
                $this->db->where('id', $id);
                $data = $this->db->get('members')->row();
                array_push($cetak, $data);
            }
            $this->printKartu($cetak);
        }
    }

    function printKartu($cetak)
    {
        // $this->load->helper('formater_helper');

        // $data['members'] = $cetak;
        // $this->load->view('admin/template/meta', $data);
        // $this->load->view('admin/template/header');
        // $this->load->view('admin/template/sidebar');
        // $this->load->view('admin/menu/preveiwKartu');
        // $this->load->view('admin/template/script');
        // Require composer autoload
        if ($cetak) {

            $jml = count($cetak);
            if ($jml == 5) {
                $j = 5;
            } elseif ($jml < 6) {
                $j = $jml;
            } elseif ($jml > 5) {
                echo 'Error! <br> Maksimal mencetak 5 data';
                die;
            }
        } else {
            echo 'Error ! <br> Tidak ada data dipilih!';
            die;
        }




        require(APPPATH . 'third_party/fpdf/fpdf.php');

        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->SetTopMargin(5);
        $pdf->SetAutoPageBreak(true, 8);
        $pdf->AddPage();
        $pdf->Line(105, 2, 105, 294);

        // $j = 1;
        for ($i = 0; $i < $j; $i++) {
            // Looping kotak
            $pdf->Rect($pdf->GetX() - 2, $pdf->GetY() - 2, 89, 55);
            $pdf->Rect($pdf->GetX() + 103, $pdf->GetY() - 2, 89, 55);

            // Loping gambar
            $pdf->Image('assets/images/logo/pgri.png', $pdf->GetX() + 3, $pdf->GetY(), 12);

            $pdf->Image('assets/images/logo/back.png', $pdf->GetX() + 103.2, $pdf->GetY() - 1.8, 88.5, 54.6);

            $pdf->Image('assets/images/logo/ttd_ketua.png', $pdf->GetX() + 36, $pdf->GetY() + 36, '', 12);
            $pdf->Image('assets/images/logo/ttd_sekretaris.png', $pdf->GetX() + 63, $pdf->GetY() + 38, '', 8);
            $pdf->Image('assets/images/logo/stamp.png', $pdf->GetX() + 48, $pdf->GetY() + 35, 14);
            if ($cetak[$i]->photo) {
                $pdf->Image('assets/images/photo/thumb/' . $cetak[$i]->photo, $pdf->GetX() + 1, $pdf->GetY() + 15, 16, 22);
            }
            if ($cetak[$i]->barcode) {

                $pdf->Image('assets/barcode/' . $cetak[$i]->barcode, $pdf->GetX() + 1, $pdf->GetY() + 40, 25);
            }

            $pdf->SetFont('Times', 'B', 15);
            $pdf->Cell(20, 0, '');
            $pdf->Cell(65, 5, 'P G R I', 0, 0, 'C');
            $pdf->Ln(5);
            $pdf->SetFont('Times', 'B', 11);
            $pdf->Cell(20, 0, '');
            $pdf->Cell(65, 5, 'KARTU TANDA ANGGOTA', 0, 0, 'C');

            $pdf->Ln(4);
            $pdf->SetFont('Times', '', 6);
            $pdf->Ln(5);
            $pdf->Cell(20, 0, '');
            $pdf->Cell(20, 1, 'No. Pokok Anggota', 0, 0, 'L');
            $pdf->Cell(1, 1, ':', 0, 0, 'L');
            $pdf->Cell(30, 1, $cetak[$i]->npa, 0, 0, 'L');

            $pdf->Ln(2.5);
            $pdf->Cell(20, 0, '');
            $pdf->Cell(20, 1, 'Nama', 0, 0, 'L');
            $pdf->Cell(1, 1, ':', 0, 0, 'L');
            $pdf->Cell(30, 1, $cetak[$i]->name, 0, 0, 'L');

            $pdf->Ln(2.5);
            $pdf->Cell(20, 0, '');
            $pdf->Cell(20, 1, 'Tempat/Tgl. Lahir', 0, 0, 'L');
            $pdf->Cell(1, 1, ':', 0, 0, 'L');
            $pdf->Cell(30, 1, $cetak[$i]->tmp_lahir . ', ' . $cetak[$i]->tgl . ' ' . bulan($cetak[$i]->bln) . ' ' . $cetak[$i]->thn, 0, 0, 'L');

            $pdf->Ln(2.5);
            $pdf->Cell(20, 0, '');
            $pdf->Cell(20, 1, 'Agama', 0, 0, 'L');
            $pdf->Cell(1, 1, ':', 0, 0, 'L');
            $pdf->Cell(30, 1, agama($cetak[$i]->agama), 0, 0, 'L');

            $pdf->Ln(2.5);
            $pdf->Cell(20, 0, '');
            $pdf->Cell(20, 2, 'Alamat', 0, 0, 'L');
            $pdf->Cell(1, 2, ':', 0, 0, 'L');
            $pdf->MultiCell(40, 2, substr($cetak[$i]->address, 0, 70), 0, 'J');

            $pdf->Ln(1);
            $pdf->Cell(20, 0, '');
            $pdf->Cell(20, 1, 'Berlaku Sampai', 0, 0, 'L');
            $pdf->Cell(1, 1, ':', 0, 0, 'L');
            $pdf->Cell(30, 1, '27 Desember 2030', 0, 0, 'L');

            $pdf->Ln(5);
            $pdf->Cell(50, 0, '');
            $pdf->Cell(40, 1, 'Kec. Jorong, 30 Desember 2022', 0, 0, 'C');
            $pdf->Ln(2);
            $pdf->Cell(50, 0, '');
            $pdf->Cell(40, 1, 'Pengurus PGRI Kec. Jorong', 0, 0, 'C');
            $pdf->Ln(2);
            $pdf->Cell(30, 0, '');
            $pdf->Cell(20, 1, 'Ketua', 0, 0, 'C');
            $pdf->Cell(40, 1, 'Sekretaris', 0, 0, 'C');
            $pdf->Ln(7);
            $pdf->Cell(30, 0, '');
            $pdf->Cell(20, 1, 'Ketua PGRI', 0, 0, 'C');
            $pdf->Cell(40, 1, 'Sekretaris PGRI', 0, 0, 'C');
            $pdf->Ln(2);
            $pdf->Cell(30, 0, '');
            $pdf->Cell(20, 1, 'NPA. 0000005432', 0, 0, 'C');
            $pdf->Cell(40, 1, 'NPA. 0000004763', 0, 0, 'C');
            $pdf->Ln(12);
        }


        $pdf->Output();
    }

    function buatbarcode()
    {

        require APPPATH . 'vendor/autoload.php';

        $generator = new Picqer\Barcode\BarcodeGeneratorJPG();

        $this->db->select('id,npa');
        $data = $this->db->get('members')->result();

        foreach ($data as $key) {

            if ($key->npa) {
                file_put_contents('./assets/barcode/' . $key->id . '.jpg', $generator->getBarcode($key->npa, $generator::TYPE_CODABAR, 4, 80));

                $object = ['barcode' => $key->id . '.jpg'];

                $this->db->where('id', $key->id);
                $this->db->update('members', $object);
            }
        }
    }
}

/* End of file Admin.php */
