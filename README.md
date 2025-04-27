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

## 2. Hardware Setup and Upload Arduino Code

### 🛠 Hardware Setup

Connect the ESP32 to the 16x2 I2C LCD display:

| LCD Pin | ESP32 Pin |
|:-------:|:---------:|
| VCC     | 5V        |
| GND     | GND       |
| SDA     | GPIO21    |
| SCL     | GPIO22    |

> ⚡ **Note**: Ensure the LCD is connected to **5V**, not 3.3V, for proper operation.

---

### 🚀 Upload Arduino Code

Upload the provided Arduino sketch to your ESP32 using the Arduino IDE.  
Make sure you install these libraries first:

- **LiquidCrystal_I2C**
- **WiFi**
- **Wire**
- **ESPAsyncWebServer**
- **AsyncTCP**

You can install them through Arduino Library Manager (`Tools > Manage Libraries`).

---

### 📟 System Behavior

- When the ESP32 starts, it will automatically connect to your Wi-Fi network.
- The LCD will initially display: **"Waiting..."**.
- When a registration is received (HTTP GET request to `/register`):
  - The LCD will display: **"Marked"**.
  - After **2 seconds**, the LCD will reset back to **"Waiting..."**.
- This behavior allows the ESP32 to handle multiple registrations without rebooting.

---

### 🔄 Key Display Flow

```
Waiting...   --->   Marked   --->   Waiting...
          (trigger)    (2 seconds)
```

---

