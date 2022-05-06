# PHP Web Form Mailer

A PHP script for emailing web forms.

This is designed to be targeted by an HTML web form's "POST" method:

`<form action="https://api.example.com/PHPWebFormEmailer" method="post">`

## Prerequisites

-   PHP 5.x or greater
-   PHP Mailer 5.x

## Getting Started

1. Place the [PHPMailer library](https://packagist.org/packages/phpmailer) into a folder called "mailer"
2. Make sure your HTML form has a hidden field called "route". Its value should match one of the keys from the "mailroutes" array in config.php
