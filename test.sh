#!/bin/bash

#declare an array in bash
declare -a instanceARR

mapfile -t instanceARR < <(aws ec2 run-instances --image-id ami-5189a661 --count 3 --instance-type t2.micro --key-name itmo544-spring-virtualbox --security-group-ids sg-9d36b2f9 --subnet-id subnet-bcd69ed9 --associate-public-ip-address --iam-instance-profile Name=phpdeveloperRole --user-data file://install-webserver.sh --output table | grep InstanceId | sed "s/|//g" | tr -d '' | sed "s/InstanceId//g")
			   

echo ${instanceARR[@]}
aws ec2 wait instance-running --instance-ids ${instanceARR[@]}

echo "instances are running"

ELBURL=('aws elb create-load-balancer --load-balancer-name itmo544-jrh-lb  --listeners Protocol=HTTP,LoadBalancerPort=80,InstanceProtocol=HTTP,InstancePort=80 --subnets subnet-bcd69ed9 --security-groups sg-9d36b2f9 --output=text'); echo $ELBURL

echo -e "\nFinished launching ELB and sleeping 25 seconds"
for i in {0..25}; do echo -ne '.';sleep 1;done
echo "\n"

aws elb register-instances-with-load-balancer --load-balancer-name itmo544-jrh-lb --instances ${instanceARR[@]}

