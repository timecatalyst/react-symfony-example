/* eslint-disable @typescript-eslint/no-explicit-any */
import axios, {AxiosInstance, AxiosPromise, AxiosRequestConfig} from 'axios';

const createAxiosInstance = (): AxiosInstance =>
  axios.create({
    baseURL: process.env.API_BASE_URL,
  });

export const get = <T = any>(url: string, requestConfig?: AxiosRequestConfig): AxiosPromise<T> =>
  createAxiosInstance().get(url, requestConfig);

export const post = <T = any>(
  url: string,
  data: any,
  requestConfig?: AxiosRequestConfig,
): AxiosPromise<T> => createAxiosInstance().post(url, data, requestConfig);

export const put = <T = any>(
  url: string,
  data: any,
  requestConfig?: AxiosRequestConfig,
): AxiosPromise<T> => createAxiosInstance().put(url, data, requestConfig);

export const patch = <T = any>(
  url: string,
  data: any,
  requestConfig?: AxiosRequestConfig,
): AxiosPromise<T> => createAxiosInstance().patch(url, data, requestConfig);

export const del = <T = any>(url: string, requestConfig?: AxiosRequestConfig): AxiosPromise<T> =>
  createAxiosInstance().delete(url, requestConfig);
