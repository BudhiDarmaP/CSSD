<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TambahInstrumentControl
 *
 * @author budhidarmap
 */
class InstrumenControl extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->check_log_in();
    }

    function check_log_in() {
        $is_logged_in_check = $this->session->userdata('is_logged_in');

        if (!isset($is_logged_in_check) || $is_logged_in_check != TRUE) {
            $data = array(
                'is_logged_in' => false,
                'not_login' => 'Maaf Anda Harus Login'
            );
            $this->session->set_userdata($data);
            $this->load->view('welcome_message');
            $this->CI = & get_instance();
            $this->CI->output->_display();

            die();
        }
    }

    function tambah() {
        $this->load->model('Instrument');

        $nama = $_GET["nama_instrumen"];
        $jumlah = $_GET["jumlah_instrumen"];
//        $steril = $_GET["steril"];
        $query = $this->Instrument->tambah_data_instrument($nama, $jumlah);

        if ($query) {

            $data = array(
                'tambah_instrumen' => true
            );
            $this->session->set_userdata($data);
            $this->load->view('tambah_instrument');
        } else {

            $data = array(
                'tambah_instrumen' => false
            );
            $this->session->set_userdata($data);
            $this->load->view('tambah_instrument');
        }
    }

    function cari() {
        $this->load->model('Instrument');
        $nama = $_GET["namainstrumen"];
        $data['cari_instrumen'] = $this->Instrument->cari_data_instrument($nama);
        $data['nama_instrumen'] = $nama;
        $this->load->view('data_instrumen', $data);
    }

    function cariHapus() {
        $this->load->model('Instrument');
        $nama = $_GET["namainstrumen"];
        $data['cari_instrumen'] = $this->Instrument->cari_data_instrument($nama);
        $data['nama_instrumen'] = $nama;
        $this->load->view('hapus_instrument', $data);
    }

    function hapus() {
        $this->load->model('Instrument');
        $id = $_GET['id'];

        if (count($id) == 0) {

            $data = array(
                'hapus_instrumen' => 2
            );
            $this->session->set_userdata($data);
            redirect(base_url('site/hapus_instrument'));
        } else {
            $data = array(
                'hapus_instrumen_confirm' => TRUE,
                'listid' => $id
            );
            $this->session->set_userdata($data);
            redirect(base_url('site/hapus_instrument'));
        }
    }

    function hapusFix() {
        $confirm = $_GET['denied'];
        $data;
        if ($confirm == 1) {
            $this->load->model('Instrument');
            $id = $_SESSION['listid'];
            $query = $this->Instrument->hapus_instrumen($id);
            $this->session->unset_userdata('listid');
            $data = array(
                'hapus_instrumen' => 1,
                'listid' => 'habis'
            );
        } else {
            $data = array(
                'hapus_instrumen' => 0,
                'listid' => 'habis'
            );
        }

        $this->session->set_userdata($data);
        redirect(base_url('site/hapus_instrument'));
    }

    function tambahStok() {
        $this->load->model('Instrument');
        $id_instrumen = $_POST["nama_instrumen"];
        $jumlah = $_POST["jumlah_instrumen"];
        $id_cssd = $_SESSION['username'];
//        $steril = $_GET["steril"];
        $this->Instrument->tambah_stok_instrumen($id_instrumen, $jumlah, $id_cssd);

        $instrumen = $this->Instrument->panggil_data_id($id_instrumen);
        $data['tambah_stok_instrumen'] = true;
        $data['nama_instrumen'] = $instrumen->nama_instrumen;
        $data['instrumen'] = $this->Instrument->cari_data_instrument('');
        $this->load->view('perbarui_instrument', $data);
    }

    function tambahSteril() {
        $this->load->model('Instrument');
        $id_instrumen = $_POST["nama_instrumen"];
        $jumlah = $_POST["jumlah_instrumen"];
        $id_cssd = $_SESSION['username'];
        $instrumen = $this->Instrument->panggil_data_id($id_instrumen);

        $jumlahBelumSteril = $instrumen->jumlah - $instrumen->steril;
        //cek jumlah yang dimasukkan apakaha melebihi jumlah stok / tidak
        if ($jumlah > $jumlahBelumSteril) {
            $data['tambah_stok_instrumen'] = false;
        } else {
            $this->Instrument->tambah_stok_steril_instrumen($id_instrumen, $jumlah, $id_cssd);
            $data['tambah_stok_instrumen'] = true;
        }
        $data['nama_instrumen'] = $instrumen->nama_instrumen;
        $data['instrumen'] = $this->Instrument->cari_data_instrument('');
        $this->load->view('perbarui_instrument', $data);
    }

    function pilih_perbarui_banyak() {
        $this->load->model('Instrument');
        $perbaruiStok = $_GET["perbaruiStok"];
        $id = null;
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        if ($id == null) {
            $data = array(
                'pinjam_instrumen' => false
            );
            $this->session->set_userdata($data);
            $data['id_peminjam'] = $this->Users->panggil_data_peminjam();
            $data['ada_instrumen'] = $this->Instrument->panggil_semua_data_instrument();
            $this->load->view('perbarui_banyak', $data);
        } else {
            $data[count($id)] = null;
            $index = 1;
            foreach ($id as $key) {
                $data[$index] = $this->Instrument->panggil_data_id($key);
                $index++;
            }

            //menyimpan data instrumen yg dipesan dalam session
            $data_session = null;
            if ($perbaruiStok == 0) {
                $data_session = array(
                    'tambahStok' => $data
                );
            } else if ($perbaruiStok == 1) {
                $data_session = array(
                    'tambahSteril' => $data
                );
            }
            $this->session->set_userdata($data_session);
            $this->load->view('perbarui_banyak');
        }
    }

    function tambah_setting_set() {
        $this->load->model('Instrument');
        $this->load->model('Setting_Set');
        $setting_set = $_POST["setting_set"];
        $untuk = $_POST["untuk"];
        $id = $_POST["id"];
        $jumlah = $_POST["input"];
        //memberi nama setting set pada database
        $nama_setting_set;
        if ($untuk == "") {
            $nama_setting_set = $setting_set;
        } else {
            $nama_setting_set = $setting_set . ': ' . $untuk;
        }
        //memberi id setting set
        $id_set = $this->Setting_Set->id_setting_set_otomatis();

        $data['setting_set'] = null;
        //cek checklist
        if (count($id) == 0) {
            $data['setting_set'] = false;
        } else {
            //check jumlah barang
            $cek = 0;
            foreach ($jumlah as $a) {
                if ($a > 0) {
                    $cek++;
                }
            }
            //jika jumlah salah
            if ($cek != count($id)) {
                $data['setting_set'] = false;
                //jika salah
            } else {
                $index = 0;
                foreach ($id as $r) {
                    if ($jumlah[$index]) {
                        $this->Setting_Set->tambah_setting_set($id_set, $nama_setting_set, $r, $jumlah[$index]);
                    }
                    $index++;
                }
                //mengirim nilai true, penambahan berhasil
                $data['setting_set'] = true;
            }
        }
        //mengirim list instrumen untuk ditampilkan
        $data['ada_instrumen'] = $this->Instrument->panggil_data_instrument();
        $this->load->view('tambah_setting_set', $data);
    }

    function ubah_nama_set() {
        $this->load->model('Setting_Set');
        $id = $_SESSION['id_set'];
        $nama = $_GET['nama'];
        $jenis = $_GET['jenis'];
        
        $nama_setting_set = '';
        if ($jenis != '') {
            $nama_setting_set = $nama . ': ' . $jenis;
        } else {
            $nama_setting_set = $nama;
        }
        $this->Setting_Set->ubah_nama_setting_set($nama_setting_set, $id);
        $data_session = array(
            'nama_set_baru' => $nama_setting_set
        );
        $this->session->set_userdata($data_session);
        redirect(base_url("/InstrumenControl/panggil_ubah_setting_set?set=$id&ubah=yes#!"));
    }

    function panggil_ubah_setting_set() {
        $this->load->model('Setting_Set');
        $this->load->model('Instrument');
        $setting_set = $_GET["set"];
        $data_session = array(
            'ada_instrumen' => $this->Setting_Set->panggil_set_id($setting_set, 1),
            'nama_set' => $this->Setting_Set->panggil_nama($setting_set)->nama_set,
            'id_set' => $setting_set
        );
        $this->session->set_userdata($data_session);
        $data['set'] = $this->Setting_Set->panggil_set();
        $data['tambah_instrumen'] = $this->Instrument->panggil_data_instrument();
        $this->load->view('ubah_setting_set', $data);
    }

    function hapus_instrumen() {
        $this->load->model('Instrument');
        $this->load->model('Users');
        $this->load->model('Setting_Set');
        $indexhapus = $_GET['nomor_index'];
        $ada_instrumen = $_SESSION['ada_instrumen'];
        $id_set = $_SESSION['id_set'];
        $nama_set = $_SESSION['nama_set'];

        if (count($ada_instrumen) == 0) {
            $data = array(
                'setting_set' => false
            );
            $this->session->set_userdata($data);
            redirect(base_url('/site/ubah_setting_set/?setting_set=false'));
        } else {
            $data[count($ada_instrumen) - 1] = null;
            $index = 1;
            foreach ($ada_instrumen as $key) {
                if ($key->id_instrumen != $indexhapus) {
                    $data[$index] = $this->Instrument->panggil_data_id($key->id_instrumen);
                    $index++;
                } else {
                    $index;
                }
            }
            //menyimpan data instrumen yg dipesan dalam session
            $data_session = array(
                'ada_instrumen' => $data,
                'nama_set' => $nama_set,
                'id_set' => $id_set
            );
            $this->session->set_userdata($data_session);

            //menyimpan data peminjam untuk ditampilkan pada pilih pinjam oleh pegawai cssd
            $id_peminjam = $this->Users->panggil_data_peminjam();
            $data['id_peminjam'] = $id_peminjam;
            $data['tambah_instrumen'] = $this->Instrument->panggil_semua_data_instrument();
            $data['set'] = $this->Setting_Set->panggil_set();
            $this->load->view('ubah_setting_set', $data);
        }
    }

    function tambah_instrumen() {
        $this->load->model('Instrument');
        $this->load->model('Users');
        $this->load->model('Setting_Set');
        $ada_instrumen = $_SESSION['ada_instrumen'];
        $id_set = $_SESSION['id_set'];
        $id = null;
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }

        if ($id == null) {
            $data = array(
                'setting_set' => false
            );
            $this->session->set_userdata($data);
            $data['id_peminjam'] = $this->Users->panggil_data_peminjam();
            $data['tambah_instrumen'] = $this->Instrument->panggil_semua_data_instrument();
            $this->load->view('ubah_setting_set', $data);
        } else {
            $cetak = true;
            foreach ($ada_instrumen as $r):
                foreach ($id as $row) {
                    if ($r->id_instrumen == $row) {
                        $cetak = false;
                        break;
                    }
                }
            endforeach;

            if ($cetak) {
                $data[count($ada_instrumen) + count($id)] = null;
                $index = 1;
                foreach ($ada_instrumen as $key) {
                    $data[$index] = $this->Instrument->panggil_data_id($key->id_instrumen);
                    $index++;
                }
                foreach ($id as $key) {
                    $data[$index] = $this->Instrument->panggil_data_id($key);
                    $index++;
                }

                //menyimpan data instrumen yg dipesan dalam session
                $data_session = array(
                    'ada_instrumen' => $data,
                    'id_set' => $id_set
                );
                $this->session->set_userdata($data_session);
            }
            //menyimpan data peminjam untuk ditampilkan pada pilih pinjam oleh pegawai cssd
            $id_peminjam = $this->Users->panggil_data_peminjam();
            $data['id_peminjam'] = $id_peminjam;
            $data['set'] = $this->Setting_Set->panggil_set();
            $data['tambah_instrumen'] = $this->Instrument->panggil_semua_data_instrument();
            $this->load->view('ubah_setting_set', $data);
        }
    }

    function ubah_setting_set() {
        $this->load->model('Instrument');
        $this->load->model('Setting_Set');
        $set = $_SESSION['nama_set'];
        $id_set = $_SESSION['id_set'];
        $id = $_SESSION['ada_instrumen'];
        $jumlah = $_POST['input'];
        $data['setting_set'] = null;
        //cek checklist
        if (count($id) == 0) {
            $data['setting_set'] = false;
        } else {
            //check jumlah barang
            $cek = 0;
            foreach ($jumlah as $a) {
                if ($a > 0) {
                    $cek++;
                }
            }
            //jika jumlah salah
            if ($cek != count($id)) {
                redirect(base_url('/site/ubah_setting_set/?setting_set=false'));
                //jika salah
            } else {
                $index = 0;
                $this->Setting_Set->hapus_setting_set($id_set);
                foreach ($id as $r) {
                    if ($jumlah[$index]) {
                        $this->Setting_Set->tambah_setting_set($id_set, $set, $r->id_instrumen, $jumlah[$index]);
                    }
                    $index++;
                }
                //mengirim nilai true, penambahan berhasil
                redirect(base_url('/site/ubah_setting_set/?setting_set=true'));
            }
        }
        //redirect
    }

    function namaInstrumen() {
        $this->load->model('Instrument');

        //cek apakah $_POST['cari'] memiliki value
        $nama = '';
        $data;
        if (!isset($_POST['cari'])) {
            $data = $this->Instrument->cari_data_instrument($nama);
        } else {
            $nama = $_POST['cari'];
            $data = $this->Instrument->cari_data_instrument($nama);
        }

        //hitung jumlah data
        if (count($data) > 0) {
            foreach ($data as $r):

                echo "
                <tr>
                    <td><?php echo $r->nama_instrumen; ?></td>
                </tr>";


            endforeach;
        } else {

            echo '<tr>';

            echo '<td colspan="4"><center><h3>Data Tidak Tersedia</h3></center></td>';

            echo '</tr>';
        }
    }

}

?>