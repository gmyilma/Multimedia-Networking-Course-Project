QR Triggered Photo Sharing Application forMuseums


For some historical or technical reasons it is not possible to take pictures in museums. This is eecause of the fact that in some way the camera, reflection might damage the quality of the pictures or Sculpture’s, and some museums do not allow taking pictures at all. The idea of this QR Triggered Photo sharing application project is to create a means for museum visitors to have the experience of enjoying the pictures from the museum by developing an android application to decode a QR-Code encoded with the URL of the images in the museum, bringing low quality version of the picture for image filtering and sharing on social media. While sharing the URL of high quality version of the picture with the selected image filtering applied will be posted on the social media.  In addition, to create an interactive dashboard management web application for museum managers, to perform basic operations such as adding pictures, generating QR Codes and do some basic content management. We believe through this application both museums and visitors will benefit greatly, from the fact that it is easier for visitors to scan a QR Code than taking the best shots and for the museums, they will have some automated experience for their data in the museums and easily advertise themselves on the social networks.


For more details you can refer to the documentation on https://github.com/gmyilma/Multimedia-Networking-Course-Project/blob/master/Documentation%20about%20the%20SW.pdf

Part One Web Application Setup 
Install MAMP with php version 5 (php 5.5 is the recommended one).
Add the projects's source folder to (../MAMP/htdcos/ ) directory 
Create a database and execute ./Mmuseum.sql inside the data base you just created
Use the ./configure.JSON file to adjust the database parameters 

host--------------------> hosting server name 
db---------------------->database name
userName----------->username of the database
pass------------------>password of the database 

Their is a created sample  account
with user --------->admin 
user name ------->admin@museummanagment.site11.com
password--------->xxx


To open the website locate the MAMP server application and run it. 
start Apache and MySql

on your browser type the following url. 

localhost:[port_number]/project directory name 

Login using 

username: admin@museummanagment.site11.com
password: admin

or you can register as a new user


Part two Android Client Application

How to run the source code 

1. Download and install the latest ADT bundle form http://developer.android.com/sdk/index.html
2. Open  the eclipse IDE and go to File menu and Import the source code from the source directory.
3. Connect an android enabled phone with your laptop and run the application. 

Requirement to build the application 

Minimum android version:  Android 4.0.3 ICE_CREAM_SANDWICH_MR1ICE_CREAM_SANDWICH_MR1
Minimum SDK version API level 15

The application needs to use the following permissions to work:
1. Camera 
2. Internet
3. Vibrate
4. Flashlight 
5. Read contacts 
6. Read history and bookmarks 
7. Write external storage 
8. Change wife state 
9. Access wifi state
10. Read external storage 


Or you can install the Capture.apk file
