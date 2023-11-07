<?php

include "config.php";

$inbox = imap_open($hostname, $username, $password) or die('Cannot connect to IMAP: ' . imap_last_error());

// Retrieve emails
$emails = imap_search($inbox, 'ALL');  // Retrieves all emails. You can modify the search criteria as needed.

if ($emails) {
    // Output the email headers for each email
    rsort($emails);  // Sort by newest first

    foreach ($emails as $email_number) {
        $overview = imap_fetch_overview($inbox, $email_number, 0);
        echo "From: {$overview[0]->from}\n";
        echo "Subject: {$overview[0]->subject}\n";
        echo "Date: {$overview[0]->date}\n\n";

        // Uncomment below line if you want to retrieve and display the email body
        // $body = imap_fetchbody($inbox, $email_number, 1.5);
        // echo "Message: $body\n\n";
    }
}

// Close the IMAP connection
imap_close($inbox);



