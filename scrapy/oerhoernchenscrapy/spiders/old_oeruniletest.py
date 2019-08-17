# -*- coding: utf-8 -*-
# USE IN CLI:
# scrapy crawl oeruniletest -o data.json 
# scrapy crawl infschule-basic --set CLOSESPIDER_ITEMCOUNT=5
import scrapy
from scrapy.spiders import CrawlSpider, Rule
from scrapy.linkextractors import LinkExtractor

class LinkscrawlItem(scrapy.Item):
	# define the fields for your item here like:
	link = scrapy.Field()
	attr = scrapy.Field()

class InfschuleBasicSpider(CrawlSpider):
	name = 'oeruniletest'
	allowed_domains = ['pub.matthias-andrasch.de']
	start_urls = ['http://pub.matthias-andrasch.de/2019/oerunileipzig/']

	rules = (

		# Extract links matching 'item.php' and parse them with the spider's method parse_item
		# https://blog.balthazar-rouberol.com/crawl-a-website-with-scrapy
        Rule(LinkExtractor(allow=(r'.*\/lerninhalt\/.*')), callback='parse_item'),

        # follow all other links with spider, but do not parse/save them as item
		Rule(LinkExtractor(), callback="parse_object", follow=True),
	
	)

	def parse_object(self,response):
		self.log('ONLY PARSING, NOT SAVING: '+response.url)

	def parse_item(self,response):

		scraped_info = {
			'project_url':self.start_urls[0],
			'page_url':response.url,
			'meta_title':response.xpath('//title/text()').extract(),
			'rel_license':response.css('a[rel=license]::attr(href)').extract_first(),
			'content':response.xpath('//body//p//text()').extract()
		}
		
		#item = LinkscrawlItem()
		#item["link"] = str(response.url)+":"+str(response.status)
		#print(response.status)
		# item["link_res"] = response.status
		# status = response.url
		# item = response.url
		# print(item)
		yield scraped_info
		self.log('++++ SAVED ++++ '+response.url)

