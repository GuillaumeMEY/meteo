import smbus2
import bme280

class Sensor:

    def __init_(self):
        self.port: 1
        self.address = 0x76
        self.bus = smbus2.SMBus(self.port)
    
    def get_data(self):
        data = bme280.load_calibration_params(bus, address)
        if(data == ""):
            print("Error while getting data")
        data_formated = {
            "temp": int(data.temparature),
            "humidity": int(data.humidity),
            "pressure": int(data.pressure),
        }
        print("Getting sensor data")
        return data_formated

port = 1
address = 0x77
bus = smbus2.SMBus(port)

bme280.load_calibration_params(bus, address)

# the sample method will take a single reading and return a
# compensated_reading object
data = bme280.sample(bus, address)

# the compensated_reading class has the following attributes
print(data.temperature)
print(data.humidity)