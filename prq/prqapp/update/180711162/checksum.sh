#!/bin/bash
rm nochecked.txt
md5sum buildfiles.txt>checksum.txt
mkdir deploy