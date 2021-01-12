<?php

echo "<pre>";

$opensslCnf = dirname(__FILE__).'\openssl.cnf';

$config = array(
    'config' => $opensslCnf,
    'digest_alg' => 'sha512',
    'private_key_bits' => 4096,
    'private_key_type' => OPENSSL_KEYTYPE_RSA,
);

$rsaKey = openssl_pkey_new($config);

$privKey = openssl_pkey_get_private($rsaKey); 
openssl_pkey_export($privKey, $pem, null, $config); //Private Key
$pubKey = sshEncodePublicKey($rsaKey); //Public Key

$umask = umask(0066); 
file_put_contents('ssh_rsa', $pem);
file_put_contents('ssh_rsa.pub', $pubKey);

print "Private Key:\n $pem \n\n";
echo "Public key:\n$pubKey\n\n";

while (($e = openssl_error_string()) !== false) {
    echo $e . "\n";
}

function sshEncodePublicKey($privKey)
{
    $keyInfo = openssl_pkey_get_details($privKey);

    $buffer  = pack("N", 7) . "ssh-rsa" . 
               sshEncodeBuffer($keyInfo['rsa']['e']) . 
               sshEncodeBuffer($keyInfo['rsa']['n']);

    return "ssh-rsa " . base64_encode($buffer); 
}

function sshEncodeBuffer($buffer)
{
    $len = strlen($buffer);
    if (ord($buffer[0]) & 0x80) {
        $len++;
        $buffer = "\x00" . $buffer;
    }

    return pack("Na*", $len, $buffer);
}

while (($e = openssl_error_string()) !== false) {
    echo $e . PHP_EOL;
}
