NO WARRANTY! USE THIS ON YOUR OWN RISK!
PLEASE RESPECT ROBOTS.TXT, RATE LIMITS AND COPYRIGHT!


HOOU -> we do it with PHP, see /web/ -> cli controller
ZOERR -> let's scrape
scrapy crawl htmlexport -a project_key=zoerr

https://docs.google.com/presentation/d/1lLW2Ma_aKXSAelpsqJCk-zUF5i5GhNchSL7G1KGAPiM/edit?usp=sharing

# Use a spider (Python3, Scrapy 1.6)
cd cd /Users/admin/webserver/2019-oerhoernchen20/scrapy/
NEW:

scrapy crawl htmlexport -a project_key=oerunileipzig

scrapy crawl basic -a project_key=hoou



Uni LE removed from test server?
scrapy crawl basic -a project_key=oeruniletest

OLD:
scrapy crawl basic -a project_key=hoou -o result_data/data_hoou.json -a limit=50
scrapy crawl basic -a project_key=oeruniletest -o data.json -a limit=50
scrapy crawl basic -a project_key=oeruniletest -o data.json

-> Data.json, limit funzt, aber was genau bedeutet 50?

daten werden aus projects.json ausgelesen
