#!/bin/bash

perl -I"./modules" -we 'use NameOfTheProject::SomeModule qw(some_function); print some_function();' 
