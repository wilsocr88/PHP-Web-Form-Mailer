<?php

    $GLOBALS['config'] = array(
        // These connection settings get passed to PHPMailer
        'host' => 'mailserver.example.com',
        'port' => 25,
        
        // Each of these mailRoutes arrays is a "route" that tells PHP Web 
        // Form Mailer what to do with the form data POSTed to it.
        // The HTML form should contain a hidden field called "route" that
        // maps to one of these mailRoutes arrays:
        // <input type="hidden" name="route" value="generic" />
        'mailRoutes' => array(
            'generic' => array(
                'fromName' => 'Website Contact Form',

                // OPTION 1: Automatically "map" fields to the body text like 
                // this: "fieldName: fieldValue"
                'body' => 'mapFields', 

                'toEmails' => array( 'email@example.com', 'things@example.com' ),
            ),
            'bodyExample' => array(
                'fromName' => 'Website Contact Form',

                // OPTION 2: You can also construct the HTML body manually, 
                // using bracketed {fieldnames} like this:
                'body' => '
                    <p><strong>Name:</strong> {name}</p>
                    <p><strong>Address:</strong><br/>
                    {address}
                    {city} {state} {zip}</p>
                    <p><strong>Email:</strong> {email}</p>
                    <p><strong>Phone:</strong> {phone}</p>
                ',
                
                // Where the form is emailed
                'toEmails' => array(
                    'email@example.com',
                    'things@example.com'
                ),
            ),
        ),
        'redirectURL' => 'https://example.com/form-submission-confirmation',
    );

?>