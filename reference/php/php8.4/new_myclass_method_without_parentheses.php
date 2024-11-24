<?php

class PhpVersion
{
    public function getVersion(): string
    {
        return 'PHP 8.4';
    }
}

var_dump(new PhpVersion()->getVersion());

