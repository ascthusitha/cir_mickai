<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Twilio\Rest\Client;

class Send_mail extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->library('Menu_Lib');
        $this->load->model('alert_sms_model');
    }
    public function index()
    {

        $this->menu_lib->get_active_menu(8, 41);
        //load view
        $data['user'] = $this->session->userdata('first_name');
        $data['title'] = "Instant Message";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('instant_mail/quick_email', $data);
        $this->load->view('layout/footer', $data);
    }


    function send()
    {
        $alert_type = $this->input->post('alert_type');
        if ($alert_type == 'email') {
            $this->load->config('email');
            $this->load->library('email');

            $from = $this->config->item('smtp_user');
            $to = $this->input->post('to');
            $subject = $this->input->post('subject');
            $message = $this->input->post('message');

            $this->email->set_newline("\r\n");
            $this->email->from($from);
            $this->email->to($to);
            $this->email->subject($subject);
            $this->email->message($message);

            if ($this->email->send()) {
                echo 'success';
            } else {
                echo ($this->email->print_debugger());
            }
        } else if ($alert_type == "sms") {
            $data = ['phone' => '+14168853138', 'text' => 'Hello, CEO'];
            $this->sendSMS($data);
        }
    }
    protected function sendSMS($data)
    {
        // Your Account SID and Auth Token from twilio.com/console
        $sid = 'ACe2fd1855274ed4eeb167a4fd0ae876b2';
        $token = 'e8c00eee568edf1a21b75dccd4e247fe';
        // $client = new Client($sid, $token);
        $twilioNumber = 'MG2a2d5a06bbacbe1d54c7f4b60dcc331c'; //'+12267740744';
$today = Date('Y-m-d');
       $message = "Dear Sir/Madam".$data['text']."\n CIR \n 416 267
6700 ";//;
        // $message=$data['text'];
        $mobileNumber = $data['phone'];
        // Use the client to do fun stuff like send text messages!
        //    return $client->messages->create(
        //       // the number you'd like to send the message to
        //       $data['phone'],
        //       array(
        //           // A Twilio phone number you purchased at twilio.com/console
        //           "from" => $twilioNumber,
        //           // the body of the text message you'd like to send
        //           'body' => $data['text']
        //       )
        //   );
        try {
            $client = new Client($sid, $token);
            $res = $client->messages->create(
                // Where to send a text message (your cell phone?)
                '+' . $mobileNumber,
                array(
                    'from' => $twilioNumber,
                    'body' => $message,
                   // "provideFeedback" => True
                    'statusCallback' => "https://cirtest.mickai.com/campaign_manage/sms_reply"
                )
            );
            $this->update_alert('',$today,'sms', $mobileNumber, $twilioNumber, $message,$res->sid,'0');
            print($res->sid);
            // exit();
            return true;
        } catch (\Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public function update_alert($contact_id,$app_date,$type, $mobileNumber, $twilioNumber, $message,$tw_id,$c_id)
{
$this->alert_sms_model->add_alert($contact_id,$app_date,$type ,$mobileNumber, $twilioNumber, $message,$tw_id,$c_id);
return true;
}
}