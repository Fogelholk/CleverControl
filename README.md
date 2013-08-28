CleverControl
=============

Use this at your own risk! Shouldn't break anything though :)

My Tellstick control panel mainly used from my mobile to easily tinker with my devices from a comfortable location.

Font (Comfortaa) downloaded from http://www.deviantart.com/art/Comfortaa-font-105395949 - Thanks!

Information
-----------
* Uses jQuery to update the page every 6 second.
* Reads output from a textfile made with "tdtool --list" which is located in the same directory (tdtool.txt)
* Room/Device must be diviced with ; - Example "Livingroom;Window Lamp"
* Reads temperature from sensors (Tellstick Duo) with "fineoffset" protocol. Set ID and location in control.php!
* Optimized for Firefox only at the moment!

Known Issues
------------
* jQuery animation when a device is controlled might get cut because of the auto refresh.
* I currently don't own any dimmers, hence the script might/should not work with them (yet) :) 
* Only updates the tdtool.txt when a device is changed. My current workaround is a cronjob every 15 minutes to update tdtool.txt in the background.
* A few hardcoded knockups (for example temperature sensors) and fault tollerance needs to be looked over.

Screenshot
----------
Example of how it can look :)
<img src="https://fogelholk.se/clevercontrol.png" />
