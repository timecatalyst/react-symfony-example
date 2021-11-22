import React from 'react';
import {FormControlLabel, Radio} from '@material-ui/core';
import {FormProvider, UseFormMethods} from 'react-hook-form';
import {HookFormTextField, HookFormRadioGroup, FormSubmitBar} from '../../forms/components';
import {UserFormValues, nameOf} from '../schemas/userValidationSchema';
import {UserGender} from '../types';

interface Props {
  form: UseFormMethods<UserFormValues>;
  onSubmit: (_: UserFormValues) => void;
  onCancel: () => void;
}

export default ({form, onSubmit, onCancel}: Props) => (
  <FormProvider {...form}>
    <form onSubmit={form.handleSubmit(onSubmit)} noValidate>
      <HookFormTextField name={nameOf('name')} label="Name" />
      <HookFormTextField name={nameOf('email')} label="Email" />
      <HookFormRadioGroup name={nameOf('gender')} label="Gender" fullWidth>
        <FormControlLabel value={UserGender.Male} control={<Radio />} label="Male" />
        <FormControlLabel value={UserGender.Female} control={<Radio />} label="Female" />
      </HookFormRadioGroup>
      <HookFormRadioGroup name={nameOf('active')} label="Active" fullWidth>
        <FormControlLabel value control={<Radio />} label="Yes" />
        <FormControlLabel value={false} control={<Radio />} label="No" />
      </HookFormRadioGroup>
      <FormSubmitBar submitting={form.formState.isSubmitting} onCancel={onCancel} />
    </form>
  </FormProvider>
);
