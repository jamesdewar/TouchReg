# TouchReg
Second Year Software Project
Group CS2
Members of the team:
- James Dewar
- William Moore
- Richard Bard
- Zach Ahmed
- Gergely Kiss
- Richard Lan Chow Wing

## Admin Website 

When you login with the credentials below you will see the statistics that we built from our database.
You can click on ANY of the students to see their individual statistics. 
When you click back on the course on the left side you are greated again with GENERAL statistics of that course.
You can see 3 data visualization:
- Attendance of the module over the whole 10 week period
- Average attendance of the module over 10 week period
- Table showing the attendance record for every student over 10 weeks. This complemented by the individual section of the website (when you click on their names)

###Website logins
- URL: http://igor.gold.ac.uk/~ma303jd/login
- Credentials: 
- Username: ma303jd@gold.ac.uk 
- Password: ma303jd


##Hardware Side (Arduino)

How to test:
- If arduino required for testing please contact William Moore
- In place of arduino a simple URL will suffice for testing purposes:
- igor.gold.ac.uk/~ma301wm/touchReader/checkin.php?cid=???&room=???
- Replace the question marks with a card ID and a Room ID respectively
- Room IDs: 1,2,3,4,5
- Test Card IDs: D1+B1+67+C0, 71+C7+A6+C0, 04+CD+E1+EA+BC+2B+80, 01+53+3E+C0
- NOTE: The database will not update if a class isn't scheduled within half an hour of you 'registering' a student's attendance. For accurate testing you would need to make sure you ran the check at the correct time. 
- Video demonstration of hardware: https://www.youtube.com/user/WillTwoBill/videos

Hardware Used
-  Arduino Yun (http://arduino.cc/en/Main/ArduinoBoardYun?from=Products.ArduinoYUN)
- SeeedStudio NFC Shield V2.0 (http://www.seeedstudio.com/wiki/NFC_Shield_V2.0)
- 1 red LED
- 1 green LED
- 1 Breadboard
- 4 Wires
- 1 Micro USB cable
- 1 Ethernet cable
- Headers (used to extend distnace between arduino yun and nfc shield)

Arduino Code
- Primary code located in the ArduinoCode folder under the title touchReader
- Code in the testing folder was used for fixing problems but is not part of the primary code
- All extra libraries used are in the Libraries folder

PHP Connection to Database
- Arduino uses get to register attendance in the database
- PHP files for the arduino can be found in 'ArduinoCode/PHP Scripts'
