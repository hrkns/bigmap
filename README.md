mini tool for get a map in high resolution using google maps api

you can put this in a XAMPP|LAMPP|WAMPP server or some equivalent

simple code, for the moment, when you press "get high resolution map" just wait few seconds or even minutes...

some issues:
  - the process to obtain the map could take several minutes, it depends of the amplitude of the zone that you choose, so you must change the max_time_execution in the php.ini in order to avoid that the execution of the script engine.php be interrupted suddenly
  - at this moment it is being solved the problem associated with trying to get a map of a big location, because some image processing functions of php consume a lot of RAM memory; you could try to change memory_limit in php.ini but it's not enough

both issues could be fixed using imagemagick pecl for php (i haven't done it because i'm in windows right now and the pecl installation and use is giving to me some troubles)

the process to merge the images for build the big map could be done using 
this: http://php.net/manual/en/imagick.appendimages.php
and this: http://stackoverflow.com/questions/5280813/how-do-you-append-images-that-are-already-created-with-appendimage
