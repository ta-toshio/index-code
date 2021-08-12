from django.db import models

class Field(models.Model):

    table_id = models.BigIntegerField()
    table_name = models.CharField(max_length=255)
    field_name = models.CharField(max_length=255)
    field_type = models.CharField(max_length=255)
    field_param = models.CharField(max_length=255)
    created_at = models.DateTimeField()
    updated_at = models.DateTimeField()

    class Meta:
        db_table = "fields"
