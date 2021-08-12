from django.db import models

class Table(models.Model):

    project_id = models.BigIntegerField()
    name = models.CharField(max_length=255)
    created_at = models.DateTimeField()
    updated_at = models.DateTimeField()

    class Meta:
        db_table = "tables"
