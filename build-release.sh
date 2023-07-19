#!/bin/bash

# Print commands to the screen
# set -x

# Catch Errors
set -euo pipefail

if [ $# -eq 0 ]
then
  echo "No arguments supplied. Please pass in a release message, such as \"Release 1.0.2\""
  exit
fi

# Delete the release folder
rm -rf release

# Clone the built repo
git clone git@github.com:petenelson/hello-bruce-campbell-built.git ./release

# Run any build scripts here, which are zero

# Copy the necessary files to the release
cp readme.txt release/
cp *.php release/
cp -R assets release/

# Commit the built release to the repo
cd release
git add --all
git commit -m "$1"

# Push the built release to the repo
git push origin head
