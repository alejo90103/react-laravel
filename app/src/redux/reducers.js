import { combineReducers } from 'redux';
import { persistReducer } from 'redux-persist';
import { IntlReducer as Intl } from 'react-redux-multilingual'
import storage from 'redux-persist/lib/storage';
import hardSet from 'redux-persist/lib/stateReconciler/hardSet'

import AuthReducer from 'store/Auth/AuthReducer';
import ContactReducer from 'store/Contact/ContactReducer';
import ThemeReducer from 'store/Theme/ThemeReducer';

const persistConfig = {
  key: 'root',
  storage: storage,
  stateReconciler: hardSet
};

const reducers = combineReducers({
  Auth: AuthReducer,
  Contact: ContactReducer,
  Theme: ThemeReducer,
  Intl
});

export default persistReducer(persistConfig, reducers);