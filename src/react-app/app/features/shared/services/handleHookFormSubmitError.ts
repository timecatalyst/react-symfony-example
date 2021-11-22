import {forIn} from 'lodash';
import {FieldName, FieldValues} from 'react-hook-form';
import handleApiError from './handleApiError';
import {
  ApiError,
  ApiErrorResponseData,
  EnqueueSnackbarFunction,
  SetHookFormErrorFunction,
} from '../types';

export type HandleHookFormSubmitErrorParameters<TFormValues extends FieldValues> = {
  error: ApiError;
  setFormError: SetHookFormErrorFunction<TFormValues>;
  setGeneralValidationErrors?: (errors: string[]) => void;
  enqueueSnackbar?: EnqueueSnackbarFunction;
  errorMessage?: string;
};

export default <TFormValues extends FieldValues>({
  error,
  setFormError,
  enqueueSnackbar = null,
  errorMessage = null,
}: HandleHookFormSubmitErrorParameters<TFormValues>) => {
  const data = error?.response?.data as ApiErrorResponseData;
  const apiValidationErrors = data?.errors;

  if (error?.response?.status === 422 && apiValidationErrors) {
    forIn(apiValidationErrors, (message, field) => {
      setFormError(field as FieldName<TFormValues>, {message: message.join(' ')});
    });
  } else {
    handleApiError(error, enqueueSnackbar, errorMessage);
  }
};
