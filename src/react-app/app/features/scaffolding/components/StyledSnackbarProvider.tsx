import React, {ReactNode} from 'react';
import {SnackbarProvider} from 'notistack';
import {makeStyles} from '@material-ui/core';

type Props = {
  children: ReactNode;
};

const useStyles = makeStyles({
  variantSuccess: {},
  variantError: {},
  variantWarning: {},
  variantInfo: {},
});

const StyledSnackbarProvider = ({children}: Props) => {
  const classes = useStyles();

  return (
    <SnackbarProvider classes={classes}>
      <>{children}</>
    </SnackbarProvider>
  );
};

export default StyledSnackbarProvider;
