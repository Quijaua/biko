#!/bin/sh
docker build -t biko_docker . && docker run --name biko_app -p "8000:80" biko_docker
