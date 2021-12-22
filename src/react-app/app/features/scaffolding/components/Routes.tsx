import React from 'react';
import {Switch, Route} from 'react-router-dom';

import {ArticlesListPage, ArticleDetailsPage} from '../../articles/components';
import {UsersListPage, UserDetailsPage} from '../../users/components';
import {NotFound, AccessDenied, SystemError} from '../../shared/components';
import Layout, {Section} from './Layout';

export default () => (
  <Switch>
    <Route exact path={['/', '/users']}>
      <Layout section={Section.Users}>
        <UsersListPage />
      </Layout>
    </Route>
    <Route exact path="/users/:userId">
      <Layout section={Section.Users}>
        <UserDetailsPage />
      </Layout>
    </Route>
    <Route exact path="/articles">
      <Layout section={Section.Articles}>
        <ArticlesListPage />
      </Layout>
    </Route>
    <Route exact path="/articles/:articleId">
      <Layout section={Section.Articles}>
        <ArticleDetailsPage />
      </Layout>
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
