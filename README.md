Quick & dirty prototype

## Install web frontend

1. setup config (database.php, base_url in config.php, appbase) - use /config/development/ folder, I provided examples in config/example-env
2. import oerhoernchen_db.sql
3. import ion_auth.sql
4. import ci_sessions.sql
4. Make sure to change the default password to a new password via http://localhost/auth/
5. Make sure to change the users email address
6. For production - set CI_ENV and use /config/production for config

## Run reactjs interfaces locally

1. "npm start" to run it locally
2. "npm run build" to build production version
3. Appbase config values (API-url, API-key) can be added in /public/index.html (Please use your own due to rate limiting on my instances)

## Open Source Software used <3

- Codeigniter https://www.codeigniter.com/
- Codeigniter Ion Auth https://github.com/benedmunds/CodeIgniter-Ion-Auth
- ReactiveSearch https://opensource.appbase.io/reactivesearch/
- SimpleDOM Parser https://simplehtmldom.sourceforge.io/
- ReactJS https://reactjs.org/
- Bootstrap https://getbootstrap.com/docs/4.0/getting-started/introduction/

## Elastic search service

- Appbase https://appbase.io/ - Much love for providing a free plan :) <3

## LICENSE

Feel free to use all source code created by me via https://creativecommons.org/publicdomain/zero/1.0/, does not apply to external source code provided by other projects
