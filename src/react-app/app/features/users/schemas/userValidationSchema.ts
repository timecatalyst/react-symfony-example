import * as Yup from 'yup';
import nameOfFactory from '../../shared/services/nameOfFactory';
import {UserGender} from '../types';

export type UserFormValues = {
  name: string;
  email: string;
  gender: string;
  active: boolean;
};

export const nameOf = nameOfFactory<UserFormValues>();

export const defaultValues = {
  [nameOf('name')]: '',
  [nameOf('email')]: '',
  [nameOf('gender')]: UserGender.Male,
  [nameOf('active')]: true,
};

export const validationSchema = Yup.object().shape({
  [nameOf('name')]: Yup.string().required().max(256).label('Name'),
  [nameOf('email')]: Yup.string().required().max(256).label('Email'),
  [nameOf('gender')]: Yup.string().required().label('Gender'),
  [nameOf('active')]: Yup.bool().required().label('Active'),
});
