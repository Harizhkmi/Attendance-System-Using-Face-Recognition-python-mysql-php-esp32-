Got it! Here's the updated **README** with the modification you've requested, specifically excluding the step for dynamic IP address management and adding the instruction to run **EncodeGenerator** before running **`main.py`**.

---

# 📚 Attendance System Using Face Recognition (Python + MySQL + PHP + ESP32)

## 📌 Project Summary

This **Attendance System** uses **ESP32** and **ESP32-CAM** to **capture images** of individuals. The **Python script** then processes the image for **face recognition**, and once a match is found, it sends an **update to the MySQL database** to mark the attendance. The **PHP** web interface is used to display the **overall attendance**.

### Flow:
1. **ESP32-CAM** captures an image and sends it to the **Python server**.
2. The **Python script** uses **face recognition** to identify the individual.
3. If identified, the **Python script updates the attendance** in the **MySQL database**.
4. **PHP** displays the overall attendance on a web interface.

---

## 📋 Setup Instructions

### 1. Website Setup

Follow these steps to set up the website and database:

#### 🖥 Step 1: Copy Website Files
- Copy the entire project folder into your local **XAMPP** server directory:
  ```
  C:/xampp/htdocs/
  ```
- Make sure all PHP, CSS, JavaScript, and asset files are placed correctly inside the project folder.

#### 🗃 Step 2: Import the Database
- Open your browser and go to **phpMyAdmin**:
  ```
  http://localhost/phpmyadmin/
  ```
- Create a **new database** named:
  ```
  attendance_system
  ```
- Click on the database name, then choose **Import** from the top menu.
- Select the file **attendance_system.db** (provided in this repository).
- Click **Go** to import the database structure and sample data.

✅ After these steps, the **website backend** will be ready and connected to the database!

---

### 2. Hardware Setup and Upload Arduino Code

#### 🛠 Hardware Setup

##### 1️⃣ ESP32 with LCD (Registration Status)
Connect your **ESP32** to the **16x2 I2C LCD display** as follows:

| LCD Pin | ESP32 Pin |
|:-------:|:---------:|
| VCC     | 5V        |
| GND     | GND       |
| SDA     | GPIO21    |
| SCL     | GPIO22    |

> ⚡ **Important**: Ensure the LCD is powered from **5V**, not 3.3V.

##### 2️⃣ ESP32-CAM (Camera for Image Capture)
Connect the **ESP32-CAM** using an FTDI programmer for uploading code:

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
Upload the provided Arduino sketch for the **registration status** on your ESP32.

Required libraries:
- **LiquidCrystal_I2C**
- **WiFi**
- **Wire**
- **ESPAsyncWebServer**
- **AsyncTCP**

> 📚 Install them via Arduino IDE: `Tools > Manage Libraries`.

#### ➔ For ESP32-CAM (Image Capture)
Upload the provided ESP32-CAM sketch for **capturing images** and sending them to the **Python server** for face recognition.

Required libraries:
- **WiFi**
- **ESP32-Camera**
- **ESPAsyncWebServer**

> 📸 The ESP32-CAM captures the image of the individual and sends it to the **Python server** for processing.

---

### 📟 System Behavior

#### 🖥 ESP32 + LCD
- Upon startup, the ESP32 connects to Wi-Fi.
- The LCD initially shows **"Waiting..."**.
- When a registration trigger (`/register`) is received:
  - LCD displays **"Marked"**.
  - After **2 seconds**, the LCD resets to **"Waiting..."**.

#### 📸 ESP32-CAM
- The **ESP32-CAM** connects to Wi-Fi.
- Once triggered, it captures an image and sends it to the **Python server**.
- The Python server performs **face recognition** and, if identified, updates the attendance in the MySQL database.

---

### 🔄 Key Display Flow (for LCD)

```
Waiting...   --->   Marked   --->   Waiting...
          (trigger)    (2 seconds)
```

---

### **3. Important Step Before Running the Application**

Before running the **main.py** script, make sure to generate **encode files** for face recognition by running the **EncodeGenerator.py** script.

#### Step 1: Run EncodeGenerator
- **`EncodeGenerator.py`** will generate **encodings** for the registered faces.
- This step must be done **first** before running **`main.py`**, as it will provide the necessary encoding files that the **Python server** uses to perform face recognition.

```bash
python EncodeGenerator.py
```

> ⚡ **Note**: Ensure that the images of registered individuals are properly stored in the **images folder** for the encoding process to work.

#### Step 2: Run main.py
After the encodings are generated, you can run the **`main.py`** to start the server and process the face recognition.

```bash
python main.py
```

The **Python server** will now wait for the **ESP32-CAM** to send an image for face recognition.

---

## 📌 Quick Checklist

✅ Connect hardware wiring for both ESP32 and ESP32-CAM  
✅ Install required libraries in Arduino IDE  
✅ Upload the code to both ESP32 boards  
✅ Verify Wi-Fi connections for both devices  
✅ Run **EncodeGenerator.py** to create face encodings  
✅ Run **main.py** to start the server  
✅ Test LCD marking and ESP32-CAM capturing (with Python server)  

---

### ⚡ Final Notes

This system allows you to **automatically mark attendance** based on **face recognition** through the combination of **ESP32** for registration status and **ESP32-CAM** for image capture, powered by Python and PHP.

