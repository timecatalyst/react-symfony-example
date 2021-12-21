import React from 'react';
import {Dialog, DialogTitle, DialogContent} from '@material-ui/core';
import {useForm} from 'react-hook-form';
import {yupResolver} from '@hookform/resolvers/yup';
import useUpdateArticle from '../hooks/useUpdateArticle';
import {ArticleFormValues, validationSchema} from '../schemas/articleValidationSchema';
import {ArticleDetails} from '../types';
import AddEditArticleForm from './AddEditArticleForm';

interface Props {
  article: ArticleDetails;
  onClose: () => void;
}

const useEditArticleDialog = (article: ArticleDetails, onClose: () => void) => {
  const form = useForm<ArticleFormValues>({
    defaultValues: {
      title: article.title,
      userId: article.userId,
      published: article.published,
    },
    resolver: yupResolver(validationSchema),
  });

  const updateArticle = useUpdateArticle(article.id, form.setError, onClose);

  const handleUpdateArticle = (values: ArticleFormValues) => {
    updateArticle.mutate(values);
  };

  return {form, handleUpdateArticle};
};

export default ({article, onClose}: Props) => {
  const {form, handleUpdateArticle} = useEditArticleDialog(article, onClose);

  return (
    <Dialog open onClose={onClose}>
      <DialogTitle>Edit Article</DialogTitle>
      <DialogContent>
        <AddEditArticleForm form={form} onSubmit={handleUpdateArticle} onCancel={onClose} />
      </DialogContent>
    </Dialog>
  );
};
