perl -e "foreach (@INC) {
    print `find $_ -type f -name "*.pm"`;
 }"
