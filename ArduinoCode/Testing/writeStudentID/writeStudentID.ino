// This example writes a MIFARE memory block 0x08. It is tested with a new MIFARE 1K cards. Uses default keys.
// Note: Memory block 0 is readonly and contains manufacturer data. Do not write to Sector Trailer block
// unless you know what you are doing. Otherwise, the MIFARE card may be unusable in the future.

//Contributed by Seeed Technology Inc (www.seeedstudio.com)

#include <PN532.h> //These are needed for the NFC reader to work
#define SCK 13
#define MOSI 11
#define SS 10
#define MISO 12

PN532 nfc(SCK, MISO, MOSI, SS); //Sets up the NFC reader

//uint8_t written = 0; //Means of checking user input entered succesffully
//uint8_t input[7]; //User input using Serial, currently on hold

String studentID; //The user entered string of the student ID
int limit; //Length of the student ID
int start; //Starting block of memory on the card.

void setup(void) 
{
  Serial.begin(9600); //Opens serial port for user interaction
  studentID = "ma301wm"; //Currently just set as my ID, will change when user input is added
  limit = studentID.length(); //set limit at the length of the student ID
  start = 20; //Sets the starting block to 20
  
  nfc.begin(); //Activates NFC reader

  uint32_t versiondata = nfc.getFirmwareVersion(); //Unsure if needed
  if (! versiondata) //Makes sure the program can actually find the NFC board
  { 
    Serial.println("Didn't find PN53x board");
    while (1); // halts program if it can't find the board
  }
  nfc.SAMConfig(); //sets up NFC program
  Serial.println("Hello! Welcome to the writeStudentID program"); //Greets user, lets them know it is connecting fine
}


void loop(void) 
{
  /* This is for user entry of the student ID but isn't working yet.
  
  boolean entered=false;
  uint8_t in;
  Serial.println("Please enter the student ID you are wanting to input onto the Student Card.");
  while (!entered)
  {
    if (Serial.available()>0)
    {
      input[0] = Serial.read();
      input[1] = Serial.read();
      input[2] = Serial.read();
      input[3] = Serial.read();
      input[4] = Serial.read();
      input[5] = Serial.read();
      input[6] = Serial.read();
      Serial.print("I received: ");
      for (int i=0;i<7;i++)
      {
        Serial.print(input[i], HEX);
      }
      Serial.println();
      Serial.println("Is this correct? Enter Y or N");
      boolean confirmed=false;
      while (!confirmed)
      {
        if (Serial.available()>0)
        {
          in = Serial.read();
        }
        if (in>0)
        {
          confirmed=true;
        }
        Serial.flush();
      }
      if (in==59||in==79)
      {
        entered=true;
      }
      Serial.flush();
    }
  }
  Serial.println("You're out of the loop.");*/
  
  uint8_t studentNo[limit]; //Student number is an array of the characters in studentID 
  for (int i=0;i<limit;i++) //loops through each of the characters in studentID
  {
    studentNo[i] = studentID.charAt(i); //assigns the character to its corresponding location in the array
  }
  
  uint32_t id = 0; //Contains the NFC card number (not student number)
  Serial.println("Please hold the card over the reader");
  while(id==0) //waits till card is placed over reader
  {
    id = nfc.readPassiveTargetID(PN532_MIFARE_ISO14443A); //Attempts to read student's card
  }
  if (id != 0) //Proceeds with the rest of the program if a card is found
  {
    Serial.println();
    Serial.println("Writing to card...Please do not move");
    for (int i=0;i<limit;i++) //Has to make sure to write each character in the array to the card
    {
      uint8_t writeBuffer[16]; //Mostly used to ensure clear printing of the card details
      for (int j=0;j<16;j++)
      {
        writeBuffer[j] = 0; //Relevant section will be overwritten but otherwise the characters are kept at 0
      }
      writeBuffer[0] = studentNo[i]; //sets the first unit in the memory block to the necessary character.
      nfc.writeMemoryBlock(1,(start+i),writeBuffer); //Writes the memory block to the card.
      
    }
    Serial.println("Writing complete...checking card");
    boolean correct=true;
    for (int i=0;i<limit;i++) //Scans through each of the written sections
    {
      uint8_t block[16]; //output from card
      nfc.readMemoryBlock(1,(start+i),block); //reads output from card
      if (block[0]!=studentNo[i]) //Checks if the correct things was written
      {
        correct=false; //Incorrect (usually if the card was moved early
      }
    }
    if(correct) //Lets the user know if it all went accordint to plan
    {
      Serial.println("Card details recorded correctly");
      delay(500); //gives time for user to remove the card before it starts again
      Serial.println();
      Serial.println();
      Serial.println("Please remove the card");
    }
    else
    {
      Serial.println("Card details were not recorded successfully, please try again");
    }
    //Serial.print("Read card #"); Serial.println(id); //Displays the card ID, mainly useful for reference
    //written = nfc.writeMemoryBlock(1, 19, writeBuffer); // original version of writeBuffer
  }
  delay(1500); //gap so it doesn't restart program before the user moves away
}

