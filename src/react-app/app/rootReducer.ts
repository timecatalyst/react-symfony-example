/* eslint-disable sort-imports */
/* eslint-disable camelcase */
/* eslint-disable object-shorthand */
import {combineReducers} from 'redux';

import users, {UsersState} from './features/users/reducers';

export type ApplicationState = {
  features: {
    users: UsersState;
  };
};

const createRootReducer = () =>
  combineReducers({
    features: combineReducers({
      users: users,
    }),
  });

export default createRootReducer;
