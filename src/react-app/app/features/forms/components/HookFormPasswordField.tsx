import React, {ReactNode, MouseEvent, MouseEventHandler} from 'react';
import {
  FormHelperTextProps,
  IconButton,
  InputAdornment,
  InputLabelProps,
  TextField,
} from '@material-ui/core';
import {InputProps as StandardInputProps} from '@material-ui/core/Input/Input';
import {FilledInputProps} from '@material-ui/core/FilledInput';
import {OutlinedInputProps} from '@material-ui/core/OutlinedInput';
import {Visibility, VisibilityOff} from '@material-ui/icons';
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
  label?: ReactNode;
  margin?: 'none' | 'dense' | 'normal';
  placeholder?: string;
  required?: boolean;
  size?: 'small' | 'medium';
  variant?: 'standard' | 'outlined' | 'filled';
};

const HookFormPasswordField = ({
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
  label,
  margin = 'normal',
  placeholder,
  required,
  size,
  variant = 'outlined',
}: Props) => {
  const {errors} = useFormContext();
  const [showPassword, setShowPassword] = React.useState(false);
  const error = errors[name];
  const displayError = Boolean(error?.message);

  const overriddenInputProps = InputProps ?? {};
  overriddenInputProps.endAdornment = (
    <ShowPasswordToggle
      showPassword={showPassword}
      onClickShowPassword={() => setShowPassword(!showPassword)}
    />
  );

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
          InputProps={overriddenInputProps}
          label={label}
          margin={margin}
          onBlur={onBlur}
          onChange={onChange}
          placeholder={placeholder}
          required={required}
          size={size}
          type={showPassword ? 'text' : 'password'}
          value={value ?? ''}
          variant={variant}
        />
      )}
    />
  );
};

type ShowPasswordToggleProps = {
  showPassword: boolean;
  onClickShowPassword: MouseEventHandler<HTMLButtonElement>;
};

const ShowPasswordToggle = ({showPassword, onClickShowPassword}: ShowPasswordToggleProps) => {
  const handleMouseDownPassword = (event: MouseEvent<HTMLButtonElement>) => event.preventDefault();

  return (
    <InputAdornment position="end">
      <IconButton
        aria-label="toggle password visibility"
        onClick={onClickShowPassword}
        onMouseDown={handleMouseDownPassword}
      >
        {showPassword ? <Visibility /> : <VisibilityOff />}
      </IconButton>
    </InputAdornment>
  );
};

export default HookFormPasswordField;
