import {useQuery} from 'react-query';
import {useSnackbar} from 'notistack';
import {get} from '../../../util/http';
import {handleApiError} from '../../shared/services';
import {ApiError} from '../../shared/types';
import {ArticleDetails} from '../types';

export const ARTICLE_DETAILS = 'ArticleDetails';

const buildDateObject = (value: string | Date) => (value ? new Date(value) : undefined);

export default (articleId: string) => {
  const {enqueueSnackbar} = useSnackbar();

  const {data, isLoading} = useQuery(
    [ARTICLE_DETAILS, articleId],
    async () => {
      const response = await get<ArticleDetails>(`article/${articleId}`);
      const {data} = response;
      data.createdDate = buildDateObject(data.createdDate);
      data.publishedDate = buildDateObject(data.publishedDate);
      return data;
    },
    {
      onError: (error: ApiError) => {
        handleApiError(error, enqueueSnackbar);
      },
    },
  );

  return {article: data, isLoading};
};
