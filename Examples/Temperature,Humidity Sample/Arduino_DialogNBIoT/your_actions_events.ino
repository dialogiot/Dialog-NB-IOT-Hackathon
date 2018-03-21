void createSendEvent(){

  delay(10000);  // Event trigger time gap

  Serial.println(F("Reading battery percentage left..."));
  float battLevel = ideaBoard.getBattPercent(); // Get voltage in percentage
  delay(1000);

  float humidity = bme.readHumidity();
  delay(1000);
  float temperature= bme.readTemp();
  
 
  char json[100] ={0};
  String jsonMessage = "{\"eventName\":\"DataPubllish\",\"status\":\"none\",\"humidity\":"+String(humidity)+",\"temperature\":"+String(temperature)+",\"mac\":\""+DEVICE_MAC_ADDRESS+"\"}";

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

