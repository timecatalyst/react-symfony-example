import {useMutation, useQueryClient} from 'react-query';
import {useSnackbar} from 'notistack';
import {del} from '../../../util/http';
import {handleApiError} from '../../shared/services';
import {ApiError, EnqueueSnackbarVariant} from '../../shared/types';
import {ARTICLES_COLLECTION} from './useArticlesList';

export default (onSuccess?: () => void) => {
  const {enqueueSnackbar} = useSnackbar();
  const queryClient = useQueryClient();

  return useMutation((id: number) => del(`article/${id}`), {
    onSuccess: () => {
      queryClient.invalidateQueries(ARTICLES_COLLECTION);
      enqueueSnackbar('Article Deleted Successfully', {variant: EnqueueSnackbarVariant.Success});
      if (onSuccess) onSuccess();
    },
    onError: (error: ApiError) => {
      handleApiError(error, enqueueSnackbar);
    },
  });
};
