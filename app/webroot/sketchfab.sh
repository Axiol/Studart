#!/bin/bash
 
path=$1
filename=$2
file=${path}${filename}
token_api="089a2fa233194f1d8cacd9b37ed0dae7"
title=$3
 
curl -k -X POST -F "fileModel=@${file}" -F "filenameModel=${filename}" -F "title=${title}" -F "token=${token_api}" https://api.sketchfab.com/v1/models