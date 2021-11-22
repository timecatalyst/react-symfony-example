import React from 'react';
import {Grid, Paper, makeStyles, Theme} from '@material-ui/core';
import {FieldLabelValue} from '../../shared/components';
import {UserDetails} from '../types';

interface Props {
  user: UserDetails;
}

const useStyles = makeStyles((theme: Theme) => ({
  cardContainer: {
    padding: theme.spacing(3),
  },
}));

export default ({user}: Props) => {
  const classes = useStyles();

  return (
    <Paper className={classes.cardContainer}>
      <Grid container spacing={5}>
        <FieldLabelValue label="Name" value={user.name} />
        <FieldLabelValue label="Email" value={user.email} />
        <FieldLabelValue label="Gender" value={user.gender} />
        <FieldLabelValue label="Active" value={user.active ? 'Yes' : 'No'} />
      </Grid>
    </Paper>
  );
};
