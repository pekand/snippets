<?php

// https://www.php.net/manual/en/language.enumerations.php

enum Status
{
    case Draft;
    case Published;
    case Archived;
}

function acceptStatus(Status $status) {
    if ($status == Status::Draft){
        echo "Draft\n";
    }
}

acceptStatus(Status::Draft);
