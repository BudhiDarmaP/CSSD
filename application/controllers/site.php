<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Site extends CI_Controller {

    function __construct() {
        parent::__construct();
    }
    
    function halamanUtama(){
        $this->load->view('home');
    }
    
    function halamanLogin(){
        $this->load->view('welcome_message');
    }
    
    function instrumen(){
        $this->load->view('data_instrumen');
    }
    
    

}
