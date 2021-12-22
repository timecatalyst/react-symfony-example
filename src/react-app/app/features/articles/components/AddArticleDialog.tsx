import React from 'react';
import {Dialog, DialogTitle, DialogContent} from '@material-ui/core';
import {useForm} from 'react-hook-form';
import {yupResolver} from '@hookform/resolvers/yup';
import useCreateArticle from '../hooks/useCreateArticle';
import {
  ArticleFormValues,
  defaultValues,
  validationSchema,
} from '../schemas/articleValidationSchema';
import AddEditArticleForm from './AddEditArticleForm';

interface Props {
  onClose: () => void;
}

const useAddArticleDialog = (onClose: () => void) => {
  const form = useForm<ArticleFormValues>({defaultValues, resolver: yupResolver(validationSchema)});
  const createArticle = useCreateArticle(form.setError, onClose);

  const handleCreateArticle = (values: ArticleFormValues) => {
    createArticle.mutate(values);
  };

  return {form, handleCreateArticle};
};

export default ({onClose}: Props) => {
  const {form, handleCreateArticle} = useAddArticleDialog(onClose);

  return (
    <Dialog open onClose={onClose}>
      <DialogTitle>Add Article</DialogTitle>
      <DialogContent>
        <AddEditArticleForm form={form} onSubmit={handleCreateArticle} onCancel={onClose} />
      </DialogContent>
    </Dialog>
  );
};
