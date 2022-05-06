<?php

    require 'config.php';
    require 'getMailRouteConfig.php';
    require 'mailer/class.phpmailer.php';

    class FormHandler {

        private $mail;

        function __construct() {
            if ( !trim( $_POST['email'] ) ) {
                $this->showError();
            }
        }

        public function run() {
            $this->bootMailer();
            $this->routeMail();
            if ( $this->sendMail() ) {
                die( header( "Location: " . $GLOBALS['config']['redirectURL'] ) );
            } else {
                $this->showError();
            }
        }

        private function bootMailer() {
            $this->mail = new PHPMailer;
            $this->mail->IsSMTP();
            $this->mail->SMTPDebug = 0;
            $this->mail->WordWrap = 70;
            $this->mail->IsHTML( true );
            $this->mail->Host = $GLOBALS['config']['host'];
            $this->mail->Port = $GLOBALS['config']['port'];
            $this->mail->From = $_POST['email'];
            $this->mail->FromName = getMailRouteConfig('fromName');
            $this->mail->AddReplyTo( $_POST['email'] );
            // Hidden form field named "subject" becomes the email subject:
            $this->mail->Subject = $_POST['subject'];
            $toEmails = getMailRouteConfig('toEmails');
            foreach ( $toEmails as $email ) {
                $this->mail->AddAddress( $email );
            }
        }

        private function routeMail() {
            if ( getMailRouteConfig('body') === 'mapFields' ) {
                $this->mail->Body = $this->mapFieldsToBody();
            } else {
                $this->mail->Body = $this->getBody();
            }
        }

        private function mapFieldsToBody() {
            $body = '';
            foreach ( $_POST as $key => $val ) {
                if ( $key === 'route' || $key === 'subject' ) continue;
                if ( $val === null || trim($val) === '' ) continue;
                $body .= '<p><strong>' . $key . '</strong>: ' . $val . '</p>';
            }
            return $body;
        }

        private function getBody() {
            $bodyString = getMailRouteConfig('body');
            foreach ( $_POST as $key => $val ) {
                $tag = '{' . $key . '}';
                $bodyString = str_replace( $tag, $_POST[$key], $bodyString );
            }
            return $bodyString;
        }

        private function sendMail() {
            return $this->mail->Send();
        }

        private function showError() {
            die('<h1>Something went wrong. Please use the "Back" button and try again.</h1>');
        }

    }

?>