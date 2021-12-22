/* eslint-disable sort-imports */
/* eslint-disable camelcase */
/* eslint-disable object-shorthand */
import {combineReducers} from 'redux';
import {createReducer} from '@reduxjs/toolkit';

export type ApplicationState = {
  features: null;
};

const createRootReducer = () => combineReducers({features: createReducer({}, {})});

export default createRootReducer;
