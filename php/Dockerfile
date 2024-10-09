FROM php:8.0-apache

# ติดตั้ง mysqli, cron และ MySQL client
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli \
    && apt-get update && apt-get upgrade -y \
    && apt-get install -y cron vim default-mysql-client \
    && mysqladmin --version  # เพิ่มการตรวจสอบที่นี่

# สร้าง directory สำหรับ backup และ log
RUN mkdir -p /backup && touch /var/log/cron.log && touch /backup/cron_error.log

# สร้างไฟล์สำหรับ Cron job
RUN echo "0 0 * * * root echo 'Cron is working' >> /var/log/cron_test.log" >> /etc/crontab && \
    echo "0 0 * * * root mysqldump --no-tablespaces -h db -uuser123 -ppassword123 db_minimum > /backup/db_backup_\$(date +\%F_\%T).sql 2>> /backup/cron_error.log" >> /etc/crontab && \
    echo "0 8 * * * root php /var/www/html/HDC1.php >> /var/log/cron.log 2>&1" >> /etc/crontab && \
    echo "0 8 * * * root php /var/www/html/HDC2.php >> /var/log/cron.log 2>&1" >> /etc/crontab && \
    echo "0 8 * * * root php /var/www/html/HDC3.php >> /var/log/cron.log 2>&1" >> /etc/crontab && \
    echo "0 8 * * * root php /var/www/html/HDC4.php >> /var/log/cron.log 2>&1" >> /etc/crontab && \
    echo "0 8 * * * root php /var/www/html/HDC5.php >> /var/log/cron.log 2>&1" >> /etc/crontab && \
    echo "0 8 * * * root php /var/www/html/HDC6.php >> /var/log/cron.log 2>&1" >> /etc/crontab && \
    echo "0 8 * * * root php /var/www/html/HDC7.php >> /var/log/cron.log 2>&1" >> /etc/crontab && \
    echo "0 8 * * * root php /var/www/html/HDC8.php >> /var/log/cron.log 2>&1" >> /etc/crontab && \
    echo "0 8 * * * root php /var/www/html/HDC9.php >> /var/log/cron.log 2>&1" >> /etc/crontab && \
    echo "0 8 * * * root php /var/www/html/HDC10.php >> /var/log/cron.log 2>&1" >> /etc/crontab && \
    echo "0 8 * * * root php /var/www/html/HDC11.php >> /var/log/cron.log 2>&1" >> /etc/crontab && \
    echo "0 8 * * * root php /var/www/html/HDC12.php >> /var/log/cron.log 2>&1" >> /etc/crontab && \
    echo "0 8 * * * root php /var/www/html/HDC13.php >> /var/log/cron.log 2>&1" >> /etc/crontab && \
    echo "0 8 * * * root php /var/www/html/HDC14.php >> /var/log/cron.log 2>&1" >> /etc/crontab && \
    echo "0 8 * * * root php /var/www/html/HDC15.php >> /var/log/cron.log 2>&1" >> /etc/crontab && \
    echo "0 8 * * * root php /var/www/html/HDC16.php >> /var/log/cron.log 2>&1" >> /etc/crontab && \
    echo "0 8 * * * root php /var/www/html/HDC17.php >> /var/log/cron.log 2>&1" >> /etc/crontab && \
    echo "0 8 * * * root php /var/www/html/HDC18.php >> /var/log/cron.log 2>&1" >> /etc/crontab && \
    echo "0 8 * * * root php /var/www/html/HDC19.php >> /var/log/cron.log 2>&1" >> /etc/crontab && \
    echo "0 8 * * * root php /var/www/html/HDC20.php >> /var/log/cron.log 2>&1" >> /etc/crontab && \
    echo "0 8 * * * root php /var/www/html/HDC21.php >> /var/log/cron.log 2>&1" >> /etc/crontab && \
    echo "0 8 * * * root php /var/www/html/CMSreports.php >> /var/log/cron.log 2>&1" >> /etc/crontab


# เพิ่ม entrypoint script เพื่อให้แน่ใจว่า MySQL พร้อมใช้งานก่อนที่จะรัน cron
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# ใช้ entrypoint script เป็น default command
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]