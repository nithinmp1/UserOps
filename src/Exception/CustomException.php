<?php

namespace App\Exception;

use Exception;

class CustomException extends Exception
{
    protected $adminEmail;

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        // Set the admin email address
        $this->adminEmail = 'admin@example.com'; // Change this to the admin's email address
    }

    public function sendEmailToAdmin()
    {
        echo "mailed"; return;
        // Compose the email message
        $subject = 'Error Notification';
        $body = "An exception occurred:\n\n";
        $body .= "Message: " . $this->getMessage() . "\n";
        $body .= "File: " . $this->getFile() . "\n";
        $body .= "Line: " . $this->getLine() . "\n";
        
        // Send email
        $headers = 'From: webmaster@example.com' . "\r\n" .
                   'Reply-To: webmaster@example.com' . "\r\n" .
                   'X-Mailer: PHP/' . phpversion();

        // Send email
        mail($this->adminEmail, $subject, $body, $headers);
    }
}
