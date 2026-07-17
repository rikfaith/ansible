#!/bin/bash
# build-nvtop.sh -*-ksh-*-

cd ~/git
rm -rf nvtop
git clone https://github.com/Syllo/nvtop.git
cd nvtop
mkdir -p build
cd build
sudo apt-get -y install libncurses5-dev libncursesw5-dev libsystemd-dev libudev-dev libdrm-dev
cmake .. \
      -DNVIDIA_SUPPORT=ON \
      -DAMDGPU_SUPPORT=OFF \
      -DINTEL_SUPPORT=OFF \
      -DV3D_SUPPORT=OFF \
      -DMSM_SUPPORT=OFF \
      -DPANFROST_SUPPORT=OFF \
      -DPANTHOR_SUPPORT=OFF \
      -DMETAX_SUPPORT=OFF
make
sudo make install
