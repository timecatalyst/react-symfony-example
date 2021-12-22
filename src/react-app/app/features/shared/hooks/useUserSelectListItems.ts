import {useQuery} from 'react-query';
import {useSnackbar} from 'notistack';
import {handleApiError} from '../services';
import {ApiError, SelectListItem} from '../types';
import {get} from '../../../util';

export const USER_SELECT_LIST_ITEMS = 'UserSelectListItems';

export default () => {
  const {enqueueSnackbar} = useSnackbar();

  const {data, isLoading} = useQuery(
    USER_SELECT_LIST_ITEMS,
    async () => {
      const response = await get<Array<SelectListItem>>('user/select-list-items');
      return response.data;
    },
    {
      onError: (error: ApiError) => {
        handleApiError(error, enqueueSnackbar);
      },
    },
  );

  return {items: data || [], isLoading};
};
