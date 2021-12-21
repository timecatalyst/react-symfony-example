import React from 'react';
import {Grid, Paper, makeStyles, Theme} from '@material-ui/core';
import {FieldLabelValue} from '../../shared/components';
import {ArticleDetails} from '../types';

interface Props {
  article: ArticleDetails;
}

const useStyles = makeStyles((theme: Theme) => ({
  cardContainer: {
    padding: theme.spacing(3),
  },
}));

export default ({article}: Props) => {
  const classes = useStyles();

  return (
    <Paper className={classes.cardContainer}>
      <Grid container spacing={5}>
        <FieldLabelValue label="Title" value={article.title} />
        <FieldLabelValue label="User" value={article.userName} />
        <FieldLabelValue label="Published" value={article.published ? 'Yes' : 'No'} />
        <FieldLabelValue label="Published Date" value={article.publishedDate?.toString()} />
      </Grid>
    </Paper>
  );
};
