import React from 'react';
import {Switch, Route} from 'react-router';

import {UsersListPage, UserDetailsPage} from '../../users/components';
import {NotFound, AccessDenied, SystemError} from '../../shared/components';

export default () => (
  <Switch>
    <Route exact path={['/', '/users']}>
      <UsersListPage />
    </Route>
    <Route exact path="/users/:userId">
      <UserDetailsPage />
    </Route>
    <Route path="/access-denied">
      <AccessDenied />
    </Route>
    <Route path="/system-error">
      <SystemError />
    </Route>
    <Route>
      <NotFound />
    </Route>
  </Switch>
);
