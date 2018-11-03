#!/bin/bash
# Add custom commands here. Will run once, on initial script run
function custom_commands() {
	echo "Custom commands is empty"
}

# Add custom commands that should be done on every run
function run_every_time() {
	echo "Run every time is empty"
}

# Maksimer defaults
function maksimer_defaults() {
	wp plugin install "https://github.com/maksimer/maksimer-wordpress-environment/archive/master.zip" --activate
	wp plugin deactivate maksimer-wordpress-environment
	wp plugin delete maksimer-wordpress-environment

	# Install kernl plugin
	wp plugin install "https://github.com/maksimer/kernl-wp-plugin-repository/archive/master.zip" --activate

	# Ask for Kernl API key
	echo -n "Enter kernl api key (https://kernl.us/app/#!/login): [key] "
	read APIKEY
	if [ ! -z "$APIKEY" ]
	then
		wp option update kernl_plugin_repo "{\"authentication\":{\"api_key\":\"$APIKEY\"}}" --format=json
	else
		echo "Skipping Kernl API key update"
	fi
}

# Empty default WordPress content and plugins
function empty_content() {
	# Remove all posts, comments, and terms
	wp site empty --yes

	# Remove plugins and themes
	wp plugin delete hello akismet
	wp theme delete twentyfifteen twentysixteen

	# Remove widgets
	wp widget delete search-2 recent-posts-2 recent-comments-2 archives-2 categories-2 meta-2
}


# Set custom language
function set_language() {
	wp language core install $LANGUAGE --activate
}

# If setup had run before
if [ -f "setup-done.test" ]
then
	# Skip initial setup (things that should be done only once, on initial creation of WordPress)
	echo "Skipping initial setup. It's been done before"

	# Run Run_every_time
	echo -n "Do you want to run the commands in run_every_time? [y/n] "
	read RUN_EVERY_TIME
	if [ "n" = "$RUN_EVERY_TIME" ]
	then
		run_every_time
	else
		echo "Skipping run_every_time commands"
	fi

	# Give some feeling that it´s finished
	echo "Script is done. Shutting down"
	sleep .5s

# If setup has never been run before
else
	echo "Sleeping 5 seconds to wait for WordPress"
	sleep 5s

	# Initial WordPress setup, creating database tables etc.
	wp core install --url=localhost:8000 --title=WordPress --admin_user=admin --admin_password=password --admin_email=email@example.com

	# Run language installation and activation
	echo -n "Do you want to activate another language? [nb_NO / n] "
	read LANGUAGE
	if [ "n" = "$LANGUAGE" ]
	then
		echo "Skipping language"
	else
		set_language
	fi

	# Run removal of akismet, hello, posts, comments and pages
	echo -n "Do you want to remove the default content? [y/n] "
	read EMPTY_CONTENT
	if [ "y" = "$EMPTY_CONTENT" ]
	then
		empty_content
	else
		echo "Skipping removal of default content"
	fi

	# Run Maksimer default commands
	echo -n "Do you want to install Maksimer defaults? [y/n] "
	read MAKSIMER_DEFAULTS
	if [ "y" = "$MAKSIMER_DEFAULTS" ]
	then
		maksimer_defaults
	else
		echo "Skipping Maksimer defaults"
	fi

	# Run custom commands
	echo -n "Do you want to run custom commands? [y/n] "
	read CUSTOM_COMMANDS
	if [ "y" = "$CUSTOM_COMMANDS" ]
	then
		custom_commands
	else
		echo "Skipping custom commands"
	fi

	echo "Script done. This will not run again on this docker instance. To start fresh, run $ npm run docker-delete and then $ npm run docker"

	# Do a final update of core language.
	wp language core update

	# Add file that´s used for a hack to stop this from running again
	touch setup-done.test
fi
