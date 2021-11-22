import React from 'react';
import {Grid, Typography, makeStyles} from '@material-ui/core';

interface Props {
  label: string;
  value: string | number;
}

const useStyles = makeStyles(() => ({
  label: {
    fontWeight: 'bold',
  },
}));

export default ({label, value}: Props) => {
  const classes = useStyles();

  return (
    <Grid item>
      <Typography className={classes.label}>{label}</Typography>
      <Typography>{value}</Typography>
    </Grid>
  );
};
