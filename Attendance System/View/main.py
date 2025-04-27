import os
import pickle
import cv2
import cvzone
import face_recognition
import requests
import numpy as np
import mysql.connector
from datetime import datetime
import urllib.request

url='http://192.168.18.178/cam-hi.jpg'

#directly capture from webcam or laptop camera
#cap = cv2.VideoCapture(1) 

#connecting to database
db = mysql.connector.connect(
     host="localhost",
     user="root",
     passwd="",
     database="attendance_system"
)


if db.is_connected():
    print("success")

    mycursor=db.cursor()
    sql="INSERT INTO attendance (Student_ID, status, date) " \
    "SELECT student.Student_ID, 'Absent', CURRENT_DATE " \
    "FROM student " \
    "WHERE NOT EXISTS (" \
    "   SELECT 1 " \
    "   FROM attendance " \
    "   WHERE attendance.Student_ID	= student.Student_ID " \
    "   AND attendance.date = CURRENT_DATE" \
    ")"
    mycursor.execute(sql)
    db.commit()

    imgBackground = cv2.imread('Resources/background.png')

# Importing the mode images into a list
    folderModePath = 'Resources/Models'
    modePathList = os.listdir(folderModePath)
    imgModeList = []
    for path in modePathList:
        imgModeList.append(cv2.imread(os.path.join(folderModePath, path)))

    # Load the encoding file
    print("Loading Encode File ...")
    file = open('EncodeFile.p', 'rb')
    encodeListKnownWithIds = pickle.load(file)
    file.close()
    encodeListKnown, studentIds = encodeListKnownWithIds
    print(studentIds)
    print("Encode File Loaded")

    modeType=0
    counter=0
    id=-1

    while True:
        #success, img = cap.read()
        img_resp=urllib.request.urlopen(url)
        imgnp=np.array(bytearray(img_resp.read()),dtype=np.uint8)
        
        img=cv2.imdecode(imgnp,-1)


        #resize image
        imgS = cv2.resize(img, (0, 0), None, 0.25, 0.25)
        imgS = cv2.cvtColor(imgS, cv2.COLOR_BGR2RGB)

        #take image location
        faceCurFrame = face_recognition.face_locations(imgS)
        encodeCurFrame = face_recognition.face_encodings(imgS, faceCurFrame)

        imgBackground= img
        #imgBackground[44:44 + 633, 808:808 + 414] = imgModeList[modeType]

        #check for matches face
        for encodeFace, faceLoc in zip(encodeCurFrame, faceCurFrame):
                matches = face_recognition.compare_faces(encodeListKnown, encodeFace)
                faceDis = face_recognition.face_distance(encodeListKnown, encodeFace)
                #print("matches", matches)#true if matched face
                #print("faceDis", faceDis)#match values(how close it is, the lower the better)

                matchIndex = np.argmin(faceDis)
                #print("Match Index", matchIndex)

                if matches[matchIndex]:
                    #print("Known Face Detected")
                    #print(studentIds[matchIndex])
                    y1, x2, y2, x1 = faceLoc
                    y1, x2, y2, x1 = y1 * 4, x2 * 4, y2 * 4, x1 * 4
                    bbox = 55 + x1, 162 + y1, x2 - x1, y2 - y1
                    imgBackground = cvzone.cornerRect(imgBackground, bbox, rt=0)
                    id = studentIds[matchIndex]
                    if counter==0:
                        counter =1
                        modeType =1
        if counter!=0:
            
            # Fetch Data From Database
            if counter ==1:
                mycursor.execute("SELECT * FROM attendance")
                studentInfo = mycursor.fetchall()
                for row in studentInfo:
                    if (row[1]==id):
                        if(row[2]=="Absent"):
                        #studentName=row[0]
                        #studentContact=row[2]
                        #studentProgram=row[3]
                        #studentClass=row[4]

                            Student_ID = id  # The student ID you want to update
                            date = datetime.now().strftime('%Y-%m-%d')  # The date for which you want to update the attendance
                            status = "Present"  # The status you want to set (Present, Late, Absent)
                            timeIn = datetime.now().strftime('%H:%M:%S')  # Current time in HH:MM:SS format

                            # SQL query to update the status and time for a specific student and date
                            query = """
                                UPDATE attendance
                                SET status = %s, timeIn = %s
                                WHERE Student_ID = %s AND date = %s
                            """

                            # Values to bind to the query
                            values = (status, timeIn, Student_ID, date)

                            # Execute the update query
                            mycursor.execute(query, values)

                            # Commit the changes to the database
                            db.commit()

                            esp32_ip = "http://192.168.18.130"  # Replace with actual IP
                            try:
                                r = requests.get(f"{esp32_ip}/trigger")
                                print("Response:", r.text)
                            except Exception as e:
                                print("Error:", e)



                            #Image=cv2.imread(f'Images/{id}.png')
                    
                            print(row[0], row[1], row[2])
                        else:
                            print("Already Marked")
                            print(row[0], row[1], row[2])
                            

            if 10<counter<20:
                modeType = 2
                
            imgBackground = imgModeList[modeType]

            
            #if counter<=10:

                #Output Name
             #   (w, h), _ = cv2.getTextSize(studentName, cv2.FONT_HERSHEY_DUPLEX, 1, 1)
             #   offset = (414 - w) // 2
             #   cv2.putText(imgBackground, str(studentName), (808 + offset, 445),
             #          cv2.FONT_HERSHEY_DUPLEX, 1, (50, 50, 50), 1)

                #Output ID
              #  cv2.putText(imgBackground, str(id), (1006, 493),
              #          cv2.FONT_HERSHEY_DUPLEX, 0.5, (255, 255, 255), 1)

                #Output Program
               # cv2.putText(imgBackground, str(studentProgram), (1006, 550),
               #       cv2.FONT_HERSHEY_DUPLEX, 0.5, (255, 255, 255), 1)


               # imgBackground[175:175 + 216, 909:909 + 216] = Image

            counter +=1

            if counter>=20:
                counter = 0
                modeType = 0
                studentInfo = []
                Image = []



        #display on screen
        #cv2.imshow("Webcam", img)
        cv2.imshow("Face Attendace", imgBackground)
        cv2.waitKey(1)
