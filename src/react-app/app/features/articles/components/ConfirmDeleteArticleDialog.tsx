import React from 'react';
import {Button, Dialog, DialogTitle, DialogContent, DialogActions} from '@material-ui/core';
import useDeleteArticle from '../hooks/useDeleteArticle';
import {ArticlesListItem} from '../types';

interface Props {
  article: ArticlesListItem;
  onClose: () => void;
}

const useConfirmDeleteArticleDialog = (article: ArticlesListItem, onClose: () => void) => {
  const deleteArticle = useDeleteArticle(onClose);

  const handleDelete = () => {
    deleteArticle.mutate(article.id);
  };

  return {handleDelete};
};

export default ({article, onClose}: Props) => {
  const {handleDelete} = useConfirmDeleteArticleDialog(article, onClose);

  return (
    <Dialog open onClose={onClose}>
      <DialogTitle>Confirm Delete</DialogTitle>
      <DialogContent>
        Are you sure you want to delete article &quot;{article.title}&quot;?
      </DialogContent>
      <DialogActions>
        <Button onClick={onClose} variant="outlined">
          Cancel
        </Button>
        <Button onClick={handleDelete} variant="contained" color="secondary">
          Confirm
        </Button>
      </DialogActions>
    </Dialog>
  );
};
