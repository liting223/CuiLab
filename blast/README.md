# ViroBLAST Standalone Web Server

## Introduction

This standalone ViroBLAST server suite of programs was
designed to be similar to the NCBI BLAST server and
command-line NCBI C++ Toolkit BLAST applications referred as
the BLAST+ applications. It incorporates most
features that exist in NCBI BLAST+ program, and adds new
features to extend the utility of BLAST. It was created to
facilitate verification of the origins of Human
Immunodeficiency Virus (HIV) sequences derived from various
experiments, and then was developed into the standalone web
server for maximum utility in other research fields. It is
recommended that users have experience in installation and
running standalone NCBI BLAST+ programs when installing,
configuring and customizing ViroBLAST. After files are
uncompressed, ViroBLAST server is ready to be used
immediately. Users then can configure and customize sequence
databases to manage their own BLAST web server tailored to
meet their specific research purpose.

## Features

* Customize public and user's local sequence databases.
* Blast against user's sequence data set by uploading
sequence file in FASTA format.
* Blast against multiple sequence databases selected by
user.
* Summarize the BLAST output and easily navigate the result.
* Download sequences in database that match user's query
sequence.

## Installation of the standalone ViroBLAST server

After downloading the file viroblast.tar.gz, place it into
document directory of HTTPD server in your computer and
uncompress it by

    gzip -d viroblast.tar.gz
    tar -xvpf viroblast.tar
    
It is important to have the parameter "p" in tar options. It
will preserve file access options stored in the
distribution. Directory for the BLAST output (data) should
have readable, writeable and executable permissions for
everyone (777).

After you have uncompressed the distribution file, the
directory "viroblast" will be created. You can access the
ViroBLAST home page via URL:

    http://your_hostname/viroblast/viroblast.php

## Configuration of BLAST program

The standalone ViroBLAST server runs the NCBI BLAST+
program and has been tested on Linux, Mac OS X and Sun OS.
The distribution comes with a standalone BLAST+ program for
linux/x64. It is your responsibility to download
appropriate standalone BLAST+ for your computer's operating
system from NCBI ftp site
(ftp://ftp.ncbi.nlm.nih.gov/blast/executables/blast+/LATEST/). After you have
downloaded the standalone BLAST+, uncompress it and put in a
directory you want, then, change the path to "blast+" program
into server configuration file (viroblast.ini).

## Configuration and customization of BLAST sequence databases

This distribution comes with 2 BLAST databases to test.
"Nucleotide test database" - sample nucleotide database and
"Protein test database" - sample protein database. These
databases are configured to be searchable immediately. After
testing, you need to set up your sequence databases for the
standalone ViroBLAST server. It is necessary to follow these
steps:

1. Put sequence FASTA file in appropriate directory under ./db/
(./db/nucleotide/ or ./db/protein/).
2. Run "makeblastdb" program, available from the NCBI ftp site
(ftp://ftp.ncbi.nlm.nih.gov/blast/executables/blast+/LATEST/)
to format the sequence database.
3. Add name of the database into server configuration file
(viroblast.ini). The format is: "database_file_name => database_name_for_display".
If there are more than one database, put comma "," between them.

## Directories and Files in the distribution

#### Root directory (./viroblast/):
- viroblast.php: viroblast home page.
- blastresult.php: blast result output page.
- blast.pl: perl program executes blast+ program and formats
the output.
- sequence.php: page showing sequences ready for download.
- download.php: download sequences.
- viroblast.ini: Default configuration file for the ViroBLAST
server.

#### ./viroblast/blast+/
- Default standalone BLAST+ program for linux/x64 downloaded
from NCBI.

#### ./viroblast/data/
- Storage for BLAST output files.

#### ./viroblast/docs/
- Documents for the ViroBLAST server.

#### ./viroblast/db/nucleotide/
- Storage of nucleotide sequence databases for BLAST search.

#### ./viroblast/db/protein/
- Storage of protein sequence databases for BLAST search.

#### ./viroblast/image/
- Images used in ViroBLAST pages.

## Server configuration file

This distribution comes with a default configuration file
"viroblast.ini". The configuration file will set the path to
blast+ program and what databases may be used with what
programs.
