import React from 'react';
import {Button, Dialog, DialogTitle, DialogContent, DialogActions} from '@material-ui/core';
import useDeleteUser from '../hooks/useDeleteUser';
import {UsersListItem} from '../types';

interface Props {
  user: UsersListItem;
  onClose: () => void;
}

const useConfirmDeleteUserDialog = (user: UsersListItem, onClose: () => void) => {
  const deleteUser = useDeleteUser(onClose);

  const handleDeleteUser = () => {
    deleteUser.mutate(user.id);
  };

  return {handleDeleteUser};
};

export default ({user, onClose}: Props) => {
  const {handleDeleteUser} = useConfirmDeleteUserDialog(user, onClose);

  return (
    <Dialog open onClose={onClose}>
      <DialogTitle>Confirm Delete</DialogTitle>
      <DialogContent>Are you sure you want to delete user &quot;{user.name}&quot;?</DialogContent>
      <DialogActions>
        <Button onClick={onClose} variant="outlined">
          Cancel
        </Button>
        <Button onClick={handleDeleteUser} variant="contained" color="secondary">
          Confirm
        </Button>
      </DialogActions>
    </Dialog>
  );
};
