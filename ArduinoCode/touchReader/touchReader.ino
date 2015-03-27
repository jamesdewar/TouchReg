#include <Console.h> //Console used for visual feed back that the entered code is working (not used unless needed
#include <Bridge.h>
#include <SPI.h> //Sets up digital pins being used for sending data to the user
#include "PN532_SPI.h" //Sets up digital pins being used for transferring the nfc signal
#include "PN532.h" //Library that allows the nfc card to work. Sourced from Seeed studios from https://github.com/Seeed-Studio/PN532
#include "NfcAdapter.h" //Sourced from https://github.com/don/NDEF
PN532_SPI interface(SPI, 10); // create a PN532 SPI interface with the SPI CS terminal located at digital pin 10 (code take from https://github.com/don/NDEF)
NfcAdapter nfc = NfcAdapter(interface); // create an NFC adapter object
#include <HttpClient.h> //Allows Yun to call a URL and send the card numbers to the PHP scripts

int room; //what room does this arduino represent - needed for checking the timetable. At present can only be changed in the code
int waiting; //LED to show that the arduino is waiting for a card
int success; //LEDto show that the card has been received

void setup()
{
  Bridge.begin(); //Sets up the connection to arduino over internet
  //Console.begin(); //All Console notes are used for feedback when the code is running, not necessary exept for testing
  //while(!Console) {;} //waits for user to connect.Unnecessary in main version of the program
  //Console.println("Hello! Welcome to the touchReader program."); //Lets the user know the program is ready
  SPI.begin(); //Sets up the digital pins for the nfc communication
  nfc.begin(); //starts up the NFC card reader
  room = 5; //Room is currently set to 5
  waiting = 11; //Pin for the red led
  success = 9; //Pin for the green led
  pinMode(waiting, OUTPUT); 
  pinMode(success, OUTPUT); //sets up two designated LED pins
}

void loop()
{
  digitalWrite(success,LOW);
  digitalWrite(waiting,HIGH); 
  //Console.println("\nScan an NFC tag\n"); //represents waiting for the card to be presented
   if (nfc.tagPresent()) // Checks to see if NFC tag tag is present. Code mostly from http://www.seeedstudio.com/wiki/NFC_Shield_V2.0
   {
     NfcTag tag = nfc.read(); // read the NFC data into an object, NfcTag
     digitalWrite(waiting,LOW); //Swaps LEDs to let user know the scan has taken place. Happens after card is read to make sure nothing goes wrong
     digitalWrite(success, HIGH);
     String id = tag.getUidString(); //Gets a usable string of the card ID from the NfcTag class 
     //Console.println(tag.getUidString()); //Used to display the tag to demonstrate that it was working
     upload(id); //Activates the upload process with the nfc card datain it
   }
   delay(1000); // wait half one second before scanning again 
}
void upload(String id) //upload class sends the room number and card ID to the php script 'checkin.php'
{
  HttpClient client; //Idea to use taken from here http://arduino.cc/en/Tutorial/HttpClient Allows arduino to call a url
  String cid = id; //Card ID to be sent
  cid.replace(' ','+'); //Worked out I needed to replace the spaces in the URL with plusses from here: http://stackoverflow.com/questions/4462219/get-request-with-space-in-querystring-crashes-code
  String query = "http://igor.gold.ac.uk/~ma301wm/touchReader/checkin.php?cid="+cid+"&room="+room; //Builds the get request using the URL and data
  client.get(query); //Calls the website (ie, sends the data through)
}

