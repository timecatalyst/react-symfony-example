import {ErrorOption, FieldName, FieldValues, UseFormMethods} from 'react-hook-form';

export type HookFormSubmitFunction<TFormValues extends FieldValues> = (
  values: TFormValues,
  formMethods: UseFormMethods<TFormValues>,
) => void | Promise<never>;

export type SetHookFormErrorFunction<TFormValues extends FieldValues> = (
  name: FieldName<TFormValues>,
  error: ErrorOption,
) => void;

export type SetGeneralValidationErrorsFunction = (errors: string[]) => void;
