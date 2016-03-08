<?php
class contactform extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->load->library(array('session', 'form_validation'));
        $this->load->database();
    }
	
	function index()
    {
        //set validation rules
    	$this->load->view('home');
    }

    function contact_page()
    {
    	$this->load->view('contact_page');
    }

    function add_contact()
    {

        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('ph_no', 'Message', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'Emaid ID', 'trim|required|valid_email');

        

        //run validation on post data
        if ($this->form_validation->run() == FALSE)
        {   //validation fails
            $this->load->view('contact_page');
        }
        else
        {
            //insert the contact form data into database
            $data = array(
                'name' => $this->input->post('name'),
                'ph_no' => $this->input->post('ph_no'),
                'email' => $this->input->post('email')
            );

            if ($this->db->insert('store', $data))
            {
                // success
                $this->session->set_flashdata('msg','<div class="alert alert-success text-center">We received your message! Will get back to you shortly!!!</div>');
                redirect('contactform/contact_page');
            }

            else
            {
                // error
                $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Some Error.  Please try again later!!!</div>');
                redirect('contactform/contact_page');
            }
        }
    }
}
?>