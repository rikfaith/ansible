#!/bin/sh
#
#
# This program is a wrapper for the HSIM simulator.
#
# The intent is to wrap hsim in order to make it easy to invoke from
# a PHP-based web front-end.
#
# There are three ways to invoke this program:
#
# 	hs_wrap -S <session ID> -i
#	
#		Reads the hsim input file on stdin and saves it away.
#
#	hs_wrap -S <session ID> -r
#
#		Generates the hsim report in HTML format on stdout.
#
#	hs_wrap -S <session ID> -e
#
#		Generates the hsim error report in HTML format on stdout.
#
#	hs_wrap -S <session ID> -R
#
#		writes the path name to the 'RSE' file on stdout.
#
#	hs_wrap -X
#
#		called periodically, this deletes old files from
#		old sessions.  Anything older than 1 week is deleted.
#


#
# Some constants
#
WORKDIR="../sim_temp"
HSIM="/www/hybridsky.com/support/hsim.sh"
REPORT="/www/hybridsky.com/support/report.sh"
DAYS=2

#
# These functions do the work.
#
function usage() {
	cat <<EOF 1>&2
Usage:	$0 -S <session ID> -i
		read the hsim input file on stdin
	$0 -S <session ID> -r
		write the hsi report (in html) on stdout
	$0 -S <session ID> -R
		write the pathname to the RSE file on stdou
	$0 -X
		cleanup old files
EOF
	exit 1
}

function cleanup() {
	dir=${WORKDIR}
	if [ ! -d ${dir} ] ; then
		echo $0: could not find working directory ${dir} 1>&2
		exit 1
	fi
	minutes=`expr ${DAYS} \* 1440`
	find ${dir} -mindepth 1 -daystart -cmin +${minutes} -delete 2>&1
}

#
# Create the session directory
# and load the input file into it.
#

function input() {
	dir=${WORKDIR}/${SESSION}
	if [ -d ${dir} ] ; then
		rm -f ${dir}/*
	else
		mkdir ${dir}
	fi
	if [ $? -ne 0 ] ; then
		echo $0: Could not create session directory ${dir} 1>&2
		exit 1
	fi

	cat > ${dir}/hsim_input

	(
		${HSIM} -N exec < ${dir}/hsim_input |
		${REPORT} -H > ${dir}/hsim_report -r ${dir}/hsim.rse
	) 2> ${dir}/hsim_errors

}

function report() {
	dir=${WORKDIR}/${SESSION}
	if [ ! -d ${dir} ] ; then
		echo $0: could not find session directory ${dir} 1>&2
		exit 1
	fi
	cat ${dir}/hsim_report
}

function report_errors() {
	dir=${WORKDIR}/${SESSION}
	if [ ! -d ${dir} ] ; then
		echo $0: could not find session directory ${dir} 1>&2
		exit 1
	fi
	cat ${dir}/hsim_errors | sed -e 's/^[^:]*; *//' | grep -v 'No input'
}
	

function rocksim() {
	dir=${WORKDIR}/${SESSION}
	if [ ! -d ${dir} ] ; then
		echo $0: could not find session directory ${dir} 1>&2
		exit 1
	fi
	echo ${dir}/hsim.rse
}


#
# Figure out what mode we are in and validate all command line arguments
#

if [ x$1 = 'x-X' ] ; then
	if [ $# -ne 1 ] ; then
		usage
	fi
	cleanup
elif [ x$1 != 'x-S' ] ; then
	usage
elif [ $# -ne 3 ] ; then
	usage
else
	SESSION=$2
	case $3 in
	-i) input;;
	-r) report;;
	-e) report_errors;;
	-R) rocksim;;
	*) usage;;
	esac
fi
