CleverControl
=============

Use this at your own risk! Shouldn't break anything though :)

My Tellstick control panel mainly used from my mobile to easily tinker with my devices from a comfortable location.

Font (Comfortaa) downloaded from http://www.deviantart.com/art/Comfortaa-font-105395949 - Thanks!

Information
-----------
* Only tested with tdtool 2.1.2_rc1 (some elements has moved around in the tdtool --list output)
* Uses jQuery to refresh elements every 3 and 5 second (3 for buttons, 5 for temperature sensors)
* Reads output from a textfile made with "tdtool --list" which is located in the same directory (tdtool.txt)
* Room/Device must be divided with ; - Example "Livingroom;Window Lamp"
* Reads temperature from sensors (Tellstick Duo) with "fineoffset" protocol. Set ID and location in control.php!

Known Issues
------------
* Has very small support for dimmers (only ON and OFF commands sent to them), would appreciate help with this!
* Only reconstructs the tdtool.txt when a device is changed. My current workaround is a cronjob every 15 minutes to update tdtool.txt in the background.
* A few hardcoded knockups (for example temperature sensors) and fault tollerance needs to be looked over.
* Only tested and optimized for Firefox at the moment!

Screenshot
----------
Example of how it can look :)
<img src="https://fogelholk.se/clevercontrol.png" />
