import React from 'react';
import {Grid, TableContainer, Table, Paper, CircularProgress} from '@material-ui/core';
import {SortDirection} from '../../shared/types';
import {UsersListItem} from '../types';
import UsersListTableBody from './UsersListTableBody';
import UsersListTableHeader from './UsersListTableHeader';
import UsersListTablePager from './UsersListTablePager';

interface Props {
  isLoading: boolean;
  users: Array<UsersListItem>;
  totalItems: number;
  pageNumber: number;
  pageSize: number;
  sortBy: keyof UsersListItem;
  sortDirection: SortDirection;
  onRowClick: (_: number) => () => void;
  onDelete: (_: UsersListItem) => () => void;
  onSetPageNumber: (_: number) => void;
  onSetPageSize: (_: number) => void;
  onSetSortBy: (_: keyof UsersListItem) => void;
  onSetSortDirection: (_: SortDirection) => void;
}

export default ({
  isLoading,
  users,
  totalItems,
  pageNumber,
  pageSize,
  sortBy,
  sortDirection,
  onRowClick,
  onDelete,
  onSetPageNumber,
  onSetPageSize,
  onSetSortBy,
  onSetSortDirection,
}: Props) => (
  <Grid>
    <TableContainer component={Paper}>
      <Table>
        <UsersListTableHeader
          sortBy={sortBy}
          sortDirection={sortDirection}
          onSetSortBy={onSetSortBy}
          onSetSortDirection={onSetSortDirection}
        />
        {isLoading ? (
          <CircularProgress />
        ) : (
          <UsersListTableBody users={users} onRowClick={onRowClick} onDelete={onDelete} />
        )}
      </Table>
    </TableContainer>
    <UsersListTablePager
      totalItems={totalItems}
      pageNumber={pageNumber}
      pageSize={pageSize}
      onSetPageNumber={onSetPageNumber}
      onSetPageSize={onSetPageSize}
    />
  </Grid>
);
