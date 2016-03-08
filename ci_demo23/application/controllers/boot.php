<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class boot extends CI_Controller {


	public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->load->library(array('session', 'form_validation','email'));
        $this->load->database();
        $this->load->model('user_model');

        if(!$this->session->userdata('user_id'))
        {      
         //   $this->login();
        }
    }

	public function index()
	{
		$this->load->view('header_index');
        $this->load->view('slider');
		$this->load->view('body_index');
		$this->load->view('footer');
	}

	function register()
	{
		$this->load->view('header_index');
		$this->load->view('register');
		$this->load->view('footer');
	}

	function add_user()
    {
        //set validation rules
        $this->form_validation->set_rules('fname', 'First Name', 'trim|required|alpha|min_length[3]|max_length[30]|xss_clean');
        $this->form_validation->set_rules('lname', 'Last Name', 'trim|required|alpha|min_length[1]|max_length[30]|xss_clean');
        $this->form_validation->set_rules('ph_no', 'Phone Number', 'trim|required|');
        $this->form_validation->set_rules('email', 'Email ID', 'trim|required|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[cpassword]|md5');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required');
        
        //validate form input
        if ($this->form_validation->run() == FALSE)
        {
            // fails
            $this->load->view('header_index');
            $this->load->view('register');
            $this->load->view('footer');
        }
        else
        {
            //insert the user registration details into database
            $data = array(
                'fname' => $this->input->post('fname'),
                'lname' => $this->input->post('lname'),
                'ph_no' => $this->input->post('ph_no'),
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password')
            );
            
            // insert form data into database
            if ($this->user_model->insertUser($data))
            {
                // send email
                if ($this->user_model->sendEmail($this->input->post('email')))
                {
                    // successfully sent mail
                    $this->session->set_flashdata('msg','<div class="alert alert-success text-center">You are Successfully Registered! Please confirm the mail sent to your Email-ID!!!</div>');
                    redirect('boot/register');
                }
                else
                {
                    // error
                    $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Error.  Please try again later!!!</div>');
                    redirect('boot/register');
                }
            }
            else
            {
                // error
                $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Error Data not Inserted.  Please try again later!!!</div>');
                redirect('boot/register');
            }
        }
    }

    function verify($hash=NULL)
    {
        if ($this->user_model->verifyEmailID($hash))
        {
            $this->session->set_flashdata('verify_msg','<div class="alert alert-success text-center">Your Email Address is successfully verified! Please login to access your account!</div>');
            redirect('boot/login');
        }
        else
        {
            $this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center">Sorry! There is error verifying your Email Address!</div>');
            redirect('boot/register');
        }
    }

	function login()
	{
		$this->load->view('header_index');
		$this->load->view('login');
		$this->load->view('footer');
	}

	function check_login()
	{
		//set validations
          $this->form_validation->set_rules("email", "Email", "trim|required");
          $this->form_validation->set_rules("password", "Password", "trim|required");

		if ($this->form_validation->run() == FALSE)
        {
           	//validation fails
            $this->load->view('header_index');
			$this->load->view('login');
			$this->load->view('footer');
        }

        else
        {
          //get the posted values
          	$username = $this->input->post("email");
          	$password = $this->input->post("password");

        	//check if username and password is correct
            $usr_result = $this->user_model->get_user($username, $password);
            
            //active user record is present
            if ($usr_result > 0)
            {
                redirect("main/home");
            }
            else
            {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Invalid username and password!</div>');
                redirect('boot/login');
            }
      	}

	}

    function forget_password()
    {
            $this->load->view('header_index');
            $this->load->view('forget_password');
    }

    function recover_password()
    {
        //set validations
        $this->form_validation->set_rules("email", "Email", "trim|required");

        if ($this->form_validation->run() == FALSE)
        {
            //validation fails
            $this->load->view('header_index');
            $this->load->view('forget_password');
        }
        else
        {
            $username = $this->input->post("email");
            $usr_result = $this->user_model->get_forget_user($username);
            if($usr_result>0)
            {
                // successfully sent mail
                $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Please click the link sent to your Email-ID to change the password!!!</div>');
                redirect('boot/forget_password');
            }
            else
            {
                $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Error! Please provide registerd Email Id</div>');
                redirect('boot/forget_password');
            }
        }
    }

    function change_password($hsh=NULL)
    {
        $h['hash']=$hsh;
        $this->load->view('header_index');
        $this->load->view('change_password',$h);
    }

    function update_password()
    {
        $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[cpassword]|md5');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required');

        //validate form input
        if ($this->form_validation->run() == FALSE)
        {
            // fails
            $this->load->view('header_index');
            $this->load->view('change_password');
        }
        else
        {
            $pass=$this->input->post('password');
            $hash=$this->input->post('hash');
            if($this->user_model->update_password($pass,$hash))
            {
                $this->session->set_flashdata('verify_msg','<div class="alert alert-success text-center">Your Password is successfully Changed! Please login to access your account!</div>');
            redirect('boot/login');
            }
            else
            {
                $this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center">Sorry! There is error changing your password</div>');
            redirect('boot/change_password($hash)');
            }
        }
    }

}
?>