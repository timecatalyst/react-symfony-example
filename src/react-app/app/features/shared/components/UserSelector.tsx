import React from 'react';
import {MenuItem} from '@material-ui/core';
import {HookFormSelect} from '../../forms/components';
import useUserSelectListItems from '../hooks/useUserSelectListItems';

interface Props {
  name: string;
  label: string;
}

export default ({name, label}: Props) => {
  const {items} = useUserSelectListItems();

  return (
    <HookFormSelect name={name} label={label}>
      {items.map((x) => (
        <MenuItem key={x.value} value={x.value}>
          {x.label}
        </MenuItem>
      ))}
    </HookFormSelect>
  );
};
