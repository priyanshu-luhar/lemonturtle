import sys
import socket
import requests
from urllib.parse import urlparse

def getIPbyHost():
    hsocket = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
    hsocket.connect(("8.8.8.8", 80))
    ip = hsocket.getsockname()[0]
    hsocket.close()
    return ip

def getCitybyIP(ip):
    try:
        response = requests.get(f"http://ip-api.com/json/{ip}")
        data = response.json()
        if data['status'] == 'success':
            lat = data['lat']
            lng = data['lon']
            city = data['city'] + ", " + data['country']

            return [lat, lng]
        else:
            return f"Lookup failed: {data['message']}"
    except Exception as e:
        return f"Error fetching city: {e}"

def getDomain(url):
    try:
        parsed_url = urlparse(url)
        domain = parsed_url.netloc
        if domain.startswith("www."):
            domain = domain[4:] 
        return domain
    except Exception as e:
        return f"Error parsing URL: {e}"


if (len(sys.argv)) < 2:
    print ("Error: no domain name specified")
else:
    domain = getDomain(sys.argv[1])
    ip = socket.gethostbyname(domain)
    city = getCitybyIP(ip)
    myip = getIPbyHost()
    mycity = getCitybyIP(myip)
    print(city, "*", mycity)

