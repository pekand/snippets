<?php

// https://www.php.net/manual/en/language.oop5.properties.php#language.oop5.properties.readonly-properties

class Blog
{
    public readonly string $status;

    // Fatal error: Readonly property Blog::$status2 cannot have default value
    // public readonly string $status = "active";

    public function __construct($status)
    {
        $this->status = $status;
    }

    public function changeStatus($status)
    {
        $this->status = $status;
    }
}

$blog = new Blog("active");

echo $blog->status."\n";

// PHP Fatal error:  Uncaught Error: Cannot modify readonly property
// $blog->status = "inactive"; 

// PHP Fatal error:  Uncaught Error: Cannot modify readonly property
// $blog->changeStatus("inactive");
