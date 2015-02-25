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

const int ledPin = 13; // the pin that the LED is attached to
PN532 nfc(SCK, MISO, MOSI, SS);

void setup()
{ // initialize serial communication:
  Serial.begin(9600);
  nfc.begin();
  // initialize the LED pin as an output:
  pinMode(ledPin, OUTPUT);
  //runCurl();
  //runCpuInfo();
  uint32_t versiondata = nfc.getFirmwareVersion();
  if (!versiondata)
  {
    Serial.print("Didn't find PN53x board");
    while (1); //halt
  }
  nfc.SAMConfig();
  Serial.println("Hello!");
}

void loop()
{
  // see if there's incoming serial data:
  uint32_t id;
  // look for MiFare type cards
  Serial.println("hi");
  id = nfc.readPassiveTargetID(PN532_MIFARE_ISO14443A);
  if (id != 0) 
    {
        Serial.print("Read card #");
        Serial.println(id);
        Serial.println();

        uint8_t keys[]= {0xFF,0xFF,0xFF,0xFF,0xFF,0xFF};  // default key of a fresh card
        for(uint8_t blockn=0;blockn<64;blockn++) {
            if(nfc.authenticateBlock(1, id ,blockn,KEY_A,keys)) //authenticate block blockn
            {
                //if authentication successful
                uint8_t block[16];
                //read memory block blockn
                if(nfc.readMemoryBlock(1,blockn,block))
                {
                    //if read operation is successful
                    for(uint8_t i=0;i<16;i++)
                    {
                        //print memory block
                        Serial.print(block[i],HEX);
                        if(block[i] <= 0xF) //Data arrangement / beautify
                        {
                            Serial.print("  ");
                        }
                        else
                        {
                            Serial.print(" ");
                        }
                    }

                    Serial.print("| Block ");
                    if(blockn <= 9) //Data arrangement / beautify
                    {
                        Serial.print(" ");
                    }
                    Serial.print(blockn,DEC);
                    Serial.print(" | ");

                    if(blockn == 0)
                    {
                        Serial.println("Manufacturer Block");
                    }
                    else
                    {
                        if(((blockn + 1) % 4) == 0)
                        {
                            Serial.println("Sector Trailer");
                        }
                        else
                        {
                            Serial.println("Data Block");
                        }
                    }
                }
            }
        }
    }
  //Useful way of knowing for sure the program is running
  digitalWrite(ledPin, HIGH);
  delay(100);
  digitalWrite(ledPin, LOW);
  delay(100);
}

/*void runCurl()
{
  Process p;
  p.begin("curl");
  p.addParameter("http://arduino.cc/asciilogo.txt");
  p.run();

  while (p.available() > 0)
  {
    char c = p.read();
    Serial.print(c);
  }
  Serial.flush();
}

void runCpuInfo()
{
  Process p;
  p.begin("cat");
  p.addParameter("/proc/cpuinfo");
  p.run();

  while (p.available() > 0)
  {
    char c = p.read();
    Serial.print(c);
  }
  Serial.flush();
}*/
