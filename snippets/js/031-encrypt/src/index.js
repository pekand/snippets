import CryptoES from 'crypto-es';

function init() {
    var ciphertext = CryptoES.AES.encrypt("text", "password", 256);
    console.log(ciphertext.toString());
    var plaintext = CryptoES.AES.decrypt(ciphertext, "password", 256);
    console.log(plaintext.toString(CryptoES.enc.Utf8));
}

window.addEventListener('load', init);

