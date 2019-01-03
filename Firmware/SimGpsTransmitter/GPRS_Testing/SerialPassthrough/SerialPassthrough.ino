/*
  SerialPassthrough sketch

  Some boards, like the Arduino 101, the MKR1000, Zero, or the Micro, have one
  hardware serial port attached to Digital pins 0-1, and a separate USB serial
  port attached to the IDE Serial Monitor. This means that the "serial
  passthrough" which is possible with the Arduino UNO (commonly used to interact
  with devices/shields that require configuration via serial AT commands) will
  not work by default.

  This sketch allows you to emulate the serial passthrough behaviour. Any text
  you type in the IDE Serial monitor will be written out to the serial port on
  Digital pins 0 and 1, and vice-versa.

  On the 101, MKR1000, Zero, and Micro, "Serial" refers to the USB Serial port
  attached to the Serial Monitor, and "Serial1" refers to the hardware serial
  port attached to pins 0 and 1. This sketch will emulate Serial passthrough
  using those two Serial ports on the boards mentioned above, but you can change
  these names to connect any two serial ports on a board that has multiple ports.

  created 23 May 2016
  by Erik Nyquist
*/
#include <SoftwareSerial.h>
SoftwareSerial sim_ss(A2,A3); //RX TX 


char buf[80];

int readline(int readch, char *buffer, int len) {
    static int pos = 0;
    int rpos;

    if (readch > 0) {
        switch (readch) {
            case '\r': // Ignore CR
                break;
            case '\n': // Return on line feed
                rpos = pos;
                pos = 0;  // Reset position index ready for next time
                return rpos;
            default:
                if (pos < len-1) {
                    buffer[pos++] = readch;
                    buffer[pos] = 0;
                }
        }
    }
    return 0;
}

void setup() {
  pinMode(6,OUTPUT);
  pinMode(5,OUTPUT);
  Serial.begin(9600);
  sim_ss.begin(9600);
  digitalWrite(6, HIGH);
  digitalWrite(5, HIGH);
  Serial.write("GPS Serial Passthrough");
  
  sim_ss.write("AT");
  if (sim_ss.available()) {     // If anything comes in Software Serial (pins 8 & 9)
    Serial.write(sim_ss.read());   // read it and send it out Serial (USB)
    
  }
}

void loop() {
   if (readline(Serial.read(), buf, 80) > 0) {
        Serial.print("You entered: >");
        Serial.print(buf);
        Serial.println("<");
    }
    /**/
if (readline(sim_ss.read(), buf, 80) > 0) {
        Serial.print("SIM Responded >");
        Serial.print(buf);
        Serial.println("<");
    }
    if (sim_ss.available()) {     // If anything comes in Software Serial (pins 8 & 9)
    Serial.write(sim_ss.read());   // read it and send it out Serial (USB)
    digitalWrite(6, LOW);
    delay(1000);
    digitalWrite(6, HIGH);
    delay(1000);
    digitalWrite(6, LOW);
    delay(1000);
    digitalWrite(6, HIGH);
    delay(1000);
    digitalWrite(6, LOW);
    delay(1000);
    digitalWrite(6, HIGH);
  }
  }

  

