import 'core-js/stable';
import 'regenerator-runtime/runtime';

import React from 'react';
import {render} from 'react-dom';
import {configureStore} from './util';

// Root needs to stay out here for HMR purposes
import Root from './Root';

const appElement = document.getElementById('app');
const store = configureStore();

render(<Root store={store} />, appElement);
