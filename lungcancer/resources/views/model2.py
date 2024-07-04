import sys
import cv2
import os
import numpy as np
from tensorflow.keras.models import load_model

# Get the image path from the command-line arguments
image_path = sys.argv[1]

# Check if the file exists
if not os.path.exists(image_path):
    print(f"File not found: {image_path}")
    sys.exit(1)

# Load the image
image = cv2.imread(image_path)

# Check if the image was loaded successfully
if image is None:
    print(f"Failed to load image: {image_path}")
    sys.exit(1)

# Resize the image
resized_image = cv2.resize(image, (224, 224))

# Convert the image to a format suitable for your model
resized_image = resized_image.astype('float32') / 255.0
input_data = np.expand_dims(resized_image, axis=0)

# Load the model
model = load_model('lungcancer200.h5')

# Make a prediction
# prediction = model.predict(input_data)
# print(prediction)
print(model(input_data))