
#! /bin/bash

while getopts "p:" opt; do
	case ${opt} in
		p )
			PROJECT_DIR=${OPTARG}
			;;
	esac
done

# Establish symbolic links for the following directories:
# the media folder
rm -rf media
ln -s ../environment/${PROJECT_DIR}/media media
# the data folder
rm -rf data
ln -s ../environment/${PROJECT_DIR}/data data
