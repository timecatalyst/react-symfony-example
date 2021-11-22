import React from 'react';
import {Box, Button, Typography, makeStyles} from '@material-ui/core';
import {Theme} from '@material-ui/core/styles/createMuiTheme';
import {LockOutlined} from '@material-ui/icons';
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

const AccessDenied = () => {
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
        <LockOutlined style={{fontSize: 72}} />
      </Box>
      <Typography variant="h3" component="h1" gutterBottom>
        Page Access Forbidden
      </Typography>
      <Typography variant="h5" component="div" align="center" className={classes.message}>
        It looks like you don&#39;t have the correct permissions to access this page. If this seems
        like an error, please contact your administrator.
      </Typography>
      <Box marginTop={4}>
        <Button variant="contained" color="secondary" component={RouterLink} to="/">
          Back to Application
        </Button>
      </Box>
    </Box>
  );
};

export default AccessDenied;
