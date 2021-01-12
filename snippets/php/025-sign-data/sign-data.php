<?php

echo "<pre>";

$opensslCnf = dirname(__FILE__).'\openssl.cnf';

$data = 'data you want to sign';

if (!file_exists('signature-private-key.pem') || !file_exists('signature-public-key.pem')) {
    echo "Generate new keys".PHP_EOL;
    
    $config = array(
        'config' => $opensslCnf,
        'digest_alg' => 'sha512',
        'private_key_bits' => 4096,
        'private_key_type' => OPENSSL_KEYTYPE_RSA,
    );

    $new_key_pair = openssl_pkey_new($config);
    openssl_pkey_export($new_key_pair, $private_key_pem, null, $config);

    $details = openssl_pkey_get_details($new_key_pair);
    $public_key_pem = $details['key'];

    file_put_contents('signature-private-key.pem', $private_key_pem);
    file_put_contents('signature-public-key.pem', $public_key_pem);
} else {
    echo "Load from file".PHP_EOL;
    $private_key_pem = file_get_contents('signature-private-key.pem');
    $public_key_pem = file_get_contents('signature-public-key.pem');
    
}

if (!file_exists('signature.dat')) {
    echo "Create signature".PHP_EOL;
    openssl_sign($data, $signature, $private_key_pem, OPENSSL_ALGO_SHA512);
    file_put_contents('signature.dat', base64_encode($signature));
} else {
    echo "Load signature from file".PHP_EOL;
    $signature = base64_decode(file_get_contents('signature.dat'));
}

echo 'data = '.$data.PHP_EOL;
echo 'signature(base64) = '.base64_encode($signature).PHP_EOL;

$signatureIsValid = openssl_verify($data, $signature, $public_key_pem, "sha512WithRSAEncryption");

echo 'valid = '.($signatureIsValid?1:0).PHP_EOL;

while (($e = openssl_error_string()) !== false) {
    echo $e . PHP_EOL;
}
