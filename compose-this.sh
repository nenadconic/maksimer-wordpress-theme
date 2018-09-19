#!/bin/bash
# Sleep for 15 seconds to wait for WordPress to run (hopefully)
echo "Sleeping for 10 seconds"
sleep 10s

if [ -f "setup-done.test" ]
then
	echo "Skipping initial setup. It's been done before"
else
# Do some wp-cli stuff
wp core install --url=localhost:8000 --title=KimKong --admin_user=admin --admin_password=password --admin_email=email@example.com
wp theme install twentyten
touch setup-done.test
fi

echo "Shutting down"
sleep 5s
