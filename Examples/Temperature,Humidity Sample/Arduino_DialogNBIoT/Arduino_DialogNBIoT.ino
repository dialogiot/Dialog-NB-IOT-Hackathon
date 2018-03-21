//***Please update  DEVICE_MAC_ADDRESS, EVENT_TOPIC, Network Mode with your parameters*****//

const String DEVICE_MAC_ADDRESS = "9033215437939420";   //your device's mac address
const String EVENT_TOPIC   = "ideamarttemphumidityv1/common";  //your EVENT url/topic as shown under you device definition

//Network mode  GSM/NB-IOT
const String mode = "NB-IOT";

       
//Dialog GPRS APN Credentials
#define DIALOG_GSM_APN   "dialogbb"
#define DIALOG_NBIOT_APN "dialogbb"
#define DIALOG_USERNAME  ""
#define DIALOG_PASSWORD  ""

// ideaBoard pin configuration
#define ideaBoard_PWRKEY 13
#define ideaBoard_RX 8
#define ideaBoard_TX 7
#define ideaBoard_RST 11

//****You don't have to change anything below this***//


#include <Adafruit_SleepyDog.h>
#include <SoftwareSerial.h>
#include "Dialog_NBIOT.h"
#include "Adafruit_MQTT.h"
#include "Adafruit_MQTT_FONA.h"
#include <Wire.h>
#include <BME280.h>
#define halt(s) { Serial.println(F( s )); while(1);  }

SoftwareSerial DialogSerial = SoftwareSerial(ideaBoard_TX, ideaBoard_RX);
Adafruit_FONA_LTE ideaBoard = Adafruit_FONA_LTE(); // For SIM7000

Adafruit_MQTT_FONA mqtt(&ideaBoard, "mqtt.iot.ideamart.io", 1883, DEVICE_MAC_ADDRESS.c_str(), "rabbit", "rabbit");

boolean FONAconnect(const __FlashStringHelper *apn, const __FlashStringHelper *username, const __FlashStringHelper *password);

/****************************** Feeds ***************************************/

// Setup a feed called 'sensor' for publishing.
Adafruit_MQTT_Publish sensor = Adafruit_MQTT_Publish(&mqtt,EVENT_TOPIC.c_str());  

/*************************** Sketch Code ************************************/
// How many transmission failures in a row we're willing to be ok with before reset
uint8_t txfailures = 0;
BME280 bme;
void setup() {
  while (!Serial);
  Wire.begin();
  bme.begin();
  pinMode(ideaBoard_RST, OUTPUT);
  digitalWrite(ideaBoard_RST,LOW); // Default state

    pinMode(ideaBoard_PWRKEY, OUTPUT);
  digitalWrite(ideaBoard_PWRKEY, LOW);
    delay(200);

  digitalWrite(ideaBoard_PWRKEY, HIGH);
  delay(180);
  digitalWrite(ideaBoard_PWRKEY, LOW);

  Serial.begin(115200);
  Serial.println(F("********** Dialog NB-IOT Begin **********"));

  Watchdog.reset();
  delay(5000);  // wait a few seconds to stabilize connection
  Watchdog.reset();

  // Initialise the ideaBoard module
  if(mode=="NB-IOT"){
    while (! FONAconnect(F(DIALOG_NBIOT_APN), F(DIALOG_USERNAME), F(DIALOG_PASSWORD))) {
      Serial.println("Retrying ideaBoard");  
      
   }
  }
  else if(mode=="GSM"){
    while (! FONAconnect(F(DIALOG_GSM_APN), F(DIALOG_USERNAME), F(DIALOG_PASSWORD))) {
      Serial.println("Retrying ideaBoard");
   }
  }
  
  Serial.println(F("Connected to cellular!"));
  ideaBoard.getfullstatus();
  Watchdog.reset();
  delay(5000);  // wait a few seconds to stabilize connection
  Watchdog.reset();
}

uint32_t x = 0;

void loop() {
  // Make sure to reset watchdog every loop iteration!
  Watchdog.reset();
  // Ensure the connection to the MQTT server is alive (this will make the first
  // connection and automatically reconnect when disconnected).  See the MQTT_connect
  // function definition further below.
  MQTT_connect();

  Watchdog.reset();
  // Now we can publish stuff!
  createSendEvent();
  Watchdog.reset();

}

// Function to connect and reconnect as necessary to the MQTT server.
// Should be called in the loop function and it will take care of connecting.
void MQTT_connect() {
  int8_t ret;
  // Stop if already connected.
  if (mqtt.connected()) {
    return;
  }
  Serial.println(F("Connecting to MQTT server... "));

  while ((ret = mqtt.connect()) != 0) { // connect will return 0 for connected
    Serial.println(mqtt.connectErrorString(ret));
    Serial.println("Retrying MQTT connection in 5 seconds...");
    mqtt.disconnect();
    delay(5000);  // wait 5 seconds
  }
  Serial.print(F("*******Connection established to mqtt.iot.ideamart.io*********"));

}

boolean FONAconnect(const __FlashStringHelper *apn, const __FlashStringHelper *username, const __FlashStringHelper *password) {
  Watchdog.reset();

  Serial.println(F("Initializing Dialog NB-IoT DevBoard....(May take 3 seconds)"));
  DialogSerial.begin(115200); // Default SIM7000 shield baud rate

  Serial.println(F("Configuring to 4800 baud"));
  DialogSerial.println("AT+IPR=4800");
  DialogSerial.begin(4800);
  if (! ideaBoard.begin(DialogSerial)) {
    Serial.println(F("Couldn't find Dialog NB-IoT DevBoard"));
    return false; // Don't proceed if it couldn't find the device
  }

  DialogSerial.println("AT+CMEE=2"); // Verbose mode to enable error explanation
  Serial.println(F("Dialog NB-IoT DevBoard detected"));
  Watchdog.reset();
  Serial.println(F("Initially setting up Dialog GSM network and checking connectivity..."));
  ideaBoard.connectDialogGsm();
  while (ideaBoard.getNetworkStatus() != 1 && ideaBoard.getNetworkStatus() != 5) {
    delay(500);  //loop if, not in registered(1) or roaming(5) mode
  }

  Watchdog.reset();
  delay(5000);  // wait a few seconds to stabilize connection
  Watchdog.reset();
  
  //connect to Dialog NB-IOT
  if (mode=="NB-IOT") {
    if (ideaBoard.getMode()!= 38) {
      if (!ideaBoard.connectDialogNBIoT()) {
        delay(1000);
        Serial.println(F("Failed to configure Dialog NB-IoT"));
      }
    }
    else {
      if (ideaBoard.getNB_IoT_status() == 9) 
        Serial.println(F("Status : Dialog NB-IoT Online..."));
      else
        Serial.println(F("Status : Unable to connect Dialog NB-IoT network"));
    }
  }

  //connect to Dialog GSM
  else if (mode=="GSM") {
    if (int(ideaBoard.getMode()) != 13 ) {
      if (! ideaBoard.connectDialogGsm()) {
        Serial.println(F("Failed to configure Dialog GSM"));
      }
    }
    else {
      if (ideaBoard.getNB_IoT_status() == 0)
        Serial.println(F("Status : Dialog GSM Online..."));
      else
        Serial.println(F("Status : Unable to connect Dialog GSM network"));
    }
  }

  ideaBoard.setGPRSNetworkSettings(apn, username, password);

  Serial.println(F("Disabling GPRS...."));
  ideaBoard.enableGPRS(false);

  Watchdog.reset();
  delay(5000);  // wait a few seconds to stabilize connection
  Watchdog.reset();
  Serial.println(F("Enabling GPRS...."));
  if (!ideaBoard.enableGPRS(true)) {
    Serial.println(F("Failed to turn GPRS on"));
    return false;
  }
  Watchdog.reset();
  return true;
}

