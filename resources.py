import json

import numpy as np, os

import pandas as pd

from flask import request, abort

from flask.ext import restful

from flask.ext.restful import reqparse

from flask_rest_service import app, api

#from bson.objectid import ObjectId

path1 = '/home/ubuntu/FlaskApp/flask_rest_service/beer.pkl'

dists = pd.read_pickle(path1)

class BeerList(restful.Resource):

    def get(self,n=None):

        results1 = request.args.get('data')

        beers = results1.split(',')

        # making sure the beers in the beer list is part of the beers contained in the pivot table       
        beers = [beer for beer in beers if beer in dists.columns]

        # summing the correlation coefficients of the recommended beers 
        beers_summed = dists[beers].apply(lambda row: np.sum(row), axis=1)

        # sort the correlation coefficients
        beers_summed = beers_summed.sort_values(ascending=False)

        # only show the ranked beers that are not part of the initial request list
        ranked_beers = beers_summed.index[beers_summed.index.isin(beers)==False]

        ranked_beers = ranked_beers.tolist()

        if n is None:

            return ranked_beers

        else:

            return ranked_beers[:n]

    
# Just a dummy class to show the setup of different classes in Flask
class Root(restful.Resource):

    def get(self):

        return {

            'status': 'OK',

        }

api.add_resource(Root, '/')

api.add_resource(BeerList, '/beers/<int:n>')
