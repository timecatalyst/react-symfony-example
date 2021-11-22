import {useMutation, useQueryClient} from 'react-query';
import {useSnackbar} from 'notistack';
import {USERS_COLLECTION} from './useUsersList';
import {post} from '../../../util/http';
import {handleHookFormSubmitError} from '../../shared/services';
import {ApiError, SetHookFormErrorFunction, EnqueueSnackbarVariant} from '../../shared/types';
import {UserDetails} from '../types';
import {UserFormValues} from '../schemas/userValidationSchema';

export default (setFormError: SetHookFormErrorFunction<UserFormValues>, onSuccess?: () => void) => {
  const queryClient = useQueryClient();
  const {enqueueSnackbar} = useSnackbar();

  return useMutation((data: UserFormValues) => post<UserDetails>('users', data), {
    onSuccess: () => {
      queryClient.invalidateQueries(USERS_COLLECTION);
      enqueueSnackbar('User Added Successfully', {variant: EnqueueSnackbarVariant.Success});
      if (onSuccess) onSuccess();
    },
    onError: (error: ApiError) => {
      handleHookFormSubmitError({error, setFormError, enqueueSnackbar});
    },
  });
};
