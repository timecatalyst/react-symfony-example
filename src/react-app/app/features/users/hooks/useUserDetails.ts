import {useQuery} from 'react-query';
import {useSnackbar} from 'notistack';
import {get} from '../../../util/http';
import {handleApiError} from '../../shared/services';
import {ApiError} from '../../shared/types';
import {UserDetails} from '../types';

export const USER_DETAILS = 'UserDetails';

export default (userId: string) => {
  const {enqueueSnackbar} = useSnackbar();

  const {data, isLoading} = useQuery(
    [USER_DETAILS, userId],
    async () => {
      const response = await get<UserDetails>(`user/${userId}`);
      return response.data;
    },
    {
      onError: (error: ApiError) => {
        handleApiError(error, enqueueSnackbar);
      },
    },
  );

  return {user: data, isLoading};
};
