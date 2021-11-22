/* eslint-disable sort-imports */
import {combineReducers} from 'redux';
import userDetails, {UserDetailsState} from './userDetails';

export type UsersState = {
  userDetails: UserDetailsState;
};

export default combineReducers({
  userDetails,
});
