import * as Yup from 'yup';
import nameOfFactory from '../../shared/services/nameOfFactory';

export type ArticleFormValues = {
  title: string;
  userId: number | null;
  published: boolean;
};

export const nameOf = nameOfFactory<ArticleFormValues>();

export const defaultValues: {[x: string]: string | number | boolean | null} = {
  [nameOf('title')]: '',
  [nameOf('userId')]: null,
  [nameOf('published')]: false,
};

export const validationSchema = Yup.object().shape({
  [nameOf('title')]: Yup.string().required().max(256).label('Title'),
  [nameOf('userId')]: Yup.number().nullable().required().label('User'),
});
