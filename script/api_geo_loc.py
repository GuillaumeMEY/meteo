import requests

class ApiGeoLoc:

    def __init__(self):
        self.ipapi_url = "https://ipapi.co"
    
    def get_public_addr(self):
        try:
            resp = requests.get("https://api64.ipify.org?format=json").json()
            print("Getting the public")
            return resp["ip"]
        except requests.ConnectionError as e:
            print("Error while connection: {0}".format(e))
    
    def get_city_by_ip(self, ip_addr):
        try:
            resp =requests.get(f"{self.ipapi_url}/{ip_addr}/json/").json()
            city_data = {
                "name": resp.get("city"),
                "lat": resp.get("latitude"),
                "lon": resp.get("longitude")
            }
            print("Getting city by ip", city_data)
            return city_data
        except requests.ConnectionError as e :
            print("Error while connection: {0}".format(e))