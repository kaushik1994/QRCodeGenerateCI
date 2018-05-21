<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
        $postData = $this->input->post();

        if(!empty($postData)) {
            $this->load->library('ciqrcode');
            $this->load->helper('download');
            $params['data'] = $postData['url'];
            $params['level'] = 'H';
            $params['size'] = 10;
            if(isset($postData['color']) && $postData['color'] == 'blue')
                $params['white']		= array(0,0,255);
            $params['savename'] = FCPATH.'tes.jpg';
            $this->ciqrcode->generate($params);
            $data = file_get_contents(base_url().'tes.jpg');
            force_download(rand(1,10000).'.jpg', $data);
        }
		$this->load->view('qrcode_form');
	}
}
