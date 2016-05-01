import os

from flask import Flask

from flask.ext import restful

#from flask import make_response

#from bson.json_util import dumps

app = Flask(__name__)

#DEFAULT_REPRESENTATIONS = {'application/json': output_json}

api = restful.Api(app)

#api.representations = DEFAULT_REPRESENTATIONS

import flask_rest_service.resources