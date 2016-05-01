# activate the virtual environment containing the Flask and other libraries
activate_this = '/home/ubuntu/FlaskApp/FlaskApp/venv/bin/activate_this.py'
execfile(activate_this, dict(__file__=activate_this))

import sys
import logging
logging.basicConfig(stream=sys.stderr)

# Inserts the directory containing this .wsgi file into the system path
sys.path.insert(0,"/home/ubuntu/FlaskApp/")


# This is a key statement to import this directory as the application for this wsgi file
from flask_rest_service import app as application

# optional statement
application.secret_key = 'Add your secret key'
