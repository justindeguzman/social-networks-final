Social.mesh
===========
A Hyper-local social network exclusively accessible to those connected to the NYC mesh network’s Wi-Fi nodes.
- Enhances node connectivity and performance through gamification and social ranking
- Promotes the mesh network to local communities that have connection
- Creates a digital extension of hyper-local culture

[For more information, see our presentation] (https://docs.google.com/presentation/d/1gAhZw-xq6RTACxCbkcj_MS0iZOGMFyBAJiKgJGHTGeY/edit#slide=id.gda013de5f_1_6)

Features
- QR codes in locations where the public can connect to the mesh, which links to that node’s portal page. You can only join nodes that you have visited.
- Global mesh parent portal
- Users and nodes are associated with a level of reputation
- Parsing node uptime 
- Gain reputation by participating on the site and performing certain “challenges” 
    - Example: go to all the nodes in LES, visit two nodes in two burrows, etc.
- Hyper-local information/activity stream (Pull from APIs to gather “Song of the Street”, events, etc.)


Technology Used

Social.mesh runs on an inexpensive Raspberry Pi server. All of our code is open source. To install your own Social.mesh node, you need a nanobeam to connect to other mesh nodes. We recommend the Ubiquiti NanoStation nanobeam router. You also need a traditional router, although if you only plan to be an incoming node (instead of also an outgoing node, which provides access to others), then you do not need to pay an ISP for internet service. We are using MySQL, Node.js, PHP, and other technologies on the back-end. We are building on top of HumHub, an open source social network framework built in PHP. We decided to use the framework so that we could reuse much of the pre-built features and focus on building custom features for our network. We recommend you visit the following websites to learn more about mesh networks: http://nycmesh.net and http://www.openmeshproject.org/.

Setup Instructions

Social.mesh is usable out-of-the-box except for setting up permissions. Please look at the HumHub setup instructions (located at http://github.com/humhub) for more detailed instructions. You also need Node.js and MySQL installed to run some of the scripts in the “/scripts” folder.

HumHub - Social Network Kit
===========================

[![Build Status](https://travis-ci.org/humhub/humhub.svg?branch=master)](https://travis-ci.org/humhub/humhub)
[![Yii2](https://img.shields.io/badge/Powered_by-Yii_Framework-green.svg?style=flat)](http://www.yiiframework.com/)

HumHub is a feature rich and highly flexible OpenSource Social Network Kit written in PHP.

It's perfect for individual:
- Social Intranets
- Enterprise Social Networks
- Private Social Networks

More information:
- [Homepage & Demo](http://www.humhub.org)
- [Documentation & Class Reference](http://www.humhub.org/docs)
- [Licence](http://www.humhub.org/licences)

