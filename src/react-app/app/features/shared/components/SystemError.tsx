import React from 'react';
import {Box, Button, Typography, makeStyles} from '@material-ui/core';
import {Theme} from '@material-ui/core/styles/createMuiTheme';
import {ErrorOutline} from '@material-ui/icons';

import {Link as RouterLink} from 'react-router-dom';

const useStyles = makeStyles((theme: Theme) => ({
  container: {
    height: '100vh',
    maxWidth: '550px',
    marginLeft: 'auto',
    marginRight: 'auto',
  },
  message: {
    color: theme.palette.text.primary,
  },
}));

const SystemError = () => {
  const classes = useStyles();

  return (
    <Box
      display="flex"
      flexDirection="column"
      alignItems="center"
      justifyContent="center"
      className={classes.container}
    >
      <Box marginBottom={3} style={{textAlign: 'center'}}>
        <ErrorOutline style={{fontSize: 72}} />
      </Box>
      <Typography variant="h3" component="h1" gutterBottom>
        Something Went Wrong
      </Typography>
      <Typography variant="h5" component="div" align="center" className={classes.message}>
        It looks like something went wrong. Please return to the application and try your request
        again.
      </Typography>
      <Box marginTop={4}>
        <Button variant="contained" color="secondary" component={RouterLink} to="/">
          Back to Application
        </Button>
      </Box>
    </Box>
  );
};

export default SystemError;
