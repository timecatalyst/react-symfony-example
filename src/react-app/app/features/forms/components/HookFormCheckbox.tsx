import React, {InputHTMLAttributes, ReactNode} from 'react';
import {Checkbox, FormControlLabel} from '@material-ui/core';
import {Controller} from 'react-hook-form';

type Props = {
  name: string;
  checkedIcon?: ReactNode;
  color?: 'primary' | 'secondary' | 'default';
  defaultChecked?: boolean;
  disabled?: boolean;
  disableRipple?: boolean;
  icon?: ReactNode;
  id?: string;
  indeterminate?: boolean;
  indeterminateIcon?: ReactNode;
  inputProps?: InputHTMLAttributes<HTMLInputElement>;
  label?: string;
  labelPlacement?: 'end' | 'start' | 'top' | 'bottom';
  required?: boolean;
  size?: 'small' | 'medium';
};

export default ({
  name,
  checkedIcon,
  color,
  defaultChecked,
  disabled,
  disableRipple,
  icon,
  id,
  indeterminate,
  indeterminateIcon,
  inputProps,
  label,
  labelPlacement,
  required,
  size,
}: Props) => (
  <Controller
    name={name}
    defaultValue={defaultChecked}
    render={({onChange, onBlur, value}) => {
      const checkbox = (
        <Checkbox
          name={name}
          checked={value}
          checkedIcon={checkedIcon}
          color={color}
          disabled={disabled}
          disableRipple={disableRipple}
          icon={icon}
          id={id ?? name}
          indeterminate={indeterminate}
          indeterminateIcon={indeterminateIcon}
          inputProps={inputProps}
          onBlur={onBlur}
          onChange={(e) => onChange(e.target.checked)}
          required={required}
          size={size}
        />
      );

      return label ? (
        <FormControlLabel control={checkbox} label={label} labelPlacement={labelPlacement} />
      ) : (
        checkbox
      );
    }}
  />
);
