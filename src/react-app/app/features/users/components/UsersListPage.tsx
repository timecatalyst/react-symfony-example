import React, {useState} from 'react';
import {useHistory} from 'react-router';
import {Grid, makeStyles, Theme} from '@material-ui/core';
import {SortDirection} from '../../shared/types';
import useUsersList from '../hooks/useUsersList';
import {UsersListItem} from '../types';
import AddUserDialog from './AddUserDialog';
import ConfirmDeleteUserDialog from './ConfirmDeleteUserDialog';
import UsersListHeader from './UsersListHeader';
import UsersListTable from './UsersListTable';

const useStyles = makeStyles((theme: Theme) => ({
  pageContainer: {
    margin: theme.spacing(5),
  },
  header: {
    marginBottom: theme.spacing(5),
  },
}));

const useUsersListUserActions = () => {
  const history = useHistory();
  const [addUser, setAddUser] = useState(false);
  const [deleteUser, setDeleteUser] = useState<UsersListItem>();

  const handleRowClick = (userId: number) => () => {
    history.push(`users/${userId}`);
  };

  const handleAddUser = () => setAddUser(true);
  const handleCancelAddUser = () => setAddUser(false);

  const handleDeleteUser = (user: UsersListItem) => () => setDeleteUser(user);
  const handleCancelDeleteUser = () => setDeleteUser(undefined);

  return {
    addUser,
    deleteUser,
    handleRowClick,
    handleAddUser,
    handleCancelAddUser,
    handleDeleteUser,
    handleCancelDeleteUser,
  };
};

const useUsersListTableControls = () => {
  const [pageNumber, setPageNumber] = useState(1);
  const [pageSize, setPageSize] = useState(5);
  const [sortBy, setSortBy] = useState<keyof UsersListItem>('name');
  const [sortDirection, setSortDirection] = useState<SortDirection>(SortDirection.ASC);

  return {
    pageNumber,
    pageSize,
    sortBy,
    sortDirection,
    setPageNumber,
    setPageSize,
    setSortBy,
    setSortDirection,
  };
};

export default () => {
  const classes = useStyles();

  const {
    addUser,
    deleteUser,
    handleRowClick,
    handleAddUser,
    handleCancelAddUser,
    handleDeleteUser,
    handleCancelDeleteUser,
  } = useUsersListUserActions();

  const {
    pageNumber,
    pageSize,
    sortBy,
    sortDirection,
    setPageNumber,
    setPageSize,
    setSortBy,
    setSortDirection,
  } = useUsersListTableControls();

  const {users, totalItems, isLoading} = useUsersList(pageNumber, pageSize, sortBy, sortDirection);

  return (
    <Grid className={classes.pageContainer}>
      <UsersListHeader isLoading={isLoading} onAddUser={handleAddUser} />
      <UsersListTable
        isLoading={isLoading}
        users={users}
        totalItems={totalItems}
        pageNumber={pageNumber}
        pageSize={pageSize}
        sortBy={sortBy}
        sortDirection={sortDirection}
        onRowClick={handleRowClick}
        onDelete={handleDeleteUser}
        onSetPageNumber={setPageNumber}
        onSetPageSize={setPageSize}
        onSetSortBy={setSortBy}
        onSetSortDirection={setSortDirection}
      />
      {addUser && <AddUserDialog onClose={handleCancelAddUser} />}
      {deleteUser && <ConfirmDeleteUserDialog user={deleteUser} onClose={handleCancelDeleteUser} />}
    </Grid>
  );
};
