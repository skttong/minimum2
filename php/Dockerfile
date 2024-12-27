FROM php:8.0-apache

# ติดตั้ง mysqli, cron และ MySQL client
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli \
    && apt-get update && apt-get upgrade -y \
    && apt-get install -y cron vim default-mysql-client \
    && mysqladmin --version  # เพิ่มการตรวจสอบที่นี่

# ติดตั้ง mod_ssl สำหรับ Apache
RUN a2enmod ssl

# คัดลอกไฟล์ SSL certificate และคีย์ไปยัง container
COPY ./certs/Certificate.crt /etc/ssl/certs/
COPY ./certs/star_dmh_go_th.crt /etc/ssl/certs/
COPY ./certs/IntermediateCA.crt /etc/ssl/certs/
COPY ./certs/DigiCertCA.crt /etc/ssl/certs/
COPY ./certs/PrivateKey.key /etc/ssl/private/
COPY ./certs/certificate.pem /etc/ssl/certs/
COPY ./certs/TrustedRoot.crt /etc/ssl/certs/

# สร้าง directory สำหรับ backup และ log
RUN mkdir -p /backup && touch /var/log/cron.log && touch /backup/cron_error.log

# สร้างไฟล์สำหรับ Cron job
RUN echo "0 0 * * * root echo 'Cron is working' >> /var/log/cron_test.log" >> /etc/crontab && \
    echo "0 0 * * * root mysqldump --no-tablespaces -h db -uuser123 -ppassword123 db_minimum > /backup/db_backup_\$(date +\%F_\%T).sql 2>> /backup/cron_error.log" >> /etc/crontab && \
    echo "0 2 * * * root php /var/www/html/HDC1.php >> /var/log/cron.log 2>&1" >> /etc/crontab && \
    echo "10 2 * * * root php /var/www/html/HDC2.php >> /var/log/cron.log 2>&1" >> /etc/crontab && \
    echo "20 2 * * * root php /var/www/html/HDC3.php >> /var/log/cron.log 2>&1" >> /etc/crontab && \
    echo "30 2 * * * root php /var/www/html/HDC4.php >> /var/log/cron.log 2>&1" >> /etc/crontab && \
    echo "40 2 * * * root php /var/www/html/HDC5.php >> /var/log/cron.log 2>&1" >> /etc/crontab && \
    echo "50 2 * * * root php /var/www/html/HDC6.php >> /var/log/cron.log 2>&1" >> /etc/crontab && \
    echo "0 3 * * * root php /var/www/html/HDC7.php >> /var/log/cron.log 2>&1" >> /etc/crontab && \
    echo "10 3 * * * root php /var/www/html/HDC8.php >> /var/log/cron.log 2>&1" >> /etc/crontab && \
    echo "20 3 * * * root php /var/www/html/HDC9.php >> /var/log/cron.log 2>&1" >> /etc/crontab && \
    echo "30 3 * * * root php /var/www/html/HDC10.php >> /var/log/cron.log 2>&1" >> /etc/crontab && \
    echo "40 3 * * * root php /var/www/html/HDC11.php >> /var/log/cron.log 2>&1" >> /etc/crontab && \
    echo "50 3 * * * root php /var/www/html/HDC12.php >> /var/log/cron.log 2>&1" >> /etc/crontab && \
    echo "0 4 * * * root php /var/www/html/HDC13.php >> /var/log/cron.log 2>&1" >> /etc/crontab && \
    echo "10 4 * * * root php /var/www/html/HDC14.php >> /var/log/cron.log 2>&1" >> /etc/crontab && \
    echo "20 4 * * * root php /var/www/html/HDC15.php >> /var/log/cron.log 2>&1" >> /etc/crontab && \
    echo "30 4 * * * root php /var/www/html/HDC16.php >> /var/log/cron.log 2>&1" >> /etc/crontab && \
    echo "40 4 * * * root php /var/www/html/HDC17.php >> /var/log/cron.log 2>&1" >> /etc/crontab && \
    echo "50 4 * * * root php /var/www/html/HDC18.php >> /var/log/cron.log 2>&1" >> /etc/crontab && \
    echo "0 5 * * * root php /var/www/html/HDC19.php >> /var/log/cron.log 2>&1" >> /etc/crontab && \
    echo "10 5 * * * root php /var/www/html/HDC20.php >> /var/log/cron.log 2>&1" >> /etc/crontab && \
    echo "20 5 * * * root php /var/www/html/HDC21.php >> /var/log/cron.log 2>&1" >> /etc/crontab && \
    echo "30 5 * * * root php /var/www/html/HDC22.php >> /var/log/cron.log 2>&1" >> /etc/crontab && \
    echo "40 5 * * * root php /var/www/html/HDC23.php >> /var/log/cron.log 2>&1" >> /etc/crontab && \
    echo "50 5 * * * root php /var/www/html/CMSreports.php >> /var/log/cron.log 2>&1" >> /etc/crontab


# คัดลอกไฟล์การตั้งค่า Apache สำหรับ SSL
COPY ./ssl/000-default.conf /etc/apache2/sites-available/


# เปิดพอร์ต 443 สำหรับ HTTPS
EXPOSE 443

# เพิ่ม entrypoint script เพื่อให้แน่ใจว่า MySQL พร้อมใช้งานก่อนที่จะรัน cron
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# ใช้ entrypoint script เป็น default command
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]