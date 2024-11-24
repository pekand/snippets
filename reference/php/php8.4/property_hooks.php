<?php 

class LocaleClass
{
    public string $languageCode;

    public string $countryCode
    {
        set (string $countryCode) {
            $this->countryCode = strtoupper($countryCode);
        }
    }

    public string $combinedCode
    {
        get => \sprintf("%s_%s", $this->languageCode, $this->countryCode);
        set (string $value) {
            [$this->countryCode, $this->languageCode] = explode('_', $value, 2);
        }
    }

    public function __construct(string $languageCode, string $countryCode)
    {
        $this->languageCode = $languageCode;
        $this->countryCode = $countryCode;
    }
}

$brazilianPortuguese = new LocaleClass('pt', 'br');
var_dump($brazilianPortuguese->countryCode); // BR
var_dump($brazilianPortuguese->combinedCode); // pt_BR