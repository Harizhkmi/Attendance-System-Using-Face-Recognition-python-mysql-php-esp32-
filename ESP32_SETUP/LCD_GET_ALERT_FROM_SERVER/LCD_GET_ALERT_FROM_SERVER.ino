#include <WiFi.h>
#include <Wire.h>
#include <LiquidCrystal_I2C.h>
#include <ESPAsyncWebServer.h>

LiquidCrystal_I2C lcd(0x27, 16, 2);  // Or use 0x3F if this doesn't work

const char* ssid = "YOUR_WIFI_SSID";
const char* password = "YOUR_WIFI_PASSWORD";

AsyncWebServer server(80);

unsigned long messageShownAt = 0;
bool showingReceived = false;

void setup() {
  Serial.begin(115200);
  lcd.init();
  lcd.backlight();

  lcd.setCursor(0, 0);
  lcd.print("Connecting WiFi");

  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("\n✅ WiFi connected");
  Serial.print("IP: ");
  Serial.println(WiFi.localIP());

  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("Waiting...");

  // When Python sends a GET request to /trigger
  server.on("/trigger", HTTP_GET, [](AsyncWebServerRequest *request){
    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print("Marked!");
    messageShownAt = millis();
    showingReceived = true;
    Serial.println("✅ Trigger received!");
    request->send(200, "text/plain", "ESP32 got it!");
  });

  server.begin();
  Serial.println("🚀 Server started");
}

void loop() {
  // Check if "Received!" message has been shown for more than 2 seconds
  if (showingReceived && millis() - messageShownAt > 2000) {
    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print("Waiting...");
    showingReceived = false;
  }
}
