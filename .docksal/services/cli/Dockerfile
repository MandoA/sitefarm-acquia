# Use a stock Docksal image as the base
FROM docksal/cli:2.2-php7.1

# Install addtional pecl packages
RUN pecl -q install apcu > /dev/null 2>&1
