#!/bin/bash

aws autoscaling create-launch-configuration --launch-configuration-name inmp1-2-lc --image-id ami-5189a661 --key-name itmo544-spring-virtualbox  --security-groups sg-9d36b2f9 --instance-type t2.micro --user-data file://itmo-544-444-mp1/install-webserver.sh --iam-instance-profile phpdeveloperRole

aws autoscaling create-auto-scaling-group --auto-scaling-group-name sg-9d36b2f9 --launch-configuration-name inmp1-2-lc --load-balancer-names itmo544jrh-lb  --health-check-type ELB --min-size 1 --max-size 3 --desired-capacity 2 --default-cooldown 600 --health-check-grace-period 120 --vpc-zone-identifier subnet-c6a6f1a3 
