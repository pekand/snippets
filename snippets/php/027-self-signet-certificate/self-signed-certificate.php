<?php

echo "<pre>";

$dn = array(
    "countryName" => "SK",
    "stateOrProvinceName" => "Slovakia",
    "localityName" => "Bratislava",
    "organizationName" => "organization",
    "organizationalUnitName" => "unit",
    "commonName" => "domain.loc",
);

/////////////////////////////////////////////

$config = array(
    'config' => dirname(__FILE__).'\self-signed.cnf',
    'digest_alg' => 'SHA256',
    'private_key_bits' => 2048,
    'private_key_type' => OPENSSL_KEYTYPE_RSA,
);

$configCsr = array(
    'config' => dirname(__FILE__).'\self-signed-csr.cnf',
    'digest_alg' => 'SHA256',
    'private_key_bits' => 2048,
    'private_key_type' => OPENSSL_KEYTYPE_RSA,
    'x509_extensions' => 'v3_req',
    'req_extensions' => 'v3_req',
);

$privkey = openssl_pkey_new($config);

$csr = openssl_csr_new($dn, $privkey, $config);

$cacert = file_get_contents('./self-signed-ca.crt');
$caprivkey = array(file_get_contents('./self-signed-ca.key'), "password");

$x509 = openssl_csr_sign($csr, $cacert, $caprivkey, 365, $configCsr, time());

openssl_csr_export($csr, $csrout) and var_dump($csrout);
openssl_x509_export($x509, $certout) and var_dump($certout);
openssl_pkey_export($privkey, $pkeyout, null, $config) and var_dump($pkeyout);

file_put_contents('self-signed.csr', $csrout);
file_put_contents('self-signed.crt', $certout);
file_put_contents('self-signed.key', $pkeyout);

while (($e = openssl_error_string()) !== false) {
    echo $e . PHP_EOL;
}
