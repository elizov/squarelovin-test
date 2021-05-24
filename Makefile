export UID  = $(shell id -u)
export GID  = $(shell id -g)
export USER = $(shell id -un)
export ARCH	= $(shell uname -p)

-include .env

.PHONY: help
help:
	@echo 'Usage: make [COMMAND]'
	@echo ''
	@cat ./make/* | sed -n 's/^##//p' | column -t -s ':' |  sed -e 's/^/ /'

include ./make/*
