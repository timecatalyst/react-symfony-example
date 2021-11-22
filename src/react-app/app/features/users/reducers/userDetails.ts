/* eslint-disable no-param-reassign */
import {createReducer, PayloadAction} from '@reduxjs/toolkit';

import {UserDetails, UserGender} from '../types';
import {GetUserDetailsActions, UpdateUserDetailsActions} from '../actions';

export type UserDetailsState = {
  isLoading: boolean;
  isSaving: boolean;
  userDetails: UserDetails;
};

const INITIAL_STATE: UserDetailsState = {
  isLoading: false,
  isSaving: false,
  userDetails: {
    id: 0,
    name: '',
    email: '',
    gender: UserGender.Male,
    active: false,
  },
};

export default createReducer(INITIAL_STATE, {
  [GetUserDetailsActions.Pending]: (state) => {
    state.isLoading = true;
  },

  [GetUserDetailsActions.Succeeded]: (state, action: PayloadAction<UserDetails>) => {
    state.isLoading = false;
    state.userDetails = action.payload;
  },

  [GetUserDetailsActions.Failed]: (state) => {
    state.isLoading = false;
  },

  [UpdateUserDetailsActions.Pending]: (state) => {
    state.isSaving = true;
  },

  [UpdateUserDetailsActions.Succeeded]: (state, action: PayloadAction<UserDetails>) => {
    state.isSaving = false;
    state.userDetails = action.payload;
  },

  [UpdateUserDetailsActions.Failed]: (state) => {
    state.isSaving = false;
  },
});
