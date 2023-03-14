from database import Database
from api_weather import ApiWeather
from api_geo_loc import ApiGeoLoc
from sensor import Sensor

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
    temp = api_response["main"]["temp"]
    humidity = api_response["main"]["humidity"]
    pressure = api_response["main"]["pressure"]
    weather = api_response["weather"][0]["main"]
    
    return {
        # int(temp) for avoid float 
        "temp": str(int(temp)),
        "humidity":str(humidity),
        "pressure":str(pressure),
        "weather":weather
    }
    



def main():
    # Declare and init Class
    database = Database()
    api_weather = ApiWeather()
    api_geo_loc = ApiGeoLoc()
    sensor = Sensor()
    

    my_ip = api_geo_loc.get_public_addr()
    my_city = api_geo_loc.get_city_by_ip(my_ip)

    
    # Get the current weather data of the city 
    api_weather_response = api_weather.get_weather_data(my_city["lat"], my_city["lon"])

    print(api_weather_response)
    weather_data = data_extraction(api_weather_response)
    
    # Getting data from the sensor
    data_sensor = sensor.get_data()
    
    data = [
         ("temp", weather_data['temp'], "api"),
         ("humidity", weather_data['humidity'], "api"),
         ("pression", weather_data['pressure'], "api"),
         ("weather", weather_data['weather'], "api"),
         ("temp", data_sensor['temp'], "sensor"),
         ("humidity", data_sensor['humidity'], "sensor"),
         ("pressure", data_sensor['pressure'], "sensor"),
     ]
    
    database.insert_into_Measures(data)
    
    # For push modification into the database
    database.con.commit()

    database.close_connection()


if __name__ == '__main__':
    main()