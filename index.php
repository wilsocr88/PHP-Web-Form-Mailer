<?php

    /**
     * Required HTML form field names:
     *   email <- becomes the "From" field in the resulting email
     *   subject <- (hidden field) Text string of the email subject
     *   route <- (hidden field) the key from the "mailRoutes" array item in config.php
     */

    require 'FormHandler.php';
    $f = new FormHandler();
    $f->run();

?>