<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/third_party/sendgrid-php/lib/SendGrid.php';
require_once APPPATH . '/third_party/sendgrid-php/lib/Mail/Mail.php';


use SendGrid\Mail\Mail;

class Sendgrid_lib {
    protected $CI;
    protected $sendgrid;

    public function __construct() {
        $this->CI =& get_instance();
        $sendgridApiKey = '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';
        $this->sendgrid = new \SendGrid($sendgridApiKey);
    }

    public function sendEmail($to, $subject, $content) {
        $email = new Mail();
        $email->setFrom("your-email@example.com", "Your Name");
        $email->setSubject($subject);
        $email->addTo($to);
        $email->addContent("text/plain", $content);

        try {
            $response = $this->sendgrid->send($email);
            return $response->statusCode();
        } catch (Exception $e) {
            return 'Caught exception: '. $e->getMessage();
        }
    }
}