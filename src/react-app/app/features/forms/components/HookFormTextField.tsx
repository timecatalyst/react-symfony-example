/* eslint-disable react/jsx-no-duplicate-props */

import React, {ReactNode} from 'react';
import {
  FormHelperTextProps,
  InputBaseComponentProps,
  InputLabelProps,
  TextField,
} from '@material-ui/core';
import {InputProps as StandardInputProps} from '@material-ui/core/Input/Input';
import {FilledInputProps} from '@material-ui/core/FilledInput';
import {OutlinedInputProps} from '@material-ui/core/OutlinedInput';
import {Controller, useFormContext} from 'react-hook-form';

type Props = {
  name: string;
  autoComplete?: string;
  autoFocus?: boolean;
  defaultValue?: string;
  disabled?: boolean;
  FormHelperTextProps?: Partial<FormHelperTextProps>;
  fullWidth?: boolean;
  helperText?: ReactNode;
  id?: string;
  InputLabelProps?: Partial<InputLabelProps>;
  InputProps?:
    | Partial<StandardInputProps>
    | Partial<FilledInputProps>
    | Partial<OutlinedInputProps>;
  inputProps?: InputBaseComponentProps;
  label?: ReactNode;
  margin?: 'none' | 'dense' | 'normal';
  multiline?: boolean;
  placeholder?: string;
  required?: boolean;
  rows?: string | number;
  rowsMax?: string | number;
  size?: 'small' | 'medium';
  type?: string;
  variant?: 'standard' | 'outlined' | 'filled';
};

const HookFormTextField = ({
  name,
  autoComplete,
  autoFocus,
  defaultValue,
  disabled,
  FormHelperTextProps,
  fullWidth = true,
  helperText,
  id,
  InputLabelProps,
  InputProps,
  inputProps,
  label,
  margin = 'normal',
  multiline,
  placeholder,
  required,
  rows,
  rowsMax,
  size,
  type,
  variant = 'outlined',
}: Props) => {
  const {errors} = useFormContext();
  const error = errors[name];
  const displayError = Boolean(error?.message);

  return (
    <Controller
      name={name}
      defaultValue={defaultValue}
      render={({onChange, onBlur, value}) => (
        <TextField
          name={name}
          autoComplete={autoComplete}
          autoFocus={autoFocus}
          disabled={disabled}
          error={displayError}
          FormHelperTextProps={FormHelperTextProps}
          fullWidth={fullWidth}
          helperText={displayError ? error.message : helperText}
          id={id ?? name}
          InputLabelProps={InputLabelProps}
          InputProps={InputProps}
          inputProps={inputProps}
          label={label}
          margin={margin}
          multiline={multiline}
          onBlur={onBlur}
          onChange={onChange}
          placeholder={placeholder}
          required={required}
          rows={rows}
          rowsMax={rowsMax}
          size={size}
          type={type}
          value={value ?? ''}
          variant={variant}
        />
      )}
    />
  );
};

export default HookFormTextField;
