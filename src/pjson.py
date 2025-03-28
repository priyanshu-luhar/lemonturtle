import sys
import json


if len(sys.argv) < 2:
    print("Error in printing the json file")
else:
    filename = sys.argv[1]
    with open(filename, 'r') as jFile:
        parsedJson = json.load(jFile)
        print(json.dumps(parsedJson, indent = 2))
