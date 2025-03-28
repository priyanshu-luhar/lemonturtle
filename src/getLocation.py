import sys
from ip2geotools.geolocator import IPGeolocation
from ip2geotools.models import IpLocationModel

def get_location_from_ip(ip_address):
    try:
        if len(sys.argv) < 2:
            print("Enter an IP")
            return None
        else:
            ip_address = sys.argv[1];
        geolocator = IPGeolocation()
        location_data = geolocator.get(ip_address)
        return location_data
    except Exception as e:
        print(f"Error occurred: {e}")
        return None

ip_address = '8.8.8.8'
location = get_location_from_ip(ip_address)

if location:
    print(f"IP Address: {ip_address}")
    print(f"Country: {location.country}")
    print(f"City: {location.city}")
    print(f"Latitude: {location.latitude}")
    print(f"Longitude: {location.longitude}")
else:
    print(f"Could not retrieve location for IP address: {ip_address}")
