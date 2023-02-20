# Class for communicate with the openweathermap api

from dotenv import load_dotenv

load_dotenv()

class ApiWeather:
    def __init__(self):
        self.key = os.getenv("OW_API_Key")