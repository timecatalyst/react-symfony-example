import React, {ChangeEvent} from 'react';
import {TablePagination} from '@material-ui/core';

interface Props {
  totalItems: number;
  pageNumber: number;
  pageSize: number;
  onSetPageNumber: (_: number) => void;
  onSetPageSize: (_: number) => void;
}

export default ({totalItems, pageNumber, pageSize, onSetPageNumber, onSetPageSize}: Props) => {
  const handleChangePage = (_: unknown, page: number) => onSetPageNumber(page + 1);

  const handleChangeRowsPerPage = (event: ChangeEvent<HTMLInputElement>) => {
    onSetPageSize(parseInt(event.target.value, 10));
    onSetPageNumber(1);
  };

  return (
    <TablePagination
      rowsPerPageOptions={[5, 10, 25]}
      component="div"
      count={totalItems}
      page={pageNumber - 1}
      rowsPerPage={pageSize}
      onChangePage={handleChangePage}
      onChangeRowsPerPage={handleChangeRowsPerPage}
    />
  );
};
