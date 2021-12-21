import React from 'react';
import {Grid, TableContainer, Table, Paper, CircularProgress} from '@material-ui/core';
import {ListTableColumn, SortDirection} from '../../types';
import ListTableHeader from './ListTableHeader';
import ListTableBody from './ListTableBody';
import ListTablePager from './ListTablePager';

interface Props<T, R> {
  columns: Array<ListTableColumn<T, R>>;
  rows: Array<R>;
  showHeader?: boolean;
  hasPagination?: boolean;
  isLoading?: boolean;
  totalItems?: number;
  pageNumber?: number;
  pageSize?: number;
  sortBy?: keyof R;
  sortDirection?: SortDirection;
  onSetPageNumber?: (_: number) => void;
  onSetPageSize?: (_: number) => void;
  onSetSortBy?: (_: keyof R) => void;
  onSetSortDirection?: (_: SortDirection) => void;
  onRowClick?: (_: R) => () => void;
}

export default <T extends unknown, R extends unknown>({
  columns,
  rows,
  showHeader = true,
  hasPagination = false,
  isLoading = false,
  totalItems = 0,
  pageNumber = 1,
  pageSize = 10,
  sortBy,
  sortDirection = SortDirection.ASC,
  onSetPageNumber,
  onSetPageSize,
  onSetSortBy,
  onSetSortDirection,
  onRowClick,
}: Props<T, R>) => {
  if (isLoading) return <CircularProgress />;

  return (
    <Grid>
      <TableContainer component={Paper}>
        <Table>
          {showHeader && (
            <ListTableHeader
              columns={columns}
              sortBy={sortBy}
              sortDirection={sortDirection}
              onSetSortBy={onSetSortBy}
              onSetSortDirection={onSetSortDirection}
            />
          )}
          <ListTableBody columns={columns} rows={rows} onRowClick={onRowClick} />
        </Table>
      </TableContainer>
      {hasPagination && (
        <ListTablePager
          totalItems={totalItems}
          pageNumber={pageNumber}
          pageSize={pageSize}
          onSetPageNumber={onSetPageNumber}
          onSetPageSize={onSetPageSize}
        />
      )}
    </Grid>
  );
};
