#include <Console.h>
#include <process.h>
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
int incomingByte;      // a variable to read incoming serial data into
PN532 nfc(SCK, MISO, MOSI, SS);

void setup()
{ // initialize serial communication:
  Bridge.begin();
  Console.begin();
  nfc.begin();
  uint32_t versiondata = nfc.getFirmwareVersion();
  if (!versiondata)
  {
    Console.print("Didn't find PN53x board");
    while (1); //halt
  }
  //Continues if okay
  Console.print("Found chip PN5"); Console.println((versiondata >> 24) & 0xFF, HEX);
  Console.print("Firmware ver. "); Console.print((versiondata >> 16) & 0xFF, DEC);
  Console.print('.'); Console.println((versiondata >> 8) & 0xFF, DEC);
  Console.print("Supports "); Console.println(versiondata & 0xFF, HEX);
  nfc.SAMConfig();

  while (!Console) {
    ; // wait for Console port to connect.
  }
  Console.println("You're connected to the Console!!!!");
  // initialize the LED pin as an output:
  pinMode(ledPin, OUTPUT);
  runCurl();
  runCpuInfo();
}

void loop()
{
  // see if there's incoming serial data:
  if (Console.available() > 0) {
    // read the oldest byte in the serial buffer:
    incomingByte = Console.read();
    if (incomingByte == 'H') // if it's a capital H (ASCII 72), turn on the LED:
    {
      Console.println("You pressed H");
    }
    else if (incomingByte == 'L') // if it's an L (ASCII 76) turn off the LED:
    {
      Console.println("You pressed L");
    }
  }
  //Useful way of knowing for sure the program is running
  digitalWrite(ledPin, HIGH);
  delay(100);
  digitalWrite(ledPin, LOW);
  delay(100);
}

void runCurl()
{
  Process p;
  p.begin("curl");
  p.addParameter("http://arduino.cc/asciilogo.txt");
  p.run();

  while (p.available() > 0)
  {
    char c = p.read();
    Console.print(c);
  }
  Console.flush();
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
    Console.print(c);
  }
  Console.flush();
}
