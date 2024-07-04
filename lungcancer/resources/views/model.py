import numpy as np
from PIL import Image
import os
import matplotlib.pyplot as plt
import random


from tensorflow.keras.layers import Dense
from tensorflow.keras.layers import Conv2D
from tensorflow.keras.layers import MaxPooling2D
from tensorflow.keras.layers import Flatten
from tensorflow.keras.models import Sequential
from tensorflow.keras.models import load_model
from tensorflow.keras.preprocessing.image import ImageDataGenerator

import warnings
warnings.filterwarnings('ignore')
from tensorflow.keras.applications.vgg16 import preprocess_input
import cv2
import sys
lungcancers=["adenocarcinoma","largecellcarcinom","normal","squamouscellcarcinoma"]
# Step 1: Read the image
print(sys.argv[1])
image = cv2.imread(sys.argv[1])


# Step 2: Preprocess the image
resized_image = cv2.resize(image, (224, 224))
normalized_image = resized_image / 255.0
input_image = np.expand_dims(normalized_image, axis=0)

# Step 3: Load your model
model = load_model("lungcancer200.h5")
print(type(input_image))

# Step 4: Make predictions
predictions = model(input_image)


# Step 5: Interpret the predictions based on your model's output
# print(predictions[0])
pred = np.argmax(predictions[0])
print(predictions[0])
print("Model Prediction: ",lungcancers[pred])
print("==========================================")

