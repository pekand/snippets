<?php


class Blog
{
    public string $status;

    public function __construct($status)
    {
        $this->status = $status;
    }

    public function changeStatus($status)
    {
        $this->status = $status;
    }

    public function changeStatus2($status)
    {
       $callback = $this->changeStatus(...);

       $callback($status);
    }
}

// Example 1 get callback to method 

$blog = new Blog("active");

$callback = $blog->changeStatus(...);

$callback("inactive");

echo $blog->status."\n";

// Example 2 get callback to method in object

$callback = $blog->changeStatus2("deleted");

echo $blog->status."\n";

// Example 3 get call back to system function

$callback = strlen(...);

echo $callback("text")."\n";
