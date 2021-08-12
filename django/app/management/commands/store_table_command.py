import os
import re
import sqlparse
from ddlparse import DdlParse

from django.core.management.base import BaseCommand
from config.settings import BASE_DIR


class Command(BaseCommand):
    help = ""

    def handle(self, *args, **options):
        resource_dir = os.path.join(BASE_DIR, 'app/resources/')

        files = []
        with open(resource_dir + 'sample.sql') as fp:
            for cnt, line in enumerate(fp):
                # print("Line {}: {}".format(cnt, line))
                if not re.match(r'^#', line):
                    files.append(line)

        sql = "".join(files)

        ddls = sqlparse.split(sql)
        tmp_tables_regex = re.compile("CREATE TABLE.*.*\(")
        for ddl in ddls:
            if(tmp_tables_regex.search(ddl)):
                parser = DdlParse(ddl=ddl, source_database=DdlParse.DATABASE.mysql)
                table = parser.parse()
                print("table_name: %s"%table.name)
                for column in table.columns.values():
                    print("     column_name: %s, data_type: %s"%(column.name, column.data_type))

