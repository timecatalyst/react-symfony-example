import React, {ElementType, HTMLAttributes, ReactNode, useEffect, useRef, useState} from 'react';
import {MenuProps, FormControl, Select, InputLabel, FormHelperText} from '@material-ui/core';
import {Controller, useFormContext} from 'react-hook-form';

type Props = {
  name: string;
  children: ReactNode;
  autoFocus?: boolean;
  autoWidth?: boolean;
  defaultValue?: unknown;
  disabled?: boolean;
  displayEmpty?: boolean;
  fullWidth?: boolean;
  helperText?: ReactNode;
  id?: string;
  IconComponent?: ElementType;
  label?: ReactNode;
  margin?: 'none' | 'dense' | 'normal';
  MenuProps?: Partial<MenuProps>;
  multiple?: boolean;
  // eslint-disable-next-line @typescript-eslint/no-explicit-any
  renderValue?: (value: any) => ReactNode;
  required?: boolean;
  SelectDisplayProps?: HTMLAttributes<HTMLDivElement>;
  size?: 'small' | 'medium';
  variant?: 'standard' | 'outlined' | 'filled';
  onChange?: (event: React.ChangeEvent<{name?: string; value: unknown}>) => void;
};

const HookFormSelect = ({
  name,
  children,
  autoFocus,
  autoWidth,
  defaultValue,
  disabled,
  displayEmpty,
  fullWidth = true,
  helperText,
  id,
  IconComponent,
  label,
  margin = 'normal',
  MenuProps,
  multiple,
  renderValue,
  required,
  SelectDisplayProps,
  size,
  variant = 'outlined',
  onChange,
}: Props) => {
  const {errors} = useFormContext();
  const error = errors[name];
  const displayError = Boolean(error?.message);
  const onChangeExternal = onChange;
  const inputLabel = useRef<HTMLLabelElement>(null);
  const [labelWidth, setLabelWidth] = useState(0);
  useEffect(() => {
    setLabelWidth(inputLabel.current?.offsetWidth ?? 0);
  }, [label]);

  const controlId = id ?? name;
  const labelId = `${controlId}-label`;

  return (
    <FormControl
      disabled={disabled}
      error={displayError}
      fullWidth={fullWidth}
      margin={margin}
      required={required}
      size={size}
      variant={variant}
    >
      <InputLabel ref={inputLabel} id={labelId}>
        {label}
      </InputLabel>
      <Controller
        name={name}
        defaultValue={defaultValue}
        render={({onChange, onBlur, value}) => (
          <Select
            autoFocus={autoFocus}
            autoWidth={autoWidth}
            displayEmpty={displayEmpty}
            IconComponent={IconComponent}
            id={controlId}
            labelId={labelId}
            labelWidth={variant === 'outlined' ? labelWidth : 0}
            MenuProps={MenuProps}
            multiple={multiple}
            name={name}
            onBlur={onBlur}
            onChange={(e) => {
              onChange(e);
              if (onChangeExternal) onChangeExternal(e);
            }}
            renderValue={renderValue}
            SelectDisplayProps={SelectDisplayProps}
            value={value}
          >
            {children}
          </Select>
        )}
      />
      <FormHelperText>{displayError ? error.message : helperText}</FormHelperText>
    </FormControl>
  );
};

export default HookFormSelect;
