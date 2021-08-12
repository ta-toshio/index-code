from django.db import models

from app.models.project import Project


class Table(models.Model):

    project = models.ForeignKey(Project, on_delete=models.CASCADE, db_index=True)
    name = models.CharField(max_length=255)
    created_at = models.DateTimeField(auto_now_add=True)
    updated_at = models.DateTimeField(auto_now=True)

    @staticmethod
    def upsert(project, name):
        table = Table.objects.filter(
            project=project,
            name=name
        ).first()

        if not table:
            table = Table(
                project=project,
                name=name
            )

        table.save()

        return table

    class Meta:
        db_table = "tables"
