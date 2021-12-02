
# command line interface
php command.php help


Scenario - Normal
[x] user login
[x] show secret page
[x] user logout

Scenario - New user
[] show login page
[] click to register new user
[] show register page
[] fill username password repeat password email
[] send form
[] check form
[] show errors
[] add new user inactive
[] send email to activate user
[] user clic in link in email
[] redirect to activation page
[] activate user, login user
[] redirect to secret page

Scenario - Change password
[] user click on account link in secret page
[] show account
[] fill form for change password, old new , repeat
[] send form with password
[] validate changes
[] show errors
[] save new password or email

Scenario - Reset password
[] user click on link reset password on login page
[] user get to page where put email
[] send form > check if mail exist > send reset password link to email
[] send email
[] user click on link in email
[] go to reset password page
[] user fill new password and repeat
[] send form validate show errors
[] save new password 
[] user loged in and show secret page


Scenario - Stay sign in
[] user check checkbox on login  page to stey signed in
[] send login form 
[] set cookie to expire indefinetly > set cookie with secret identificator for user > if cookie exist automaticaly user login
[] implement logout from all acounts > reset secret code for user > invalidate all sesions

