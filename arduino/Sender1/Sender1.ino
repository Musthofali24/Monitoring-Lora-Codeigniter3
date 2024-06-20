#include <DHT.h>
#include <LoRa.h>

// Pin definitions
#define DHTPIN 32          // Pin connected to the DHT11 sensor
#define DHTTYPE DHT11      // DHT 11
#define LORA_SCK 18
#define LORA_MISO 19
#define LORA_MOSI 23
#define LORA_SS 5
#define LORA_RST 14
#define LORA_DI00 26
#define LORA_DI01 35
#define LORA_DI02 34
#define BAND 915E6
#define DEVICE_ID_1 "1"

// Initialize DHT sensor
DHT dht (DHTPIN, DHTTYPE);

void setup() {
  // Initialize serial communication
  Serial.begin(115200);
  while (!Serial);
  Serial.println("LoRa Sender");

  // Initialize LoRa with the defined pins
  LoRa.setPins(LORA_SS, LORA_RST, LORA_DI00);

  // Try to begin LoRa communication and handle errors
  while (!LoRa.begin(BAND)) {
    Serial.println(".");
    delay(500);
  }
  LoRa.setSyncWord(0xF3);
  Serial.println("LoRa Initialized");

  // Initialize the DHT sensor
  dht.begin();
}

void loop() {
  static int counter = 0;

  // Read temperature from DHT sensor
  float temperature = dht.readTemperature();

  // Check if the reading is valid
  if (isnan(temperature)) {
    Serial.println("Failed to read from DHT sensor!");
    return;
  }

  // Print the device ID and temperature to the serial monitor
  Serial.println(DEVICE_ID_1);
  Serial.print("Temperature is (°C) :");
  Serial.println(temperature);

  // Send the data over LoRa
  LoRa.beginPacket();
  LoRa.print(DEVICE_ID_1);
  LoRa.print(": Temperature = ");
  LoRa.print(temperature);
  LoRa.print(", Counter = ");
  LoRa.print(counter);
  LoRa.endPacket();

  // Increment the counter for each loop iteration
  counter++;

  // Wait for 3 seconds before the next loop
  delay(100);
}