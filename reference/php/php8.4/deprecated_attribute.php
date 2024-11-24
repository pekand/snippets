<?php

class PhpVersion
{
    #[\Deprecated(
        message: "use PhpVersion::getVersion() instead",
        since: "8.4",
    )]
    public function getPhpVersion(): string
    {
        return $this->getVersion();
    }

    public function getVersion(): string
    {
        return '8.4';
    }
}

$phpVersion = new PhpVersion();
// Deprecated: Method PhpVersion::getPhpVersion() is deprecated since 8.4, use PhpVersion::getVersion() instead in deprecated_attribute.php on line 22 8.4
echo $phpVersion->getPhpVersion();