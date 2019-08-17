https://codecanyon.net/item/pro-login-advanced-secure-php-user-management-system/12388905
Version 2.1 (Released 30/04/2019)

Tutorial: http://documentation.patchesoft.com/client/document/2/163


Did not use simple setup! (with webinstaller)

- Used database.sql for setup
- copy files to development/database.php and development/config.php

Setup admin account:
http://localhost/2019-oerhoernchen20-prologin/install/

# Security

2DO: delete install & setup files

IMPORTANT: Once you have installed the product, please delete the file application/controllers/install.php! This will prevent other users from messing up your settings. Please also delete setup.php and setup_db.sql in the main directory.

# Packaging 

https://www.codeigniter.com/user_guide/libraries/loader.html





> cd your-project

# Logs

> tail -f /logs/log-

# Install

Use /config/development, needs database, ion_auth, appbase-config file 

# Submissions

There are two options

- a) User is verified by staff, can publish directly to index
- b) User is not verifified/anon users, entries must be allowed by staff in backoffice

