import requests

class ApiGeoLoc:

    def __init__(self):
        self.api64_url = "https://api64.ipify.org?",
        self.ipapi_url = "'https://ipapi.co/"
    
    def get_public_addr(self):
        try:
            resp = requests.get('{0}format=json'.format(self.api64_url)).json()
            print("Getting the public")
            return resp["ip"]
        except requests.ConnectionError as e:
            print("Error while connection: {0}".format(e))
    
    def get_city_by_ip(self, ip):
        try:
            resp =requests.get('{0}{1}/json/'.format(ip, self.ipapi_url)).json()
            city_data = {
                "name": resp.get("city"),
                "lat": resp.get("latitude"),
                "lon": resp.get("longitude")
            }
            print("Getting city by ip", city_data)
            return city_data
        except requests.ConnectionError as e :
            print("Error while connection: {0}".format(e))