# Attendance-System-Using-Face-Recognition-python-mysql-php-esp32-

Of course! Here’s a **nice and clean instruction** you can put in your repository `README.md` file for the **first part** you just described:

---

# 📚 Setup Instructions

## 1. Website Setup

Follow these steps to set up the website for the Attendance System:

### Step 1: Copy Website Files
- Copy the entire website project folder into your local **XAMPP** server directory:
  ```
  C:/xampp/htdocs/
  ```
- Make sure all PHP, CSS, JavaScript, and asset files are correctly placed inside the project folder.

### Step 2: Import the Database
- Open your browser and go to **phpMyAdmin**:
  ```
  http://localhost/phpmyadmin/
  ```
- Create a **new database** named:
  ```
  attendance_system
  ```
- Click on the database, then choose **Import** from the top menu.
- Select the file **attendance_system.db** provided in this repository.
- Click **Go** to import the database structure and sample data.

After these steps, the website backend will be ready to connect to the database!

Perfect, you want a **full Step 2** section including:  
- Hardware setup (wiring)  
- Uploading Arduino code  
- Behavior explanation

Here’s the finalized version for your GitHub **Step 2**:

---

Got it —  
you want to **expand** the Step 2 documentation to **also cover a second device**, an **ESP32-CAM**, right?

So now your Step 2 should explain:  
- Setup for the first ESP32 (LCD system)  
- Setup for the second ESP32-CAM (camera system)  

---

Here’s the **updated full Step 2 documentation**, nice and organized:

---

## 📋 Step 2: Hardware Setup and Upload Arduino Code

---

### 🛠 Hardware Setup

#### 1️⃣ ESP32 with LCD (Registration Status)

Connect the ESP32 to the 16x2 I2C LCD display:

| LCD Pin | ESP32 Pin |
|:-------:|:---------:|
| VCC     | 5V        |
| GND     | GND       |
| SDA     | GPIO21    |
| SCL     | GPIO22    |

> ⚡ **Note**: Ensure the LCD is powered with **5V**, not 3.3V.

#### 2️⃣ ESP32-CAM (Camera for Image Capture)

Basic wiring for ESP32-CAM programming (using FTDI programmer):

| FTDI Programmer | ESP32-CAM |
|:---------------:|:---------:|
| 5V              | 5V        |
| GND             | GND       |
| TX              | U0R       |
| RX              | U0T       |
| GPIO0           | GND (for flashing mode) |

> ⚡ **Important**:  
> - Connect **GPIO0 to GND** only during uploading the code.  
> - Disconnect GPIO0 after flashing to run normally.

---

### 🚀 Upload Arduino Code

#### ➔ For ESP32 (LCD Display)

Upload the provided Arduino sketch for **registration status** using Arduino IDE.  
Required libraries:

- **LiquidCrystal_I2C**
- **WiFi**
- **Wire**
- **ESPAsyncWebServer**
- **AsyncTCP**

> 📚 Install them via Arduino IDE: `Tools > Manage Libraries`.

---

#### ➔ For ESP32-CAM (Image Capture)

Upload your ESP32-CAM sketch for **taking pictures** and **sending or saving images**.  
Common libraries needed:

- **WiFi**
- **ESPAsyncWebServer**
- **ESP32-Camera**

> 📸 The ESP32-CAM can be programmed to either:
> - Stream live video
> - Take a photo when triggered

(Depending on your project needs.)

---

### 📟 System Behavior

#### 🖥 ESP32 + LCD
- On startup, connects to Wi-Fi.
- LCD shows **"Waiting..."**.
- When a registration trigger (`/register`) is received:
  - LCD displays **"Marked"**.
  - After **2 seconds**, LCD resets back to **"Waiting..."**.

#### 📸 ESP32-CAM
- On startup, connects to Wi-Fi.
- Can wait for a trigger to **capture an image** and upload/send it.
- (Or can stream video if configured.)

---

### 🔄 Key Display Flow (for LCD)

```
Waiting...   --->   Marked   --->   Waiting...
          (trigger)    (2 seconds)
```

---

✅ Now both ESP32 boards are connected, programmed, and ready to operate together!

---

# 📌 Quick Checklist

✅ Connect hardware wiring  
✅ Install required libraries  
✅ Upload code for each board  
✅ Verify Wi-Fi connection  
✅ Test LCD marking and/or ESP32-CAM trigger

---


