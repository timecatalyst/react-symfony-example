import {useQuery} from 'react-query';
import {useSnackbar} from 'notistack';
import {handleApiError} from '../../shared/services';
import {ApiError} from '../../shared/types';
import {UsersListItem} from '../types';
import {get} from '../../../util/http';

export const USERS_COLLECTION = 'Users';

type ResponsePayload = {
  totalItems: number;
  results: Array<UsersListItem>;
};

export default (
  pageNumber: number,
  pageSize: number,
  sortBy: string,
  sortDirection: 'asc' | 'desc',
) => {
  const {enqueueSnackbar} = useSnackbar();

  const {data, isLoading} = useQuery(
    [USERS_COLLECTION, pageNumber, pageSize, sortBy, sortDirection],
    async () => {
      const response = await get<ResponsePayload>(
        `users?pageNumber=${pageNumber}&pageSize=${pageSize}&sortBy=${sortBy}&sortDirection=${sortDirection}`,
      );
      return response.data;
    },
    {
      onError: (error: ApiError) => {
        handleApiError(error, enqueueSnackbar);
      },
    },
  );

  return {
    totalItems: data?.totalItems || 0,
    users: data?.results || [],
    isLoading,
  };
};
