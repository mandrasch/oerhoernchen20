# THIS IS A NEW SPIDER
# WE JUST COLLECT ALL URLS MATCHING OUR SELECTORS
# e.g. hoou has no machine readable licenses
# we parse them later with PHP
# goal is just to have the html files exported




# SPIDER (python3, scrapy 1.6)
# use case options, can be mixed
# I. pages without machine readable license, but general license e.g. http://www.inf-schule.de/ (use manual_license_override)
# II. page with machine readable licenses page by page
# III. pages with mixed content (OER/standard copyright) and machine readability
# IV. pages who store OER only in subpath, e.g. edulabs.de/oer/*

# 2DO: special spiders for edutags -> get license info out correct from page

# 2DO: let license info out, we do it with simple dom in php more flexible :-)

# CLI USAGE
# cd cd /Users/admin/webserver/oerhoernchen-2019/oerhoernchenscrapy/
# testing with limit:
# scrapy crawl basic -a project_key=oeruniletest -o data.json -a limit=50
# full scraping:
# scrapy crawl basic -a project_key=oeruniletest -o data.json

import json
import scrapy
import re
from scrapy.spiders import CrawlSpider, Rule
from scrapy.linkextractors import LinkExtractor
from scrapy.exceptions import CloseSpider
import uuid

from pathlib import Path

# required params:
# domain
# start_url

# can be fine tuned (optional)
# allow / deny - item detection based on absolute urls  (e.g. restrict path to ...*/oer/*...)
# exclude_pages_with_no_a_rel_cc_license = 1 --> use machine readable information on pages which have OER/non-OER content (Default: set to 0)
# manual license override - value for pages, that do not support cc licenses, but have a general license

# https://stackoverflow.com/questions/15611605/how-to-pass-a-user-defined-argument-in-scrapy-spider
# init will load as as attribute string
# self.project_key

class HtmlexportSpider(CrawlSpider):
    name = 'htmlexport'
    # crawled pages count
    count = 0

    # CLI Call:
    # http://doc.scrapy.org/en/latest/topics/spiders.html#spider-arguments
    def __init__(self, project_key=None,limit=0, *args, **kwargs):
        super(HtmlexportSpider, self).__init__(*args, **kwargs)

        # for testing purposes (-a limit=10), 0 as default and no restriction
        self.COUNT_MAX = int(limit)
        #self.log('SET COUNT MAX TO '+limit)


        # LOAD PROJECTS LIST
        # https://stackoverflow.com/questions/40827356/find-a-value-in-json-using-python
        with open('projects.json') as json_file:
            parsedJsonData = json.load(json_file)

        self.projectSettings = None
        for projectJsonItem in parsedJsonData:
            if projectJsonItem['project_key'] == project_key:
                self.projectSettings = projectJsonItem
                break

        # cast values
        self.projectSettings['exclude_pages_with_no_cc_license'] = int(self.projectSettings['exclude_pages_with_no_cc_license'])

        if self.projectSettings is None:
            print("Project settings not found for "+projectKey+" , exiting.")
            exit()
            #2DO - error if not found/empty

        self.log("Project settings found!");
        # 2DO: How to put it in log?
        #print(projectSettings)

        # set settings for spider
        self.start_urls = self.projectSettings['start_urls']
        self.allowed_domains = self.projectSettings['allowed_domains']


        # from settings - regexp must be escaped (double backslack)
        # list of regexps, decode from json to bytes, than (unicode decode/encode)
        # is checked with absolute url
        allowList = []
        if "rules_parse_item_allow" in self.projectSettings:
            print("HAS ATTRIBUTE FOR ALLOW LIST")
            for regExString in self.projectSettings['rules_parse_item_allow']:
                # https://stackoverflow.com/questions/12989224/how-to-receive-regex-from-command-line-in-python
                allowList.append(regExString.encode().decode('unicode_escape'))
                # print(allowList)

        denyList = []
        if "rules_parse_item_deny" in self.projectSettings:
            for regExString in self.projectSettings['rules_parse_item_deny']:
                denyList.append(regExString.encode().decode('unicode_escape'))
                #print(allowList)

        # https://scrapy2.readthedocs.io/en/latest/topics/link-extractors.html
        self.rules = (

            # FIRST RULE If multiple rules match the same link, the first one will be used, according to the order they’re defined in this attribute.

            # IMPORTANT: if allow is not set, just every subpage is stored in index (broad indexing)
            # Extract links matching 'item.php' and parse them with the spider's method parse_item
            # https://blog.balthazar-rouberol.com/crawl-a-website-with-scrapy
            #Rule(LinkExtractor(allow=(r'.*\/lerninhalt\/.*')), callback='parse_item'),
            Rule(LinkExtractor(allow=allowList,deny=denyList),callback='parseItem',follow=True),

            # follow all other links with spider, but do not parse/save them as item
            Rule(LinkExtractor(), callback="parsePageForLinks",follow=True),
        )

        # important: recompile rules
        # https://stackoverflow.com/questions/27509489/how-to-dynamically-set-scrapy-rules
        super(HtmlexportSpider, self)._compile_rules()

        #eo init

    # detected as item, parse page & get page details and content for search index
    def parseItem(self,response):

        self.log('+++ PARSE ITEM +++ '+response.url)

        # IMPORTANT - FIX THIS, IMPROVE DETECTION?
        # 2DO: use function here to detect all possible license options (a rel, link rel license/copyright, etc.?)

        # some portals have OER + standard copyright material, e.g. oncampus
        # if they have machine readable cc licenses, we can exclude non-OER here:
        # BEWARE THIS ONLY WORKS IF THEY REALLY HAVE CC LICENSES ;-)
        if "exclude_pages_with_no_cc_license" in self.projectSettings and self.projectSettings['exclude_pages_with_no_cc_license'] is 1 and response.css('a[rel=license]::attr(href)').get() is None:
            self.log('PARSED ITEM - no cc license, skip to next URL')
            return

        # 2DO: do it in php
        # manual license override - if there is no machine readable license (project-wide)
        if "manual_license_override" in self.projectSettings:
            manualLicenseOverride = self.projectSettings['manual_license_override']
        else:
            manualLicenseOverride = ""


        #2DO: Open Graph / Twitter SEO, especially preview images?
        # <meta property="og:url" content="https://mediathek.hhu.de/watch/beb18a64-be2b-45b1-a216-9bf4967f83c6" />
        # <meta property="og:description" content="" />
        # <meta property="og:image" content="https://mediathek.hhu.de/thumbs/beb18a64-be2b-45b1-a216-9bf4967f83c6/thumb_000.jpg" />
        # <meta property="og:image:secure_url" content="https://mediathek.hhu.de/thumbs/beb18a64-be2b-45b1-a216-9bf4967f83c6/thumb_000.jpg" />
        # <meta property="og:site_name" content="HHU Mediathek" />
        # <meta name="twitter:card" content="summary" />
        # <meta name="twitter:site" content="@HHUMediathek" />
        # <meta name="twitter:title" content="Lehrpreis Medizin 2018" />
        # <meta name="twitter:description" content="" />
        # <meta name="twitter:image" content="https://mediathek.hhu.de/thumbs/beb18a64-be2b-45b1-a216-9bf4967f83c6/thumb_000.jpg" />

        # https://stackoverflow.com/questions/46067258/scrapy-save-response-body-as-html-file

        # save html as export file
        filename = str(uuid.uuid4())+".html"

        # 2DO: clean folder before?
        data_folder = Path("html_exports/")
        file_to_open = data_folder / filename

        self.html_file = open(file_to_open, 'w')
        self.html_file.write(response.text)
        self.html_file.close()


        scraped_info = {
            'project_key':self.projectSettings['project_key'],
            'filename':filename,
            # 'project_url':self.start_urls[0],
            'page_url':response.url,
            'meta_title':response.xpath('//title/text()').extract(),
            #'meta_description':response.xpath('//meta[@name=\'keywords\']/@content').extract(),
            #'og_title':response.xpath('//meta[@name=\'og:title\']/@content').extract(),
            #'a_rel_license':response.css('a[rel=license]::attr(href)').extract_first(),
            #'link_rel_license':response.css('link[rel=license]::attr(href)').extract_first(),
            #'link_rel_copyright':response.css('link[rel=copyright]::attr(href)').extract_first(),
            #'content':response.xpath('//body//p//text()').extract(),
            #'manual_license_override':manualLicenseOverride
        }

        # export to item list:
        yield scraped_info

        self.log('++++ SAVED ++++ '+response.url)
        self.checkMaxCount()

    # parse a page for links to follow, if allow/deny is set and item was not detected
    def parsePageForLinks(self,response):
        self.log('ONLY PARSING FOR LINKS TO FOLLOW, NO SAVING AS ITEM: '+response.url)
        self.checkMaxCount()

    def checkMaxCount(self):
        self.count = self.count + 1
        if (self.COUNT_MAX > 0 and self.count > self.COUNT_MAX):
            print("LIMIT FOR TEST REACHED, EXITING")
            raise CloseSpider('termination condition met MAX COUNT')
