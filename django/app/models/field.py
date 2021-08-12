from django.db import models

from app.models.table import Table


class Field(models.Model):

    table = models.ForeignKey(Table, on_delete=models.CASCADE, db_index=True)
    table_name = models.CharField(max_length=255)
    field_name = models.CharField(max_length=255)
    field_type = models.CharField(max_length=255)
    field_param = models.CharField(max_length=255)
    created_at = models.DateTimeField(auto_now_add=True)
    updated_at = models.DateTimeField(auto_now=True)

    @staticmethod
    def upsert(table, table_name, field_name, field_type, field_param=''):
        field = Field.objects.filter(
            table=table,
            field_name=field_name
        ).first()

        if not field:
            field = Field(
                table=table,
                field_name=field_name
            )

        field.table_name = table_name
        field.field_type = field_type
        field.field_param = field_param if field_param else ''

        field.save()

        return field

    class Meta:
        db_table = "fields"
