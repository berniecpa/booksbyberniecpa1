<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $global_data['settings'] = $this->common_model->get_settings();
        $this->settings = $global_data['settings'];
        
        $global_data['selected_lang'] = $this->settings->lang;
        $this->selected_lang = $global_data['selected_lang'];
        $this->lang->load('website', $global_data['settings']->lang_slug);
        $this->load->vars($global_data);
        
        $active_business = $this->session->userdata('active_business');
        if (empty($active_business)) {
            $global_data['business'] = $this->common_model->get_business(0);
        } else {
            $global_data['business'] = $this->common_model->get_business($active_business);
        }
        $this->business = $global_data['business'];
        $this->load->vars($global_data);
        $this->load->library('user_agent');
        $this->db->query("SET sql_mode=''");
        
        if (settings()->version == '2.1') {

            $this->db->query("ALTER TABLE `settings` ADD `pdf_type` VARCHAR(155) NULL DEFAULT '2' AFTER `rpa_enable`;");
            $this->db->query("ALTER TABLE `settings` ADD `type` VARCHAR(255) NOT NULL DEFAULT 'live' AFTER `pdf_type`;");

            $data = array(
                'version' => '2.2'
            );
            $this->admin_model->edit_option($data, 1, 'settings');
        }

    }

}


class Home_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $global_data['settings'] = $this->common_model->get_settings('settings');
        $this->settings = $global_data['settings'];
        // $gIobal_data_load = load_settings_data();
        // $gIobal_data = gets_active_langs();

        if (get_lang() == '') {
            $this->lang->load('website', $global_data['settings']->lang_slug);
        }else{
            $this->lang->load('website', get_lang());
        }
        $this->load->vars($global_data);
    }

    //verify recaptcha
    public function recaptcha_verify_request()
    {
        if ($this->settings->enable_captcha == 0) {
            return true;
        }

        $this->load->library('recaptcha');
        $recaptcha = $this->input->post('g-recaptcha-response');
        if (!empty($recaptcha)) {
            $response = $this->recaptcha->verifyResponse($recaptcha);
            if (isset($response['success']) && $response['success'] === true) {
                return true;
            }else{
                return true;
            }
        }
        return false;
    }

}