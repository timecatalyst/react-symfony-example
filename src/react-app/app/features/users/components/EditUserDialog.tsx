import React from 'react';
import {Dialog, DialogTitle, DialogContent} from '@material-ui/core';
import {useForm} from 'react-hook-form';
import {yupResolver} from '@hookform/resolvers/yup';
import useUpdateUser from '../hooks/useUpdateUser';
import {UserFormValues, validationSchema} from '../schemas/userValidationSchema';
import {UserDetails} from '../types';
import AddEditUserForm from './AddEditUserForm';

interface Props {
  user: UserDetails;
  onClose: () => void;
}

const useEditUserDialog = (user: UserDetails, onClose: () => void) => {
  const form = useForm<UserFormValues>({
    defaultValues: {
      name: user.name,
      email: user.email,
      gender: user.gender,
      active: user.active,
    },
    resolver: yupResolver(validationSchema),
  });

  const updateUser = useUpdateUser(user.id, form.setError, onClose);

  const handleUpdateUser = (values: UserFormValues) => {
    updateUser.mutate(values);
  };

  return {form, handleUpdateUser};
};

export default ({user, onClose}: Props) => {
  const {form, handleUpdateUser} = useEditUserDialog(user, onClose);

  return (
    <Dialog open onClose={onClose}>
      <DialogTitle>Edit User</DialogTitle>
      <DialogContent>
        <AddEditUserForm form={form} onSubmit={handleUpdateUser} onCancel={onClose} />
      </DialogContent>
    </Dialog>
  );
};
