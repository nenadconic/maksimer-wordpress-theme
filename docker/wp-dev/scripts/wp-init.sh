#!/bin/bash
set -euo pipefail

# mute CMD from official wordpress image
sed -i -e 's/^exec "$@"/#exec "$@"/g' /usr/local/bin/docker-entrypoint.sh

# execute bash script from official wordpress image
source /usr/local/bin/docker-entrypoint.sh

# I would do my thing here, but this ain't working

# execute CMD
exec "$@"
