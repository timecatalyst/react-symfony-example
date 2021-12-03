import {useMutation, useQueryClient} from 'react-query';
import {useSnackbar} from 'notistack';
import {del} from '../../../util/http';
import {handleApiError} from '../../shared/services';
import {ApiError, EnqueueSnackbarVariant} from '../../shared/types';
import {USERS_COLLECTION} from './useUsersList';

export default (onSuccess?: () => void) => {
  const {enqueueSnackbar} = useSnackbar();
  const queryClient = useQueryClient();

  return useMutation((id: number) => del(`user/${id}`), {
    onSuccess: () => {
      queryClient.invalidateQueries(USERS_COLLECTION);
      enqueueSnackbar('User Deleted Successfully', {variant: EnqueueSnackbarVariant.Success});
      if (onSuccess) onSuccess();
    },
    onError: (error: ApiError) => {
      handleApiError(error, enqueueSnackbar);
    },
  });
};
