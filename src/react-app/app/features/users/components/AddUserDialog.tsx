import React from 'react';
import {Dialog, DialogTitle, DialogContent} from '@material-ui/core';
import {useForm} from 'react-hook-form';
import {yupResolver} from '@hookform/resolvers/yup';
import useCreateUser from '../hooks/useCreateUser';
import {UserFormValues, defaultValues, validationSchema} from '../schemas/userValidationSchema';
import AddEditUserForm from './AddEditUserForm';

interface Props {
  onClose: () => void;
}

const useAddUserDialog = (onClose: () => void) => {
  const form = useForm<UserFormValues>({defaultValues, resolver: yupResolver(validationSchema)});
  const createUser = useCreateUser(form.setError, onClose);

  const handleCreateUser = (values: UserFormValues) => {
    createUser.mutate(values);
  };

  return {form, handleCreateUser};
};

export default ({onClose}: Props) => {
  const {form, handleCreateUser} = useAddUserDialog(onClose);

  return (
    <Dialog open onClose={onClose}>
      <DialogTitle>Add User</DialogTitle>
      <DialogContent>
        <AddEditUserForm form={form} onSubmit={handleCreateUser} onCancel={onClose} />
      </DialogContent>
    </Dialog>
  );
};
