import smbus2
import bme280

class Sensor:

    def __init__(self):
        port= 1
        self.address = 0x76
        self.bus = smbus2.SMBus(port)
    
    def get_data(self):
        bme280.load_calibration_params(self.bus, self.address)
        data = bme280.sample(self.bus, self.address)
        if(data == ""):
            print("Error while getting data")
        print(data)
        data_formated = {
            "temp": str(int(data.temperature)),
            "humidity": str(int(data.humidity)),
            "pressure": str(int(data.pressure)),
        }
        print(data)
        print("Getting sensor data")
        return data_formated

