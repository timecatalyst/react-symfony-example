import React from 'react';
import {Button, Grid, IconButton, Typography, makeStyles, Theme} from '@material-ui/core';
import ArrowBackIcon from '@material-ui/icons/ArrowBack';

interface Props {
  isLoading: boolean;
  onNavigateBack: () => void;
  onEditUser: () => void;
}

const useStyles = makeStyles((theme: Theme) => ({
  headerContainer: {
    marginBottom: theme.spacing(5),
  },
}));

export default ({isLoading, onNavigateBack, onEditUser}: Props) => {
  const classes = useStyles();

  return (
    <Grid
      container
      justify="space-between"
      alignItems="center"
      wrap="nowrap"
      className={classes.headerContainer}
    >
      <Grid item container alignItems="center">
        <IconButton onClick={onNavigateBack}>
          <ArrowBackIcon />
        </IconButton>
        <Typography variant="h3">User Details</Typography>
      </Grid>
      <Button variant="contained" color="primary" disabled={isLoading} onClick={onEditUser}>
        Edit
      </Button>
    </Grid>
  );
};
