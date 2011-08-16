#!/bin/bash
set -x
set -e

echo "Downloading Yii Framework 1.1.8"
cd protected/lib
svn export http://yii.googlecode.com/svn/tags/1.1.8/framework yii
