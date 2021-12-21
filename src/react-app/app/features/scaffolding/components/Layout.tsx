import React, {ReactNode} from 'react';
import {useHistory} from 'react-router-dom';
import {AppBar, Grid, Tabs, Tab, makeStyles, Theme} from '@material-ui/core';

export enum Section {
  Users,
  Articles,
}

interface Props {
  section: Section;
  children: ReactNode;
}

const useStyles = makeStyles((theme: Theme) => ({
  container: {
    paddingTop: theme.spacing(6),
  },
}));

export default ({section, children}: Props) => {
  const classes = useStyles();
  const history = useHistory();

  const handleClick = (path: string) => () => history.push(path);

  return (
    <Grid className={classes.container}>
      <AppBar color="default">
        <Tabs value={section}>
          <Tab value={Section.Users} label="Users" onClick={handleClick('/users')} />
          <Tab value={Section.Articles} label="Articles" onClick={handleClick('/articles')} />
        </Tabs>
      </AppBar>
      {children}
    </Grid>
  );
};
