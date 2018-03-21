void createSendEvent(){

  delay(10000);  // Event trigger time gap

  Serial.println(F("Reading battery percentage left..."));
  float battLevel = ideaBoard.getBattPercent(); // Get voltage in percentage
  delay(1000);
  Serial.println(F("Reading Signal Quality..."));
  float rssi =ideaBoard.getRSSI();
  delay(1000);
 
  char json[100] ={0};
  String jsonMessage = "{\"eventName\":\"dataPush\",\"status\":\"none\",\"rssi\":"+String(rssi,2)+",\"battLevel\":"+String(battLevel)+",\"mac\":\""+DEVICE_MAC_ADDRESS+"\"}";

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

