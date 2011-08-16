#!/bin/bash
set -x
set -e

echo "Downloading Yii Framework 1.1.8"

# Create the lib directory if it doesn't exist already
if [ ! -d "protected/lib" ]; then
	mkdir -p protected/lib
fi

# Create the runtime directory if it doesn't exist already and make sure it's writeable
if [ ! -d "protected/runtime" ]; then
	mkdir -p protected/runtime
	chmod 777 protected/runtime
fi

# Create the assets directory if it doesn't exist already and make sure it's writeable
if [ ! -d "" ]; then
	mkdir -p assets
	chmod 777 assets
fi

cd protected/lib
svn export http://yii.googlecode.com/svn/tags/1.1.8/framework yii
