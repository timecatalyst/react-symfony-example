/* eslint-disable react/no-array-index-key */
import React from 'react';
import {TableBody, TableCell, TableRow} from '@material-ui/core';
import {ListTableColumn} from '../../types';

interface Props<T, R> {
  columns: Array<ListTableColumn<T, R>>;
  rows: Array<R>;
  onRowClick?: (_: R) => () => void;
}

export default <T extends unknown, R extends unknown>({columns, rows, onRowClick}: Props<T, R>) => (
  <TableBody>
    {rows.map((row, rowIndex) => (
      <TableRow key={rowIndex} hover>
        {columns.map((col, colIndex) => (
          <TableCell
            key={colIndex}
            onClick={!col.hasActions && onRowClick ? onRowClick(row) : undefined}
          >
            {col.renderer ? col.renderer(row) : (row as unknown)[col.name]}
          </TableCell>
        ))}
      </TableRow>
    ))}
  </TableBody>
);
