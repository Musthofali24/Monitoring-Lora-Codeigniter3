#include <LoRa.h>

#define LORA_SCK     18
#define LORA_MISO    19
#define LORA_MOSI    23
#define LORA_SS      5
#define LORA_RST     0
#define LORA_DI00    2
#define LORA_BAND    915E6
#define TRIGGER_PIN  12
#define ECHO_PIN     13
#define DEVICE_ID_2 "2"

void setup() {
  Serial.begin(115200);
  while (!Serial);
  Serial.println("LoRa Sender");
  
  pinMode(TRIGGER_PIN, OUTPUT);
  pinMode(ECHO_PIN, INPUT);

  LoRa.setPins(LORA_SS, LORA_RST, LORA_DI00);

  while (!LoRa.begin(LORA_BAND)) {
    Serial.println("LoRa initialization failed. Waiting...");
    delay(500);
  }

  LoRa.setSyncWord(0xF3);

  Serial.println("LoRa Initialized");
}

void loop() {
  long duration, distance;
  static int counter = 0;
  
  // Membaca jarak dari sensor ultrasonik
  digitalWrite(TRIGGER_PIN, LOW);
  delayMicroseconds(2);
  digitalWrite(TRIGGER_PIN, HIGH);
  delayMicroseconds(10);
  digitalWrite(TRIGGER_PIN, LOW);
  duration = pulseIn(ECHO_PIN, HIGH);
  distance = duration * 0.034 / 2;
  
  // Menampilkan jarak ke Serial Monitor
  Serial.println(DEVICE_ID_2);
  Serial.print("Distance: ");
  Serial.print(distance);
  Serial.println(" cm");

  LoRa.beginPacket();
  LoRa.print(DEVICE_ID_2);
  LoRa.print(": Distance = ");
  LoRa.print(distance);
  LoRa.print(" cm, Counter = ");
  LoRa.print(counter);
  LoRa.endPacket();

  counter++;

  delay(100);
}
