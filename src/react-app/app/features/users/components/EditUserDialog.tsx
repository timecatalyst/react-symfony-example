import React from 'react';
import {useDispatch, useSelector} from 'react-redux';
import {useQueryClient} from 'react-query';
import {Dialog, DialogTitle, DialogContent} from '@material-ui/core';
import {useForm} from 'react-hook-form';
import {yupResolver} from '@hookform/resolvers/yup';
import {useSnackbar} from 'notistack';
import {EnqueueSnackbarVariant} from '../../shared/types';
import {updateUserDetails} from '../actions';
import {USERS_COLLECTION} from '../hooks/useUsersList';
import {UserFormValues, validationSchema} from '../schemas/userValidationSchema';
import {userDetailsSelector} from '../selectors/userDetails';
import AddEditUserForm from './AddEditUserForm';

interface Props {
  onClose: () => void;
}

const useEditUserDialog = (onClose: () => void) => {
  const dispatch = useDispatch();
  const userDetails = useSelector(userDetailsSelector);
  const queryClient = useQueryClient();
  const {enqueueSnackbar} = useSnackbar();

  const form = useForm<UserFormValues>({
    defaultValues: {
      name: userDetails.name,
      email: userDetails.email,
      gender: userDetails.gender,
      active: userDetails.active,
    },
    resolver: yupResolver(validationSchema),
  });

  const handleUpdateUser = (values: UserFormValues) => {
    dispatch(
      updateUserDetails(userDetails.id, values, form.setError, enqueueSnackbar, () => {
        enqueueSnackbar('User Added Successfully', {variant: EnqueueSnackbarVariant.Success});
        queryClient.invalidateQueries(USERS_COLLECTION);
        onClose();
      }),
    );
  };

  return {form, handleUpdateUser};
};

export default ({onClose}: Props) => {
  const {form, handleUpdateUser} = useEditUserDialog(onClose);

  return (
    <Dialog open onClose={onClose}>
      <DialogTitle>Edit User</DialogTitle>
      <DialogContent>
        <AddEditUserForm form={form} onSubmit={handleUpdateUser} onCancel={onClose} />
      </DialogContent>
    </Dialog>
  );
};
