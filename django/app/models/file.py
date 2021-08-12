from django.db import models

from app.models.project import Project


class File(models.Model):

    project = models.ForeignKey(Project, on_delete=models.CASCADE, db_index=True)
    name = models.CharField(max_length=255)
    file_path = models.CharField(max_length=255)
    path = models.CharField(max_length=255)
    body = models.TextField()
    extension = models.CharField(max_length=255)
    description = models.TextField()
    parent_id = models.IntegerField()
    is_dir = models.BooleanField()
    depth = models.SmallIntegerField()
    created_at = models.DateTimeField(auto_now_add=True)
    updated_at = models.DateTimeField(auto_now=True)

    class Meta:
        db_table = "files"
