import numpy as np
from PIL import Image
import os
import matplotlib.pyplot as plt
import random

from flask import Flask, request, jsonify


from tensorflow.keras.layers import Dense
from tensorflow.keras.layers import BatchNormalization
from tensorflow.keras.layers import  ReLU
from tensorflow.keras.layers import GlobalAvgPool2D
from tensorflow.keras.layers import Conv2D
from tensorflow.keras.layers import MaxPooling2D
from tensorflow.keras.layers import Dropout
from tensorflow.keras.layers import  Concatenate
from tensorflow.keras.layers import  Input
from tensorflow.keras.layers import  AvgPool2D
from tensorflow.keras.layers import Flatten
from tensorflow.keras.models import Sequential
from tensorflow.keras.models import load_model
from tensorflow.keras.preprocessing.image import ImageDataGenerator
from tensorflow.keras import Model
from tensorflow.keras.utils import plot_model

from tensorflow.keras.applications.vgg16 import preprocess_input
import cv2
import sys

app = Flask(__name__)

# Dummy model prediction function
def predict(image):
    # Replace this with your actual model prediction code
    return "dummy_prediction"

@app.route('/<pathvariable>/predict', methods=['POST'])
def predict_endpoint(pathvariable):
     if int(pathvariable)==1:
        if 'image' not in request.files:
                return jsonify({"error": "No image file provided"}), 400
            
        image_file = request.files['image']
        image = Image.open(image_file).convert('RGB')


        lungcancers=["Adeno Carcinoma","Large Cell Carcinoma","Normal","Squamous Cell Carcinoma"]
        
        
        resized_image = image.resize((224, 224))


        image_array = np.array(resized_image)

        
        normalized_image = image_array / 255.0

    
        input_image = np.expand_dims(normalized_image, axis=0)

    
        model = load_model("lungcancer200.h5")
        


        predictions = model(input_image)


    
        pred = np.argmax(predictions[0])
        print(predictions[0])
        print("Model Prediction: ",lungcancers[pred])
        print("==========================================")
        prediction = "hjakjajlk"
        data = {
            'name': lungcancers[pred],
            'pred': predictions[0].numpy().tolist()  # Convert numpy array to list for JSON serialization
        }
        return jsonify(data)
     if int(pathvariable)==2:
        if 'image' not in request.files:
                return jsonify({"error": "No image file provided"}), 400
            
        image_file = request.files['image']
        image = Image.open(image_file).convert('RGB')


        lungcancers=["Adeno Carcinoma","Large Cell Carcinoma","Normal","Squamous Cell Carcinoma"]
        
        
        resized_image = image.resize((224, 224))


        image_array = np.array(resized_image)

        
        normalized_image = image_array / 255.0

    
        input_image = np.expand_dims(normalized_image, axis=0)

    
        model = load_model("lungcancer2002.h5")
        


        predictions = model(input_image)


    
        pred = np.argmax(predictions[0])
        print(predictions[0])
        print("Model Prediction: ",lungcancers[pred])
        print("==========================================")
        prediction = "hjakjajlk"
        data = {
            'name': lungcancers[pred],
            'pred': predictions[0].numpy().tolist()  # Convert numpy array to list for JSON serialization
        }
        return jsonify(data)
     if int(pathvariable)==3:
        if 'image' not in request.files:
                return jsonify({"error": "No image file provided"}), 400
            
        image_file = request.files['image']
        image = Image.open(image_file).convert('RGB')


        lungcancers=["Adeno Carcinoma","Large Cell Carcinoma","Normal","Squamous Cell Carcinoma"]
        
        
        resized_image = image.resize((224, 224))


        image_array = np.array(resized_image)

        
        normalized_image = image_array / 255.0

    
        input_image = np.expand_dims(normalized_image, axis=0)

    
        model = load_model("lungcancer200.h5")
        


        predictions = model(input_image)


    
        pred = np.argmax(predictions[0])
        print(predictions[0])
        print("Model Prediction: ",lungcancers[pred])
        print("==========================================")
        prediction = "hjakjajlk"
        data = {
            'name': lungcancers[pred],
            'pred': predictions[0].numpy().tolist()  # Convert numpy array to list for JSON serialization
        }
        return jsonify(data)
     
     
    
          
     
     
    

    
    

if __name__ == '__main__':
    app.run(debug=True)