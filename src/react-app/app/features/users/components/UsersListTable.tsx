import React from 'react';
import {useHistory} from 'react-router-dom';
import {IconButton} from '@material-ui/core';
import DeleteIcon from '@material-ui/icons/Delete';
import {ListTable} from '../../shared/components/ListTable';
import useListTableControls from '../../shared/hooks/useListTableControls';
import {ListTableColumn} from '../../shared/types';
import useUsersList from '../hooks/useUsersList';
import {UsersListItem} from '../types';

interface Props {
  onDeleteUser: (_: UsersListItem) => () => void;
}

type UsersListTableColumns = Array<
  ListTableColumn<UsersListItem & {delete: undefined}, UsersListItem>
>;

const useUsersListTable = (onDeleteUser: (_: UsersListItem) => () => void) => {
  const history = useHistory();
  const tableControls = useListTableControls<UsersListItem>('name');

  const {pageNumber, pageSize, sortBy, sortDirection} = tableControls;
  const {users, totalItems, isLoading} = useUsersList(pageNumber, pageSize, sortBy, sortDirection);

  const handleRowClick = (user: UsersListItem) => () => {
    history.push(`users/${user.id}`);
  };

  const columns: UsersListTableColumns = [
    {name: 'name', label: 'Name', sortable: true},
    {name: 'email', label: 'Email', sortable: true},
    {
      name: 'delete',
      label: 'Delete',
      sortable: false,
      hasActions: true,
      renderer: (row: UsersListItem) => (
        <IconButton onClick={onDeleteUser(row)}>
          <DeleteIcon />
        </IconButton>
      ),
    },
  ];

  return {
    users,
    totalItems,
    isLoading,
    handleRowClick,
    columns,
    ...tableControls,
  };
};

export default ({onDeleteUser}: Props) => {
  const {
    users,
    totalItems,
    isLoading,
    handleRowClick,
    columns,
    pageNumber,
    pageSize,
    sortBy,
    sortDirection,
    setPageNumber,
    setPageSize,
    setSortBy,
    setSortDirection,
  } = useUsersListTable(onDeleteUser);

  return (
    <ListTable
      columns={columns}
      rows={users}
      hasPagination
      isLoading={isLoading}
      totalItems={totalItems}
      pageNumber={pageNumber}
      pageSize={pageSize}
      sortBy={sortBy}
      sortDirection={sortDirection}
      onSetPageNumber={setPageNumber}
      onSetPageSize={setPageSize}
      onSetSortBy={setSortBy}
      onSetSortDirection={setSortDirection}
      onRowClick={handleRowClick}
    />
  );
};
