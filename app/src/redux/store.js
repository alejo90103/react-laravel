
import { createStore, applyMiddleware } from 'redux';
import { persistStore } from 'redux-persist';
import logger from 'redux-logger';
import thunk from 'redux-thunk';

import reducers from 'redux/reducers';

const middleware = applyMiddleware(thunk, logger);

export const store = createStore(reducers, middleware);
export const persistor = persistStore(store);
