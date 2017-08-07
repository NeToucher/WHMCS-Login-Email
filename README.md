WHMCS User Login Notify Email [Hook]
===========
When a user login from clientarea login page (instead of login as a user from administrator panel), send the user a notification email.

Usage Document
------------------
Create a custom email template before you load this hook in your WHMCS. And edit `$values["messagename"] = "Login Prompt";` to match your template name.
