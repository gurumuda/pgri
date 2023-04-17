<?php

function agama($agm)
{
    switch ($agm) {
        case '01':
            $agama = "Islam";
            break;
        case '02':
            $agama = "Kristen";
            break;
        case '03':
            $agama = "Katholik";
            break;
        case '04':
            $agama = "Hindu";
            break;
        case '05':
            $agama = "Budha";
            break;
        case '06':
            $agama = "Khong Huchu";
            break;
        case '07':
            $agama = "Kepercayaan Tuhan YME";
            break;
        default:
            $agama = "Tidak di ketahui";
            break;
    }
    return $agama;
}

function ijazah($ijz)
{
    switch ($ijz) {
        case '01':
            $ijazah = "SMA";
            break;
        case '02':
            $ijazah = "D-1";
            break;
        case '03':
            $ijazah = "D-2";
            break;
        case '04':
            $ijazah = "D-3";
            break;
        case '05':
            $ijazah = "S-1 / D-4";
            break;
        case '06':
            $ijazah = "S-2";
            break;
        case '07':
            $ijazah = "S-3";
            break;
        default:
            $ijazah = "Tidak di ketahui";
            break;
    }
    return $ijazah;
}

function jabatan($jbt)
{
    switch ($jbt) {
        case '01':
            $jabatan = "Kepala Sekolah";
            break;
        case '02':
            $jabatan = "Wakil Kepala Sekolah";
            break;
        case '03':
            $jabatan = "Kepala TU";
            break;
        case '04':
            $jabatan = "Guru";
            break;
        case '05':
            $jabatan = "Staf TU";
            break;
        case '06':
            $jabatan = "Bendahara";
            break;
        case '07':
            $jabatan = "Laboran";
            break;
        case '08':
            $jabatan = "Pustakawan";
            break;
        case '09':
            $jabatan = "Pengawas Sekolah";
            break;
        case '10':
            $jabatan = "Pesuruh/Penjaga Sekolah";
            break;
        case '11':
            $jabatan = "Juru Bengkel";
            break;
        case '12':
            $jabatan = "Petugas Instalasi";
            break;
        case '13':
            $jabatan = "Tutor Keaksaraan";
            break;
        case '14':
            $jabatan = "Pamong Belajar";
            break;
        case '15':
            $jabatan = "TLD";
            break;
        case '16':
            $jabatan = "Pengelola PKBM";
            break;
        case '17':
            $jabatan = "Pendidik PAUD";
            break;
        case '18':
            $jabatan = "Penilik";
            break;
        case '19':
            $jabatan = "Instruktur Kursus";
            break;
        case '20':
            $jabatan = "Tutor Paket A";
            break;
        case '21':
            $jabatan = "Tutuor Paket B";
            break;
        case '22':
            $jabatan = "Tutuor Paket C";
            break;
        case '23':
            $jabatan = "Pegawai Dinas Pendidikan";
            break;
        case '24':
            $jabatan = "Dosen";
            break;
        case '25':
            $jabatan = "Pensiunan";
            break;

        default:
            $jabatan = "Tidak di ketahui";
            break;
    }
    return $jabatan;
}

function status($stat)
{
    switch ($stat) {
        case '01':
            $status = "Non PNS";
            break;
        case '02':
            $status = "PNS";
            break;
        case '03':
            $status = "CPNS";
            break;
        default:
            $status = "Tidak di ketahui";
            break;
    }
    return $status;
}


function golongan($gol)
{
    switch ($gol) {
        case '01':
            $golongan = "II/a";
            break;
        case '02':
            $golongan = "II/b";
            break;
        case '03':
            $golongan = "II/c";
            break;
        case '04':
            $golongan = "II/d";
            break;
        case '05':
            $golongan = "III/a";
            break;
        case '06':
            $golongan = "III/b";
            break;
        case '07':
            $golongan = "III/c";
            break;
        case '08':
            $golongan = "III/d";
            break;
        case '09':
            $golongan = "IV/a";
            break;
        case '10':
            $golongan = "IV/b";
            break;
        case '11':
            $golongan = "IV/c";
            break;
        case '12':
            $golongan = "IV/d";
            break;
        case '13':
            $golongan = "IV/e";
            break;
        case '14':
            $golongan = "NON PNS";
            break;

        default:
            $golongan = "Tidak di ketahui";
            break;
    }
    return $golongan;
}


function tingkat($tkt)
{
    switch ($tkt) {
        case '01':
            $tingkat = "TK";
            break;
        case '02':
            $tingkat = "SD";
            break;
        case '03':
            $tingkat = "SMP";
            break;
        case '04':
            $tingkat = "SMA";
            break;
        case '05':
            $tingkat = "D-1";
            break;
        case '06':
            $tingkat = "D-2";
            break;
        case '07':
            $tingkat = "D-3";
            break;
        case '08':
            $tingkat = "S-1 / D-4";
            break;
        case '09':
            $tingkat = "S-2";
            break;
        case '10':
            $tingkat = "S-3";
            break;
        default:
            $tingkat = "Tidak di ketahui";
            break;
    }
    return $tingkat;
}


function bulan($bul)
{
    switch ($bul) {
        case '01':
            $bulan = "Januari";
            break;
        case '02':
            $bulan = "Februari";
            break;
        case '03':
            $bulan = "Maret";
            break;
        case '04':
            $bulan = "April";
            break;
        case '05':
            $bulan = "Mei";
            break;
        case '06':
            $bulan = "Juni";
            break;
        case '07':
            $bulan = "Juli";
            break;
        case '08':
            $bulan = "Agustus";
            break;
        case '09':
            $bulan = "September";
            break;
        case '10':
            $bulan = "Oktober";
            break;
        case '11':
            $bulan = "November";
            break;
        case '12':
            $bulan = "Desember";
            break;
        default:
            $bulan = "Tidak di ketahui";
            break;
    }
    return $bulan;
}


function jenis_kelamin($jk)
{
    switch ($jk) {
        case '01':
            $jeniskelamin = "Laki-laki";
            break;
        case '02':
            $jeniskelamin = "Perempuan";
            break;
        default:
            $jeniskelamin = "Tidak di ketahui";
            break;
    }
    return $jeniskelamin;
}


function status_instansi($stat)
{
    switch ($stat) {
        case '01':
            $status = "Negeri";
            break;
        case '02':
            $status = "Swasta";
            break;
        default:
            $status = "Tidak di ketahui";
            break;
    }
    return $status;
}

function kartu($kartu)
{
    switch ($kartu) {
        case '01':
            $card = "Belum memiliki";
            break;
        case '02':
            $card = "Memiliki (Masa berlaku habis)";
            break;
        case '03':
            $card = "Memiliki kartu aktif";
            break;
        default:
            $card = "Tidak di ketahui";
            break;
    }
    return $card;
}
