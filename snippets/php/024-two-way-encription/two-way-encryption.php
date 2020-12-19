<?php

echo "<pre>";

if (!file_exists('encrypt-private.key') || !file_exists('encrypt-public.key')) {
    echo "Generate new keys".PHP_EOL;
    $opensslCnf = dirname(__FILE__).'\openssl.cnf';

    $config = array(
        'config' => $opensslCnf,
        "digest_alg" => "sha512",
        "private_key_bits" => 4096,
        "private_key_type" => OPENSSL_KEYTYPE_RSA,
    );

    $res = openssl_pkey_new($config);

    openssl_pkey_export($res, $private_key, null, $config);

    $public_key = openssl_pkey_get_details($res);
    $public_key = $public_key["key"];

    file_put_contents("./encrypt-private.key", $private_key);
    file_put_contents("./encrypt-public.key", $public_key);
} else {
    echo "Load from file".PHP_EOL;
    $private_key = file_get_contents('./encrypt-private.key');
    $public_key = file_get_contents('./encrypt-public.key');
}

$text = 'This is the text to encrypt';

openssl_public_encrypt($text, $encrypted, $public_key);

$encrypted_hex = bin2hex($encrypted);
echo "Encrypted: $encrypted_hex\n\n";

openssl_private_decrypt($encrypted, $decrypted, $private_key);

echo "Decrypted: $decrypted\n\n";

while (($e = openssl_error_string()) !== false) {
    echo $e . PHP_EOL;
}
