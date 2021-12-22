import React, {useState} from 'react';
import {Grid, makeStyles, Theme} from '@material-ui/core';
import {UsersListItem} from '../types';
import AddUserDialog from './AddUserDialog';
import ConfirmDeleteUserDialog from './ConfirmDeleteUserDialog';
import UsersListHeader from './UsersListHeader';
import UsersListTable from './UsersListTable';

const useStyles = makeStyles((theme: Theme) => ({
  pageContainer: {
    margin: theme.spacing(5),
  },
}));

const useUsersListPage = () => {
  const [addUser, setAddUser] = useState(false);
  const [deleteUser, setDeleteUser] = useState<UsersListItem>();

  const handleAddUser = () => setAddUser(true);
  const handleCancelAddUser = () => setAddUser(false);

  const handleDeleteUser = (user: UsersListItem) => () => setDeleteUser(user);
  const handleCancelDeleteUser = () => setDeleteUser(undefined);

  return {
    addUser,
    deleteUser,
    handleAddUser,
    handleCancelAddUser,
    handleDeleteUser,
    handleCancelDeleteUser,
  };
};

export default () => {
  const classes = useStyles();

  const {
    addUser,
    deleteUser,
    handleAddUser,
    handleCancelAddUser,
    handleDeleteUser,
    handleCancelDeleteUser,
  } = useUsersListPage();

  return (
    <Grid className={classes.pageContainer}>
      <UsersListHeader onAddUser={handleAddUser} />
      <UsersListTable onDeleteUser={handleDeleteUser} />
      {addUser && <AddUserDialog onClose={handleCancelAddUser} />}
      {deleteUser && <ConfirmDeleteUserDialog user={deleteUser} onClose={handleCancelDeleteUser} />}
    </Grid>
  );
};
