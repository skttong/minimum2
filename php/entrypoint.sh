#!/bin/bash

# รอจนกว่า MySQL จะพร้อมใช้งาน
until mysql -h db -uuser123 -ppassword123 -e "SELECT 1"; do
  echo "Waiting for MySQL to be ready..."
  sleep 5
done

# แสดงไฟล์ /etc/crontab เพื่อดูว่ามีการตั้งค่าถูกต้องหรือไม่
echo "Current crontab:"
cat /etc/crontab

# ตรวจสอบว่า cron ทำงานอยู่หรือไม่
echo "Starting cron"
cron -f &

# ตรวจสอบว่ามีการรัน cron job
echo "Checking cron jobs"
ps aux | grep cron

# รัน Apache
echo "Starting Apache"
apache2-foreground