#include <PN532.h>

#define SS 10
#if defined(__AVR_ATmega1280__) || defined(__AVR_ATmega2560__)
  #define MISO 50
  #define MOSI 51
  #define SCK 52
#else
  #define MISO 12
  #define MOSI 11
  #define SCK 13
#endif
 
PN532 nfc(SCK, MISO, MOSI, SS); //Creates the NFC object
int processing = 3; //The pins the LEDs are connected to
int right = 4;
int wrong = 5;
 
void setup(void) {
  pinMode(processing, OUTPUT);
  pinMode(right, OUTPUT);
  pinMode(wrong, OUTPUT);
  nfc.begin();  //Initialises the NFC driver
  nfc.SAMConfig(); 
}
 
void loop(void) 
{
  uint32_t id = nfc.readPassiveTargetID(PN532_MIFARE_ISO14443A);
  if (id!=0) 
  {
    digitalWrite(processing,HIGH);
    delay(100);
    uint8_t block[16];
    nfc.readMemoryBlock(1,19,block);
    Serial.print(block[3]); 
    if (block[3]==3)
    {
      digitalWrite(right,HIGH);
    }
    else
    {
      digitalWrite(wrong,HIGH);
    }
  }
  delay(1000);
  digitalWrite(processing,LOW);
  digitalWrite(wrong,LOW);
  digitalWrite(right,LOW);
}
//Haloooooo
//will2bill = 3938200448
//RBard = 3938200448

/*
  uint8_t writeBuffer[16];
    for (uint8_t ii=0;ii<16;ii++)
    {
      writeBuffer[ii]=ii; //fills buffer with 0123456
    }
    nfc.writeMemoryBlock(1,0x13,writeBuffer);
    Serial.println("Successful write");
    Serial.println("Checking location");
    uint8_t block[16];
    nfc.readMemoryBlock(1,19,block);
    for (int i=0;i<16;i++)
    {
      Serial.print(block[i]);
    }
    Serial.println();
    digitalWrite(right,HIGH);
*/
