import os
import cv2
import face_recognition
import pickle
import mysql.connector


db = mysql.connector.connect(
     host="localhost",
     user="root",
     passwd="",
     database="attendance_system"
)


if db.is_connected():
    print("success")

# Importing student images
    folderPath = 'Images/'
    pathList = os.listdir(folderPath)
    print(pathList)
    imgList = []
    studentIds = []


    for path in pathList:
        imgList.append(cv2.imread(os.path.join(folderPath, path)))
        studentIds.append(os.path.splitext(path)[0])


        # print(path)
        # print(os.path.splitext(path)[0])
    print(studentIds)

    #function for encode images
    def findEncodings(imagesList):
        encodeList = []
        for img in imagesList:
            img = cv2.cvtColor(img, cv2.COLOR_BGR2RGB)
            encode = face_recognition.face_encodings(img)[0]
            encodeList.append(encode)

        return encodeList

    #run the encoding then save in array called encodelistknown
    print("Encoding Started ...")
    encodeListKnown = findEncodings(imgList)
    #print(encodeListKnown)
    encodeListKnownWithIds = [encodeListKnown, studentIds]
    print("Encoding Complete")

    file = open("EncodeFile.p", 'wb')
    pickle.dump(encodeListKnownWithIds, file)
    file.close()
    print("File Saved")