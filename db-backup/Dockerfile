FROM ubuntu:latest

# ติดตั้ง MySQL client, cron และ bash
RUN apt-get update && apt-get install -y mysql-client cron bash

# สร้างไดเรกทอรีสำหรับ backup
RUN mkdir -p /backup && chmod 777 /backup

# สร้าง crontab
COPY crontab.txt /etc/cron.d/db-backup-cron

# ตั้ง permission ให้กับ crontab
RUN chmod 0644 /etc/cron.d/db-backup-cron

# ตั้งค่า cron job
RUN crontab /etc/cron.d/db-backup-cron

# เริ่ม cron daemon
CMD ["cron", "-f"]
