import {UserGender} from './UserGender';

export type UserDetails = {
  id: number;
  name: string;
  email: string;
  gender: UserGender;
  active: boolean;
};
