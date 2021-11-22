import React from 'react';
import {Router} from 'react-router';
import {MuiThemeProvider} from '@material-ui/core/styles';
import CssBaseline from '@material-ui/core/CssBaseline';
import {MuiPickersUtilsProvider} from '@material-ui/pickers';
import DateFnsUtils from '@date-io/date-fns';
import {QueryClient, QueryClientProvider} from 'react-query';

import theme from '../../../styles/theme';
import {history} from '../services';
import StyledSnackbarProvider from './StyledSnackbarProvider';
import Routes from './Routes';

const queryClient = new QueryClient();

const App = () => (
  <Router history={history}>
    <MuiThemeProvider theme={theme}>
      <MuiPickersUtilsProvider utils={DateFnsUtils}>
        <QueryClientProvider client={queryClient}>
          <StyledSnackbarProvider>
            <CssBaseline />
            <Routes />
          </StyledSnackbarProvider>
        </QueryClientProvider>
      </MuiPickersUtilsProvider>
    </MuiThemeProvider>
  </Router>
);

export default App;
