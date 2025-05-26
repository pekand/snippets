Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope CurrentUser
Invoke-RestMethod -Uri https://get.scoop.sh | Invoke-Expression
php 8.3 required
scoop install symfony-cli
symfony new --webapp my_project
symfony new my_project
symfony serve
http://127.0.0.1:8000