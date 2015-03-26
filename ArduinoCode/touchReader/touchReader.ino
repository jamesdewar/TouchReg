#include <Console.h>
#include <SPI.h>
#include "PN532_SPI.h"
#include "PN532.h"
#include "NfcAdapter.h"
PN532_SPI interface(SPI, 10); // create a PN532 SPI interface with the SPI CS terminal located at digital pin 10
NfcAdapter nfc = NfcAdapter(interface); // create an NFC adapter object
#include <Bridge.h>
#include <YunServer.h>
#include <YunClient.h>
#include <HttpClient.h>

int start; //starting block of memory on the card
String room; //what room does this arduino represent
YunClient client;
//HttpClient client2;
const char* server;
uint16_t port;

void setup()
{
  Bridge.begin(); //Sets up the connection to arduino over 
  //Console.begin();
  SPI.begin();
  //while(!Console) {;} 
  //Console.println("Hello");
  nfc.begin(); //starts up the NFC card
  room = "G001";
  server = "ma301wm.gold.ac.uk";
  port = 80;
  //Console.println("Connected");
  //Console.println("Hello! Welcome to the touchReader program."); //Lets the user know the program is ready
}

void loop()
{
   //Console.println("\nScan an NFC tag\n");
   if (nfc.tagPresent()) // Do an NFC scan to see if an NFC tag is present
   {
     NfcTag tag = nfc.read(); // read the NFC tag into an object, nfc.read() returns an NfcTag object.
     String id = tag.getUidString();
     //Console.println(tag.getUidString());
     upload(id);
   }
   delay(500); // wait half a second (500ms) before scanning again 
}
void upload(String id) //Use of client id depended on libraries available with arduino yun
{
  //Console.println("Connecting");
  HttpClient client;
  String cid = id;
  cid.replace(' ','+');
  String query = "http://igor.gold.ac.uk/~ma301wm/touchReader/checkin.php?cid="+cid+"&room="+room;
  //Console.println(query);
  client.get(query);
}

