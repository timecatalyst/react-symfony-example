import React from 'react';
import {FormControlLabel, Radio} from '@material-ui/core';
import {FormProvider, UseFormMethods} from 'react-hook-form';
import {UserSelector} from '../../shared/components';
import {HookFormTextField, HookFormRadioGroup, FormSubmitBar} from '../../forms/components';
import {ArticleFormValues, nameOf} from '../schemas/articleValidationSchema';

interface Props {
  form: UseFormMethods<ArticleFormValues>;
  onSubmit: (_: ArticleFormValues) => void;
  onCancel: () => void;
}

export default ({form, onSubmit, onCancel}: Props) => (
  <FormProvider {...form}>
    <form onSubmit={form.handleSubmit(onSubmit)} noValidate>
      <HookFormTextField name={nameOf('title')} label="Title" />
      <UserSelector name={nameOf('userId')} label="User" />
      <HookFormRadioGroup
        name={nameOf('published')}
        label="Published"
        transformValue={(v: string) => v === 'true'}
      >
        <FormControlLabel value control={<Radio />} label="Yes" />
        <FormControlLabel value={false} control={<Radio />} label="No" />
      </HookFormRadioGroup>
      <FormSubmitBar submitting={form.formState.isSubmitting} onCancel={onCancel} />
    </form>
  </FormProvider>
);
