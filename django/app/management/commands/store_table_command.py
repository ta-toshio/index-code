import os
import re
import sqlparse
from ddlparse import DdlParse

from django.core.management.base import BaseCommand

from app.models.field import Field
from app.models.project import Project
from app.models.table import Table
from config.settings import BASE_DIR


class Command(BaseCommand):
    help = ""

    def add_arguments(self, parser):
        parser.add_argument('-r', '--resource', required=True, default='', type=str)
        parser.add_argument('-f', '--file', required=True, default='', type=str)

    def handle(self, *args, **options):
        resource = options['resource']
        file = options['file']

        project = Project.objects.filter(name=resource).first()
        if not project:
            self.stdout.write('Could not find project name: {}'.format(resource))
            return

        resource_dir = os.path.join(BASE_DIR, 'app/resources/sql/')

        files = []
        with open(resource_dir + file) as fp:
            for cnt, line in enumerate(fp):
                # print("Line {}: {}".format(cnt, line))
                if not re.match(r'^#', line):
                    files.append(line)

        sql = "".join(files)

        ddls = sqlparse.split(sql)
        tmp_tables_regex = re.compile("CREATE TABLE.*.*\(")
        for ddl in ddls:
            if tmp_tables_regex.search(ddl):
                parser = DdlParse(ddl=ddl, source_database=DdlParse.DATABASE.mysql)
                table = parser.parse()

                print("table_name: %s"%table.name)
                table_model = Table.upsert(project=project, name=table.name)
                # table_model = Table.objects.get(pk=table_model.id)

                for column in table.columns.values():
                    print("     column_name: %s, data_type: %s"%(column.name, column.data_type))
                    Field.upsert(table=table_model, table_name=table.name, field_name=column.name, field_type=column.data_type)

