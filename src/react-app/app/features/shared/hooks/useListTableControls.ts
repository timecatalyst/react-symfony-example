import {useState} from 'react';
import {SortDirection} from '../types';

export default <T>(sortColumn: keyof T) => {
  const [pageNumber, setPageNumber] = useState(1);
  const [pageSize, setPageSize] = useState(5);
  const [sortBy, setSortBy] = useState<keyof T>(sortColumn);
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
