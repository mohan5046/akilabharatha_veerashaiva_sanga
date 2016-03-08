<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start();

class main extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->load->library(array('session', 'form_validation','email'));
        $this->load->database();
        $this->load->model('user_model');

        if(!$this->session->userdata('user_id'))
        {      
            redirect('boot/login');
        }
    }

	function home()
	{
        $u['usr'] = $this->session->userdata('user_id');
		$this->load->view('header',$u);
		$this->load->view('body');
		$this->load->view('footer');
	}

    function members()
    {
        $u['usr'] = $this->session->userdata('user_id');

        //call the model function to get the department data
        $deptresult = $this->user_model->get_member_list();           
        $data['memlist'] = $deptresult;

        $this->load->view('header',$u);
        $this->load->view('members',$data);
        $this->load->view('footer');
    }

    function add_member()
    {
        $u['usr'] = $this->session->userdata('user_id');
        $this->load->view('header',$u);
        $this->load->view('add_members');
        $this->load->view('footer');
    }

    function add_member_db()
    {
        $this->form_validation->set_rules('fname', 'First Name', 'trim|required|alpha|min_length[3]|max_length[30]|xss_clean');
        $this->form_validation->set_rules('lname', 'Last Name', 'trim|required|alpha|min_length[1]|max_length[30]|xss_clean');
        $this->form_validation->set_rules('date', 'Date', 'trim|required|');

        if($this->form_validation->run()==FALSE)
        {
            //fails
            $u['usr'] = $this->session->userdata('user_id');
            $this->load->view('header',$u);
            $this->load->view('add_members');
            $this->load->view('footer');
        }
        else
        {
            //set preferences
            $usr = $this->session->userdata('user_id');
            $id=$this->session->userdata('u_id');
            $up_path="assets/images/".$usr;
            if(!file_exists($up_path)) 
            {
                $mask=umask(0);
                mkdir($up_path, 0777);
                umask($mask);
                chmod('$up_path', 0777);
            }
            $config['upload_path'] = $up_path;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']    = '3000';

            //load upload class library
            $this->load->library('upload', $config);

            //upload image
            if($this->upload->do_upload('userfile') || (!$upload_data['is_image']))
            {
                $upload_data = $this->upload->data();
                $img_path=$up_path."/".$upload_data['file_name'];

                $data = array(
                    'fname' => $this->input->post('fname'),
                    'lname' => $this->input->post('lname'),
                    'dob'=>$this->input->post('date'),
                    'ph_no' => $this->input->post('ph_no'),
                    'email' => $this->input->post('email'),
                    'relationship'=>$this->input->post('relationship'),
                    'image'=>$img_path,
                    'u_id'=>$id);

                if ($this->user_model->insert_member($data))
                {
                    $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Member Successfully Added</div>');
                    redirect('main/add_member');
                }
                else
                {
                    $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Error Data not Inserted.  Please try again later!!!</div>');
                    redirect('main/add_member');
                }
            }
            else
            {
                $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Error Image not Inserted.  Please try again later!!!</div>');
                redirect('main/add_member');
            }
        }
    }

	function contact()
	{
        $u['usr'] = $this->session->userdata('user_id');
		$this->load->view('header',$u);
		$this->load->view('contact_page_boot');
		$this->load->view('footer');
	}

	function add_contact_boot()
	{

		$this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required');
        $this->form_validation->set_rules('message', 'Message', 'trim|required|xss_clean');

        //run validation on post data
        if ($this->form_validation->run() == FALSE)
        {   //validation fails
            $u['usr'] = $this->session->userdata('user_id');
        	$this->load->view('header',$u);
            $this->load->view('contact_page_boot');
        }
        else
        {

            //get form data
            $name = $this->input->post('name');
            $from_email = $this->input->post('email');
            $subject = $this->input->post('subject');
            $message = $this->input->post('message');

            $msg=$from_email." has sent this message\n";
            $message=$msg."<br>".$message;

            //set to_email id to which you want to receive mails
            $to_email = 'mahesh50468@gmail.com';

            //load email library
        	$this->load->library('email');

            //send mail
            $this->email->from($from_email, $name);
            $this->email->to($to_email);
            $this->email->subject($subject);
            $this->email->message($message);

        //    $this->email->send();

        //    echo $this->email->print_debugger();

            if ($this->email->send())
            {
                // mail sent
                $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Your mail has been sent successfully!</div>');
                redirect('main/contact');
            }
            else
            {
                //error
                $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">There is error in sending mail! Please try again later</div>');
                redirect('main/contact');
            }   
        }
	}

    function member_edit($id)
    {
        $u['usr'] = $this->session->userdata('user_id');

        $deptresult=$this->user_model->member_edit($id);
        $data['memlist']=$deptresult;

        $this->load->view('header',$u);
        $this->load->view('member_edit',$data);
        $this->load->view('footer');
    }

    function member_update()
    {
        $id=$this->session->userdata('u_id');
        $data = array(
                    'fname' => $this->input->post('fname'),
                    'lname' => $this->input->post('lname'),
                    'ph_no' => $this->input->post('ph_no'),
                    'email' => $this->input->post('email'),
                    'relationship'=>$this->input->post('relationship'),
                    'u_id'=>$id);

        $m_id=$this->input->post('m_id');

        if($this->user_model->member_update($data,$m_id))
        {
            echo '<script>alert("You Have Successfully updated this Record!");</script>';
            redirect('main/members', 'refresh');
        }
        else
        {
            echo '<script>alert("Error in updating this Record!");</script>';
            redirect('main/members', 'refresh');
        }
    }

    function member_delete($id)
    {
        $u['usr'] = $this->session->userdata('user_id');

        if($this->user_model->member_delete($id))
        {
            echo "<script>alert('Record successfully deleted');</script>";
            redirect('main/members', 'refresh');
        }
        else
        {
            echo "<script>alert('Failed to delete record');</script>";
            redirect('main/members', 'refresh');
        }
        
    }

    function edit_member_img()
    {
        $usr = $this->session->userdata('user_id');
        $id=$this->session->userdata('u_id');
        $up_path="assets/images/".$usr;
        if(!file_exists($up_path)) 
        {
            $mask=umask(0);
            mkdir($up_path, 0777);
            umask($mask);
            chmod('$up_path', 0777);
        }
        $config['upload_path'] = $up_path;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']    = '3000';

        $m_id=$this->input->post('m_id');

        //load upload class library
        $this->load->library('upload', $config);

        $this->upload->do_upload('userfile');
        $upload_data = $this->upload->data();
        $img_path=$up_path."/".$upload_data['file_name'];

        if($this->user_model->update_member_img($img_path,$m_id))
        {
            $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Image Successfully Changed</div>');
            redirect('main/member_edit/'.$m_id);
        }
        else
        {
            $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Error.  Please try again later!!!</div>');
            redirect('main/member_edit/'.$m_id);
        }

    }

    function logout()
    {
        $this->session->sess_destroy();
        session_destroy();
        redirect('boot','refresh');
    }
}
?>