# Class for communicate with the openweathermap api

from dotenv import load_dotenv
import requests
import json

load_dotenv()

class ApiWeather:
    def __init__(self):
        self.api_key = os.getenv("OW_API_Key")
        self.baseUrl = "https://api.openweathermap.org"
        
    def city_data(self, city_name):
        try: 
            url = "${0}/geo/1.0/direct?q={1}&limit=5&appid={2}".format(self.baseUrl, city_name, self.api_key)
            response = requests.get(url) 
            data = json.loads(response.text)
            return data[0]["lat"], data[0]["lon"]
        except requests.ConnectionError as e:
            print("Error while connection: {0} ".format(e))
    
    # TODO: See how wee rly do error handling with requests
    def get_weather_data(self, city_lat, city_lon):
        try:    
            url = "${0}/geo/1.0/direct?q={1}&limit=5&appid={2}".format(self.baseUrl, city_name, self.api_key)
            response = requests.get(url)
            data = json.loads(response.text)
            return data
        except requests.ConnectionError as e:
            print('Error connection to the api: {0}'.format(e))
