import {Dispatch} from 'redux';
import {createAction} from '@reduxjs/toolkit';
import {handleApiError} from '../../shared/services';
import {ApiError} from '../../shared/types';
import {get} from '../../../util/http';
import {UserDetails} from '../types';

export enum GetUserDetailsActions {
  Pending = 'GET_USER_DETAILS/PENDING',
  Succeeded = 'GET_USER_DETAILS/SUCCEEDED',
  Failed = 'GET_USER_DETAILS/FAILED',
}

const pending = createAction(GetUserDetailsActions.Pending);
const succeeded = createAction<UserDetails>(GetUserDetailsActions.Succeeded);
const failed = createAction(GetUserDetailsActions.Failed);

export const getUserDetails = (id: number | string) => async (dispatch: Dispatch) => {
  dispatch(pending());

  try {
    const response = await get<UserDetails>(`users/${id}`);
    dispatch(succeeded(response.data));
  } catch (e) {
    dispatch(failed());
    handleApiError(e as ApiError);
  }
};
