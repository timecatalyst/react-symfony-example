import React from 'react';
import {useFormContext} from 'react-hook-form';

type Props = {
  name: string;
  defaultValue?: string;
  id?: string;
};

const HookFormHiddenField = ({name, defaultValue, id}: Props) => {
  const {register} = useFormContext();

  return (
    <input type="hidden" ref={register} id={id ?? name} name={name} defaultValue={defaultValue} />
  );
};

export default HookFormHiddenField;
