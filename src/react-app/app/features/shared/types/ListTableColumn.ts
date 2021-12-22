import {ReactNode} from 'react';

export type ListTableColumn<T, R> = {
  name: keyof T;
  label: string;
  sortable: boolean;
  renderer?: (_: R) => ReactNode;
  hasActions?: boolean;
};
