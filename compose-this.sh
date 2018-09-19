#!/bin/bash
if [ -f "first-run.done" ]
then

	if [ -f "setup-done.test" ]
	then

		# Skip initial setup (things that should be done only once, on initial creation of WordPress)
		echo "Skipping initial setup. It's been done before"

		# Add something that should be done on every docker-compose up (npm run docker)
		# wp plugin list

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
		echo -n "Do you want to activate another language? [nb_NO / n] "
		read LANGUAGE

		if [ "n" = "$LANGUAGE" ]
		then
			echo 'Skipping language'
		else
			wp language core install $LANGUAGE
			wp language core activate $LANGUAGE
			wp language core update
		fi

		echo -n "Do you want to remove the default content? [y/n] "
		read EMPTY_CONTENT

		if [ "y" = "$EMPTY_CONTENT" ]
		then
			# Remove all posts, comments, and terms
			wp site empty --yes

			# Remove plugins and themes
			wp plugin delete hello akismet
			wp theme delete twentyfifteen twentysixteen

			# Remove widgets
			wp widget delete search-2 recent-posts-2 recent-comments-2 archives-2 categories-2 meta-2
		fi


		wp theme activate maksimer

		echo -n "Do you want to install maksimer defaults? [y/n] "
		read MAKSIMER_DEFAULTS

		if [ "y" = "$MAKSIMER_DEFAULTS" ]
		then
			wp plugin install "https://github.com/maksimer/kernl-wp-plugin-repository/archive/master.zip" --activate
			echo -n "Enter kernl api key: [key] "
			read APIKEY

			if [ ! -z "$APIKEY" ]
			then
				wp option update kernl_plugin_repo "{\"authentication\":{\"api_key\":\"$APIKEY\"}}" --format=json
			fi
		fi





		# Add file that´s used for a hack to stop this from running again
		touch setup-done.test

	fi

else

	touch first-run.done
	echo "Docker setup finished. To do further setup, run: $ npm run docker-script"

fi
