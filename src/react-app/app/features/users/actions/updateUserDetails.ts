import {Dispatch} from 'redux';
import {createAction} from '@reduxjs/toolkit';
import {handleHookFormSubmitError} from '../../shared/services';
import {ApiError, EnqueueSnackbarFunction, SetHookFormErrorFunction} from '../../shared/types';
import {put} from '../../../util/http';
import {UserDetails} from '../types';
import {UserFormValues} from '../schemas/userValidationSchema';

export enum UpdateUserDetailsActions {
  Pending = 'UPDATE_USER_DETAILS/PENDING',
  Succeeded = 'UPDATE_USER_DETAILS/SUCCEEDED',
  Failed = 'UPDATE_USER_DETAILS/FAILED',
}

const pending = createAction(UpdateUserDetailsActions.Pending);
const succeeded = createAction<UserDetails>(UpdateUserDetailsActions.Succeeded);
const failed = createAction(UpdateUserDetailsActions.Failed);

export const updateUserDetails = (
  id: number,
  data: UserFormValues,
  setFormError: SetHookFormErrorFunction<UserFormValues>,
  enqueueSnackbar: EnqueueSnackbarFunction,
  onSuccess?: () => void,
) => async (dispatch: Dispatch) => {
  dispatch(pending());

  try {
    const response = await put<UserDetails>(`user/${id}`, data);
    dispatch(succeeded(response.data));
    if (onSuccess) onSuccess();
  } catch (e) {
    dispatch(failed());
    handleHookFormSubmitError({error: e as ApiError, setFormError, enqueueSnackbar});
  }
};
