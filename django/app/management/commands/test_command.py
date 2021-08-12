from django.core.management.base import BaseCommand
from app.models.file import File

class Command(BaseCommand):
    help = ""

    def handle(self, *args, **options):
        files = File.objects.first()
        print(files.__dict__)

