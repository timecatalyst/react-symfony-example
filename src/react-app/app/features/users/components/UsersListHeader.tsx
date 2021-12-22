import React from 'react';
import {Button, Grid, Typography, makeStyles, Theme} from '@material-ui/core';

interface Props {
  onAddUser: () => void;
}

const useStyles = makeStyles((theme: Theme) => ({
  headerContainer: {
    marginBottom: theme.spacing(5),
  },
}));

export default ({onAddUser}: Props) => {
  const classes = useStyles();

  return (
    <Grid container justify="space-between" alignItems="center" className={classes.headerContainer}>
      <Typography variant="h3">Users List</Typography>
      <Button variant="contained" color="primary" onClick={onAddUser}>
        Add User
      </Button>
    </Grid>
  );
};
