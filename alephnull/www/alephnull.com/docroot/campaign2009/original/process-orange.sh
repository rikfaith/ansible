#!/bin/sh
# process.sh -- 
# Created: Wed Apr 15 21:31:22 2009 by faith@acm.org
# Revised: Wed Sep 23 16:26:38 2009 by faith@acm.org
# Copyright 2009 Rickard E. Faith (faith@acm.org)
# This program comes with ABSOLUTELY NO WARRANTY.
# 
# $Id$
#

for i in "CARRBORO" "DAMASCUS" "HOGAN FARMS" "LIONS CLUB" "NORTH CARRBORO" "OWASA" "ST JOHN" "TOWN HALL"; do
    echo "Processing $i"
    filename=list-`echo $i | sed 's, ,,' | tr 'A-Z' 'a-z'`
    grep "\"$i\"$" target \
        | csvtool col 1,9,10 - \
        | sort \
        | uniq \
        | sed 's,  , ,g' \
        | sed 's,  , ,g' \
        | sed 's/,F,/,Z,/' \
        | sed 's,P\.O\.BOX,PO BOX,' \
        | sed 's,P\. O\. BOX,PO BOX,' \
        | sed 's,P O BOX,PO BOX,' \
        | sed 's/"\(.*\), \(.*\) III"/\2 \1 III/' \
        | sed 's/"\(.*\), \(.*\) II"/\2 \1 II/' \
        | sed 's/"\(.*\), \(.*\) IV"/\2 \1 IV/' \
        | sed 's/"\(.*\), \(.*\) JR"/\2 \1 JR/' \
        | sed 's/"\(.*\), \(.*\) SR"/\2 \1 SR/' \
        | sed 's/"\(.*\), \(.*\)"/\2 \1/' \
        | tr 'A-Z' 'a-z' \
        | sed 's,\([ ,]\)\([a-z]\),\1\u\2,g' \
        | sed 's,\([a-z0-9]\)-\([a-z]\),\1-\u\2,g' \
        | sed 's,^\([a-z]\),\u\1,' \
        | sed 's,#\([a-z]\),#\u\1,' \
        | sed "s, O'\([a-z]\), O'\u\1," \
        | sed "s, D'\([a-z]\), D'\u\1," \
        | sed "s, Mc\([a-z]\), Mc\u\1," \
        | sed 's, Nc , NC ,' \
        | sed 's,Po Box,PO Box,' \
        | sed 's/Iii,/III,/' \
        | sed 's/Ii,/II,/' \
        | sed 's/Iv,/IV,/' \
        | sed 's,  , ,g' \
        | sed 's,  , ,g' \
        > $filename.csv
        glabels-batch -i $filename.csv -o $filename.pdf test.glabels
done
