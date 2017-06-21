<?php

//defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of panggil_users
 *
 * @author budhidarmap
 */
class panggil_users extends CI_Controller {

    function __construct() {
        echo 'Masuk Controller';
        parent::__construct();
//        $this->load->model('users');
    }

    function user() {
         $this->load->model('users');
        $data['user'] = $this->users->ambil_data();
        $this->load->view('view_users.php', $data);
//        $this->load->view('view_users.php');
    }

    function index() {
        echo 'Index';
    }

}
