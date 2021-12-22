import {useMutation, useQueryClient} from 'react-query';
import {useSnackbar} from 'notistack';
import {ARTICLES_COLLECTION} from './useArticlesList';
import {post} from '../../../util/http';
import {handleHookFormSubmitError} from '../../shared/services';
import {ApiError, SetHookFormErrorFunction, EnqueueSnackbarVariant} from '../../shared/types';
import {ArticleDetails} from '../types';
import {ArticleFormValues} from '../schemas/articleValidationSchema';

export default (
  setFormError: SetHookFormErrorFunction<ArticleFormValues>,
  onSuccess?: () => void,
) => {
  const queryClient = useQueryClient();
  const {enqueueSnackbar} = useSnackbar();

  return useMutation((data: ArticleFormValues) => post<ArticleDetails>('article', data), {
    onSuccess: () => {
      queryClient.invalidateQueries(ARTICLES_COLLECTION);
      enqueueSnackbar('Article Added Successfully', {variant: EnqueueSnackbarVariant.Success});
      if (onSuccess) onSuccess();
    },
    onError: (error: ApiError) => {
      handleHookFormSubmitError({error, setFormError, enqueueSnackbar});
    },
  });
};
