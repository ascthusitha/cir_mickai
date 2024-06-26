<?php

if (!defined('BASEPATH'))  exit('No direct script access allowed');

// use SendGrid\Mail\Mail;
use Twilio\Rest\Client;
// use Twilio\Rest\Client;
// use Twilio\TwiML\MessagingResponse;

/**
 * Description of Cron
 *
 * @author Thusitha
 */
class Campaign_manage extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('form_validation'));
		
        $this->load->helper('url');
        $this->load->model('contact_model');
		$this->load->model('campaign_model');
			$this->load->model('alert_sms_model');
        $this->load->helper('form');
        $this->load->library('Menu_Lib');
    }

	public function check_campaign(){
		$now = Date('Y-m-d');
		//find campaign ttytpe
		$clists=$this->campaign_model->get_campaign_list($now);
		foreach ($clists as $clist) {
			if($clist->campaign_type=='email'){
				//$this->sendEmail($clist->campaign_id);
				$this->send_email($clist->campaign_id);
			}else if($clist->campaign_type=='sms'){
					$this->send_sms($clist->campaign_id);
			}else{

			}
		}
		
	}
    public function send_alert()
    {
        $today = Date('Y-m-d');
        $datas = $this->task_detail_model->get_task_detail_data($today, '2');
    }
    public function send_email($c_id)
    {

        $this->load->config('email');
        $this->load->library('email');

        $today = Date('Y-m-d');
        $datas = $this->contact_model->get_contact();

		$campaign_data = $this->campaign_model->get_detail($c_id);
		
        foreach ($datas as $data) {

            $message = '<html><body><img src="<?php echo base_url(); ?>assets/dist/img/MickaiLogo.png" alt=""
width="300"
style="height:auto;display:block;" />
<h1 style="color:#f40;">Dear '.$data->contact_name.' '.$data->contact_lname.',</h1>
<p style="color:#080;font-size:18px;">'.$campaign_data['message'].'</p>
</body>

</html>';

$message_db = 'Dear '.$data->contact_name.' '.$data->contact_lname.',<br>'. $campaign_data['message'];
$from = $this->config->item('smtp_user');
$to = $data->email;
$contact_id = $data->contact_id;
$app_date=$today;
$subject = 'CIR Promotion';


$this->email->set_newline("\r\n");
$this->email->from($from);
$this->email->to($to);
$this->email->subject($subject);
$this->email->message($message);

$this->email->send();
//update data base with sms
$this->update_alert($contact_id,$app_date,'email', $to, $from, $message_db,'1',$c_id);
}
}

public function send_sms($c_id)
{

//sending mechanism
$today = Date('Y-m-d');
$datas = $this->contact_model->get_contact();
$campaign_data = $this->campaign_model->get_detail($c_id);// Your Account SID and Auth Token from twilio.com/console
$sid = 'ACe2fd1855274ed4eeb167a4fd0ae876b2';
$token = 'e8c00eee568edf1a21b75dccd4e247fe';

$client = new Client($sid, $token);
$twilioNumber = 'MG2a2d5a06bbacbe1d54c7f4b60dcc331c'; //'+12267740744';
foreach ($datas as $data) {
$message = "Dear " . $data->contact_name." ".$data->contact_lname . ",\n".$campaign_data['message']."\n CIR \n 416 267
6700 ";

// $mobileNumber = $data->office_phone;
// if($mobileNumber==null){
// $mobileNumber = $data->mobile;

// }
$mobileNumber =  preg_replace('/[^\dxX]/', '', $data->mobile);
if($mobileNumber==null){
  
//$mobileNumber =  "office==".preg_replace('/[^\dxX]/', '', $data->office_phone);
//  if($data->office_phone==null){
//        continue;
//    }
continue;
}
$contact_id = $data->contact_id;
$app_date=$today;
try {

$res=$client->messages->create(
// Where to send a text message (your cell phone?)
'+1' . $mobileNumber,
array(
'from' => '+12267740744',
'body' => $message,
//'provideFeedback' => True,
'statusCallback' => "https://cirtest.mickai.com/campaign_manage/sms_reply"
)
);

//update data base with sms
$this->update_alert($contact_id,$app_date,'sms', $mobileNumber, $twilioNumber, $message,$res->sid,$c_id);
echo 'success';
//return f;
} catch (\Exception $e) {
echo "error";
return false;
}
}
}
public function sms_reply()
{
$messageSid = $_POST['MessageSid'];
$messageStatus = $_POST['MessageStatus'];
// Log the status or update your database
//log_message('debug', "Received status update for $messageSid: $messageStatus");
$this->alert_sms_model->updateSMSStatus($messageSid, $messageStatus);

}

public function update_alert($contact_id,$app_date,$type, $mobileNumber, $twilioNumber, $message,$tw_id,$c_id)
{
$this->alert_sms_model->add_alert($contact_id,$app_date,$type ,$mobileNumber, $twilioNumber, $message,$tw_id,$c_id);
return true;
}

//send via sendgrid

public function sendEmail($c_id){

$sendgridApiKey = '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';


$today = Date('Y-m-d');
$datas = $this->contact_model->get_contact();

$campaign_data = $this->campaign_model->get_detail($c_id);

foreach ($datas as $data) {

$message = '<html>

<body><img src="<?php echo base_url(); ?>assets/dist/img/MickaiLogo.png" alt="" width="300"
        style="height:auto;display:block;" />
    <h1 style="color:#f40;">Dear '.$data->contact_name.' '.$data->contact_lname.',</h1>
    <p style="color:#080;font-size:18px;">'.$campaign_data['message'].'</p>
</body>

</html>';

$message_db = 'Dear '.$data->contact_name.' '.$data->contact_lname.',<br>'. $campaign_data['message'];
$from = 'marketing@cir.mickai.com';
$to = $data->email;
$contact_id = $data->contact_id;
$app_date=$today;
$subject = 'CIR Promotion';


$email = new Mail();
$email->setFrom("marketing@cir.mickai.com", "CIR");
$email->setSubject($subject);
$email->addTo($to);
$email->addContent("text/plain", $message);
$sendgrid = new SendGrid($sendgridApiKey);
try {
$response = $sendgrid->send($email);
echo 'Email sent successfully. Status code: ' . $response->statusCode();
} catch (Exception $e) {
echo 'Caught exception: '. $e->getMessage() ."\n";
}
//update data base with sms
$this->update_alert($contact_id,$app_date,'email', $to, $from, $message_db,'1',$c_id);
}
}

public function send_test_email() {
$to = 'dananjayata@gmail.com';
$subject = 'Test Email Subject';
$content = 'This is a test email.';

$status = $this->sendgrid_lib->sendEmail($to, $subject, $content);
echo 'Email send status: ' . $status;
}

}
