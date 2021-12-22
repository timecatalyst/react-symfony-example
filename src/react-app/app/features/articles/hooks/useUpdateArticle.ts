import {useMutation, useQueryClient} from 'react-query';
import {useSnackbar} from 'notistack';
import {put} from '../../../util/http';
import {handleHookFormSubmitError} from '../../shared/services';
import {ApiError, SetHookFormErrorFunction, EnqueueSnackbarVariant} from '../../shared/types';
import {ArticleDetails} from '../types';
import {ArticleFormValues} from '../schemas/articleValidationSchema';
import {ARTICLES_COLLECTION} from './useArticlesList';
import {ARTICLE_DETAILS} from './useArticleDetails';

export default (
  id: number,
  setFormError: SetHookFormErrorFunction<ArticleFormValues>,
  onSuccess?: () => void,
) => {
  const queryClient = useQueryClient();
  const {enqueueSnackbar} = useSnackbar();

  return useMutation((data: ArticleFormValues) => put<ArticleDetails>(`article/${id}`, data), {
    onSuccess: () => {
      queryClient.invalidateQueries(ARTICLES_COLLECTION);
      queryClient.invalidateQueries(ARTICLE_DETAILS);
      enqueueSnackbar('Article Updated Successfully', {variant: EnqueueSnackbarVariant.Success});
      if (onSuccess) onSuccess();
    },
    onError: (error: ApiError) => {
      handleHookFormSubmitError({error, setFormError, enqueueSnackbar});
    },
  });
};
