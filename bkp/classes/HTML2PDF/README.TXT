Welcome to HTML2PS/PDF!

This system is a PHP equivalent to the Perl software by the same name. This software takes it a step further, however, and provides the ability to render the output as a PDF file, provided that you are on a Unix or Linux server which allows the exec() function to be run in PHP. The server must also have Ghostscript installed, and you should know what the Ghostscript path is.

This software is FREE for commercial and non-commercial use. Donations help the development a lot, and can be made to g8z@yahoo.com using PayPal.


REQUIREMENTS:

PHP 4.3.x or higher, GD library with JPEG, GIF, and PNG support. Ability to use exec() and Ghostscript's PDF writer are required for PDF output. You must have GhostView to view Postscript files, and Adobe Acrobat Reader to view PDF files.

The "temp" and "out" folders should be chmoded to a writable mode.


GETTING STARTED:

Upload the files from the "public_html" folder to a web server, and open index.php. Then, input the URL to your HTML page and click 'Convert'.

Depending on your server configuration, you may need to adjust this constant in writer.class.php:

define('PS2PDF_PATH','/usr/local/bin/gs'); // Another common path: /usr/bin/gs

This is the path to your Ghostscript installation. ps2pdf is a utility which converts PostScript files to PDF files.


GETTING SUPPORT:

This is user-to-user support only! You can post questions and help others at the www.TUFaT.com forum:

http://www.tufat.com/forum/

I'm always looking for URLs that fail with this software - i.e., they produce PHP or Ghostscript errors, or they do not accurately render the PostScript or PDF output. Please post such URLs in the forum, or email them to g8z@yahoo.com

Please be sure to view the online documentation at:

http://www.tufat.com/docs/html2ps/index.html


ACKNOWLEDGEMENTS:

Special thanks to Konstantin for his coding help! 


Thanks for using HTML2PS/PDF!
Darren
