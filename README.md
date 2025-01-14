![echoCTF RED logo](https://echoctf.red/images/logo-red-small.png)

![ci-tests](https://github.com/echoCTF/echoCTF.RED/workflows/ci-tests/badge.svg)
[![Documentation Status](https://readthedocs.org/projects/echoctfred/badge/?version=latest)](http://echoctfred.readthedocs.org/)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/echoCTF/echoCTF.RED/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/echoCTF/echoCTF.RED/?branch=master)



echoCTF is a pioneer computer security framework, developed by
Echothrust Solutions, for running CyberSecurity exercises and competitions such
as Capture the Flag.

echoCTF allows building and running capture the flag competitions for network
penetration testing and security auditing on real IT infrastructure. It is
also used for security awareness and training purposes, by businesses and
educational institutes.

# What is echoCTF.RED
echoCTF.RED <sub>(codename Mycenae),</sub> is the first iteration of our online
long running CTF service, based on the applications from this repository.

It is a free online service that offers a controlled environment, based on
real-life systems and services, to train and sharpen your offensive and
defensive security skills. Scan, brute-force and do whatever it takes to
attack the systems and solve the real-life security scenarios to gain points.

For more information about our competitions visit [https://echoCTF.com/](https://echoCTF.com/) or if
you'd rather see a live example of our platform feel free to visit [https://echoCTF.RED/](https://echoCTF.RED/)

Our main goals for echoCTF include:
* **Completeness** - Provide a complete set of tools and applications to develop, deploy and maintain competitions
* **Modularity** - Each component has a unique and clear role
* **Expandability** - echoCTF's components are designed to permit expansion

## Quick start
```sh
$ git clone https://github.com/echoCTF/echoCTF.RED.git
$ cd echoCTF.RED
$ docker-compose pull
$ docker-compose up
```

For more details check [echoCTF.RED@ReadTheDocs](https://echoctfred.rtfd.io).

## Disclaimer
The documents and guides in this repository are only examples and are not meant
to be used to setup production environments.

Special care should be taken with securing and restring access to your setups.

Apply common logic when copy pasting commands and files :)

echoCTF is software that comes with absolutely no warranties whatsoever. By
using echoCTF, you take full responsibility for any and all outcomes that
result.

Keep in mind that the system comes up with absolutely no data. This means
that it is up to you to create targets, challenges, rules, instructions and
any other details you require.
