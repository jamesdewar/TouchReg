// This example writes a MIFARE memory block 0x08. It is tested with a new MIFARE 1K cards. Uses default keys.
// Note: Memory block 0 is readonly and contains manufacturer data. Do not write to Sector Trailer block
// unless you know what you are doing. Otherwise, the MIFARE card may be unusable in the future.

//Contributed by Seeed Technology Inc (www.seeedstudio.com)

#include <PN532.h>

#define SCK 13
#define MOSI 11
#define SS 10
#define MISO 12

PN532 nfc(SCK, MISO, MOSI, SS);

uint8_t written = 0;
uint8_t input[7];

void setup(void) {
  Serial.begin(9600);
  Serial.println("Hello!");

  nfc.begin();

  uint32_t versiondata = nfc.getFirmwareVersion();
  if (! versiondata) {
    Serial.println("Didn't find PN53x board");
    while (1); // halt
  }
  // Got ok data, print it out!

  // configure board to read RFID tags and cards
  nfc.SAMConfig();
}


void loop(void) {
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
  Serial.println("You're out of the loop.");
  uint32_t id;
  // look for MiFare type cards
  id = nfc.readPassiveTargetID(PN532_MIFARE_ISO14443A);

  if (id != 0)
  {
    Serial.print("Read card #"); Serial.println(id);
    Serial.println();

    uint8_t writeBuffer[16];
    for (int i = 0; i < 16; i++)
    {
      writeBuffer[i] = 0; //Fill buffer with 0
      Serial.print(i);
    }
    Serial.println();
    //writeBuffer[2] = 55;
    //writeBuffer[3] = 30; //Are only able to use up to 4
    Serial.println("Writing");
    for (int i=18;i<37;i++)
    {
      written = nfc.writeMemoryBlock(1, 19, writeBuffer); // Write writeBuffer[] to block 0x08
    }
    if (written)
    {
      Serial.println("Write Successful");
    }
    uint8_t block[16]; //Reads back result
    if (nfc.readMemoryBlock(1, 19, block))
    {
      Serial.println("Read block 19: ");
      //if read operation is successful
      for (int i = 0; i < 16; i++)
      {
        //print memory block
        Serial.print(block[i]);
        Serial.print(" ");
      }
      Serial.println();
    }
  }
  delay(1000);
}

