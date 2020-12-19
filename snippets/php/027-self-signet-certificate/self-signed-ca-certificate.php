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

// generate CA 

$configCA = array(
    'config' => dirname(__FILE__).'\self-signed-ca.cnf',
    'digest_alg' => 'SHA256',
    'private_key_bits' => 2048,
    'private_key_type' => OPENSSL_KEYTYPE_RSA,
    'encrypt_key' => true,
    'encrypt_key_cipher'=> OPENSSL_CIPHER_3DES
);

$privkeyCA = openssl_pkey_new($configCA);
$csrCA = openssl_csr_new($dn, $privkeyCA, $configCA);
$x509CA = openssl_csr_sign($csrCA, null, $privkeyCA, 365, $configCA, time());

openssl_csr_export($csrCA, $csrCAout) and var_dump($csrCAout);
openssl_x509_export($x509CA, $certCAout) and var_dump($certCAout);
openssl_pkey_export($privkeyCA, $privkeyCAout, "password", $configCA) and var_dump($privkeyCAout);

file_put_contents('self-signed-ca.csr', $csrCAout);
file_put_contents('self-signed-ca.crt', $certCAout);
file_put_contents('self-signed-ca.key', $privkeyCAout);

