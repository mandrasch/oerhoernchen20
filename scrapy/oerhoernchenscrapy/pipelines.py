# -*- coding: utf-8 -*-

# Define your item pipelines here
#
# Don't forget to add your pipeline to the ITEM_PIPELINES setting
# See: https://doc.scrapy.org/en/latest/topics/item-pipeline.html


class OerhoernchenscrapyPipeline(object):
    def process_item(self, item, spider):
        return item

import json


class JsonWriterPipeline(object):
    def open_spider(self, spider):
        self.file = open('scraped_items.json', 'w')
        # Your scraped items will be saved in the file 'scraped_items.json'.
        # You can change the filename to whatever you want.
        self.file.write("[")

    def close_spider(self, spider):
        self.file.write("]")
        self.file.close()

    def process_item(self, item, spider):
        line = json.dumps(
            dict(item),
            indent = 4,
            sort_keys = True,
            separators = (',', ': ')
        ) + ",\n"
        self.file.write(line)

        return item
