## Install

1. setup config (database.php, base_url in config.php) - use /config/development/ folder
2. import oerhoernchen_db.sqlite
3. import ion_auth.sqlite
4. create ci_sessions table (see below)
4. Make sure to change the default password!
5. Make sure to change the users email adress

> CREATE TABLE IF NOT EXISTS `ci_sessions` (
        `id` varchar(128) NOT NULL,
        `ip_address` varchar(45) NOT NULL,
        `timestamp` int(10) unsigned DEFAULT 0 NOT NULL,
        `data` blob NOT NULL,
        KEY `ci_sessions_timestamp` (`timestamp`)
);
