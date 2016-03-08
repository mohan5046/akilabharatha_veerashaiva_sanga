<?php
class user_model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->library('session');
    }

    //insert into user table
    function insertUser($data)
    {
        return $this->db->insert('user', $data);
    }

    //send verification email to user's email id
    function sendEmail($to_email)
    {
        $from_email = 'mahesh50468@gmail.com'; 
        $subject = 'Verify Your Email Address';
        $message = 'Dear User,<br /><br />Please click on the below activation link to verify your email address.<br /><br /> http://localhost/ci_demo23/boot/verify/' . md5($to_email) . '<br /><br /><br />Thanks<br />Mohan Team';
        

        $this->load->library('email');

        //send mail
        $this->email->from($from_email, 'Mohan');
        $this->email->to($to_email);
        $this->email->subject($subject);
        $this->email->message($message);
        return $this->email->send();
    }

    //activate user account
    function verifyEmailID($key)
    {
        $data = array('status' => 1);
        $this->db->where('md5(email)', $key);
        return $this->db->update('user', $data);
    }

    //user database check
    function get_user($usr, $pwd)
     {
          $sql = "select * from user where email = '" . $usr . "' and password = '" . md5($pwd) . "' and status = '1'";
          $query = $this->db->query($sql);
          foreach($query->result() as $row)
          {
            $u_id=$row->u_id;
          }
          $q_num=$query->num_rows();
          if($q_num>0)
          {
          	$this->set_session_value($usr,$u_id);
          }
          return $query->num_rows();
     }

     function get_forget_user($usr)
     {
      $sql="select * from user where email='".$usr."'";
      $query=$this->db->query($sql);
      $q_num=$query->num_rows();
      if($q_num>0)
      {
        $res=$this->recover_sendemail($usr);
      }
      if($res)
        return $query->num_rows();
     }

     function recover_sendemail($to_email)
     {
        $from_email = 'mahesh50468@gmail.com'; 
        $subject = 'Forget Password';
        $message = 'Dear User,<br /><br />Please click on the below link to change your password.<br /><br /> http://localhost/ci_demo23/boot/change_password/' . md5($to_email) . '<br /><br /><br />Thanks<br />Mohan Team';
        

        $this->load->library('email');

        //send mail
        $this->email->from($from_email, 'Mohan');
        $this->email->to($to_email);
        $this->email->subject($subject);
        $this->email->message($message);
        return $this->email->send();  
     }

     function update_password($pass,$hash)
     {
        $data = array('status' => 1,
                      'password'=>$pass);
        $this->db->where('md5(email)', $hash);
        return $this->db->update('user',$data);
     }

     function set_session_value($usr,$id)
     {
     	$this->session->set_userdata(array(
     							'user_id'=>$usr,
                  'u_id'=>$id,
     							'loginuser'=>TRUE));
     }

     function insert_member($data)
    {
        return $this->db->insert('members', $data);
    }

    function get_member_list()
    {
        $id=$this->session->userdata('u_id');
        $sql="select * from members where u_id='$id'";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    function member_edit($m_id)
    {
        $sql="select * from members where m_id='$m_id'";
        $query=$this->db->query($sql);
        $result=$query->result();
        return $result;
    }

    function member_update($data,$m_id)
    {
        $this->db->where('m_id', $m_id);
        return $this->db->update('members',$data);
    }

    function member_delete($m_id)
    {
        $this->db->where('m_id', $m_id);
        return $this->db->delete('members');
    }

    function update_member_img($img_path,$m_id)
    {
        $data = array('image' => $img_path);
        $this->db->where('m_id', $m_id);
        return $this->db->update('members',$data);
    }

}
?>