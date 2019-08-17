# -*- coding: utf-8 -*-

# Define here the models for your scraped items
#
# See documentation in:
# https://doc.scrapy.org/en/latest/topics/items.html

import scrapy


class OerhoernchenscrapyItem(scrapy.Item):
	
    # define the fields for your item here like:
    # name = scrapy.Field()
    project_key = scrapy.Field()
    project_url = scrapy.Field() #or key?
    page_url = scrapy.Field()
    meta_title = scrapy.Field()
    og_title = scrapy.Field()
    meta_keywords = scrapy.Field()
    meta_description = scrapy.Field()
    a_rel_license = scrapy.Field()
    link_rel_license = scrapy.Field()
    link_rel_copyright = scrapy.Field()
    manual_License_override = scrapy.Field() # must be converted in DB import
    content = scrapy.Field()