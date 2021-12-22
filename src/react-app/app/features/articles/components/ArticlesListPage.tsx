import React, {useState} from 'react';
import {Grid, makeStyles, Theme} from '@material-ui/core';
import {ArticlesListItem} from '../types';
import AddArticleDialog from './AddArticleDialog';
import ArticlesListHeader from './ArticlesListHeader';
import ArticlesListTable from './ArticlesListTable';
import ConfirmDeleteArticleDialog from './ConfirmDeleteArticleDialog';

const useStyles = makeStyles((theme: Theme) => ({
  pageContainer: {
    margin: theme.spacing(5),
  },
}));

const useArticlesListUserActions = () => {
  const [addArticle, setAddArticle] = useState(false);
  const [deleteArticle, setDeleteArticle] = useState<ArticlesListItem>();

  const handleAddArticle = () => setAddArticle(true);
  const handleCancelAddArticle = () => setAddArticle(false);

  const handleDeleteArticle = (article: ArticlesListItem) => () => setDeleteArticle(article);
  const handleCancelDeleteArticle = () => setDeleteArticle(undefined);

  return {
    addArticle,
    deleteArticle,
    handleAddArticle,
    handleCancelAddArticle,
    handleDeleteArticle,
    handleCancelDeleteArticle,
  };
};

export default () => {
  const classes = useStyles();

  const {
    addArticle,
    deleteArticle,
    handleAddArticle,
    handleCancelAddArticle,
    handleDeleteArticle,
    handleCancelDeleteArticle,
  } = useArticlesListUserActions();

  return (
    <Grid className={classes.pageContainer}>
      <ArticlesListHeader onAddArticle={handleAddArticle} />
      <ArticlesListTable onDeleteArticle={handleDeleteArticle} />
      {addArticle && <AddArticleDialog onClose={handleCancelAddArticle} />}
      {deleteArticle && (
        <ConfirmDeleteArticleDialog article={deleteArticle} onClose={handleCancelDeleteArticle} />
      )}
    </Grid>
  );
};
