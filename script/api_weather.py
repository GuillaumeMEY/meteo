# Class for communicate with the openweathermap api

from dotenv import load_dotenv
import requests
import json
import os

load_dotenv()

# TODO: Return success for herror handling
class ApiWeather:
    def __init__(self):
        self.api_key = os.getenv("OW_API_Key")
        self.baseUrl = "https://api.openweathermap.org"
    
    # Get lon and lat from a city name
    def get_city_data(self, city_name):
        try: 
            url = f"{self.baseUrl}/geo/1.0/direct?q={city_name}&limit=5&appid={self.api_key}"
            response = requests.get(url) 
            data = json.loads(response.text)
            return data[0]["lat"], data[0]["lon"]
        except requests.ConnectionError as e:
            print("Error while connection: {0} ".format(e))
    
    # Get weather data from the api openWeatherMap
    def get_weather_data(self, city_lat, city_lon):
        try:    
            url = f"{self.baseUrl}/data/2.5/weather?lat={city_lat}&lon={city_lon}&appid={self.api_key}&units=metric"
            response = requests.get(url)
            data = json.loads(response.text)
            return data
        except requests.ConnectionError as e:
            print('Error connection to the api: {0}'.format(e))

    
