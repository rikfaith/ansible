a:3:{i:0;a:3:{i:0;s:14:"document_start";i:1;a:0:{}i:2;i:0;}i:1;a:3:{i:0;s:12:"preformatted";i:1;a:1:{i:0;s:686:"mdadm -C /dev/md0 /dev/sdb1 /dev/sdc1 -c 128 -n 2 -l 1  
cryptsetup -c aes-cbc-essiv:sha256 -s 128 -h sha256 --align-payload=1024 luksFormat /dev/sdd1
cryptsetup -c aes-cbc-essiv:sha256 -s 128 -h sha256 --align-payload=1024 luksFormat /dev/md0
cryptsetup luksOpen /dev/sdd1 r1
cryptsetup luksOpen /dev/md0 r0

pvcreate --metadatasize 506k /dev/mapper/r0
pvcreate --metadatasize 506k /dev/mapper/r1
vgcreate -s 1g v0 /dev/mapper/r0
vgcreate -s 1g v1 /dev/mapper/r1

lvcreate -L 110g -n vmware v0
lvcreate -L 1t -n backup v1

mke2fs -t ext4 -i1048576 -m0 -E stride=32,stripe-width=128 /dev/mapper/v0-vmware
mke2fs -t ext4 -i1048576 -m0 -E stride=32,stripe-width=128 /dev/mapper/v1-backup ";}i:2;i:0;}i:2;a:3:{i:0;s:12:"document_end";i:1;a:0:{}i:2;i:0;}}