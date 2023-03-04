Update December 2021: This idea / technical approach is now used in a real OER search engine: https://oersi.org/resources/, source code: https://gitlab.com/oersi. Much success, OERSI-team! 🎉

Update February 2020: @sroertgen forked this prototype, please check out his fork for further improvements 
https://github.com/sroertgen/oerhoernchen20_docker

This repository is currently not actively developed.

# Quick & dirty prototype

IT IS NOT RECOMMEND TO USE IT IN PRODUCTION ENVIRONMENTS, NO WARRANTY

Live demo: https://beta2.oerhoernchen.de/hochschule/ (offline)

Background / documentation:

- DE https://www.youtube.com/watch?v=yI5xqyNTkTs
- EN https://www.youtube.com/watch?v=ibFHmo_jHC4

(Maybe extend this idea for #TOSIoer - first draft:
https://docs.google.com/presentation/d/14jMeONt1-uW9QKOuciZBw9uGSR6GC6JHzfBx9uckp3g/edit#slide=id.p)

## Technical background

How was OER metadata obtained from https://oerbw.de, https://hoou.de and others?

Mainly this is the same approach that Google and other search engines use: Discovering URLs by sitemap.xml file and crawl the pages (Google offers the https://search.google.com/search-console/about?hl=de to reindex pages and check if all pages were crawled correctly, I think thats smart for OER in the OpenWeb too)

1. Get sitemap.xml file
2. Search for url with specific paths, e.g. /render/ (OERBW/ZOERR) /materials/ (HOOU)
3. Get URL (curl), parse it (Simple DOM)
4. For OERBW/ZOERR it is wonderful & easy, because metadata is stored as json & in schema.org format in HTML source code :raised_hands: :raised_hands: :raised_hands:
5. For HOOU we need to parse the HTML source code manually (although they have schema.org metadata, but only about their organisation \[submitted to them as feedback already\]
6. Push the obtained metadata to appbase.io index (elastic search), handle create/update logic
7. Enjoy

- Next step, hopefully we'll achieve this soon: Cooperate on OER metadata standard, so we can filter for subjects, technical formats, etc.
- big dream: every OER portal or project has metadata in HTML source available
- Example for schema.org metadata in source code: https://www.oerbw.de/edu-sharing/components/render/4aed7529-dd02-44d0-b518-4640a8e8902f

If you're nOERdy, please also check out http://blog.lobid.org/2019/05/17/skohub.html

Also inspired by https://blog.hartleybrody.com/web-scraping/ <3

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
