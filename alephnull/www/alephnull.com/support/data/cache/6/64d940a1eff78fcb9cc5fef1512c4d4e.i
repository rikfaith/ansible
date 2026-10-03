a:15:{i:0;a:3:{i:0;s:14:"document_start";i:1;a:0:{}i:2;i:0;}i:1;a:3:{i:0;s:6:"p_open";i:1;a:0:{}i:2;i:0;}i:2;a:3:{i:0;s:7:"p_close";i:1;a:0:{}i:2;i:1;}i:3;a:3:{i:0;s:12:"section_edit";i:1;a:4:{i:0;i:-1;i:1;i:0;i:2;i:1;i:3;s:0:"";}i:2;i:1;}i:4;a:3:{i:0;s:6:"header";i:1;a:3:{i:0;s:3:"Pan";i:1;i:1;i:2;i:1;}i:2;i:1;}i:5;a:3:{i:0;s:12:"section_open";i:1;a:1:{i:0;i:1;}i:2;i:1;}i:6;a:3:{i:0;s:13:"section_close";i:1;a:0:{}i:2;i:20;}i:7;a:3:{i:0;s:12:"section_edit";i:1;a:4:{i:0;i:1;i:1;i:19;i:2;i:1;i:3;s:3:"Pan";}i:2;i:20;}i:8;a:3:{i:0;s:6:"header";i:1;a:3:{i:0;s:18:"Packages Installed";i:1;i:2;i:2;i:20;}i:2;i:20;}i:9;a:3:{i:0;s:12:"section_open";i:1;a:1:{i:0;i:2;}i:2;i:20;}i:10;a:3:{i:0;s:12:"preformatted";i:1;a:1:{i:0;s:515:"apt-get install lftp
apt-get install smartmontools
apt-get install ntp
apt-get install sysstat
badblocks -b 4096 -s -v -w -t random /dev/sdb1
apt-get install mdadm
apt-get install cryptsetup
apt-get install lvm2
cryptsetup -c aes-cbc-essiv:sha256
           -s 128 -h sha256
           --align-payload=1024
           luksFormat /dev/sdb1
cryptsetup luksOpen /dev/sdb1 r0
pvcreate --metadatasize 506k /dev/mapper/r0
vgcreate -s 1g v0 /dev/mapper/r0
lvcreate -L 100g -n home v0
mke2fs -t ext4 -m0 /dev/mapper/v0-home";}i:2;i:50;}i:11;a:3:{i:0;s:12:"preformatted";i:1;a:1:{i:0;s:66:"apt-get install bind9
apt-get install rng-tools
Edit /etc/rc.local";}i:2;i:601;}i:12;a:3:{i:0;s:13:"section_close";i:1;a:0:{}i:2;i:601;}i:13;a:3:{i:0;s:12:"section_edit";i:1;a:4:{i:0;i:20;i:1;i:0;i:2;i:2;i:3;s:18:"Packages Installed";}i:2;i:601;}i:14;a:3:{i:0;s:12:"document_end";i:1;a:0:{}i:2;i:601;}}