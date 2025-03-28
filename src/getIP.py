import sys
import socket

def getIPbyHost(hostname):
    hsocket = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
    hsocket.connect(("8.8.8.8", 80))
    ip = hsocket.getsockname()[0]
    hsocket.close()
    return ip

if (len(sys.argv)) < 2:
    print ("Error: no domain name specified")
else:
    domain = sys.argv[1]
    ip = getIPbyHost(domain)
    print(ip)

