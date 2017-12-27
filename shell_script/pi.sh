#!/bin/bash

mysql  iot -proot -s -N -se" update GPIO set IsFree = 1"; 


mysql  iot -proot -s -N -se" truncate table Device ";




