<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('MSudi');
    }

    public function index()
    {
        $status = array(
            'status' => 'Ok'
        );
        echo json_encode($status);
    }

    public function GetData()
    {
        $query = $this->MSudi->GetData('tbl_siswa')->result();
        echo json_encode($query);
    }

    public function PostData()
    {
        $data = [
            'npm' => urldecode($this->uri->segment(3)),
            'nama' => urldecode($this->uri->segment(4)),
            'jurusan' => urldecode($this->uri->segment(5)),
            'prodi' => urldecode($this->uri->segment(6)),
            'kelas' => urldecode($this->uri->segment(7))
        ];
        $input = $this->MSudi->AddData('tbl_siswa', $data);
        if ($input) {
            redirect('Api');;
        } else {
            echo "Error";
        }
    }

    public function PutData()
    {
        $npm = urldecode($this->uri->segment(3));
        $update['nama'] = urldecode($this->uri->segment(4));
        $update['kelas'] = urldecode($this->uri->segment(5));
        $update = $this->MSudi->UpdateData('tbl_siswa', 'npm', $npm, $update);
        if ($update) {
            redirect('Api');
        } else {
            echo 'Error';
        }
    }

    public function DeleteData()
    {
        $npm = urldecode($this->uri->segment(3));
        $delete = $this->MSudi->DeleteData('tbl_siswa', 'npm', $npm);
        if ($delete) {
            redirect('Api');
        } else {
            echo 'Error';
        }
    }
}
