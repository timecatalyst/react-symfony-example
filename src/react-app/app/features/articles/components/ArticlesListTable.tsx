import React from 'react';
import {useHistory} from 'react-router-dom';
import {IconButton} from '@material-ui/core';
import DeleteIcon from '@material-ui/icons/Delete';
import {ListTable} from '../../shared/components/ListTable';
import useListTableControls from '../../shared/hooks/useListTableControls';
import {ListTableColumn} from '../../shared/types';
import useArticlesList from '../hooks/useArticlesList';
import {ArticlesListItem} from '../types';

interface Props {
  onDeleteArticle: (_: ArticlesListItem) => () => void;
}

type ArticlesListTableColumns = Array<
  ListTableColumn<ArticlesListItem & {delete: undefined}, ArticlesListItem>
>;

const useArticlesListTable = (onDeleteArticle: (_: ArticlesListItem) => () => void) => {
  const history = useHistory();
  const tableControls = useListTableControls<ArticlesListItem>('title');

  const {pageNumber, pageSize, sortBy, sortDirection} = tableControls;
  const {articles, totalItems, isLoading} = useArticlesList(
    pageNumber,
    pageSize,
    sortBy,
    sortDirection,
  );

  const handleRowClick = (article: ArticlesListItem) => () => {
    history.push(`articles/${article.id}`);
  };

  const columns: ArticlesListTableColumns = [
    {name: 'title', label: 'Title', sortable: true},
    {name: 'userName', label: 'User', sortable: true},
    {
      name: 'delete',
      label: 'Delete',
      sortable: false,
      hasActions: true,
      renderer: (row: ArticlesListItem) => (
        <IconButton onClick={onDeleteArticle(row)}>
          <DeleteIcon />
        </IconButton>
      ),
    },
  ];

  return {
    articles,
    totalItems,
    isLoading,
    handleRowClick,
    columns,
    ...tableControls,
  };
};

export default ({onDeleteArticle}: Props) => {
  const {
    articles,
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
  } = useArticlesListTable(onDeleteArticle);

  return (
    <ListTable
      columns={columns}
      rows={articles}
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
