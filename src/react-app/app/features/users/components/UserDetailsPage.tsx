import React, {useState} from 'react';
import {useParams, useHistory} from 'react-router-dom';
import {Grid, makeStyles, Theme} from '@material-ui/core';
import useUserDetails from '../hooks/useUserDetails';
import EditUserDialog from './EditUserDialog';
import UserDetailsCard from './UserDetailsCard';
import UserArticlesList from './UserArticlesList';
import UserDetailsHeader from './UserDetailsHeader';

const useStyles = makeStyles((theme: Theme) => ({
  pageContainer: {
    margin: theme.spacing(5),
  },
}));

const useUserDetailsPage = () => {
  const history = useHistory();
  const {userId} = useParams<{userId: string}>();
  const [editUser, setEditUser] = useState(false);
  const {user, isLoading} = useUserDetails(userId);

  const handleEdit = () => setEditUser(true);
  const handleCancelEdit = () => setEditUser(false);
  const handleBack = () => history.push('/users');

  return {userId, user, isLoading, editUser, handleEdit, handleCancelEdit, handleBack};
};

export default () => {
  const classes = useStyles();

  const {
    userId,
    user,
    isLoading,
    editUser,
    handleEdit,
    handleCancelEdit,
    handleBack,
  } = useUserDetailsPage();

  return (
    <Grid className={classes.pageContainer}>
      <UserDetailsHeader
        isLoading={isLoading}
        onNavigateBack={handleBack}
        onEditUser={handleEdit}
      />
      <UserDetailsCard user={user} isLoading={isLoading} />
      <UserArticlesList userId={userId} />
      {editUser && <EditUserDialog user={user} onClose={handleCancelEdit} />}
    </Grid>
  );
};
