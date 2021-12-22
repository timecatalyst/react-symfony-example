import React from 'react';
import {useHistory} from 'react-router-dom';
import {Grid, Typography, makeStyles, Theme} from '@material-ui/core';
import {ListTable} from '../../shared/components/ListTable';
import useListTableControls from '../../shared/hooks/useListTableControls';
import useArticlesList from '../../articles/hooks/useArticlesList';
import {ListTableColumn} from '../../shared/types';
import {ArticlesListItem} from '../../articles/types';

interface Props {
  userId: string;
}

type UserArticlesListTableColumns = Array<ListTableColumn<ArticlesListItem, ArticlesListItem>>;

const useStyles = makeStyles((theme: Theme) => ({
  container: {
    marginTop: theme.spacing(3),
    marginBottom: theme.spacing(3),
  },
  headerText: {
    marginLeft: theme.spacing(),
    marginBottom: theme.spacing(),
  },
}));

const useUserArticlesList = (userId: string) => {
  const history = useHistory();
  const tableControls = useListTableControls<ArticlesListItem>('title');

  const {pageNumber, pageSize, sortBy, sortDirection} = tableControls;
  const {articles, totalItems, isLoading} = useArticlesList(
    pageNumber,
    pageSize,
    sortBy,
    sortDirection,
    userId,
  );

  const handleRowClick = (article: ArticlesListItem) => () => {
    history.push(`/articles/${article.id}`);
  };

  const columns: UserArticlesListTableColumns = [{name: 'title', label: 'Title', sortable: true}];

  return {articles, totalItems, isLoading, handleRowClick, columns, ...tableControls};
};

export default ({userId}: Props) => {
  const classes = useStyles();

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
  } = useUserArticlesList(userId);

  return (
    <Grid className={classes.container}>
      <Typography variant="h4" className={classes.headerText}>
        Articles
      </Typography>
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
    </Grid>
  );
};
