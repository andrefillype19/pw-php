# Generated by Django 3.1.8 on 2024-09-02 00:03

from django.db import migrations


class Migration(migrations.Migration):

    dependencies = [
        ('myapp', '0004_feedback_user'),
    ]

    operations = [
        migrations.AlterModelOptions(
            name='feedback',
            options={'managed': True, 'permissions': [('change_only_yours', 'Pode mudar apenas seus dados de Feedback')]},
        ),
    ]