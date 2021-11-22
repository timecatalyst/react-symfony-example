import React from 'react';
import {TableCell, TableHead, TableRow, TableSortLabel} from '@material-ui/core';
import {SortDirection} from '../../shared/types';
import {UsersListItem} from '../types';

interface Props {
  sortBy: keyof UsersListItem;
  sortDirection: SortDirection;
  onSetSortBy: (_: keyof UsersListItem) => void;
  onSetSortDirection: (_: SortDirection) => void;
}

export default ({sortBy, sortDirection, onSetSortBy, onSetSortDirection}: Props) => {
  const handleSort = (columnName: keyof UsersListItem) => () => {
    if (columnName === sortBy) {
      onSetSortDirection(
        sortDirection === SortDirection.ASC ? SortDirection.DESC : SortDirection.ASC,
      );
    } else {
      onSetSortBy(columnName);
      onSetSortDirection(SortDirection.ASC);
    }
  };

  return (
    <TableHead>
      <TableRow>
        <TableCell>
          <TableSortLabel
            active={sortBy === 'name'}
            direction={sortDirection}
            onClick={handleSort('name')}
          >
            Name
          </TableSortLabel>
        </TableCell>
        <TableCell>
          <TableSortLabel
            active={sortBy === 'email'}
            direction={sortDirection}
            onClick={handleSort('email')}
          >
            Email
          </TableSortLabel>
        </TableCell>
        <TableCell>Delete</TableCell>
      </TableRow>
    </TableHead>
  );
};
