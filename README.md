CleverControl
=============

Use this at your own risk! Shouldn't break anything though :)

My Tellstick control panel mainly used from my mobile to easily tinker with my devices from a comfortable location.

Font (Comfortaa) downloaded from http://www.deviantart.com/art/Comfortaa-font-105395949 - Thanks!

Thanks [Ranzdo](https://github.com/Ranzdo) for some help with jQuery

Information
-----------
* Only tested/functional with tdtool 2.1.2_rc1 (some elements has moved around and new output-command with 'tdtool --list-devices' and 'tdtool --list-sensors')
* Uses jQuery to refresh elements every 3 and 5 second (3 for buttons, 5 for temperature sensors)
* Reads output from a textfile made with "tdtool --list-devices" and "tdtool --list-sensors" which is located in the same directory (tdtool-devices.txt and tdtool-sensors.txt)
* Room/Device must be divided with ; - Example "Livingroom;Window Lamp" for best functionality
* Reads temperature from sensors (Tellstick Duo). Set ID and location in control.php!
* Initial support for dimmer control. Dimmable lights has to be named for example "Livingroom;Window Lamp;Dimmable" for the slider to show

Known Issues
------------
* Only reconstructs the tdtool-devices.txt when a device is changed. My current workaround is a cronjob every 5 minutes to update tdtool-devices.txt in the background.
* Only tested and optimized for Firefox at the moment!

Screenshot
----------
Example of how it can look :)

<img src="https://fogelholk.se/img/clevercontrol.png?1" />
