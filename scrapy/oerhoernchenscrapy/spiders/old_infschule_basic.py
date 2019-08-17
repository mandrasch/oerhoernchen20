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
	name = 'infschule-basic'
	allowed_domains = ['www.inf-schule.de']
	start_urls = ['http://www.inf-schule.de/']

	rules = (
        # follow all links and parse them
		Rule(LinkExtractor(), callback="parse_item", follow=True),
	
	)

	def parse_item(self,response):

		scraped_info = {
			'project_key':self.name,
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

