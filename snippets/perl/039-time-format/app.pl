#!/usr/bin/perl

package App;

use v5.10.1;

use strict;
use warnings;

use Data::Dumper;

use Time::Piece;


my $now = Time::Piece->new;
print $now->strftime('%Y-%m-%d %H:%M:%S')."\n";
print '%%='.$now->strftime('%%')."\n";
print '%a='.$now->strftime('%a')."\n";
print '%A='.$now->strftime('%A')."\n";
print '%b='.$now->strftime('%b')."\n";
print '%B='.$now->strftime('%B')."\n";
print '%h='.$now->strftime('%h')."\n";
print '%c='.$now->strftime('%c')."\n";
print '%C='.$now->strftime('%C')."\n";
print '%d='.$now->strftime('%d')."\n";
print '%e='.$now->strftime('%e')."\n";
print '%D='.$now->strftime('%D')."\n";
print '%F='.$now->strftime('%F')."\n";
print '%g='.$now->strftime('%g')."\n";
print '%G='.$now->strftime('%G')."\n";
print '%H='.$now->strftime('%H')."\n";
print '%I='.$now->strftime('%I')."\n";
print '%j='.$now->strftime('%j')."\n";
print '%m='.$now->strftime('%m')."\n";
print '%M='.$now->strftime('%M')."\n";
print '%n='.$now->strftime('%n')."\n";
print '%N='.$now->strftime('%N')."\n";
print '%p='.$now->strftime('%p')."\n";
print '%P='.$now->strftime('%P')."\n";
print '%r='.$now->strftime('%r')."\n";
print '%R='.$now->strftime('%R')."\n";
print '%s='.$now->strftime('%s')."\n";
print '%S='.$now->strftime('%S')."\n";
print '%t='.$now->strftime('%t')."\n";
print '%T='.$now->strftime('%T')."\n";
print '%U='.$now->strftime('%U')."\n";
print '%u='.$now->strftime('%u')."\n";
print '%w='.$now->strftime('%w')."\n";
print '%W='.$now->strftime('%W')."\n";
print '%x='.$now->strftime('%x')."\n";
print '%X='.$now->strftime('%X')."\n";
print '%y='.$now->strftime('%y')."\n";
print '%Y='.$now->strftime('%Y')."\n";
print '%z='.$now->strftime('%z')."\n";
print '%Z='.$now->strftime('%Z')."\n";
print '%O='.$now->strftime('%O')."\n";
