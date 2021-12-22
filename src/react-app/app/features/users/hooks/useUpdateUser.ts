import {useMutation, useQueryClient} from 'react-query';
import {useSnackbar} from 'notistack';
import {put} from '../../../util/http';
import {handleHookFormSubmitError} from '../../shared/services';
import {ApiError, SetHookFormErrorFunction, EnqueueSnackbarVariant} from '../../shared/types';
import {UserDetails} from '../types';
import {UserFormValues} from '../schemas/userValidationSchema';
import {USERS_COLLECTION} from './useUsersList';
import {USER_DETAILS} from './useUserDetails';

export default (
  id: number,
  setFormError: SetHookFormErrorFunction<UserFormValues>,
  onSuccess?: () => void,
) => {
  const queryClient = useQueryClient();
  const {enqueueSnackbar} = useSnackbar();

  return useMutation((data: UserFormValues) => put<UserDetails>(`user/${id}`, data), {
    onSuccess: () => {
      queryClient.invalidateQueries(USERS_COLLECTION);
      queryClient.invalidateQueries(USER_DETAILS);
      enqueueSnackbar('User Updated Successfully', {variant: EnqueueSnackbarVariant.Success});
      if (onSuccess) onSuccess();
    },
    onError: (error: ApiError) => {
      handleHookFormSubmitError({error, setFormError, enqueueSnackbar});
    },
  });
};
