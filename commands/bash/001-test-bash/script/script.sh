#!/bin/bash

#### VAR1=10
#### echo $(echo "$VAR1")
#### if [[ $(echo "$VAR1") -gt 1 ]]; then
####     echo "TRUE"
#### else
####     echo "FALSE"
#### fi

### for ((i=1;i<=VAR1;i++))
### do
###   echo "i=${i}"
### done

## FILES=()
## while IFS= read -r line
## do
##     FILES+=( "$line" )
##     echo "1: $line"
## done < <( ls -la )
## 
## for FILE in "${FILES[@]}" ; do
##   echo "AAAA: $FILE\n"
## done

# VAR2=("-l" "a")
# DEFAULT_BUILD_ARGS=("--build-arg" "CENTOS_VERSION=7")
# 
# echo "${DEFAULT_BUILD_ARGS[@]}"

## echo $( ls \
## -l \
## -a
## )

CI_COMMIT_BRANCH=feature/DEV-12313

if [[ $CI_COMMIT_BRANCH =~ ^feature/[A-Z]{2,4}- ]]; then
	if [[ ! $CI_COMMIT_BRANCH =~ ^feature/[A-Z]{2,4}-[0-9]{1,6}_ ]]; then
		echo "NAZOV branche nevyhovuje predpisu feature/DEV-12345_xxx" >&2
		exit 1
	fi
fi