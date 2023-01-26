FROM hopnspace/php:latest

# Set PHP configuration
ADD conf/php/php.ini /usr/local/etc/php/

# Set Supervisord configuration
# ADD conf/supervisor/supervisord.conf /etc/supervisor/

# Clear /var/www
RUN rm -R /var/www

# Clone project
#ARG GITLAB_BRANCH
#RUN git clone -b $GITLAB_BRANCH https://deployment:glpat-ProCxh7sxrgzeWiotZY5@gitlab.com/hopnspace/api.hopnspace.io /var/www

# Setup dependencies
#RUN composer install

# Copy existing application directory permissions
#RUN chown -R www-data:www-data /var/www

# Change scheduler.sh permission
#RUN chmod o+x /var/www/bin/scheduler.sh

# Expose port 9000 for php-fpm
EXPOSE 9000

CMD ["/usr/bin/supervisord"]
