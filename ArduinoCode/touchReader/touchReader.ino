#include <PN532.h> //These are needed for the NFC reader to work
#define SCK 13
#define MOSI 11
#define SS 10
#define MISO 12
PN532 nfc(SCK, MISO, MOSI, SS); //Set up the NFC reader

int limit; //length of a studentID
int start; //starting block of memory on the card
String room; //what room does this arduino represent

void setup()
{ 
  Serial.begin(9600); //Opens serial port for user interaction (may not be needed in final version)
  nfc.begin(); //starts up the NFC card
  //runCurl(); These are for running external programs
  //runCpuInfo();
  uint32_t versiondata = nfc.getFirmwareVersion(); //Checks to make sure the NFC Shield is there
  if (!versiondata)
  {
    Serial.print("Didn't find PN53x board"); //Lets you know if it can't find the NFC shield
    while (1);
  }
  nfc.SAMConfig(); //sets up NFC program
  
  room = "G001";
  limit = 7; //Length of the studentID. Will have to be manually updated if student ID format changes
  start = 20; //Staring block of memory the program checks, as above this would need to be manually reset.
  Serial.println("Hello! Welcome to the touchReader program."); //Lets the user know the program is ready
}

void loop()
{
  // see if there's incoming serial data:
  uint8_t studentNo[limit];
  
  uint32_t id;
  Serial.println("Please hold the card over the reader");
  while(id==0) //waits till a card is presented
  {
    id = nfc.readPassiveTargetID(PN532_MIFARE_ISO14443A); //Attempts to read student's card
  }
  if (id != 0) //Starts main program once card is placed on reader
  {
    Serial.println();
    Serial.println("Reading card, please do not move it."); //Lets the user know what's happening
    for (int i=0;i<limit;i++) //scans through each block on the card that contains the student number
    {
      uint8_t block[16];
      nfc.readMemoryBlock(1,(start+i),block); //receives the student number from the card
      studentNo[i] = block[0]; //assigns it to the student number array (hex values)
    }
    //ADD SOME CHECKS TO MAKE SURE THE STUDENTID IS IN THE CORRECT FORMAT ETC
    String studentID;
    for (int i=0;i<limit;i++) {studentID+=String((char)studentNo[i]);}
    Serial.print("The card contains the ID ");
    Serial.println(studentID);
    Serial.println();
    Serial.println("Please remove the card.");
  }
  Serial.println();
  delay(1000);
}

void setupInternet()
{
}
void upload(String sid) //Use of client id depended on libraries available with arduino yun
{
  client.print("GET /add.php? room=");
  client.print(room);
  client.print(" && studentID=");
  client.print(sid);
  client.println(" HTTP/1.1");
  client.println("Host: ma301wm.igor.gold.com");
  client.println("User-Agent: MyArduino");
}
