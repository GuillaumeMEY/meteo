import smbus2
import bme280
import time

port = 1
address = 0x76
bus = smbus2.SMBus(port)

bme280.load_calibration_params(bus, address)

# the sample method will take a single reading and return a
# compensated_reading object

# the compensated_reading class has the following attributes
while True:

	data = bme280.sample(bus, address)
	print("Température: {:.2f}°C".format(data.temperature, 2))
	print("Humidité: {:.2f}%".format(data.humidity, 2))
	print("Pression: {:.2f}hPa".format(data.pressure, 2))
	print("---------------------")

	time.sleep(2)