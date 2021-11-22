import {join, flatMap} from 'lodash';
import {history} from '../../scaffolding/services';
import {ApiError, EnqueueSnackbarFunction, EnqueueSnackbarVariant} from '../types';

export default (
  error: ApiError,
  enqueueSnackbar: EnqueueSnackbarFunction = null,
  errorMessage: string = null,
) => {
  const status = error?.response?.status;
  const data = error?.response?.data;

  let snackbarMessage;
  if (typeof data === 'string') {
    snackbarMessage = errorMessage || data;
  } else if (data?.errors) {
    const flattenedErrors = flatMap(Object.values(data.errors));
    snackbarMessage = join(flattenedErrors, '. ');
  } else {
    const formattedError = error ? JSON.stringify(error) : 'Unknown';
    snackbarMessage = errorMessage || `A server error has occurred: ${formattedError}`;
  }

  switch (status) {
    case 401:
    case 403:
      history.push('/access-denied');
      break;
    case 404:
      history.push('/not-found');
      break;
    default:
      if (enqueueSnackbar) {
        enqueueSnackbar(snackbarMessage, {variant: EnqueueSnackbarVariant.Error});
      } else {
        history.push('/system-error');
      }
      break;
  }
};
