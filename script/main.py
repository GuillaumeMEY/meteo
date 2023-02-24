import mariadb
import sys
import requests
import json
import datetime
from database import Database
from api_weather import ApiWeather
from api_geo_loc import ApiGeoLoc

"""
    Todo:
       - Refactor the code for POO
       - Refactor name function to snake_case
       - Geolocalisation 
       - write requirement txt
"""

def connectDatabase():
    try:
        conn = mariadb.connect(
            user="cesi",
            password="cesi",
            host="localhost",
            port=3306,
            database="weather"

        )
        print("Connection initialised with mariadb")
    except mariadb.Error as e:
        print("Error connecting to Mariadb: {0}".format(e))
        sys.exit(1)

    return conn, conn.cursor()

   
def handleGetCityData(city_data, _db : mariadb.Cursor) -> Union[float, float, int]:
    isData, lat, lon, id = getCityDateFromDB(city_data.name, _db)
    if isData:
        return lat, lon, id
    id = storeNewCityInDB(city_data["name"], city_data["lat"], city_data["lon"], _db)
    return lat, lon, id



def getCityDateFromDB(city_name : str, _db : mariadb.Cursor) -> Union[bool, float, float, int]:
    try:
        query = "SELECT lat, lon, id FROM city WHERE name=%s"
        data = (city_name,)
        _db.execute(query, data)
        row = _db.fetchall()
        if not row:
            return False, 0, 0, 0

        return True, row[0][0], row[0][1], row[0][2]

    except mariadb.Error as e:
        print("Error retrieving entry from database: {0}".format(e))
    return False, 0, 0, 0

def getCityDataFromApi(city_name) -> Union[float, float]:
    api_url = "http://api.openweathermap.org/geo/1.0/direct?q={0}&limit=5&appid={1}".format(city_name, "0554aa483aa31c4b4aa9cf79d18542e1")
    response = requests.get(api_url)
    data = json.loads(response.text)
    return data[0]["lat"], data[0]["lon"]

def storeNewCityInDB(city_name, city_lat, city_lon, _db) -> int:
    try:
        query = "INSERT INTO city (lat, lon, name) values(?, ?, ?)"
        data = (city_lat, city_lon, city_name)
        _db.execute(query, data)
        print("City data stored")
        return _db.lastrowid
    except mariadb.Error as e:
        print("Error inserting data in city table: {0}".format(e))

    
def getWeatherApi(city_lat, city_lon):
    
    url = "https://api.openweathermap.org/data/2.5/weather?lat={0}&lon={1}&appid={2}&units=metric".format(city_lat, city_lon, "0554aa483aa31c4b4aa9cf79d18542e1")
    response = requests.get(url)

    data = json.loads(response.text)
    return data

def storeWeatherApiInDB(api_data, city_id, day_id, _db):
    try:
        query = "INSERT INTO api_weather(city_id, weather, temp, humidity, pressure, day_id) values(?,?,?,?,?,?)"
        data = (city_id, api_data["weather"][0]["main"], api_data["main"]["temp"], api_data["main"]["humidity"], api_data["main"]["pressure"], day_id)
        _db.execute(query, data)
        print("Api weather data stored")
    except mariadb.Error as e:
        print("Error inserting data in api_weather: {0}".format(e))

def getCurrentDayId(_db : mariadb.Cursor) -> int:
    try: 
        query = "SELECT id FROM day WHERE date=?"
        data = (datetime.date.today(),)
        _db.execute(query, data)
        row = _db.fetchall()
        if  not row:
            id = createNewDay(_db)
            return id
        id = row[0][0]
        return id
    except mariadb.Error as e:
        print("Error retrieving data from day table: {0}".format(e))


def createNewDay(_db : mariadb.Cursor) -> int:
    try:
        query = "INSERT INTO day(date) VALUES (?)"
        data = (datetime.date.today(),)
        _db.execute(query, data)
        print("New day created")
        id = _db.lastrowid
        return id
    except mariadb.Error as e:
        print("Error create day: {0}".format(e))


def handleGeolocation():
    ip_addr = getPublicIp()
    city_data = locatePublicIp(ip_addr)

    return city_data


#Get the pubic ip
def getPublicIp() -> str:
    resp = requests.get('https://api64.ipify.org?format=json').json()
    print(resp)
    return resp["ip"]

# Locate the ip add
def locatePublicIp(ip_addr : str):
    resp =requests.get(f'https://ipapi.co/{ip_addr}/json/').json()
    city_data = {
        "name": resp.get("city"),
        "lat": resp.get("latitude"),
        "lon": resp.get("longitude")
    }

    print("city_data", city_data)

    return city_data
#uxaq1861eu2jtf3j api key https://ipregistry.co/

#8898a6c67188d817f2fba8a72419b1a4 https://www.whatismyip.com/login-welcome-page/

"""
    Algo:
        - Get the ip
        - Get the city by the ip
        - Get data information of the city long, lat
        - Get weather by api
        - Get measures by captor
        - Store it to the db
"""
def data_extraction(api_response):
    # data = (city_id, api_data["weather"][0]["main"], api_data["main"]["temp"], api_data["main"]["humidity"], api_data["main"]["pressure"], day_id)
    temp = api_response["main"]["temp"]
    humidity = api_response["main"]["humidity"]
    pressure = api_response["main"]["pressure"]
    weather = api_response["weather"][0]["main"]
    
    return {
        "temp": str(int(temp)),
        "humidity":str(humidity),
        "pressure":str(pressure),
        "weather":weather
    }
    



def main():

    # conn, db = connectDatabase()

    # city_data = handleGeolocation()

    # day_id = getCurrentDayId(db)

    # city_lat, city_lon, city_id = handleGetCityData(city_data, db)

    # weather_api = getWeatherApi(city_lat, city_lon)
    # storeWeatherApiInDB(weather_api, city_id, day_id, db)
    # # Push the change into the db
    # conn.commit()
    
    # Declare and init Class
    database = Database()
    api_weather = ApiWeather()
    # api_geo_loc = ApiGeoLoc()
    

    # my_ip = api_geo_loc.get_public_addr()
    # my_city = api_geo_loc.get_city_by_ip(my_ip)
    
    # Get latitude and logitude of the city for the OpenWeatherMap api
    city_lat, city_lon = api_weather.get_city_data("pau")
    
    # Get the current weather data of the city 
    api_weather_response = api_weather.get_weather_data(city_lat, city_lon)

    weather_data = data_extraction(api_weather_response)
    
    
    data = [
        ("temp", weather_data['temp'], "api"),
        ("humidity", weather_data['humidity'], "api"),
        ("pression", weather_data['pressure'], "api"),
        ("weather", weather_data['weather'], "api")
    ]
    
    database.insert_into_Measures(data)
    
    # For push modification into the database
    database.con.commit()

    database.close_connection()


if __name__ == '__main__':
    main()