<?php

if (!defined('BASEPATH'))  exit('No direct script access allowed');

use Twilio\Rest\Client;
use Twilio\TwiML\MessagingResponse;

/**
 * Description of Cron
 *
 * @author Thusitha
 */
class Master_manage extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('form_validation'));
        $this->load->helper('url');
        $this->load->model('contact_model');
        $this->load->model('alert_sms_model');
        $this->load->model('task_detail_model');
        $this->load->helper('form');
        $this->load->library('Menu_Lib');
    }
    public function send_alert()
    {
        $today = Date('Y-m-d');
        $datas = $this->task_detail_model->get_task_detail_data($today, '2');
    }
    public function email_send()
    {

        $this->load->config('email');
        $this->load->library('email');

        $today = Date('Y-m-d');
        $datas = $this->task_detail_model->get_alert_data($today, '1');

        foreach ($datas as $data) {

            $message = '<html><body><img src="<?php echo base_url(); ?>assets/dist/img/MickaiLogo.png" alt=""
width="300"
style="height:auto;display:block;" /><br>
<h1 style="color:#f40;">Dear '.$data->contact_name.' '.$data->contact_lname.',</h1>
<p style="color:#080;font-size:18px;">This is a friendly reminder from Hope Medical Centre.<br>You are now due for your blood test.
Please contact the clinic at your earliest convenient time.<br> Hope Medical Centre<br> 416 267 6700</p>
</body>

</html>';
            
                        $message_db = "Dear '.$data->contact_name.' '.$data->contact_lname.',
This is a friendly reminder from Hope Medical Centre.You are now due for your blood test.
Please contact the clinic at your earliest convenient time.";
$from = $this->config->item('smtp_user');
$to = $data->email;
$contact_id = $data->contact_id;
$app_date=$data->app_date;
$subject = 'Appointment Reminder';


$this->email->set_newline("\r\n");
$this->email->from($from);
$this->email->to($to);
$this->email->subject($subject);
$this->email->message($message);

$this->email->send();
//update data base with sms
$this->update_alert($contact_id,$app_date,'1', $to, $from, $message_db,'1');
}
}

public function sms_send()
{

//sending mechanism
$today = Date('Y-m-d');
$datas = $this->task_detail_model->get_alert_data($today, '2');
// Your Account SID and Auth Token from twilio.com/console
$sid = 'ACe2fd1855274ed4eeb167a4fd0ae876b2';
$token = 'e8c00eee568edf1a21b75dccd4e247fe';

$client = new Client($sid, $token);
$twilioNumber = 'MG2a2d5a06bbacbe1d54c7f4b60dcc331c'; //'+12267740744';
foreach ($datas as $data) {
$message = "Dear " . $data->contact_name." ".$data->contact_lname . ",\nThis is a friendly reminder from Hope Medical Centre.\n You are now due for your blood test.
Please contact the clinic at your earliest convenient time.\n Hope Medical Centre\n 416 267 6700 ";

$mobileNumber = $data->mobile;
$contact_id = $data->contact_id;
$app_date=$data->app_date;
try {

$res=$client->messages->create(
// Where to send a text message (your cell phone?)
'+1' . $mobileNumber,
array(
'from' => $twilioNumber,
'body' => $message,
'provideFeedback' => True
//'statusCallback' => "http://hopetest.mickai.com/master_manage/sms_send"
)
);
//update data base with sms
$this->update_alert($contact_id,$app_date,'2', $mobileNumber, $twilioNumber, $message,$res->sid);
//return f;
} catch (\Exception $e) {
echo "error";
return false;
}
}
}
public function sms_reply()
{
header("content-type: text/xml");

$response = new MessagingResponse();
$response->message(
"I'm using the Twilio PHP library to respond to this SMS!"
);

echo $response;
}

public function update_alert($contact_id,$app_date,$type, $mobileNumber, $twilioNumber, $message,$tw_id)
{
$this->alert_sms_model->add_alert($contact_id,$app_date,$type ,$mobileNumber, $twilioNumber, $message,$tw_id);
return true;
}
}