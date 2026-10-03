#!/bin/sh
# drive-prices2.sh -- 
# Created: Mon Jun 16 20:46:54 2008 by faith@acm.org
# Revised: Wed Sep 28 13:31:16 2011 by faith@netapp.com
# Copyright 2008, 2011 Rickard E. Faith (faith@netapp.com)
# This program comes with ABSOLUTELY NO WARRANTY.
# 
# $Id$
# 
#

plot=/tmp/gnuplot.$$
cat > $plot <<EOF
set terminal png enhanced size 800,600 small
set output "drive-prices.png"
set xdata time
set timefmt "%Y-%m"
set ylabel "Dollars per GB"
set xlabel "Date"
set grid
set logscale y
set yrange [0.01:10000]
set format x "%Y"
set title "Cost per GB for Consumer Storage\n(DRAM, HDD, SSD)"
plot \
     "ram-prices" using 1:(\$3/(\$2/1000.0)) title "DRAM Cost", \
     "ram-prices" using 1:(\$3/(\$2/1000.0)) with lines smooth bezier notitle, \
     "drive-prices" using 1:(\$3/\$2) title "HDD Cost", \
     "drive-prices" using 1:(\$3/\$2) with lines smooth bezier notitle, \
     "ssd-prices" using 1:(\$3/\$2) title "SSD Cost", \
     "ssd-prices" using 1:(\$3/\$2) with lines smooth bezier notitle
EOF
gnuplot < $plot
