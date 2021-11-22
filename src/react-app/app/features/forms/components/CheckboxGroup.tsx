import React, {ReactNode} from 'react';
import {FormControl, FormLabel, FormGroup, FormHelperText} from '@material-ui/core';

type Props = {
  children: ReactNode;
  disabled?: boolean;
  error?: string;
  fullWidth?: boolean;
  helperText?: ReactNode;
  label?: ReactNode;
  margin?: 'none' | 'dense' | 'normal';
  required?: boolean;
  row?: boolean;
};

export default ({
  children,
  disabled,
  error,
  fullWidth,
  helperText,
  label,
  margin,
  required,
  row,
}: Props) => (
  <FormControl
    component="fieldset"
    disabled={disabled}
    error={Boolean(error)}
    fullWidth={fullWidth}
    margin={margin}
    required={required}
  >
    <FormLabel component="legend">{label}</FormLabel>
    <FormGroup row={row}>{children}</FormGroup>
    <FormHelperText>{error ?? helperText}</FormHelperText>
  </FormControl>
);
