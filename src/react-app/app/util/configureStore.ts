/* eslint-disable global-require */
import {configureStore} from '@reduxjs/toolkit';
import thunkMiddleware from 'redux-thunk';
import asyncAwaitMiddleware from 'redux-async-await';
import createRootReducer from '../rootReducer';

const IS_PRODUCTION = process.env.NODE_ENV === 'production';
const middleware = [thunkMiddleware, asyncAwaitMiddleware];
const reducer = createRootReducer();

export default () => {
  const store = configureStore({
    reducer,
    middleware,

    devTools: IS_PRODUCTION || {
      name: 'React Example',
    },
  });

  if (module.hot) {
    module.hot.accept('../rootReducer', () => {
      // eslint-disable-next-line @typescript-eslint/no-var-requires
      const newRootReducer = require('../rootReducer').default;
      store.replaceReducer(newRootReducer);
    });
  }

  return store;
};
