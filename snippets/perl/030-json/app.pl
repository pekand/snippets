#!/usr/bin/perl

package App;

use v5.10.1;

use strict;
use warnings;
use JSON;
use Data::Dumper;

use constant GDPR_CHECK_CACHE_FILE => "test.json";



{
    my $data = {
        'item1' => [
            {'key1' => 'val1'},
        ]
    };

    open my $fh, ">", GDPR_CHECK_CACHE_FILE or die("Can't open file\n");
    print $fh encode_json($data);
    close $fh;
}

{
    open my $fh, "<", GDPR_CHECK_CACHE_FILE or die("Can't open file\n");
    my $json = <$fh>;
    my $data = decode_json($json);
    warn Data::Dumper::Dumper($data);
}

1;
