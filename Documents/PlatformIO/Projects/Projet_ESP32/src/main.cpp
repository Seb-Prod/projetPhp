#include <WiFi.h>
#include <PubSubClient.h>
#include <cstring>
#include "esp_wpa2.h"
#include "esp_wifi.h"

// --- CONFIGURATION WI-FI (WPA2-Enterprise) ---
const char* ssid = "Pedagogie CCI";
const char* identity = "ludovic.denis@edu.esiee-it.fr"; // identity/email
const char* username = "ludovic.denis@edu.esiee-it.fr"; // username (set to identity/email)
const char* password = "Illid4nn33**"; // your Wi‑Fi password

// --- CONFIGURATION MQTT ---
const char* mqtt_server = "10.160.24.154"; // L'IP de ton Raspberry

WiFiClient espClient;
PubSubClient client(espClient);

#ifdef __cplusplus
extern "C" {
#endif
uint8_t temprature_sens_read();
#ifdef __cplusplus
}
#endif

void setup() {
  Serial.begin(115200);
  delay(10);

  WiFi.disconnect(true); // Nettoie les anciennes configs
  WiFi.mode(WIFI_STA);

  // Configuration WPA2 Enterprise
  esp_wifi_sta_wpa2_ent_set_identity((uint8_t *)identity, strlen(identity));
  esp_wifi_sta_wpa2_ent_set_username((uint8_t *)username, strlen(username));
  esp_wifi_sta_wpa2_ent_set_password((uint8_t *)password, strlen(password));
  esp_wifi_sta_wpa2_ent_enable();

  Serial.println("Connexion au WiFi Enterprise...");
  WiFi.begin(ssid);

  int counter = 0;
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
    counter++;
    if(counter >= 60) { // Si après 30 sec ça ne marche pas, on redémarre
      Serial.println("\nÉchec connexion, restart...");
      ESP.restart();
    }
  }

  Serial.println("\nWiFi OK (Enterprise)");
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());

  client.setServer(mqtt_server, 1883);
}

void loop() {
  if (!client.connected()) {
    if (client.connect("ESP32_Ludo")) {
       Serial.println("MQTT Connecté !");
    } else {
       delay(5000); return;
    }
  }
  client.loop();

  // Lecture du capteur interne (Fahrenheit vers Celsius)
  float temp_c = (temprature_sens_read() - 32) / 1.8;
  
  char msg[10];
  dtostrf(temp_c, 4, 1, msg);
  
  Serial.print("Temp interne ESP32: "); Serial.println(msg);
  client.publish("esp32/temp", msg); // On envoie sur un topic différent
  
  delay(5000);
}