import {useQuery} from 'react-query';
import {useSnackbar} from 'notistack';
import {handleApiError} from '../../shared/services';
import {ApiError, ListResponsePayload} from '../../shared/types';
import {ArticlesListItem} from '../types';
import {get} from '../../../util/http';

export const ARTICLES_COLLECTION = 'Articles';

export default (
  pageNumber: number,
  pageSize: number,
  sortBy: string,
  sortDirection: 'asc' | 'desc',
  userId?: string,
) => {
  const {enqueueSnackbar} = useSnackbar();

  const url = userId ? `user/${userId}/article` : 'article';

  const {data, isLoading} = useQuery(
    [ARTICLES_COLLECTION, pageNumber, pageSize, sortBy, sortDirection, userId],
    async () => {
      const response = await get<ListResponsePayload<ArticlesListItem>>(
        `${url}?pageNumber=${pageNumber}&pageSize=${pageSize}&sortBy=${sortBy}&sortDirection=${sortDirection}`,
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
    articles: data?.results || [],
    isLoading,
  };
};
