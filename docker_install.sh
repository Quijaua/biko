#!/bin/sh
docker build -t biko_docker . && docker run -p "8000:80" biko_docker
