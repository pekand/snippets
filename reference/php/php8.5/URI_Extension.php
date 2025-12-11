<?php

/*
	URI Extension
	The new always-available URI extension provides APIs to securely parse and modify URIs and URLs according to the RFC 3986 and the WHATWG URL standards.
	Powered by the uriparser (RFC 3986) and Lexbor (WHATWG URL) libraries.
	https://uriparser.github.io/
	https://datatracker.ietf.org/doc/html/rfc3986
	https://lexbor.com/	
	Learn more about the backstory of this feature in The PHP Foundation’s blog.
	https://thephp.foundation/blog/2025/10/10/php-85-uri-extension/

	https://wiki.php.net/rfc/url_parsing_api
*/

//PHP 8.5
$uri = new Uri\Rfc3986\Uri("https://%61pple:p%61ss@ex%61mple.com:433/foob%61r?%61bc=%61bc#%61bc");

echo $uri->getRawScheme().PHP_EOL;                       // https
echo $uri->getScheme().PHP_EOL;                          // https

echo $uri->getRawUserInfo().PHP_EOL;                     // %61pple:p%61ss
echo $uri->getUserInfo().PHP_EOL;                        // apple:pass

echo $uri->getRawUsername().PHP_EOL;                     // %61pple
echo $uri->getUsername().PHP_EOL;                        // apple

echo $uri->getRawPassword().PHP_EOL;                     // p%61ss
echo $uri->getPassword().PHP_EOL;                        // pass

echo $uri->getRawHost().PHP_EOL;                         // ex%61mple.com
echo $uri->getHost().PHP_EOL;                            // example.com

echo $uri->getPort().PHP_EOL;                            // 433

echo $uri->getRawPath().PHP_EOL;                         // /foob%61r
echo $uri->getPath().PHP_EOL;                            // /foobar

echo $uri->getRawQuery().PHP_EOL;                        // %61bc=%61bc
echo $uri->getQuery().PHP_EOL;                           // abc=abc

echo $uri->getRawFragment().PHP_EOL;                     // %61bc
echo $uri->getFragment().PHP_EOL;                        // abc

// string(7) "php.net"

//PHP 8.4
$components = parse_url('https://php.net/releases/8.4/en.php');
var_dump($components);
// string(7) "php.net"
