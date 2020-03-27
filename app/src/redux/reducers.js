import { combineReducers } from 'redux';
import { persistReducer } from 'redux-persist';
import storage from 'redux-persist/lib/storage';
import hardSet from 'redux-persist/lib/stateReconciler/hardSet'

import AuthReducer from 'store/Auth/AuthReducer';
import ContactReducer from 'store/Contact/ContactReducer';

const persistConfig = {
  key: 'root',
  storage: storage,
  stateReconciler: hardSet
};

const reducers = combineReducers({
  Auth: AuthReducer,
  Contact: ContactReducer
});

export default persistReducer(persistConfig, reducers);