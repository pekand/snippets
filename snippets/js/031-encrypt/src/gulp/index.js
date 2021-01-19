//import CryptoJS from 'crypto-js';
//import Person from './Person';

function init() {
    var p = new Person('aaa', 'bbb');
    p.display();
    
    var ciphertext = CryptoJS.AES.encrypt("text", "password", 256);
    console.log(ciphertext.toString());
    var plaintext = CryptoJS.AES.decrypt(ciphertext, "password", 256);
    console.log(plaintext.toString(CryptoJS.enc.Utf8));
}

window.addEventListener('load', init);

