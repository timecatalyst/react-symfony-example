import React, {useState} from 'react';
import {useParams, useHistory} from 'react-router-dom';
import {CircularProgress, Grid, makeStyles, Theme} from '@material-ui/core';
import useArticleDetails from '../hooks/useArticleDetails';
import ArticleDetailsHeader from './ArticleDetailsHeader';
import ArticleDetailsCard from './ArticleDetailsCard';
import EditArticleDialog from './EditArticleDialog';

const useStyles = makeStyles((theme: Theme) => ({
  pageContainer: {
    margin: theme.spacing(5),
  },
}));

const useArticleDetailsPage = () => {
  const history = useHistory();
  const {articleId} = useParams<{articleId: string}>();
  const [editArticle, setEditArticle] = useState(false);
  const {article, isLoading} = useArticleDetails(articleId);

  const handleEdit = () => setEditArticle(true);
  const handleCancelEdit = () => setEditArticle(false);
  const handleBack = () => history.push('/articles');

  return {article, isLoading, editArticle, handleEdit, handleCancelEdit, handleBack};
};

export default () => {
  const classes = useStyles();

  const {
    article,
    isLoading,
    editArticle,
    handleEdit,
    handleCancelEdit,
    handleBack,
  } = useArticleDetailsPage();

  return (
    <Grid className={classes.pageContainer}>
      <ArticleDetailsHeader
        isLoading={isLoading}
        onNavigateBack={handleBack}
        onEditArticle={handleEdit}
      />
      {isLoading ? <CircularProgress /> : <ArticleDetailsCard article={article} />}
      {editArticle && <EditArticleDialog article={article} onClose={handleCancelEdit} />}
    </Grid>
  );
};
