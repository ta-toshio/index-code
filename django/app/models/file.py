from django.db import models

class File(models.Model):

    project_id = models.BigIntegerField()
    name = models.CharField(max_length=255)
    file_path = models.CharField(max_length=255)
    path = models.CharField(max_length=255)
    body = models.TextField()
    extension = models.CharField(max_length=255)
    description = models.TextField()
    parent_id = models.IntegerField()
    is_dir = models.BooleanField()
    depth = models.SmallIntegerField()
    created_at = models.DateTimeField()
    updated_at = models.DateTimeField()

    class Meta:
        db_table = "files"
