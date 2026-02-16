import nltk
from nltk.corpus import stopwords
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity
import random
import re
import string
import speech_recognition as sr
import pyttsx3
import requests
from flask import Flask, render_template, request, jsonify, send_from_directory
import os
from bs4 import BeautifulSoup

app = Flask(__name__)

@app.route('/')
def home():
    return render_template('index.html')

# define the route to serve the image file
@app.route('/images/<filename>')
def serve_image(filename):
    root_dir = os.getcwd()
    return send_from_directory(os.path.join(root_dir, 'static', 'images'), filename)

#response = requests.get('http://localhost/restaurant.php')
#myText = response.text
#response = requests.get('http://localhost/backend/restaurant.php')
#soup = BeautifulSoup(response.content, 'html.parser')
#myText = soup.get_text()


f = open('restuarant.txt')
myText = f.read()
#myText = myText.lower() #the text is converted into the lower case for easier processing.

def user_text_process(text):
    text = text.lower()
    return nltk.word_tokenize(text)

myText_sent = nltk.sent_tokenize(myText)

def greeting_response(greeting):
    greeting_inputs = ("hey", "hello", "hello brainy", "howdy", "greetings", "good morning", "good afternoon", "good evening", "hi", "what's up")
    brainy_response = ["hey", "hey, what do you want know?", "hi", "hello, what do you wanna ask?", "hello", "Welcome"]
    if greeting in greeting_inputs:
        return random.choice(brainy_response)

def generate_response(user_input):
    global myText_sent
    brainy_response = ''

    # Check for goodbye message
    if user_input == 'bye' or user_input == 'bye brainy':
        bye = random.choice(['Bye human','Take care'])
        return bye
        
    # Check for greeting
    greeting = greeting_response(user_input)
    if greeting != None:
        return greeting
	 
    # Check for specific questions
    if 'what is your name' in user_input:
        return "My name is Mr. Krabs, and I'm here to assist you."
        
    elif any(word in user_input for word in ["restaurant's origin", "inspiration", "origin", "inspire", "inspired", "theme", "themed", "name", "design", "story"]):
        brainy_response = "The restaurant was originally created from a TV show; 'SPONGEBOB SQUARE PANTS'. A restaurant under the realms. A mimic of being under the sea, with sharks around you, and blue waters engulfing."
        return brainy_response
    
    myText_sent.append(user_input)
    word_vectorizer = TfidfVectorizer(tokenizer = user_text_process, stop_words='english')
    all_word_vectors = word_vectorizer.fit_transform(myText_sent)
    similar_vector_values = cosine_similarity(all_word_vectors[-1], all_word_vectors)
    similar_sentence_number = similar_vector_values.argsort()[0][-2]

    matched_vector = similar_vector_values.flatten()
    matched_vector.sort()
    vector_matched = matched_vector[-2]

    if vector_matched == 0:
        brainy_response = "I am sorry, I do not understand what you are asking me."
    else:
        brainy_response = myText_sent[similar_sentence_number]
    
    # Remove user_input from myText_sent so it doesn't repeat the same response
    myText_sent = myText_sent[:-1]
        
    return brainy_response


@app.route('/chat', methods=['POST'])
def chat():
    user_message = request.form['text']
    response = generate_response(user_message)
    return jsonify({'text': response})

if __name__ == '__main__':
    app.run(debug=True)
