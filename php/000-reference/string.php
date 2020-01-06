<?php

echo "<pre>";

function __(...$m) {echo implode('',$m).PHP_EOL;}


__("strlen('string')=", strlen('string')); //6

__("strlen('ABCDabcdábcčdď')=", strlen('ABCDabcdábcčdď')); // 17

__("str_word_count=", str_word_count('world world world')); // 3

__("strpos('world world1 world', 'world1')=", strpos('world world1 world', 'world1')); // 6

__("str_replace('old', 'new', 'string old string')=", str_replace('old', 'new', 'string old string')); // string new string

/*
addcslashes
addslashes
bin2hex
chop
chr
chunk_split
convert_cyr_string
convert_uudecode
convert_uuencode
count_chars
crc32
crypt
explode
fprintf
get_html_translation_table
hebrev
hebrevc
hex2bin
html_entity_decode
htmlentities
htmlspecialchars_decode
htmlspecialchars
implode
join
lcfirst
levenshtein
localeconv
ltrim
md5_file
md5
metaphone
money_format
nl_langinfo
nl2br
number_format
ord
parse_str
printf
quoted_printable_decode
quoted_printable_encode
quotemeta
rtrim
setlocale
sha1_file
sha1
similar_text
soundex
sprintf
sscanf
str_getcsv
str_ireplace
str_pad
str_repeat
str_replace
str_rot13
str_shuffle
str_split
str_word_count
strcasecmp
strchr
strcmp
strcoll
strcspn
strip_tags
stripcslashes
stripos
stripslashes
stristr
strlen
strnatcasecmp
strnatcmp
strncasecmp
strncmp
strpbrk
strpos
strrchr
strrev
strripos
strrpos
strspn
strstr
strtok
strtolower
strtoupper
strtr
substr_compare
substr_count
substr_replace
substr
trim
ucfirst
ucwords
vfprintf
vprintf
vsprintf
wordwrap
*/


__("mb_strlen=", mb_strlen("ABCDabcdábcčdď")); // 14

/*
mb_check_encoding
mb_chr
mb_convert_case
mb_convert_encoding
mb_convert_kana
mb_convert_variables
mb_decode_mimeheader
mb_decode_numericentity
mb_detect_encoding
mb_detect_order
mb_encode_mimeheader
mb_encode_numericentity
mb_encoding_aliases
mb_ereg_match
mb_ereg_replace_callback
mb_ereg_replace
mb_ereg_search_getpos
mb_ereg_search_getregs
mb_ereg_search_init
mb_ereg_search_pos
mb_ereg_search_regs
mb_ereg_search_setpos
mb_ereg_search
mb_ereg
mb_eregi_replace
mb_eregi
mb_get_info
mb_http_input
mb_http_output
mb_internal_encoding
mb_language
mb_list_encodings
mb_ord
mb_output_handler
mb_parse_str
mb_preferred_mime_name
mb_regex_encoding
mb_regex_set_options
mb_scrub
mb_send_mail
mb_split
mb_strcut
mb_strimwidth
mb_stripos
mb_stristr
mb_strlen
mb_strpos
mb_strrchr
mb_strrichr
mb_strripos
mb_strrpos
mb_strstr
mb_strtolower
mb_strtoupper
mb_strwidth
mb_substitute_character
mb_substr_count
mb_substr
*/