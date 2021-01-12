@echo off 

Rem comment
:: comment

echo %* %0 %1 %2 %3 %4 %5 %6 %7 %8 %9

set /A numericVariable1= 1
SET /A numericVariable2 = 2 
SET /A numericVariable3 = %numericVariable1% + %numericVariable2% * %numericVariable1% / %numericVariable1%

set message=Hello World

echo %numericVariable3% %message%

echo %Path%

set list=1 2 3 4 
(for %%a in (%list%) do ( 
   echo %%a 
))

:: array

set a[0]=1 
set a[1]=2 
set a[2]=3 
echo %a[0]% %a[1]% %a[2]%

setlocal enabledelayedexpansion 
set a[0]=s1 
set a[1]=s2
set a[2]=s3
set a[3]=s4
set a[4]=s5

for /l %%n in (0,1,4) do ( 
   echo !a[%%n]! 
)

:: objects
set obj[0].Name=A 
set obj[0].ID=1 
set obj[1].Name=B 
set obj[1].ID=2 
set obj[2].Name=C 
set obj[2].ID=3 
FOR /L %%i IN (0 1 2) DO  (
   call echo Name = %%obj[%%i].Name%%
   call echo Value = %%obj[%%i].ID%%
)


pause
