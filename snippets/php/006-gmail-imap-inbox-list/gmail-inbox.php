<?php

/*
setup gmail account for less csecure apps: https://myaccount.google.com/lesssecureapps
*/

$options = array(
    "gmail" => array(
        "username" => "",
        "password" => "",
    ),
);

$optionsFile = "options.json";
if (file_exists($optionsFile)) {
    $options = array_merge($options, json_decode(file_get_contents($optionsFile), true));
}

/*
http://test.dev/021-gmail/gmail.php
http://www.electrictoolbox.com/open-mailbox-other-than-inbox-php-imap/
*/

/* connect to gmail */
$server = '{imap.gmail.com:993/imap/ssl}';
$hostname = $server.'INBOX';

$username = $options['gmail']['username'];
$password = $options['gmail']['password'];

/* try to connect */
$inbox = imap_open($hostname, $username, $password) or die('Cannot connect to Gmail: ' . imap_last_error());


// get all mailboxies
$mailboxes = imap_list($inbox, $server, '*');
var_dump($mailboxes);
/*
    change box: imap_reopen($connection, $server.'[Google Mail]/Spam');
*/

/* grab emails */
//$emails = imap_search($inbox,'UNSEEN');
$emails = imap_search($inbox,'ALL');


/* if emails are returned, cycle through each... */
$data = array();
if($emails) {

    /* put the newest emails on top */
    rsort($emails);

    /* for every email... */
    foreach($emails as $email_number) {

        /* get information specific to this email */
        $overview = imap_fetch_overview($inbox,$email_number,0);
        $message = imap_fetchbody($inbox,$email_number,2);

        /* output the email header information */
        $data[] = array(
            'seen' => ($overview[0]->seen ? 'read' : 'unread'),
            'subject' => $overview[0]->subject,
            'from' => $overview[0]->from,
            'date' => $overview[0]->date,
            'message' => $message,
        );
    }
}

/* close the connection */
imap_close($inbox);

echo json_encode($data);