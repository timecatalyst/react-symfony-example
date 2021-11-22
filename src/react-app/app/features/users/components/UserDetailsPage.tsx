import React, {useEffect, useState} from 'react';
import {useDispatch, useSelector} from 'react-redux';
import {useParams, useHistory} from 'react-router';
import {CircularProgress, Grid, makeStyles, Theme} from '@material-ui/core';
import {getUserDetails} from '../actions';
import {userDetailsSelector, isLoadingSelector} from '../selectors/userDetails';
import EditUserDialog from './EditUserDialog';
import UserDetailsCard from './UserDetailsCard';
import UserDetailsHeader from './UserDetailsHeader';

const useStyles = makeStyles((theme: Theme) => ({
  pageContainer: {
    margin: theme.spacing(5),
  },
}));

const useUserDetailsPage = () => {
  const dispatch = useDispatch();
  const history = useHistory();
  const isLoading = useSelector(isLoadingSelector);
  const userDetails = useSelector(userDetailsSelector);
  const {userId} = useParams<{userId: string}>();

  useEffect(() => {
    dispatch(getUserDetails(userId));
  }, [userId, dispatch]);

  const handleBack = () => history.push('/users');

  return {userDetails, isLoading, userId, handleBack};
};

export default () => {
  const classes = useStyles();
  const [editUser, setEditUser] = useState(false);
  const {userDetails, isLoading, handleBack} = useUserDetailsPage();

  return (
    <Grid className={classes.pageContainer}>
      <UserDetailsHeader
        isLoading={isLoading}
        onNavigateBack={handleBack}
        onEditUser={() => setEditUser(true)}
      />
      {isLoading ? <CircularProgress /> : <UserDetailsCard user={userDetails} />}
      {editUser && <EditUserDialog onClose={() => setEditUser(false)} />}
    </Grid>
  );
};
