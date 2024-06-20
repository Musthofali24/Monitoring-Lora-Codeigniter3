#include <LoRa.h>
#include <WiFi.h>
#include <PubSubClient.h>
#include <ArduinoJson.h>

#define LORA_SCK     18
#define LORA_MISO    19
#define LORA_MOSI    23
#define LORA_SS      5
#define LORA_RST     14
#define LORA_DI00    26
#define LORA_DI01    35
#define LORA_DI02    34
#define BAND         915E6

#define DEVICE_ID_1 "1"
#define DEVICE_ID_2 "2"

#define WIFI_SSID "POCOPOCO"
#define WIFI_PASSWORD "POCO1234"
#define MQTT_SERVER "broker.hivemq.com"
#define MQTT_PORT 1883

WiFiClient wifiClient;
PubSubClient mqttClient(wifiClient);

void setup() {
  Serial.begin(115200);
  while (!Serial);
  Serial.println("LoRa Receiver");

  LoRa.setPins(LORA_SS, LORA_RST, LORA_DI00);

  while (!LoRa.begin(BAND)) {
    Serial.println(".");
    delay(500);
  }
  LoRa.setSyncWord(0xF3);
  Serial.println("LoRa Initialized");

  // Connect to WiFi
  Serial.print("Connecting to WiFi...");
  WiFi.begin(WIFI_SSID, WIFI_PASSWORD);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("WiFi connected");

  // Connect to MQTT broker
  mqttClient.setServer(MQTT_SERVER, MQTT_PORT);
  Serial.print("Connecting to MQTT broker...");
  while (!mqttClient.connected()) {
    if (mqttClient.connect(DEVICE_ID_1) || mqttClient.connect(DEVICE_ID_2)) {
      Serial.println("connected");
    } else {
      Serial.print(".");
      delay(500);
    }
  }
}

void loop() {
  int packetSize = LoRa.parsePacket();
  if (packetSize) {
    Serial.print("Received packet '");
    String LoRaData = "";
    while (LoRa.available()) {
      LoRaData += (char)LoRa.read();
    }
    Serial.println(LoRaData);

    StaticJsonDocument<200> jsonDocument;
    if (LoRaData.startsWith(DEVICE_ID_1)) {
      jsonDocument["device_id"] = DEVICE_ID_1;
      jsonDocument["data"] = LoRaData.substring(strlen(DEVICE_ID_1) + 1); 
    } else if (LoRaData.startsWith(DEVICE_ID_2)) {
      jsonDocument["device_id"] = DEVICE_ID_2;
      jsonDocument["data"] = LoRaData.substring(strlen(DEVICE_ID_2) + 1); 
    } else {
      Serial.println("Unknown device ID");
      return; 
    }

    String jsonString;
    serializeJson(jsonDocument, jsonString);

    mqttClient.publish("lora_data", jsonString.c_str());
    Serial.println("Published data:");
    Serial.println(jsonString);
  }

  if (!mqttClient.connected()) {
    Serial.println("Disconnected from MQTT broker. Reconnecting...");
    while (!mqttClient.connected()) {
      if (mqttClient.connect(DEVICE_ID_1) || mqttClient.connect(DEVICE_ID_2)) {
        Serial.println("Reconnected");
      } else {
        Serial.print(".");
        delay(500);
      }
    }
  }

  mqttClient.loop();
}   
