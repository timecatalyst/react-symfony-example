import {AxiosResponse} from 'axios';

export type ApiError = {
  response: AxiosResponse<ApiErrorResponseData | string>;
};

export type ApiErrorResponseData = {
  code: number;
  message: string;
  errors: ApiResponseErrors;
};

export type ApiResponseErrors = {
  [field: string]: string[];
};
