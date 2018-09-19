#!/bin/bash
if [ -f "setup-done.test" ]
then

	# Skip initial setup (things that should be done only once, on initial creation of WordPress)
	echo "Skipping initial setup. It's been done before"

	# Add something that should be done on every docker-compose up (npm run docker)
	wp theme activate twentyseventeen
	wp plugin list

	# Give some feeling that it´s finished
	echo "Script is done. Shutting down"
	sleep .5s

else

	# Sleep for 15 seconds to wait for WordPress to run (hopefully)
	echo "Sleeping for 10 seconds"
	sleep 10s


	# Do some wp-cli stuff

	# Initial WordPress setup, creating database tables etc.
	wp core install --url=localhost:8000 --title=WordPress --admin_user=admin --admin_password=password --admin_email=email@example.com

	# Language
	# wp language core install nb_NO
	# wp language core activate nb_NO
	# wp language core update

	wp comment delete $(wp comment list --format=ids) --force
	wp post delete $(wp post list --format=ids) --force
	wp post delete $(wp post list --post_type=page --format=ids)

	wp theme delete twentyfifteen twentyseventeen twentysixteen
	wp theme activate maksimer

	wp plugin uninstall hello
	wp plugin uninstall akismet
	wp plugin install "https://github.com/maksimer/kernl-wp-plugin-repository/archive/master.zip" --activate


	# Add file that´s used for a hack to stop this from running again
	touch setup-done.test

fi
