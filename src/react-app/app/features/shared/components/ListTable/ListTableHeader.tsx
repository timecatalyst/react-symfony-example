/* eslint-disable react/no-array-index-key */
import React from 'react';
import {TableCell, TableHead, TableRow, TableSortLabel} from '@material-ui/core';
import {ListTableColumn, SortDirection} from '../../types';

interface Props<T, R> {
  columns: Array<ListTableColumn<T, R>>;
  sortBy?: keyof R;
  sortDirection?: SortDirection;
  onSetSortBy?: (_: keyof R) => void;
  onSetSortDirection?: (_: SortDirection) => void;
}

export default <T extends unknown, R extends unknown>({
  columns,
  sortBy,
  sortDirection,
  onSetSortBy,
  onSetSortDirection,
}: Props<T, R>) => {
  const handleSort = (columnName: keyof R) => () => {
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
        {columns.map((x, i) => (
          <TableCell key={i}>
            {x.sortable ? (
              <TableSortLabel
                active={sortBy === x.name}
                direction={sortDirection}
                onClick={handleSort(x.name as keyof R)}
              >
                {x.label}
              </TableSortLabel>
            ) : (
              x.label
            )}
          </TableCell>
        ))}
      </TableRow>
    </TableHead>
  );
};
