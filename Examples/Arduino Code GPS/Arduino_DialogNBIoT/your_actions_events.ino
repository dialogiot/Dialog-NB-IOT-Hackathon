void createSendEvent(){

  delay(10000);  // Event trigger time gap

  Serial.println(F("Reading battery percentage left..."));
  float battLevel = ideaBoard.getBattPercent(); // Get voltage in percentage
  delay(1000);
  Serial.println(F("Enabling GPS.."));
  if(!ideaBoard.enableGPS(true)){
      Serial.println(F("Unable to Power ON GPS"));
    }
    
  float lat=NULL, lon=NULL, speed_kph=NULL, heading=NULL, altitude = NULL;

   if(!ideaBoard.getGPS(&lat, &lon, &speed_kph, &heading, &altitude)){
      Serial.println(F("Unable to get GPS location info"));
    }
    else{
      delay(2000);
      Serial.println(F("Location Found.."));
      Serial.print(F("Latitude: ")); Serial.println(lat, 6);
      Serial.print(F("Longitude: ")); Serial.println(lon, 6);
      Serial.print(F("Speed: ")); Serial.println(speed_kph);
      Serial.print(F("Heading: ")); Serial.println(heading);
      Serial.print(F("Altitude: ")); Serial.println(altitude);
      Serial.println(F("---------------------"));
      
      }
  char json[100] ={0};
  String jsonMessage =  "{\"eventName\":\"location\",\"status\":\"none\",\"lat\":"+String(lat,6)+",\"lon\":"+String(lon,6)+",\"battlevel\":"+String(battLevel)+",\"mac\":\""+DEVICE_MAC_ADDRESS+"\"}";

  jsonMessage.toCharArray(json,jsonMessage.length()+1);


  Serial.print(F("Publishing to topic :"));
    Serial.println(EVENT_TOPIC);
       Serial.println(F("Message : "));
        Serial.println(json);


  if (! sensor.publish(json)) {
      Serial.println(F("Failed"));
      txfailures++;
    } else {
      Serial.println(F("OK!"));
      txfailures = 0;
    }
}

