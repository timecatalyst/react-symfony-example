import React, {ReactNode} from 'react';
import {FormControl, FormLabel, RadioGroup, FormHelperText} from '@material-ui/core';
import {Controller, useFormContext} from 'react-hook-form';

type Props = {
  name: string;
  children: ReactNode;
  defaultValue?: string;
  disabled?: boolean;
  fullWidth?: boolean;
  helperText?: ReactNode;
  label?: ReactNode;
  margin?: 'none' | 'dense' | 'normal';
  required?: boolean;
  row?: boolean;
};

const HookFormRadioGroup = ({
  name,
  children,
  defaultValue,
  disabled,
  fullWidth,
  helperText,
  label,
  margin,
  required,
  row,
}: Props) => {
  const {errors} = useFormContext();
  const error = errors[name];
  const displayError = Boolean(error?.message);

  return (
    <Controller
      name={name}
      defaultValue={defaultValue}
      render={({onChange, onBlur, value}) => (
        <FormControl
          component="fieldset"
          disabled={disabled}
          error={displayError}
          fullWidth={fullWidth}
          margin={margin}
          required={required}
        >
          <FormLabel component="legend">{label}</FormLabel>
          <RadioGroup
            name={name}
            value={value}
            row={row}
            onBlur={onBlur}
            onChange={(e) => onChange(e.target.value)}
          >
            {children}
          </RadioGroup>
          <FormHelperText>{displayError ? error.message : helperText}</FormHelperText>
        </FormControl>
      )}
    />
  );
};

export default HookFormRadioGroup;
